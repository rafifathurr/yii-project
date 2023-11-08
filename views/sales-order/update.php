<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Product;

/** @var yii\web\View $this */
/** @var app\models\SalesOrder $model */

$this->title = 'Update Sales Order: ' . $model->invoice;
$this->params['breadcrumbs'][] = ['label' => 'Sales Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invoice')->textInput() ?>

    <?= $form->field($model, 'date_order', ['inputOptions' => ['type' => 'date']])->textInput(['max' => date('Y-m-d')]) ?>
    <?php $ctg = ArrayHelper::map(Product::find()->where(['deleted_at' => null])->orderBy(['product_name' => SORT_ASC])->asArray()->all(), 'id', 'product_name');  ?>
    <?php echo $form->field($model, 'id_product')->dropDownList(
        $ctg,
        [
            'prompt' => '-Select-',
            'onchange' => '
        $.get("' . Yii::$app->urlManager->createUrl('product/list') . '",{ "id" : $(this).val() }, function( data ) {
            $("#total_price").val(data["price"]);
            $("#price").val(data["price"]);
            $("#qty_product").val(1);
        });
      '
        ]
    );
    ?>

    <?= $form->field($model, 'qty', ['inputOptions' => ['type' => 'number']])->textInput(['id' => 'qty_product', 'min' => 1]) ?>
    <?= $form->field($model, 'price')->hiddenInput(['value' => $model->product->price, 'id' => 'price'])->label(false); ?>
    <?= $form->field($model, 'total_price', ['inputOptions' => ['type' => 'number']])->textInput(['id' => 'total_price', 'readonly' => true]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#qty_product').on('input', function() {
        let qty = parseInt($('#qty_product').val());
        price = parseInt($('#price').val());
        if (isNaN(qty) || qty == 0) {
            qty = 1;
        }

        let totalPrice = price * qty;

        $('#total_price').val(totalPrice);

    });
</script>