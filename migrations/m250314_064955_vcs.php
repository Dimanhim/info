<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m250314_064955_vcs
 */
class m250314_064955_vcs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vcs}}', [
            'id'                    => Schema::TYPE_PK,
            'unique_id'             => Schema::TYPE_STRING . ' NOT NULL',

            'project_id'            => Schema::TYPE_INTEGER,
            'branch'                => Schema::TYPE_STRING,
            'parent_branch_id'      => Schema::TYPE_INTEGER,
            'name'                  => Schema::TYPE_STRING,
            'description'           => Schema::TYPE_TEXT,

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
        $this->dropTable('{{%vcs}}');
    }
}
