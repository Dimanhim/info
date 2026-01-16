<?php

use yii\db\Migration;

/**
 * Class m260115_103712_extend_projects
 */
class m260115_103712_extend_projects extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE info_projects ADD folder_id INT(11) DEFAULT NULL AFTER description';
        Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260115_103712_extend_projects cannot be reverted.\n";

        return false;
    }
}
