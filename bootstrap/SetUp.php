<?php

namespace app\bootstrap;


use core\basket\Basket;
use core\basket\storage\SessionStorage;
use yii\base\BootstrapInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = \Yii::$container;

        $container->setSingleton(Basket::class, function () use ($app) {
            return new Basket(
                new SessionStorage()
            );
        });
    }
}