<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240601_123214_folders
 */
class m240601_123214_folders extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%folders}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'parent_id'             => Schema::TYPE_INTEGER . ' DEFAULT 0',

            'is_active'             => Schema::TYPE_SMALLINT . ' DEFAULT 1 NOT NULL',
            'deleted'               => Schema::TYPE_SMALLINT,
            'position'              => Schema::TYPE_INTEGER,
            'created_at'            => Schema::TYPE_INTEGER,
            'updated_at'            => Schema::TYPE_INTEGER,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%folders}}');
    }
}
