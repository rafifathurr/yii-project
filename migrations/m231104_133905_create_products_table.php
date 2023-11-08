<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m231104_133905_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'product_code' => $this->string(),
            'id_category' => $this->integer(),
            'product_name' => $this->string(),
            'price' => $this->bigInteger(),
            'stock' => $this->bigInteger(),
            'statusProduct' => $this->integer(),
            'filePhoto' => $this->string(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'deleted_at' => $this->timestamp()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
