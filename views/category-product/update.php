<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CategoryProduct $model */

$this->title = 'Update Category Product: ' . $model->category_name;
$this->params['breadcrumbs'][] = ['label' => 'Category Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput() ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>