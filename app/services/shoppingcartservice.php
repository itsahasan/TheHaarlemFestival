<?php
require __DIR__ . '/../repositories/shoppingcartrepository.php';

class ShoppingCartService
{
    private $shoppingcartRepository;

    public function __construct()
    {
        $this->shoppingcartRepository = new ShoppingCartRepository();
    }

    public function checkIfProductExistsInCart($user_id, $product_id)
    {
        return $this->shoppingcartRepository->checkIfProductExistsInCart($user_id, $product_id);
    }

    public function addProductToCart(ShoppingCartItem $shoppingCartItem)
    {
        return $this->shoppingcartRepository->addProductToCart($shoppingCartItem);
    }

    public function updateProductQty($product_id, $user_id, $qty)
    {
        return $this->shoppingcartRepository->updateProductQty($product_id, $user_id, $qty);
    }

    public function removeProductFromCart($product_id, $user_id)
    {
        return $this->shoppingcartRepository->removeProductFromCart($product_id, $user_id);
    }

    public function getShoppingCartByUserId($user_id)
    {
        return $this->shoppingcartRepository->getShoppingCartByUserId($user_id);
    }

    public function countProducts($user_id)
    {
        return $this->shoppingcartRepository->countProducts($user_id);
    }

    public function emptyCartByUserId($user_id)
    {
        return $this->shoppingcartRepository->emptyCartByUserId($user_id);
    }
}
