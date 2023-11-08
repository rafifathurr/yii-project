<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CategoryProduct $model */

$this->title = 'Create Category Product';
$this->params['breadcrumbs'][] = ['label' => 'Category Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_name')->textInput() ?>
    <div class="form-group">
        <div>
            <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>
    <?php if (Yii::$app->session->hasFlash('failed')) : ?>
        <div class="form-group">
            <div>
                <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
            </div>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>