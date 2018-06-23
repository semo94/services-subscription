<?php

namespace frontend\controllers;

use Yii;
use frontend\models\User;
use frontend\models\Subscription;
use frontend\models\SubscriptionSearch;
use common\models\UserSubscription;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveQuery;
use yii\db\Query;
use \yii\data\ActiveDataProvider;

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
        $currentID = Yii::$app->user->getId();
        $searchModel = new SubscriptionSearch();
        $dataProvider1 = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider2 = new ActiveDataProvider([
                              'query' => UserSubscription::find()->where(['user_id' => $currentID]),
                          ]);

        if (Yii::$app->user->isGuest) {
          $this->redirect('../login');
        } else {
          return $this->render('index', array(
            'searchModel' => $searchModel,
            'dataProvider1' => $dataProvider1,
            'dataProvider2' => $dataProvider2,
          ));
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

    public function actionChangeSelection()
    {
      $currentID = Yii::$app->user->getId();
      $user = User::findOne((int)$currentID);
      $action=Yii::$app->request->post('action');
      $selected=(array)Yii::$app->request->post('selection');
      $allSubscriptions = Subscription::find()->all();
      $subscriptions = array();

      foreach ($allSubscriptions as $key => $value) {
        array_push($subscriptions, $value->id);
      }

      $notSelected = array_diff($subscriptions, $selected);
      $userSubscriptions = UserSubscription::find()->where(['user_id' => $currentID])->all();
      $subscriped = array();

      foreach ($userSubscriptions as $key => $value) {
        array_push($subscriped, $value->subscription_id);
      }

      foreach($selected as $id){
        if (!in_array($id,$subscriped)) {
          $sub = Subscription::findOne((int)$id);
          $user->link('subscriptions', $sub);
        }
      }

      foreach ($notSelected as $id) {
        if (in_array($id,$subscriped)) {
          $userSub = UserSubscription::find()->where(['subscription_id' => $id])->one();
          $userSub->delete();
        }
      }

       return $this->redirect('index');

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
