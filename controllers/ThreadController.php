<?php

namespace ivan\simpleforum\controllers;

use Yii;
use ivan\simpleforum\models\Post;
use ivan\simpleforum\models\Thread;
use ivan\simpleforum\models\ThreadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use ivan\simpleforum\components\AccessRule;

/**
 * ThreadController implements the CRUD actions for Thread model.
 */
class ThreadController extends Controller
{
    public function behaviors()
    {
        return [
           'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@', 'admin'],
                    ],
                    [
                        'actions' => ['view', 'index'],
                        'allow' => true,
                        'roles' => ['?', '@', 'admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Thread models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ThreadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Thread model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $posts = Post::find()
            ->where(['thread_id' => $id])
            ->all();

        $modelPost = new Post();
        $modelPost->thread_id = Yii::$app->getRequest()->getQueryParam('id');
        $modelPost->author_id = Yii::$app->user->identity->id;
        $modelPost->editor_id = Yii::$app->user->identity->id;
        if ($modelPost->load(Yii::$app->request->post()) && $modelPost->save()) {
            Controller::refresh();
        }

        $model = $this->findModel($id);
        $model->view_count = $model->view_count + 1;
        $model->save();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'posts' => $posts,
            'modelPost' => $modelPost,
        ]);
    }

    /**
     * Creates a new Thread model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $modelPost = new Post();
        $model = new Thread();

        $model->view_count = 0;
        $model->forum_id = Yii::$app->getRequest()->getQueryParam('forum_id');
        

        if ($model->load(Yii::$app->request->post()) && $modelPost->load(Yii::$app->request->post()) && $model->validate($model)) {
        
            $model->save();

            $modelPost->thread_id = $model->id;
            $modelPost->author_id = Yii::$app->user->identity->id;
            $modelPost->editor_id = Yii::$app->user->identity->id;

            if($modelPost->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPost' => $modelPost
            ]);
        }
    }

    /**
     * Updates an existing Thread model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Thread model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Thread model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Thread the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Thread::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
