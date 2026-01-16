<?php

use yii\db\Migration;

/**
 * Class m260115_104014_extend_tasks
 */
class m260115_104014_extend_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE info_tasks ADD project_id INT(11) DEFAULT NULL AFTER type_id';
        Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260115_104014_extend_tasks cannot be reverted.\n";

        return false;
    }
}
