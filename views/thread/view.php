<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Thread */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Forums', 'url' => ['forum/index']];
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->isAdmin):
            echo "<span class='pull-right'>".Html::a('Reply to this topic', ['post/create', 'thread_id' => $model->id], ['class' => 'btn btn-success'])."</span>";
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

    <?= $this->render('_posts', [
        'posts' => $posts,
    ]); ?>

    <?= $this->render('@vendor/ivan/yii2-simpleforum/views/post/create', [
        'model' => $modelPost,
    ]) ?>
</div>
