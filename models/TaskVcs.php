<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_task_vcs".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $task_id
 * @property int|null $project_id
 * @property int|null $branch_id
 * @property string|null $action
 * @property string|null $name
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class TaskVcs extends \app\models\BaseModel
{
    const ACTION_CREATE = 'create';
    const ACTION_COMMIT = 'commit';
    const ACTION_PUSH   = 'push';
    const ACTION_MERGE  = 'merge';

    const ACTION_SUBJECT_FROM = 'from';
    const ACTION_SUBJECT_TO   = 'to';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_vcs}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Задачи';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ANY;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['task_id', 'project_id', 'branch_id'], 'integer'],
            [['action', 'name'], 'string', 'max' => 255],
            [['action_subject', 'action_branch_id'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'task_id' => 'Таск',
            'project_id' => 'Проект',
            'branch_id' => 'Ветка',
            'action' => 'Действие',
            'action_subject' => 'Направление',
            'action_branch_id' => 'Ветка действия',
            'name' => 'Название',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Vcs::className(), ['id' => 'branch_id']);
    }
}
