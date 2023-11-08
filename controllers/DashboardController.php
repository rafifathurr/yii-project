<?php

namespace app\controllers;

use Yii;
use app\models\SalesOrder;
use app\models\SalesOrderSearch;
use app\components\AuthController;
use app\models\Product;
use yii\filters\VerbFilter;

/**
 * DashboardController
 */
class DashboardController extends AuthController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function datenow()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Lists all SalesOrder models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $currMonth = date('m');
        $currYear = date('Y');
        $firstMonth = 1;

        $circleChartData = array();
        $columnChartData = array();
        $monthCategories = array();

        // ACCUMULATION
        $totalData = SalesOrder::find()
            ->where('MONTH(date_order) = ' . $currMonth)
            ->where('YEAR(date_order) = ' . $currYear)
            ->sum('qty');

        // CIRCLE CHART
        $circleChartData = SalesOrder::find()
            ->select(['products.product_name', 'SUM(sales_order.qty) as total'])
            ->leftJoin('products', 'products.id = sales_order.id_product')
            ->where('MONTH(sales_order.date_order) = ' . $currMonth)
            ->where('YEAR(sales_order.date_order) = ' . $currYear)
            ->groupBy(['products.id'])
            ->asArray()
            ->all();

        // COLUMN CHART 
        for ($loopIndex = $firstMonth; $loopIndex <= $currMonth; $loopIndex++) {
            array_push($monthCategories, date("F", mktime(0, 0, 0, $loopIndex, 10)));
            $totalCheck = SalesOrder::find()
                ->where('MONTH(date_order) = ' . $loopIndex)
                ->andWhere('YEAR(date_order) = ' . $currYear)
                ->sum('qty');
            array_push($columnChartData, is_null($totalCheck) ? 0 : intval($totalCheck));
        }

        return $this->render('index', [
            'columnChartCat' => $monthCategories,
            'dataColumnChart' => $columnChartData,
            'totalData' => $totalData,
            'dataCircleChart' => $circleChartData
        ]);
    }
}
