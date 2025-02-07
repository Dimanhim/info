<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "info_accesses".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $folder_id
 * @property string|null $login
 * @property string|null $password
 * @property string|null $url
 * @property string|null $comment
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Access extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%accesses}}';
    }

    public static function modelName()
    {
        return 'Доступы';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ACCESS;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['folder_id'], 'integer'],
            [['name', 'login', 'password', 'url', 'host'], 'string', 'max' => 255],
            [['comment'], 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'folder_id' => 'Папка',
            'login' => 'Логин',
            'password' => 'Пароль',
            'url' => 'Url',
            'host' => 'Host',
            'comment' => 'Комментарий',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folder::className(), ['id' => 'folder_id']);
    }

    public function getCopyLink($attribute, $hidden = false)
    {
        if(!$this->hasAttribute($attribute)) return false;

        $text = $hidden ? '******' : $this->$attribute;

        return Html::a($text, ['#'], ['class' => 'copy__str', 'data-value' => $this->$attribute]);
    }

    public function getFullName()
    {
        $str = '';
        if($this->folder) {
            $str = $this->folder->getMainFolder()->name;
            $str .= '/' . $this->folder->name;
        }

        return $str;
    }
}
