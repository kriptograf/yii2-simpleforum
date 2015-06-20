<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form col-md-10">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'thread_id')->textInput() ?> -->

    <!-- <?= $form->field($model, 'author_id')->textInput() ?> -->

    <!-- <?= $form->field($model, 'editor_id')->textInput() ?> -->

    <?= $form->field($model, 'content')->textarea(['rows' => 12]) ?>

    <!-- <?= $form->field($model, 'created')->textInput() ?> -->

    <!-- <?= $form->field($model, 'updated')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
