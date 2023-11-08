<?php

namespace app\models;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string|null $product_code
 * @property int|null $id_category
 * @property string|null $product_name
 * @property int|null $price
 * @property int|null $stock
 * @property int|null $statusProduct
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_code', 'id_category', 'product_name', 'price', 'stock', 'statusProduct'], 'required'],
            [['id_category', 'price', 'stock', 'statusProduct'], 'integer'],
            [['product_code', 'product_name', 'filePhoto'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'id_category' => 'Category Product',
            'product_name' => 'Product Name',
            'price' => 'Price',
            'stock' => 'Stock',
            'statusProduct' => 'Status',
            'filePhoto' => 'Photo Product',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
        ];
    }

    public function getCategoryProduct()
    {
        return $this->hasOne(CategoryProduct::class, ['id' => 'id_category']);
    }

    public function getStatusProduct($status)
    {
        if ($status == 0) {
            return 'InActive';
        } else {
            return 'Active';
        }
    }
}
