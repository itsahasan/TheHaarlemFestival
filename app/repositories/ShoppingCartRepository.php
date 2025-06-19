<?php
require __DIR__ . '/../models/ShoppingCartItem.php';

class ShoppingCartRepository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function checkIfProductExistsInCart($user_id, $product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT count(*) FROM shopping_cart_items WHERE user_id=:user_id AND product_id=:product_id");

            $user_id = htmlspecialchars(strip_tags($user_id));
            $product_id = htmlspecialchars(strip_tags($product_id));

            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":product_id", $product_id);

            $stmt->execute();

            $rows = $stmt->fetch(PDO::FETCH_NUM);

            if ($rows[0] > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function addProductToCart(ShoppingCartItem $shoppingCartItem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO shopping_cart_items(user_id, product_id, qty) VALUES (:user_id, :product_id, :qty)");

            $stmt->bindValue(":user_id", $shoppingCartItem->getUserid());
            $stmt->bindValue(":product_id", $shoppingCartItem->getProductid());
            $stmt->bindValue(":qty", $shoppingCartItem->getQty());

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateProductQty($product_id, $user_id, $qty)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE shopping_cart_items SET qty=:qty WHERE product_id=:product_id AND user_id=:user_id");

            $product_id = htmlspecialchars(strip_tags($product_id));
            $user_id = htmlspecialchars(strip_tags($user_id));
            $qty = htmlspecialchars(strip_tags($qty));

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":qty", $qty);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function removeProductFromCart($product_id, $user_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM shopping_cart_items WHERE user_id=:user_id AND product_id=:product_id");

            $product_id = htmlspecialchars(strip_tags($product_id));
            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":product_id", $product_id);
            $stmt->bindParam(":user_id", $user_id);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function emptyCartByUserId($user_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM shopping_cart_items WHERE user_id=:user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));
            $stmt->bindParam(":user_id", $user_id);

            if ($stmt->execute()){
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getShoppingCartByUserId($user_id)
    {
        try {
            // Я поправил SELECT часть, чтобы включить все нужные поля из таблицы `ci` (shopping_cart_items)
            $stmt = $this->connection->prepare("
            SELECT
                ci.id,
                ci.user_id,
                ci.product_id,
                ci.qty,
                COALESCE(NULLIF(subq.event_name, ''), 'Event') AS event_name,
                COALESCE(subq.event_price, 0) AS event_price,
                ci.qty * COALESCE(subq.event_price, 0) AS subtotal
            FROM
                shopping_cart_items AS ci
            LEFT JOIN (
                SELECT
                    music_event.id AS event_id,
                    artist.name AS event_name,
                    music_event.ticket_price AS event_price
                FROM music_event
                LEFT JOIN artist ON artist.id = music_event.artist
                UNION
                SELECT
                    id AS event_id,
                    name AS event_name,
                    price AS event_price
                FROM ticketpass
                UNION
                SELECT
                    id AS event_id,
                    'History Event' AS event_name,
                    price AS event_price
                FROM history_event
                UNION
                SELECT
                    reservation.id AS event_id,
                    CONCAT('Reservation at ', restaurant.name) AS event_name,
                    reservation.price AS event_price
                FROM reservation
                LEFT JOIN restaurant ON restaurant.id = reservation.restaurantID
            ) AS subq ON subq.event_id = ci.product_id
            WHERE
                ci.user_id = :user_id
        ");

            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ShoppingCartItem');
            $items = $stmt->fetchAll();

            return $items;

        } catch (PDOException $e) {
            // В реальном проекте здесь должно быть логирование, а не echo
            error_log("ShoppingCartRepository Error: " . $e->getMessage());
            return []; // Возвращаем пустой массив в случае ошибки
        }
    }

    function countProducts($user_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT count(*) FROM shopping_cart_items WHERE user_id=:user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $rows = $stmt->fetch(PDO::FETCH_NUM);

            return $rows[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function removeProducts($user_id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM shopping_cart_items
            WHERE user_id = :userId;");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":userId", $user_id);

            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
