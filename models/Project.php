<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_projects".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $type_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Project extends \app\models\BaseModel
{
    public $_task;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    public function init()
    {
        $this->_task = new Task();
        return parent::init();
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Проекты';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_PROJECT;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type_id', 'folder_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'type_id' => 'Тип',
            'folder_id' => 'Доступы',
            'name' => 'Название',
            'description' => 'Описание',
        ]);
    }

    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
    }

    /**
     * @return mixed|null
     */
    public function getTypeName()
    {
        $types = Task::getTypeList();
        return $types[$this->type_id] ?? null;
    }
}
