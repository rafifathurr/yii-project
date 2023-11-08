<?php

namespace app\models;

/**
 * This is the model class for table "sales_order".
 *
 * @property int $id
 * @property string|null $invoice
 * @property int|null $id_product
 * @property string|null $total_price
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class SalesOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_product', 'date_order', 'invoice', 'qty', 'total_price'], 'required'],
            [['id_product', 'qty', 'total_price'], 'integer'],
            [['invoice'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_order' => 'Date Order',
            'invoice' => 'Invoice',
            'id_product' => 'Product',
            'qty' => 'Qty',
            'total_price' => 'Total Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getProduct()
	{
		return $this->hasOne(Product::class, ['id' => 'id_product']);
	}
}
