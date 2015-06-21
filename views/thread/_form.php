<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Thread */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thread-form col-md-5">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_locked')
      ->dropDownList(
        array('0' => 'No',
        '1' => 'Yes')
        )
    ?>

    <?= !$model->isNewRecord ? $form->field($model, 'view_count')->textInput(['maxlength' => true]): '' ?>

</div>

<?php if ($model->isNewRecord): ?>
    
    <div class="post-form col-md-10">

    <?= $form->field($modelPost, 'content')->widget('\kartik\markdown\MarkdownEditor', 
    [
        'showExport' => true,
        'encodeLabels' => false,
    ]) ?>

    </div>
<?php endif; ?>

    <div class="form-group col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>