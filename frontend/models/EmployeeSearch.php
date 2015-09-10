<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `common\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'height', 'weight', 'nationality', 'race', 'religion', 'department_id', 'user_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['title', 'name', 'surname', 'gender', 'birthday', 'blood_type', 'ceallphone', 'personal_id', 'photo', 'skill'], 'safe'],
            [['salary'], 'number'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params)
    {
        $query = Employee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'birthday' => $this->birthday,
            'height' => $this->height,
            'weight' => $this->weight,
            'nationality' => $this->nationality,
            'race' => $this->race,
            'religion' => $this->religion,
            'salary' => $this->salary,
            'department_id' => $this->department_id,
            'user_id' => $this->user_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'blood_type', $this->blood_type])
            ->andFilterWhere(['like', 'ceallphone', $this->ceallphone])
            ->andFilterWhere(['like', 'personal_id', $this->personal_id])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'skill', $this->skill]);

        return $dataProvider;
    }
}
