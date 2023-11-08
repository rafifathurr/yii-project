<?php

use app\models\SalesOrder;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\SalesOrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sales Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sales Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'header' => 'No',
                'class' => 'yii\grid\SerialColumn'
            ],
            'invoice',
            [
                'attribute' => 'date_order',
                'label' => 'Date Order',
                'value' => function ($model) {
                    if ($model->date_order !== NULL) {
                        return date('j M Y', strtotime($model->date_order));
                    } else {
                        return "-";
                    }
                },
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_order',
                    'convertFormat' => true,
                    'type' => DatePicker::TYPE_INPUT,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-MM-dd'
                    ],
                ]),
                'contentOptions' => ['style' => 'width:10%;', 'class' => 'text-center'],
            ],
            [
                'attribute' => 'id_product',
                'value' => function ($model) {
                    return $model->product->product_name;
                },
            ],
            [
                'attribute' => 'qty',
                'contentOptions' => ['style' => 'width:10%;', 'class' => 'text-end'],
            ],
            [
                'attribute' => 'total_price',
                'format' => 'currency',
                'contentOptions' => ['class' => 'text-end'],
            ],
            [
                'header' => 'Action',
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SalesOrder $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>


</div>