<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SubscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscriptions List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscription-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?= Html::a('Create Subscription', ['create'], ['class' => 'btn btn-success']) ?> -->
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
              'attribute' => 'description',
              'contentOptions'=> ['style'=>'max-width: 300px; overflow: auto; word-wrap: break-word;'],
            ],

            ['class' => 'yii\grid\ActionColumn',
             'header'=>"View",
             'visibleButtons' => ['update' => false, 'delete' => false],
            ],
        ],
    ]); ?>
</div>
