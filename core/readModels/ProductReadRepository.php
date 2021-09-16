<?php
namespace core\readModels;

use core\entities\Product;

class ProductReadRepository
{
    public function getProducts()
    {
        return Product::find()->all();
    }
}