<?php
require_once 'basecontroller.php';

class Cartcontroller extends BaseController
{
    // Cart
    public function handleAddToCart($cartService): void
    {
        if (isset($_POST['add-to-cart'])) {
            $this->requireLogin();
            $user_id = $_SESSION['userId'];
            $product_id = $this->getPost("product_id");
            $qty = 1;

            if ($cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                $this->showAlert(false, '', 'This product is already in your shopping cart.');
            } else {
                $cartItem = new ShoppingCartItem();
                $cartItem->setUser_id($user_id);
                $cartItem->setProduct_id($product_id);
                $cartItem->setQty($qty);
                $cartService->addProductToCart($cartItem);
                $_SESSION['cartcount']++;

                $this->showAlert(true, 'This product successfully added to your cart', '');
            }
        }
    }
}