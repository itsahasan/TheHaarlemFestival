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
        if (!file_exists($configPath)) {
            throw new \RuntimeException("Missing config file: $configPath");
        }
        require $configPath;

        if ($type === 'mysql' && !in_array('mysql', \PDO::getAvailableDrivers(), true)) {
            throw new \RuntimeException("PDO MySQL driver not installed");
        }

        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', $type, $servername, $database);
        try {
            $this->connection = new \PDO($dsn, $username, $password, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]);
        } catch (\PDOException $e) {
            error_log("DB connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    // ИСПРАВЛЕНО: тип возвращаемого значения и setFetchMode
    public function getOnePlacedOrder(int $id): ?Order
    {
        try {
            $stmt = $this->connection->prepare(
                "SELECT * FROM orders WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Order::class);
            return $stmt->fetch() ?: null;
        } catch (\PDOException $e) {
            error_log("getOnePlacedOrder error: " . $e->getMessage());
            return null;
        }
    }

    // ИСПРАВЛЕНО: тип возвращаемого значения и setFetchMode
    public function getOneOrderItem(int $id): ?OrderItem
    {
        try {
            $stmt = $this->connection->prepare(
                "SELECT * FROM orders_item WHERE id = :id"
            );
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, OrderItem::class);
            return $stmt->fetch() ?: null;
        } catch (\PDOException $e) {
            error_log("getOneOrderItem error: " . $e->getMessage());
            return null;
        }
    }

    // ИСПРАВЛЕНО: тип аргумента и возвращаемого значения
    public function placeOrder(Order $order): ?Order
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO orders (firstName, lastName, birthdate, emailAddress, streetAddress, country, zipCode, phoneNumber, user_id, totalprice)
                 VALUES (:firstName, :lastName, :birthdate, :emailAddress, :streetAddress, :country, :zipCode, :phoneNumber, :user_id, :totalprice)"
            );
            $stmt->execute([
                ':firstName'     => $order->getFirstName(),
                ':lastName'      => $order->getLastName(),
                ':birthdate'     => $order->getBirthDate(),
                ':emailAddress'  => $order->getEmailAddress(),
                ':streetAddress' => $order->getStreetAddress(),
                ':country'       => $order->getCountry(),
                ':zipCode'       => $order->getZipCode(),
                ':phoneNumber'   => $order->getPhoneNumber(),
                ':user_id'       => $order->getUserId(),
                ':totalprice'    => $order->getTotalPrice(),
            ]);
            $order->setId((int)$this->connection->lastInsertId());
            return $this->getOnePlacedOrder($order->getId());
        } catch (\PDOException $e) {
            error_log("placeOrder error: " . $e->getMessage());
            return null;
        }
    }

    // ИСПРАВЛЕНО: setFetchMode
    public function getAllOrders(): array
    {
        try {
            $stmt = $this->connection->query("SELECT * FROM orders");
            $stmt->setFetchMode(\PDO::FETCH_CLASS, Order::class);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("getAllOrders error: " . $e->getMessage());
            return [];
        }
    }

    // ИСПРАВЛЕНО: setFetchMode
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

    public function addPayment(int $id, string $paymentId): bool
    {
        try {
            $stmt = $this->connection->prepare("UPDATE orders SET paymentId = :paymentId WHERE id = :id");
            return $stmt->execute([':paymentId' => $paymentId, ':id' => $id]);
        } catch (\PDOException $e) {
            error_log("addPayment error: " . $e->getMessage());
            return false;
        }
    }

    // ДОБАВЛЕНО: Новый метод для обновления деталей заказа
    public function updateOrderDetails(Order $order): bool
    {
        try {
            $stmt = $this->connection->prepare(
                "UPDATE orders SET firstName = :firstName, lastName = :lastName, birthdate = :birthdate, 
                 streetAddress = :streetAddress, country = :country, zipCode = :zipCode, phoneNumber = :phoneNumber
                 WHERE id = :id"
            );
            return $stmt->execute([
                ':firstName'     => $order->getFirstName(),
                ':lastName'      => $order->getLastName(),
                ':birthdate'     => $order->getBirthDate(),
                ':streetAddress' => $order->getStreetAddress(),
                ':country'       => $order->getCountry(),
                ':zipCode'       => $order->getZipCode(),
                ':phoneNumber'   => $order->getPhoneNumber(),
                ':id'            => $order->getId(),
            ]);
        } catch (\PDOException $e) {
            error_log("updateOrderDetails error: " . $e->getMessage());
            return false;
        }
    }

    // ДОБАВЛЕНО: Новый метод для отметки заказа как оплаченного
    public function markAsPaid(int $orderId): bool
    {
        try {
            // Здесь можно добавить поле isPaid, но для простоты будем считать, что наличие paymentId это подтверждает
            // Для реального приложения лучше иметь отдельный статус
            $stmt = $this->connection->prepare("UPDATE orders SET payment_status = 'paid' WHERE id = :id");
            return $stmt->execute([':id' => $orderId]);
        } catch (\PDOException $e) {
            error_log("markAsPaid error: " . $e->getMessage());
            return false;
        }
    }

    // ИСПРАВЛЕНО: тип аргумента
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

    public function updateTicketsAvailable(int $product_id, int $qty): bool
    {
        // Этот массив определяет, в каких таблицах искать билеты/места
        $tables = ['music_event', 'history_event', 'food_session'];

        foreach ($tables as $table) {
            // В таблице food_session колонка называется 'available_seats', в остальных 'tickets_available'
            $column = ($table === 'food_session') ? 'available_seats' : 'tickets_available';

            try {
                // Пытаемся обновить количество в текущей таблице
                $stmt = $this->connection->prepare("
                    UPDATE {$table}
                       SET {$column} = {$column} - :qty
                     WHERE id = :product_id AND {$column} >= :qty
                ");

                $stmt->execute([':qty' => $qty, ':product_id' => $product_id]);

                // Если мы обновили хотя бы одну строку, значит, товар найден и можно выходить
                if ($stmt->rowCount() > 0) {
                    return true;
                }
            } catch (\PDOException $e) {
                // Просто логируем ошибку и продолжаем, чтобы проверить следующую таблицу
                error_log("updateTicketsAvailable error on table {$table}: " . $e->getMessage());
            }
        }

        // Если мы прошли все таблицы и ничего не обновили, возвращаем false
        return false;
    }
}