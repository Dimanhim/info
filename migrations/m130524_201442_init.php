<?php

use yii\db\Migration;
use yii\db\Schema;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),

            'username' => $this->string()->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'password' => $this->string(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),

            'is_active' => $this->smallInteger()->defaultValue(1),
            'deleted' => $this->smallInteger(),
            'position' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'name' => 'Администратор',
            'password' => '123456',
            'password_hash' => '$2y$13$1W.D51rRnv9Hpbo/SxSZmeNMsZppWpnYMQeAJ9C/BzDxHYE6qMN8C',
            'email' => 'dimanhim@list.ru',
            'status' => '10',
            'is_active' => 1,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
