<?php

use yii\db\Migration;

class m180621_223142_create_table_subscription extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%subscription}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->string(),
        ], $tableOptions);

        $this->createIndex('title_index', '{{%subscription}}', 'title', true);
    }

    public function down()
    {
        $this->dropTable('{{%subscription}}');
    }
}
