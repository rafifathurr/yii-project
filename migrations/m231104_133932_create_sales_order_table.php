<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sales_order}}`.
 */
class m231104_133932_create_sales_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sales_order}}', [
            'id' => $this->primaryKey(),
            'date_order' => $this->date(),
            'invoice' => $this->string(),
            'id_product' => $this->integer(),
            'qty' => $this->bigInteger(),
            'total_price' => $this->bigInteger(),
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
        $this->dropTable('{{%sales_order}}');
    }
}
