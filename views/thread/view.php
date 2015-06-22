<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\forum\models\Thread */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Forums', 'url' => ['forum/index']];

$this->params['breadcrumbs'][] = [
    'label' => \ivan\simpleforum\models\Forum::find()->where(['id' => $model->forum_id])->one()->title,
    'url' => ['forum/view','id' => \ivan\simpleforum\models\Forum::find()->where(['id' => $model->forum_id])->one()->id]
    ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->isAdmin):
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

        <?php echo yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
        ]);?>
        <?php if(!Yii::$app->user->isGuest):?>
        <div class="pull-right">
            <?= Html::a('Reply to this topic', ['post/create', 'thread_id' => $model->id], ['class' => 'btn btn-success','onclick' => "$('#file-input').fileinput('upload');"]) ?>
        </div>
        <?php else:?>
        <div class="pull-right">
            <?= Html::a('Please log in to reply', ['/user/login'], ['class' => 'btn btn-success']) ?>
        </div>
        <?php endif;?>
    </p>

    <?= $this->render('_posts', [
        'posts' => $posts,
    ]); ?>

    <?= $this->render('@vendor/ivan/yii2-simpleforum/views/post/create', [
        'model' => $modelPost,
    ]) ?>
</div>
