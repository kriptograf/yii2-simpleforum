<?php

namespace ivan\simpleforum\controllers;

use Yii;
use ivan\simpleforum\models\Forum;
use ivan\simpleforum\models\Thread;
use ivan\simpleforum\models\ForumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ForumController implements the CRUD actions for Forum model.
 */
class ForumController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Forum models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ForumSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $forums = Forum::find()
            ->where(['parent_id' => NULL])
            ->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'forums' => $forums,
        ]);
    }

     /**
     * Lists all Forum models.
     * @return mixed
     */
    public function actionForums()
    {
        $forums = Forum::find()
            ->where(['parent_id' => NULL])
            ->all();

        return $this->render('_forums', [
            'forums' => $forums,
        ]);
    }

    /**
     * Displays a single Forum model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $forums = Forum::find()
            ->where(['parent_id' => $id])
            ->all();

        $threads = Thread::find()
            ->where(['forum_id' => $id])
            ->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'forums' => $forums,
            'threads' => $threads,
        ]);
    }

    /**
     * Creates a new Forum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Forum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Forum model.
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
     * Deletes an existing Forum model.
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
     * Finds the Forum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Forum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Forum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}