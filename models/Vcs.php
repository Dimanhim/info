<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_vcs".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $project_id
 * @property int|null $branch
 * @property int|null $parent_branch_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Vcs extends \app\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vcs}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'VCS';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_VCS;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['project_id', 'parent_branch_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'branch'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'project_id' => 'Проект',
            'branch' => 'Ветка',
            'parent_branch_id' => 'Родительская ветка',
            'name' => 'Название',
            'description' => 'Описание',
        ]);
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
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_branch_id']);
    }
}
