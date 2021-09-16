<?php

namespace core\entities;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $description
 * @property string $image
 */
class Product extends ActiveRecord
{

    public static function create($name,$price,$description)
    {
        $object = new self();
        $object->name = $name;
        $object->price = $price;
        $object->description = $description;

        return $object;
    }

    public function edit($name,$price,$description)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    public function assignImage(UploadedFile $image)
    {
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

}
