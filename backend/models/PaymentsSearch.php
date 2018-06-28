<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Payments;

/**
 * PaymentsSearch represents the model behind the search form of `backend\models\Payments`.
 */
class PaymentsSearch extends Payments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'voucher_id', 'status'], 'integer'],
            [['payment_id', 'date', 'created_at', 'updated_at'], 'safe'],
            [['total', 'total_usd', 'discount', 'grand_total', 'grand_total_usd'], 'number'],
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
        $query = Payments::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'date' => $this->date,
            'total' => $this->total,
            'total_usd' => $this->total_usd,
            'voucher_id' => $this->voucher_id,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'grand_total_usd' => $this->grand_total_usd,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'payment_id', $this->payment_id]);

        return $dataProvider;
    }
}
