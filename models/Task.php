<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "info_tasks".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $type_id
 * @property int|null $number
 * @property string|null $name
 * @property string|null $description
 * @property string|null $comment
 * @property int|null $status_id
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Task extends BaseModel
{
    const STATUS_NEW            = 1;
    const STATUS_PROCESS        = 2;

    const STATUS_INFO           = 3;
    const STATUS_WAIT           = 4;
    const STATUS_COORDINATION   = 5;
    const STATUS_PAUSE          = 6;
    const STATUS_ARCHIVE        = 7;




    const STATUS_COMPLETED      = 33;
    const STATUS_DONE           = 44;

    const TYPE_APP         = 1;
    const TYPE_OFFICE      = 2;
    const TYPE_WEB         = 3;
    const TYPE_SANDBOX     = 4;
    const TYPE_WIDGET      = 5;
    const TYPE_DEVELOPMENT = 6;
    const TYPE_MADEFORMED  = 7;
    const TYPE_SYSTEM      = 8;
    const TYPE_DOCS        = 9;
    const TYPE_SUPPORT     = 10;
    const TYPE_ACC         = 40;
    const TYPE_OTHER       = 99;

    public $linkTypes = [
        'office' => [
            'types' => [self::TYPE_APP, self::TYPE_OFFICE, self::TYPE_WEB, self::TYPE_SANDBOX, self::TYPE_DOCS, self::TYPE_SUPPORT, self::TYPE_MADEFORMED],
            'url' => 'https://office.rnova.org/issues/details?id=',
        ],
        'madeformed' => [
            'types' => [self::TYPE_MADEFORMED],
            'url' => 'https://madeformed.bitrix24.ru/workgroups/group/5/tasks/task/view/'
        ]
    ];

    /**
     * @return array
     */
    public static function rnovaTypes()
    {
        return [self::TYPE_APP, self::TYPE_OFFICE, self::TYPE_WEB, self::TYPE_SANDBOX, self::TYPE_DOCS, self::TYPE_SUPPORT, self::TYPE_MADEFORMED];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tasks}}';
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
        return Gallery::TYPE_TASK;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type_id', 'status_id', 'price'], 'integer'],
            [['description', 'comment'], 'string'],
            [['number', 'name', 'tags', 'type_name'], 'string', 'max' => 255],
            [['payment_date'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'type_id' => 'Тип',
            'type_name' => 'Вид',
            'number' => 'Номер',
            'name' => 'Название',
            'description' => 'Описание',
            'comment' => 'Мои комментарии',
            'tags' => 'Теги',
            'status_id' => 'Статус',
            'price' => 'Стоимость',
            'payment_date' => 'Дата оплаты',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatuses()
    {
        return $this->hasMany(TaskStatus::className(), ['task_id' => 'id']);
    }
    public function getLastStatus()
    {
        return $this->hasOne(TaskStatus::className(), ['task_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * @return array
     */
    public static function getInactiveStatuses()
    {
        return [self::STATUS_COMPLETED, self::STATUS_DONE, self::STATUS_ARCHIVE];
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_PROCESS => 'В процессе',
            self::STATUS_INFO => 'Требуется информация',
            self::STATUS_WAIT => 'В ожидании',
            self::STATUS_COORDINATION => 'На согласовании',
            self::STATUS_PAUSE  => 'На паузе',
            self::STATUS_ARCHIVE  => 'Архив',
            self::STATUS_COMPLETED => 'Решен',
            self::STATUS_DONE => 'Завершен',
        ];
    }

    public function afterFind()
    {
        if($this->payment_date) {
            $this->payment_date = date('d.m.Y', $this->payment_date);
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setTaskStatus($insert, $changedAttributes);
        return parent::afterSave($insert, $changedAttributes);
    }

    public function beforeSave($insert)
    {
        if($this->payment_date) $this->payment_date = strtotime($this->payment_date);
        return parent::beforeSave($insert);
    }

    public function setTaskStatus($insert, $changedAttributes)
    {
        $model = new TaskStatus();
        $model->status_id = $this->status_id;
        $model->task_id = $this->id;
        if(isset($changedAttributes['status_id']) && $changedAttributes['status_id'] != $this->status_id) {
            $model->old_status_id = $changedAttributes['status_id'];
        }
        if($insert || $model->old_status_id) return $model->save();
        return false;
    }

    public function getStatusesHtml()
    {
        $str = '<ul>';
        if($this->statuses) {
            foreach($this->statuses as $taskStatus) {
                $str .= '<li>'.date('d.m.Y', $taskStatus->created_at).' || '.self::getStatusNameById($taskStatus->old_status_id).' -> '.self::getStatusNameById($taskStatus->status_id).'</li>';
            }
        }
        else {
            $str .= '<li>'.date('d.m.Y', $this->created_at).' || '.self::getStatusNameById($this->status_id).'</li>';
        }
        $str .= '</ul>';
        return $str;
    }

    /**
     * @return array
     */
    public static function getTypeList()
    {
        return [
            self::TYPE_APP => 'Rnova APP',
            self::TYPE_OFFICE => 'Rnova OFFICE',
            self::TYPE_WEB => 'Rnova WEB',
            self::TYPE_SANDBOX => 'Rnova SANDBOX',
            self::TYPE_WIDGET => 'Rnova Виджет',
            self::TYPE_DOCS => 'Rnova DOCS',
            self::TYPE_SUPPORT => 'Rnova Поддержка',
            self::TYPE_DEVELOPMENT => 'Разработка',
            self::TYPE_MADEFORMED => 'MadeForMed',
            self::TYPE_SYSTEM => 'Система',
            self::TYPE_ACC => 'Accounting',
            self::TYPE_OTHER => 'Разное',
        ];
    }

    /**
     * @return mixed|null
     */
    public function getStatusName()
    {
        $statuses = self::getStatusList();
        return $statuses[$this->status_id] ?? null;
    }

    public static function getStatusNameById($statusId)
    {
        $statuses = self::getStatusList();
        return $statuses[$statusId] ?? null;
    }

    /**
     * @return mixed|null
     */
    public function getTypeName()
    {
        $types = self::getTypeList();
        return $types[$this->type_id] ?? null;
    }

    public function getRowClass()
    {
        switch ($this->status_id) {
            case self::STATUS_NEW : return 'pale-red';
            case self::STATUS_PROCESS : return 'pale-green';
            case self::STATUS_INFO : return 'pale-orange';
            case self::STATUS_WAIT : return 'pale-blue';
            case self::STATUS_COORDINATION : return 'pale-yellow';
            case self::STATUS_PAUSE : return 'pale-purple';
            case self::STATUS_COMPLETED : return 'pale-grey';
            case self::STATUS_DONE : return 'pale-grey';
        }
    }

    public function editStatusHtml()
    {
        if($statusList = Task::getStatusList()) {
            $str = "<select class='form-control {$this->getRowCLass()} change-status-select change-status-o' data-id='{$this->id}'>";
            $str .= '<option value="0">[Не выбран]</option>';
            foreach($statusList as $statusId => $statusName) {
                $selected = $this->status_id == $statusId ? " selected='selected'" : '';
                $str .= "<option value='{$statusId}'{$selected}>{$statusName}</option>";
            }
            $str .= '</select>';
        }
        return $str;
    }

    public function isLink()
    {
        foreach ($this->linkTypes as $linkType) {
            if(in_array($this->type_id, $linkType['types'])) {
                return $linkType['url'];
            }
        }
        return false;
    }

    public function numberLink()
    {
        $str = $this->number;
        if($this->type_name) {
            $str .= ' ('.$this->type_name.')';
        }

        if($linkName = $this->isLink()) {
            $link = $linkName.trim($this->number);
            /*if($this->type_id == self::TYPE_MADEFORMED) {
                $link .= '/';
            }*/
            return Html::a($str, $link, ['target' => '_blanc', 'class' => 'url_link']);
        }
        return $str;
    }

    public function vcsHtml()
    {
        return Yii::$app->controller->renderPartial('//task/_vcs', [
            'model' => $this
        ]);
    }

    public function vcsFormHtml()
    {

    }

    public function vcsFormBranchesHtml()
    {

    }

    public function vcsFormActionsBranchesHtml()
    {

    }
}
