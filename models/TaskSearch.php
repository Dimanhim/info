<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Task;

/**
 * TaskSearch represents the model behind the search form of `app\models\Task`.
 */
class TaskSearch extends Task
{
    public $_created_from;
    public $_created_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'number', 'status_id', 'is_active', 'deleted', 'position', 'created_at', 'updated_at', 'unique_id', 'name', 'description', 'comment', 'tags', '_created_from', '_created_to', 'payment_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $status)
    {
        $tableName = \Yii::$app->db->tablePrefix.'tasks';
        $query = Task::find()->where([$tableName.'.deleted' => null]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['status_id' => SORT_ASC, 'updated_at' => SORT_DESC, 'position' => SORT_ASC]],
            'pagination' => [
                'pageSize' => 50,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->_created_from and $this->_created_to) {
            $query->andWhere(['between', $tableName.'.created_at', strtotime($this->_created_from), strtotime($this->_created_to) + (60 * 60 * 24) - 1]);
        }

        if($status) {
            switch ($status) {
                case 'custom-active-rnova' : {
                    $query->andWhere(['not in', $tableName.'.status_id', Task::getInactiveStatuses()]);
                    $query->andWhere(['in', $tableName.'.type_id', Task::rnovaTypes()]);
                }
                    break;
                case 'custom-active-dev' : {
                    $query->andWhere(['not in', $tableName.'.status_id', Task::getInactiveStatuses()]);
                    $query->andWhere(['not in', $tableName.'.type_id', Task::rnovaTypes()]);
                }
                    break;
                case 'custom-done' : {
                    $query->joinWith('lastStatus');
                    $query->andWhere(['>=', \Yii::$app->db->tablePrefix.'task_statuses.created_at', strtotime('-7 days')]);
                }
                    break;
                case 'custom-proccess' : {
                    $this->status_id = [Task::STATUS_PROCESS];
                }
                    break;
            }
        }

        if($this->payment_date !== null) {
            if($this->payment_date == '0') {
                $query->andWhere(['not', [$tableName.'.price' => null]]);
                $query->andWhere(['not', [$tableName.'.price' => 0]]);
                $query->andWhere([$tableName.'.payment_date' => null]);
            }
            elseif($this->payment_date == '1') {
                $query->andWhere(['not', [$tableName.'.price' => null]]);
                $query->andWhere(['not', [$tableName.'.payment_date' => null]]);
            }
        }

        if($this->status_id) {
            $query->andFilterWhere(['in', 'status_id', $this->status_id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            $tableName.'.id' => $this->id,
            $tableName.'.type_id' => $this->type_id,
            //$tableName.'.status_id' => $this->status_id,
            $tableName.'.is_active' => $this->is_active,
            $tableName.'.deleted' => $this->deleted,
            $tableName.'.position' => $this->position,
            $tableName.'.created_at' => $this->created_at,
            $tableName.'.updated_at' => $this->updated_at,
        ]);

        if($this->number) {
            $query->andFilterWhere(['like', $tableName.'.number', $this->number])->orWhere(['like', $tableName.'.type_name', $this->number]);
        }

        $query->andFilterWhere(['like', $tableName.'.unique_id', $this->unique_id])
            ->andFilterWhere(['like', $tableName.'.name', $this->name])
            ->andFilterWhere(['like', $tableName.'.tags', $this->tags])
            ->andFilterWhere(['like', $tableName.'.description', $this->description])
            ->andFilterWhere(['like', $tableName.'.comment', $this->comment]);

        return $dataProvider;
    }
}
