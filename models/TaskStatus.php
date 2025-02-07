<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_task_statuses".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $task_id
 * @property int|null $status_id
 * @property int|null $old_status_id
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class TaskStatus extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_statuses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['task_id', 'status_id', 'old_status_id'], 'integer'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'task_id' => 'Task ID',
            'status_id' => 'Status ID',
            'old_status_id' => 'Old Status ID',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
