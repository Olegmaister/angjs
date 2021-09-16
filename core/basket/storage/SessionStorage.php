<?php
namespace core\basket\storage;

class SessionStorage implements StorageInterface
{

    public function load()
    {
        return \Yii::$app->session->get('cart',[]);
    }

    public function save($items)
    {
        \Yii::$app->session->set('cart', $items);
    }
}