<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_subscription".
 *
 * @property int $user_id
 * @property int $subscription_id
 *
 * @property User $user
 * @property Subscription $subscription
 */
class UserSubscription extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_subscription';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'subscription_id'], 'required'],
            [['user_id', 'subscription_id'], 'integer'],
            [['user_id', 'subscription_id'], 'unique', 'targetAttribute' => ['user_id', 'subscription_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['subscription_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subscription::className(), 'targetAttribute' => ['subscription_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'subscription_id' => 'Subscription ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscription()
    {
        return $this->hasOne(Subscription::className(), ['id' => 'subscription_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserSubscriptionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserSubscriptionQuery(get_called_class());
    }
}
