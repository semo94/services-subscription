<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Subscription;
use frontend\models\SubscriptionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubscriptionController implements the CRUD actions for Subscription model.
 */
class SubscriptionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Subscription models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubscriptionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        } else {
          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
        }
    }

    /**
     * Displays a single Subscription model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        } else {
          return $this->render('view', [
              'model' => $this->findModel($id),
          ]);
        }

    }

    /**
     * Creates a new Subscription model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Subscription();

        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        }
        else if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return $this->render('create', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Updates an existing Subscription model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        }
        else if ($model->load(Yii::$app->request->post()) && $model->save()) {
          return $this->redirect(['view', 'id' => $model->id]);
        } else {
          return $this->render('update', [
              'model' => $model,
          ]);
        }
    }

    /**
     * Deletes an existing Subscription model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        } else {
          $this->findModel($id)->delete();
          return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Subscription model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subscription the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subscription::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
