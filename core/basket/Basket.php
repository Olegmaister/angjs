<?php
namespace core\basket;

use core\basket\storage\StorageInterface;

class Basket
{
    private $storage;
    private $items;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }
    public function add(BasketItem $item)
    {
        //unset(\Yii::$app->session['cart']);
        $this->load();
        /** @var $current BasketItem*/
        foreach ($this->items as $i=>$current) {
            if($current->getKey() == $item->getKey()){
               $this->items[$i] = $current->changeQuantity($item->getQuantity());
               $this->save();
               return;
            }
        }

        $this->items[] = $item;
        $this->save();

    }

    public function getItems()
    {
        $this->load();
        return $this->items;
    }

    public function getCost()
    {
        $this->load();
        $cost = 0;
        /** @var $item BasketItem*/
        foreach ($this->items as $item) {
            $cost += $item->getPrice() * $item->getQuantity();
        }

        return $cost;
    }

    public function getCount()
    {
        $this->load();
        $count = 0;

        /** @var $item BasketItem*/
        foreach ($this->items as $item) {
            $count += $item->getQuantity();
        }


        return $count;

    }

    public function remove($key)
    {
        $this->load();
        /** @var $current BasketItem*/
        foreach ($this->items as $i=>$current) {
            if($current->getKey() == $key){
                unset($this->items[$i]);
                $this->save();
                return;
            }
        }
    }

    private function load()
    {
        if ($this->items === null) {
            $this->items = $this->storage->load();
        }
    }

    private function save()
    {
        $this->storage->save($this->items);
    }
}