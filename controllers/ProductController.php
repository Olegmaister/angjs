<?php
namespace app\controllers;

use core\readModels\ProductReadRepository;
use yii\web\Controller;

class ProductController extends Controller
{
    private $readRepository;
    public function __construct(
        $id,
        $module,
        ProductReadRepository $readRepository,
        $config = [])
    {
        $this->readRepository = $readRepository;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $products = $this->readRepository->getProducts();

        return $this->asJson([
                'products' => $products,
                'path' => \Yii::getAlias('@web/uploads/')
            ]
        );

    }
}