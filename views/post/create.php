<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Post */
if(Yii::$app->controller->module->id == 'forum' && Yii::$app->controller->id == 'thread' && Yii::$app->controller->action->id == 'view')
	$this->title = '';
else
	$this->title = 'Create Post';

$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
