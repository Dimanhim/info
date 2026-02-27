<?php

use yii\db\Migration;

/**
 * Class m260227_083048_extend_projects
 */
class m260227_083048_extend_projects extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = 'ALTER TABLE info_projects ADD site VARCHAR(255) DEFAULT NULL AFTER name';
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260227_083048_extend_projects cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260227_083048_extend_projects cannot be reverted.\n";

        return false;
    }
    */
}
