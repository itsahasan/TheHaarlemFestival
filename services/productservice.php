<?php
require __DIR__ . '/../repositories/productrepository.php';

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function getOneProduct($product_id)
    {
        return $this->productRepository->getOneProduct($product_id);
    }
}
