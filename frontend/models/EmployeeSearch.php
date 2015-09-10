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
    public $username;
    public $email;
    public $fullname;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'height', 'weight', 'nationality', 'race', 'religion', 'department_id', 'user_id', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['fullname','username','email','title', 'name', 'surname', 'gender', 'birthday', 'blood_type', 'ceallphone', 'personal_id', 'photo', 'skill'], 'safe'],
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
        $query = Employee::find()->JoinWith(['user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['username'] = [
            'asc'=>['user.username'=>SORT_ASC],
            'desc'=>['user.username'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['email'] = [
          'asc'=>['user.email'=>SORT_ASC],
          'desc'=>['user.email'=>SORT_DESC]
        ];

        $dataProvider->sort->attributes['fullname']=[
          'asc'=>['name'=>SORT_ASC,'surname'=>SORT_ASC],
          'desc'=>['name'=>SORT_DESC,'surname'=>SORT_DESC]
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere("name like '%$this->fullname%' or surname like '%$this->fullname%' ");

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



        $query->andFilterWhere(['like', 'user.username', $this->username])
              ->andFilterWhere(['like', 'user.email', $this->email])
              ->andFilterWhere(['like', 'title', $this->title])
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
