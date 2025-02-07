<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m241111_104027_tasks
 */
class m241111_104027_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tasks}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'type_id'               => Schema::TYPE_INTEGER,
            'type_name'             => Schema::TYPE_STRING,
            'number'                => Schema::TYPE_STRING,
            'name'                  => Schema::TYPE_STRING,
            'description'           => Schema::TYPE_TEXT,
            'comment'               => Schema::TYPE_TEXT,
            'tags'                  => Schema::TYPE_STRING,
            'status_id'             => Schema::TYPE_INTEGER,

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
        $this->dropTable('{{%tasks}}');
    }
}
