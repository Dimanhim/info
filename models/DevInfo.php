<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_dev_info".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $text
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class DevInfo extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dev_info}}';
    }

    public static function modelName()
    {
        return 'Информация';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_DEV_INFO;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name'], 'string', 'max' => 255],
            [['description', 'text'], 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'description' => 'Описание',
            'text' => 'Контент',
        ]);
    }
}
