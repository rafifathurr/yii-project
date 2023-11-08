<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesOrder;

/**
 * SalesOrderSearch represents the model behind the search form of `app\models\SalesOrder`.
 */
class SalesOrderSearch extends SalesOrder
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'qty', 'total_price'], 'integer'],
            [['invoice'], 'string'],
            [['date_order', 'id_product'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SalesOrder::find()->innerJoinWith('product', true);;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort = [
            'defaultOrder' => ['date_order' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_order' => $this->date_order,
            'invoice' => $this->invoice,
        ])
            ->andWhere(['sales_order.deleted_at'  => null]);

        $query->andFilterWhere(['like', 'invoice', $this->invoice])
            ->andFilterWhere(['like', 'product_name', $this->id_product])
            ->andFilterWhere(['like', 'total_price', $this->total_price]);

        return $dataProvider;
    }
}
