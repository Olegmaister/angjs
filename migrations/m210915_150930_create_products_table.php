<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m210915_150930_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'price' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'image' => $this->string(255)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable('{{%products}}');
    }
}
