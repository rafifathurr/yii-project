<?php

use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;

/** @var yii\web\View $this */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    <div class="row">
        <!-- COLUMN CHART -->
        <div class="col-md-6">
            <?= Highcharts::widget([
                'options' => [
                    'chart' => [
                        'type' => 'column'
                    ],
                    'title' => ['text' => 'Sales Order on ' . date('Y')],
                    'xAxis' => [
                        'categories' => $columnChartCat
                    ],
                    'yAxis' => [
                        'title' => ['text' => 'Total Data']
                    ],
                    'series' => [
                        ['name' => 'Total Sales Order', 'data' => $dataColumnChart]
                    ],
                    'legend' => [
                        'enabled' => false,
                    ]
                ]
            ]); ?>
        </div>
        <!-- CIRCLE CHART -->
        <?php
        $circleChart = array();
        $chartCircleData = array();
        foreach ($dataCircleChart as $chartData) {
            array_push($chartCircleData, [$chartData['product_name'], round(($chartData['total'] / $totalData * 100), 2)]);
        }
        ?>
        <div class="col-md-6">
            <?= Highcharts::widget([
                'options' => [
                    'title' => ['text' => 'Products Best Seller on ' . date("F", mktime(0, 0, 0, date('m'), 10))],
                    'plotOptions' => [
                        'pie' => [
                            'cursor' => 'pointer',
                        ],
                    ],
                    'series' => [
                        [
                            'type' => 'pie',
                            'name' => 'Percentage (%) ',
                            'data' => $chartCircleData
                        ]
                    ],
                    
                ],
            ]); ?>
        </div>
    </div>

</div>