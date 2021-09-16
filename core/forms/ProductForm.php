<?php
namespace core\forms;

use core\entities\Product;
use yii\base\Model;

class ProductForm extends Model
{
    public $name;
    public $price;
    public $description;
    public $image;

    public function __construct(Product $product = null, $config = [])
    {
        if($product){
            $this->name = $product->name;
            $this->price = $product->price;
            $this->description = $product->description;
            $this->image = $product->image;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'price', 'description'], 'required'],
            [['image'], 'file'],
            [['price'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
            'image' => 'Image',
        ];
    }
}