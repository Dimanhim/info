<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m250314_065505_task_vcs
 */
class m250314_065505_task_vcs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task_vcs}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'task_id'               => Schema::TYPE_INTEGER,
            'project_id'            => Schema::TYPE_INTEGER,
            'branch_id'             => Schema::TYPE_INTEGER,
            'action'                => Schema::TYPE_STRING,
            'action_subject'        => Schema::TYPE_STRING,
            'action_branch_id'      => Schema::TYPE_INTEGER,
            'name'                  => Schema::TYPE_STRING,

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
        $this->dropTable('{{%task_vcs}}');
    }
}
