<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Subscription]].
 *
 * @see Subscription
 */
class SubscriptionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Subscription[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Subscription|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
