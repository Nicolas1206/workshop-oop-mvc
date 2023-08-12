<?php

namespace controllers;

use models\Product;

class ProductController extends Product
{
    public function showHome(): void
    {
        $products = Product::getAllProduct();

        include_once "views/layout/header.view.php";
        include_once "views/index.view.php";
        include_once "views/layout/footer.view.php";
    }

    public function showProductInfo(string $productCode): void
    {
        $productInfo = Product::getProductInfo($productCode);

        include_once "views/layout/header.view.php";
        include_once "views/product.view.php";
        include_once "views/layout/footer.view.php";
    }
}
