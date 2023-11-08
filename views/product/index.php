<?php

use app\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'attribute' => 'product_code',
                'contentOptions' => ['style' => 'width:10%;'],
            ],
            'product_name',
            [
                'attribute' => 'id_category',
                'value' => function ($model) {
                    return $model->categoryProduct->category_name;
                },
            ],
            [
                'attribute' => 'price',
                'format' => 'currency',
                'contentOptions' => ['class' => 'text-end'],
            ],
            [
                'header' => 'Action',
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Product $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'contentOptions' => ['class' => 'text-center'],
            ],
        ],
    ]); ?>


</div>