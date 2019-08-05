<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['personal_code', 'phone'], 'integer'],
            [['first_name', 'last_name', 'email', 'lang'], 'safe'],
            [['active', 'dead'], 'boolean'],
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
    public function search($params)
    {
        $query = User::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'personal_code' => $this->personal_code,
            'phone' => $this->phone,
            'active' => $this->active,
            'dead' => $this->dead,
        ]);

        // grid filtering conditions - prepare %Like% query
        $search_first_name="'%".str_replace(" ","%",$this->first_name)."%'";
        $search_last_name="'%".str_replace(" ","%",$this->last_name)."%'";
        $search_email="'%".str_replace(" ","%",$this->email)."%'";
        $search_lang="'%".str_replace(" ","%",$this->lang)."%'";

        // grid filtering conditions - execute prepared %Like% query
        $query
            ->andWhere('first_name like '.$search_first_name)
            ->andWhere('last_name like '.$search_last_name)
            ->andWhere('email like '.$search_email)
            ->andWhere('lang like '.$search_lang);

        return $dataProvider;
    }
}
