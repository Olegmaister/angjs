<?php
namespace core\basket;

use core\entities\Product;

class BasketItem
{
    private $key;
    private $product;
    private $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->key = md5($product->id);
        $this->product = $product;
        $this->quantity = $quantity;
    }


    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->product->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->product->name;
    }


    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->product->price;
    }

    public function changeQuantity($quantity)
    {
        return new static($this->product,$this->quantity + $quantity);
    }

}