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

<?=Html::beginForm(['subscription/change-selection'],'post');?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider1,
        'columns' => [

            ['class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function($model, $key, $index, $widget) {
                return ['value' => $model['id'], ];
             },
            ],
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
<?=Html::submitButton('Change Subscription', ['class' => 'btn btn-success']);?>
<?= Html::endForm();?>


<?= GridView::widget([
  'dataProvider' => $dataProvider2,
  'columns' => [
    [ 'attribute' => 'subscription_id', 'header' => 'Your subscribed channels'],
  ]
]); ?>

</div>
