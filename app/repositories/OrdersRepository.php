<?php
// repositories/OrdersRepository.php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';

class OrdersRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $configPath = __DIR__ . '/../config/dbconfig.php';
        if (!file_exists($configPath)) { throw new \RuntimeException("Missing config file: $configPath"); }
        require $configPath;
        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', $type, $servername, $database);
        try {
            $this->connection = new \PDO($dsn, $username, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            error_log("DB connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * ДОБАВЛЕНО ОБРАТНО: Сохраняет ID платежа от Mollie в заказ
     */
    public function addPayment(int $id, string $paymentId): bool
    {
        try {
            $stmt = $this->connection->prepare(
                "UPDATE orders SET paymentId = :paymentId WHERE id = :id"
            );
            return $stmt->execute([
                ':paymentId' => $paymentId,
                ':id'        => $id
            ]);
        } catch (\PDOException $e) {
            error_log("addPayment error: " . $e->getMessage());
            return false;
        }
    }

    public function checkTicketsAvailable(int $product_id, int $quantity): bool
    {
        $query = "
            SELECT stock FROM (
                SELECT tickets_available as stock FROM music_event WHERE id = :productId1
                UNION ALL
                SELECT tickets_available as stock FROM history_event WHERE id = :productId2
                UNION ALL
                SELECT available_seats as stock FROM food_session WHERE id = :productId3
                UNION ALL
                SELECT 99999 as stock FROM ticketpass WHERE id = :productId4
                UNION ALL
                SELECT 1 as stock FROM reservation WHERE id = :productId5
            ) as available_stock
        ";
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute([
                ':productId1' => $product_id, ':productId2' => $product_id,
                ':productId3' => $product_id, ':productId4' => $product_id,
                ':productId5' => $product_id,
            ]);
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$result) { return false; }
            return (int)$result['stock'] >= $quantity;
        } catch (\PDOException $e) {
            die("DATABASE ERROR IN checkTicketsAvailable(): " . $e->getMessage());
        }
    }

    public function updateTicketsAvailable(int $product_id, int $qty): bool
    {
        $tables = ['music_event', 'history_event', 'food_session'];
        foreach ($tables as $table) {
            $column = ($table === 'food_session') ? 'available_seats' : 'tickets_available';
            try {
                $stmt = $this->connection->prepare("
                    UPDATE {$table} SET {$column} = {$column} - :qty WHERE id = :product_id AND {$column} >= :qty
                ");
                $stmt->execute([':qty' => $qty, ':product_id' => $product_id]);
                if ($stmt->rowCount() > 0) {
                    return true;
                }
            } catch (\PDOException $e) {
                error_log("updateTicketsAvailable error on table {$table}: " . $e->getMessage());
            }
        }
        return true;
    }

    public function placeOrder(Order $order): ?Order
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO orders (firstName, lastName, birthdate, emailAddress, streetAddress, country, zipCode, phoneNumber, user_id, totalprice, payment_status)
                 VALUES (:firstName, :lastName, :birthdate, :emailAddress, :streetAddress, :country, :zipCode, :phoneNumber, :user_id, :totalprice, 'pending')"
            );
            $stmt->execute([
                ':firstName' => $order->getFirstName(), ':lastName' => $order->getLastName(),
                ':birthdate' => $order->getBirthDate(), ':emailAddress' => $order->getEmailAddress(),
                ':streetAddress' => $order->getStreetAddress(), ':country' => $order->getCountry(),
                ':zipCode' => $order->getZipCode(), ':phoneNumber' => $order->getPhoneNumber(),
                ':user_id' => $order->getUserId(), ':totalprice' => $order->getTotalPrice(),
            ]);
            $order->setId((int)$this->connection->lastInsertId());
            return $this->getById($order->getId());
        } catch (\PDOException $e) {
            error_log("placeOrder error: " . $e->getMessage());
            return null;
        }
    }

    public function placeOneOrderItem(OrderItem $orderItem): ?OrderItem
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO orders_item (order_id, product_id, qty, price) VALUES (:order_id, :product_id, :qty, :price)"
            );
            $stmt->execute([
                ':order_id'   => $orderItem->getOrder_id(),
                ':product_id' => $orderItem->getProduct_id(),
                ':qty'        => $orderItem->getQty(),
                ':price'      => $orderItem->getPrice(),
            ]);
            $orderItem->setId((int)$this->connection->lastInsertId());
            return $this->getOneOrderItem($orderItem->getId());
        } catch (\PDOException $e) {
            error_log("placeOneOrderItem error: " . $e->getMessage());
            return null;
        }
    }

    public function getById(int $id): ?Order
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Order::class);
            return $stmt->fetch() ?: null;
        } catch (\PDOException $e) {
            error_log("getById error: " . $e->getMessage());
            return null;
        }
    }

    public function getOneOrderItem(int $id): ?OrderItem
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM orders_item WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, OrderItem::class);
            return $stmt->fetch() ?: null;
        } catch (\PDOException $e) {
            error_log("getOneOrderItem error: " . $e->getMessage());
            return null;
        }
    }

    public function deleteOrderById(int $orderId): bool
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM orders WHERE id = :id");
            return $stmt->execute([':id' => $orderId]);
        } catch (\PDOException $e) {
            error_log("deleteOrderById error: " . $e->getMessage());
            return false;
        }
    }

    public function markAsPaid(int $orderId): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE orders SET payment_status = 'paid' WHERE id = :id");
            return $stmt->execute([':id' => $orderId]);
        } catch (\PDOException $e) {
            error_log("markAsPaid error: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItemsByOrderId(int $orderId): array
    {
        try {
            $stmt = $this->connection->prepare("
            SELECT oi.*, 
                   (SELECT event_name FROM v_events WHERE event_id = oi.product_id) as event_name
            FROM orders_item oi 
            WHERE order_id = :orderId
        ");
            $stmt->execute([':orderId' => $orderId]);
            return $stmt->fetchAll(\PDO::FETCH_CLASS, OrderItem::class);
        } catch (\PDOException $e) {
            error_log("getOrderItemsByOrderId error: " . $e->getMessage());
            return [];
        }
    }
}