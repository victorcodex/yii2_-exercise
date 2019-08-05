<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Loan;
//use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class LoanSearch extends Loan
{
    /**
     * {@inheritdoc}
     */

    public $user;

    public function rules()
    {
        return [
            [['duration', 'campaign'], 'integer'],
            [['user','user_id', 'amount','interest','duration','start_date', 'end_date'], 'safe'],
            [['status'], 'boolean'],
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
        $query = Loan::find();
        // add conditions that should always apply here

        $query->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->sort->attributes['user'] = [
            'asc' => ['user.first_name' => SORT_ASC],
            'desc' => ['user.first_name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'campaign' => $this->campaign,
            'status' => $this->status,
        ]);

        // grid filtering conditions - prepare %Like% query
         $search_user="'%".str_replace(" ","%",$this->user)."%'";
        $search_amount="'%".str_replace(" ","%",$this->amount)."%'";
        $search_interest="'%".str_replace(" ","%",$this->interest)."%'";
        $search_duration="'%".str_replace(" ","%",$this->duration)."%'";
        $search_start_date="'%".str_replace(" ","%",$this->start_date)."%'";
        $search_end_date="'%".str_replace(" ","%",$this->end_date)."%'";

        // grid filtering conditions - execute prepared %Like% query
        $query
             ->andWhere('user.first_name like '.$search_user)
            ->andWhere('amount like '.$search_amount)
            ->andWhere('interest like '.$search_interest)
            ->andWhere('duration like '.$search_duration)
            ->andWhere('start_date like '.$search_start_date)
            ->andWhere('end_date like '.$search_end_date);


        return $dataProvider;
    }
}
