<?php
require __DIR__ . '/../models/shoppingcartitem.php';

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

            $stmt->bindValue(":user_id", $shoppingCartItem->getUser_id());
            $stmt->bindValue(":product_id", $shoppingCartItem->getProduct_id());
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
            $stmt = $this->connection->prepare("SELECT subq.event_id as id,
            COALESCE(NULLIF(subq.event_name,''), 'History Event') AS event_name,
            COALESCE(NULLIF(subq.event_price,''), 0) AS event_price,
            ci.qty, ci.qty * COALESCE(NULLIF(subq.event_price,''), 0) AS subtotal
            FROM shopping_cart_items ci
            LEFT JOIN (
            SELECT music_event.id as event_id, artist.name as event_name, music_event.ticket_price as event_price, music_event.datetime as event_datetime, venue.name as event_location, music_event.tickets_available as stock, music_event.type as event_type
            FROM music_event 
            LEFT JOIN venue as venue ON venue.id = music_event.venue
            LEFT JOIN artist as artist ON artist.id = music_event.artist
            UNION
            SELECT id as event_id, ticketpass.name as event_name, ticketpass.price as event_price, ticketpass.datetime as event_datetime, 'Haarlem' as event_location, 'no limit' as stock, ticketpass.type as event_type
            FROM ticketpass 
            UNION
            SELECT id as event_id, 'History Event' as event_name, history_event.price as event_price, history_event.datetime as event_datetime, history_event.location as event_location, history_event.tickets_available as stock, 'history' as event_type
            FROM history_event 
            UNION
            SELECT reservation.id as event_id, CONCAT('Reservation at ', restaurant.name) as event_name, reservation.price as event_price, reservation.date as event_datetime, restaurant.name as event_location, reservation.seats as stock, 'food' as event_type
            FROM reservation 
            LEFT JOIN restaurant as restaurant on restaurant.id = reservation.restaurantID
            ) AS subq ON subq.event_id = ci.product_id
            WHERE ci.user_id=:user_id");

            $user_id = htmlspecialchars(strip_tags($user_id));

            $stmt->bindParam(":user_id", $user_id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'ShoppingCartItem');
            $item = $stmt->fetchAll();

            return $item;
        } catch (PDOException $e) {
            echo $e;
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
