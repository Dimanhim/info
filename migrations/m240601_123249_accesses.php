<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m240601_123249_accesses
 */
class m240601_123249_accesses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%accesses}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'name'                  => Schema::TYPE_STRING,
            'folder_id'             => Schema::TYPE_INTEGER,
            'login'                 => Schema::TYPE_STRING,
            'password'              => Schema::TYPE_STRING,
            'url'                   => Schema::TYPE_STRING,
            'comment'               => Schema::TYPE_TEXT,

            'is_active'             => Schema::TYPE_SMALLINT . ' DEFAULT 1',
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
        $this->dropTable('{{%accesses}}');
    }
}
