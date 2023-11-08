<?php

use app\models\CategoryProduct;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Update Product: ' . $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?php $ctg = ArrayHelper::map(CategoryProduct::find()->where(['deleted_at' => null])->orderBy(['category_name' => SORT_ASC])->asArray()->all(), 'id', 'category_name');  ?>
    <?php echo $form->field($model, 'id_category')->dropDownList(
        $ctg,
        [
            'prompt' => '-Select-',
        ]
    );
    ?>

    <?= $form->field($model, 'product_name')->textInput() ?>
    <?= $form->field($model, 'price')->textInput() ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>