<?php
namespace core\services;

use core\basket\Basket;
use core\basket\BasketItem;
use core\repositories\ProductRepository;

class BasketService
{
    private $basket;
    private $products;
    public function __construct(Basket $basket, ProductRepository $products)
    {
        $this->basket = $basket;
        $this->products = $products;
    }
    public function add(int $id, $quantity)
    {
        $product = $this->products->get($id);
        $this->basket->add(new BasketItem($product, $quantity));

    }

    public function remove($key)
    {
        $this->basket->remove($key);
    }
}