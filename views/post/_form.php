<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\User;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form col-md-12">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'content')->widget('\kartik\markdown\MarkdownEditor', 
    [
        'showExport' => true,
        'encodeLabels' => false,
    ]) ?>

    <div class="form-group">
        <?php if(!Yii::$app->user->isGuest):?>
        <div>
            <?= Html::submitButton($model->isNewRecord ? 'Reply' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php else:?>
        <div>
            <?= Html::a('Please log in to reply', ['/user/login'], ['class' => 'btn btn-success']) ?>
            <?php Yii::$app->user->returnUrl = Yii::$app->request->url; ?>
        </div>
        <?php endif;?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
