<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "info_folders".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Folder extends BaseModel
{
    public $mainFolder;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%folders}}';
    }

    public static function modelName()
    {
        return 'Папки';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['parent_id', 'mainFolder'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'parent_id' => 'Родительская категория',
            'mainFolder' => 'Основная папка',
        ]);
    }

    public function beforeSave($insert)
    {
        if(!$this->parent_id) {
            $this->parent_id = 0;
        }
        return parent::beforeSave($insert);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(Folder::className(), ['parent_id' => 'id'])->orderBy(['position' => SORT_ASC]);
    }

    public function getMainFolder()
    {
        if($this->parent) {
            return $this->parent->getMainFolder();
        }
        return $this;
    }

    public static function getMainFolderList()
    {
        return ArrayHelper::map(self::findModels()->andWhere(['parent_id' => 0])->asArray()->all(), 'id', 'name');
    }

    public static function getParentList()
    {
        $data = [];
        $models = self::findModels()->andWhere(['not', ['parent_id' => 0]])->all();

        if($models) {
            foreach($models as $model) {
                $data[$model->id] = $model->name . ' (' . $model->getMainFolder()->name . ')';
            }
        }
        return $data;
        return ArrayHelper::map(self::findModels()->andWhere(['not', ['parent_id' => null]])->asArray()->all(), 'id', 'name');
    }
    public static function getMainFoldersList()
    {
        return ArrayHelper::map(self::findModels()->andWhere(['parent_id' => 0])->asArray()->all(), 'id', 'name');
    }

    public function getFolders()
    {
        /*return [
            'Категория 1',
            'Категория 2' => [
                1 => 'Категория 3',
                2 => 'Категория 4',
            ],
        ];*/
        $data = [];

        if($models = self::findModels()->all()) {
            foreach($models as $model) {
                if($model->name != $model->getMainFolder()->name) {
                    $data[$model->getMainFolder()->name][$model->id] = $model->name;
                }
            }
        }

        return $data;
    }

    public static function getFoldersTree()
    {
        $data = [];

        if($models = self::findModels()->all()) {
            foreach($models as $model) {
                if($model->name != $model->getMainFolder()->name) {
                    if(isset($data[$model->getMainFolder()->id])) {
                        $data[$model->getMainFolder()->id]['items'][$model->id] = $model->name;
                    }
                    else {
                        $data[$model->getMainFolder()->id] = [
                            'id' => $model->getMainFolder()->id,
                            'name' => $model->getMainFolder()->name,
                            'items' => [
                                $model->id => $model->name,
                            ],
                        ];
                    }
                }
            }
        }

        return $data;
    }
}
