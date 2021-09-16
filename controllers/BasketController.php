<?php
namespace app\controllers;

use core\basket\Basket;
use core\basket\BasketItem;
use core\services\BasketService;
use yii\web\Controller;

class BasketController extends Controller
{
    private $service;
    private $basket;

    public function __construct(
        $id,
        $module,
        BasketService $service,
        Basket $basket,
        $config = [])
    {
        $this->basket = $basket;
        $this->service = $service;
        $this->enableCsrfValidation = false;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {

        $basket = $this->basket->getItems();

        $products = [];

        /** @var $item BasketItem*/
        foreach ($basket as $item) {
            $products[] = [
                'name'=> $item->getName(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQuantity(),
                'description' => $item->getDescription(),
            ];
        }

        return $this->render('index');
    }

    public function actionGetBasket()
    {
        $basket = $this->basket->getItems();

        $products = [];

        /** @var $item BasketItem*/
        foreach ($basket as $item) {
            $products[] = [
                'key' => $item->getKey(),
                'name'=> $item->getName(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQuantity(),
                'description' => $item->getDescription(),
            ];
        }

        $products['total'] = $this->basket->getCost();

        return $this->asJson([
                'products' => $products
            ]
        );
    }

    public function actionAdd()
    {
        $id = \Yii::$app->request->get('id');
        $quantity = \Yii::$app->request->get('quantity');
        $this->service->add($id, $quantity);


        return $this->asJson([
                'totalBasket' => $this->basket->getCost(),
                'countBasket' => $this->basket->getCount()
            ]
        );
    }

    public function actionRemove()
    {
        $key = \Yii::$app->request->get('key');
        $this->service->remove($key);

    }

    public function actionInfo()
    {
        return $this->asJson([
                'totalBasket' => $this->basket->getCost(),
                'countBasket' => $this->basket->getCount()
            ]
        );
    }
}