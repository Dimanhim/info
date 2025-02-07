<?php

use yii\db\Migration;

/**
 * Class m240605_175043_extend_access_host
 */
class m240605_175043_extend_access_host extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE info_accesses ADD host VARCHAR (255) DEFAULT NULL AFTER url';
        Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240605_175043_extend_access_host cannot be reverted.\n";

        return false;
    }
}
