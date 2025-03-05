<?php
require __DIR__ . '/../models/product.php';

class ProductRepository
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

    function getOneProduct($product_id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT music_event.id as event_id, artist.name as event_name, music_event.ticket_price as event_price, music_event.datetime as event_datetime, venue.name as event_location, music_event.tickets_available as stock, music_event.type as event_type
            FROM music_event 
            LEFT JOIN venue as venue ON venue.id = music_event.venue
            LEFT JOIN artist as artist ON artist.id = music_event.artist
            WHERE music_event.id=:id
            UNION
            SELECT id as event_id, ticketpass.name as event_name, ticketpass.price as event_price, ticketpass.datetime as event_datetime, 'Haarlem' as event_location, 'no limit' as stock, ticketpass.type as event_type
            FROM ticketpass WHERE ticketpass.id=:id
            UNION
            SELECT id as event_id, 'History Event' as event_name, history_event.price as event_price, history_event.datetime as event_datetime, history_event.location as event_location, history_event.tickets_available as stock, 'history' as event_type
            FROM history_event WHERE history_event.id=:id
            UNION
            SELECT reservation.id as event_id, CONCAT('Reservation at ', restaurant.name) as event_name, reservation.price as event_price, reservation.date as event_datetime, restaurant.name as event_location, reservation.seats as stock, 'food' as event_type
            FROM reservation 
            LEFT JOIN restaurant as restaurant on restaurant.id = reservation.restaurantID
            WHERE reservation.id=:id");
            // SELECT product.id as event_id,
            // COALESCE(NULLIF(artist.name,''), NULLIF(ticketpass.name,''), 'History Event') AS event_name,
            // COALESCE(NULLIF(events.ticket_price,''), NULLIF(ticketpass.price,''), NULLIF(merchandise.price,''), 0) AS event_price,
            // COALESCE(NULLIF(events.datetime,''), NULLIF(ticketpass.datetime,''), merchandise.datetime) AS event_datetime,
            // COALESCE(NULLIF(venue.name,''), merchandise.location, 'Everywhere') AS event_location,
            // COALESCE(NULLIF(events.tickets_available,''), merchandise.tickets_available, '10000') AS tickets_available,
            // COALESCE(NULLIF(events.type,''), NULLIF(ticketpass.type,''), 'history') AS event_type
            // FROM product as product
            // LEFT JOIN music_event as events on 
            // (product.id = events.product_id AND product.eventId = events.id)
            // LEFT JOIN history_event as merchandise on
            // (product.id=merchandise.product_id AND product.eventId = merchandise.id)
            // LEFT JOIN ticketpass as ticketpass ON
            // (product.id=ticketpass.product_id AND product.eventId=ticketpass.id)
            // LEFT JOIN venue as venue ON venue.id = events.venue
            // LEFT JOIN artist as artist ON artist.id = events.artist
            // WHERE product.id=:id
            $stmt->bindParam(':id', $product_id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Product');
            $product = $stmt->fetch();

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
