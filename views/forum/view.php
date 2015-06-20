<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Forum */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Forums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->isAdmin):
            echo Html::a('Create Forum', ['create', 'parent_id' => $model->id], ['class' => 'btn btn-success']);
            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
            echo Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
            endif;
        ?>
    </p>

    <?php 
    if (!empty($forums) ) 
        echo $this->render('_forums', ['forums' => $forums]);
    // display pagination
    echo yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
    ]);
    ?>
    <?php if(!Yii::$app->user->isGuest):?>
    <div class="pull-right">
        <?= Html::a('Start new topic', ['thread/create', 'forum_id' => Yii::$app->getRequest()->getQueryParam('id')], ['class' => 'btn btn-success']) ?>
    </div>
    <?php else:?>
    <div class="pull-right">
        <?= Html::a('Please log in to post a topic', ['/user/login'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php endif;?>
    
    <?= $this->render('_threads', [
        'threads' => $threads
        ]); ?>
</div>
