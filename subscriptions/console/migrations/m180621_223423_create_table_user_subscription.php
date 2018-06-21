<?php

use yii\db\Migration;

class m180621_223423_create_table_user_subscription extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_subscription}}', [
            'user_id' => $this->integer()->notNull(),
            'subscription_id' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('user_id', '{{%user_subscription}}', 'user_id');
        $this->createIndex('user_subscription_id', '{{%user_subscription}}', ['user_id', 'subscription_id'], true);
        $this->createIndex('subscription_id', '{{%user_subscription}}', 'subscription_id');
        $this->addForeignKey('user_subscription_ibfk_1', '{{%user_subscription}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('user_subscription_ibfk_2', '{{%user_subscription}}', 'subscription_id', '{{%subscription}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%user_subscription}}');
    }
}
