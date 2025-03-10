<?php
require __DIR__ . '/../services/shoppingcartservice.php';

class ShoppingcartController
{
    private $shoppingcartService;

    function __construct()
    {
        $this->shoppingcartService = new ShoppingCartService();
        session_start();
    }

    public function index()
    {
        if (isset($_SESSION['userId'])) {
            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            //update product qty in cart
            if (isset($_GET["qty"])) {
                if ($_GET['action'] == 'update') {
                    $this->shoppingcartService->updateProductQty($_GET["id"], $_SESSION['userId'], $_GET["qty"]);
                    echo "<script>alert('Product qty has been updated in your shopping cart. ')</script>";
                    echo "<script>window.location = '/shoppingcart'</script>";
                }
            }

            //remove product from cart
            if (isset($_POST['remove'])) {
                if ($_GET['action'] == 'remove') {
                    foreach ($cartItems as $cartItem) {
                        $this->shoppingcartService->removeProductFromCart($_GET["id"], $_SESSION['userId']);
                        echo "<script>alert('Product has been removed from your shopping cart. ')</script>";
                        echo "<script>window.location = '/shoppingcart'</script>";
                        $_SESSION['cartcount'] = $count - 1;
                    }
                }
            }

            if (isset($_POST['proceed'])) {
                if ($cartItems > 0) {
                    if (!empty($count)) {
                        echo "<script>window.location = '/orders/checkout'</script>";
                    } else {
                        echo "<script>alert('No product in the shopping cart! Please add products to the cart first!')</script>";
                        echo "<script>window.location = '/page/festival'</script>";
                    }
                }
            }
        } else {
            echo "<script>
                alert('You have to be logged in to see your cart.');
                window.location.href = '/login/index'
                </script>";
        }

        require __DIR__ . '/../views/orders/shopping-cart.php';
    }

    public function checkout()
    {
        if (isset($_SESSION['userId'])) {

            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            require __DIR__ . '/../views/orders/checkout.php';
        } else {
            echo "<script>
                alert('You have to be logged in to see checkout.');
                window.location.href = '/login/index'
                </script>";
        }
    }

    public function sharedCart()
    {
        if (isset($_SESSION['userId'])) {
            if (isset($_GET['id']) && isset($_GET['qty'])) {
                $ids = $_GET['id'];
                $qtys = $_GET['qty'];
                for ($i = 0; $i < count($ids); $i++) {
                    $cartItem = new ShoppingCartItem();
                    $cartItem->setUser_id($_SESSION['userId']);
                    $cartItem->setProduct_id(intval($ids[$i]));
                    $cartItem->setQty(intval($qtys[$i]));

                    //if item already exists in shopping cart, skip it
                    if ($this->shoppingcartService->checkIfProductExistsInCart($_SESSION['userId'], intval($ids[$i]))) {
                        continue;
                    }

                    $this->shoppingcartService->addProductToCart($cartItem);
                }
            }

            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $_SESSION['cartcount'] = $this->shoppingcartService->countProducts($_SESSION['userId']);

            require __DIR__ . '/../views/orders/shopping-cart.php';
        } else {
            echo "<script>
                alert('Log in before importing a shopping cart.');
                window.location.href = '/login/index'
                </script>";
        }
    }
}
