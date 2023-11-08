<?php

use app\models\CategoryProduct;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'product_code')->textInput() ?>

    <?php $ctg = ArrayHelper::map(CategoryProduct::find()->where(['deleted_at' => null])->orderBy(['category_name' => SORT_ASC])->asArray()->all(), 'id', 'category_name');  ?>
    <?= $form->field($model, 'id_category')->dropDownList(
        $ctg,
        [
            'prompt' => '-Select-'
        ]
    );
    ?>

    <?= $form->field($model, 'product_name')->textInput() ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'price', ['inputOptions' => ['type' => 'number']])->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'stock', ['inputOptions' => ['type' => 'number']])->textInput(['id' => 'stockProduct', 'min' => 0]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'statusProduct')->dropDownList(
                ['0' => 'InActive', '1' => 'Active'],
                [
                    'prompt' => '-Select Status-'
                ],
                ['id' => 'statusProduct']
            ); ?>
        </div>
    </div>
    <?= $form->field($images, 'filePhoto')->fileInput(['id' => 'uploadedFile'])->label('Photo Product') ?>

    <img id="img" src="#" style="display:none;" />
    <br>

    <div class="form-group">
        <div>
            <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    $('#uploadedFile').on('change', function() {
        let files = $('#uploadedFile').prop('files');

        if (files && files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#img').css("display", "block");
                $('#img')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
            };

            reader.readAsDataURL(files[0]);
        }
    });
</script>