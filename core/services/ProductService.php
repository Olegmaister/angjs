<?php
namespace core\services;

use core\entities\Product;
use core\forms\ProductForm;
use core\repositories\ProductRepository;

class ProductService
{
    private $products;
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function create(ProductForm $form) : Product
    {

        $product = Product::create(
            $form->name,
            $form->price,
            $form->description
        );

        $fileName = $product->assignImage($form->image);

        $this->products->save($product);
        $form->image->saveAs('uploads/' . $form->image->baseName . '.' . $form->image->extension);

        return $product;
    }

    public function edit(ProductForm $form, int $id) : void
    {
        $product = $this->products->get($id);
        $product->edit(
            $form->name,
            $form->price,
            $form->description);

        $this->products->save($product);
    }

    public function remove(int $id)
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}