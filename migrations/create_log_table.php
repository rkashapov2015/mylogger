<?php

use yii\db\Migration;

/**
 * Handles the creation of table `log`.
 */
class m170721_121922_create_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('requestlog', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'ip' => $this->string(),
            'agent' => $this->string(),
            'url' => $this->string(),
            'lat' => $this->decimal(11, 8),
            'lng' => $this->decimal(11, 8),
            'country' => $this->string(),
            'city' => $this->string(),
            'status' => $this->integer(),
            'request_method' => $this->string(),
            'params' => $this->text(),
            'created_at' => 'datetime DEFAULT NOW()'
        ]);
        \Yii::$app->cache->flush();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('requestlog');
    }
}
