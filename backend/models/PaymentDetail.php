<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment_detail".
 *
 * @property int $id
 * @property int $payment_id
 * @property int $product_id
 * @property string $data
 * @property double $sell_price
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Payments $payment
 */
class PaymentDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_id', 'product_id', 'data', 'sell_price'], 'required'],
            [['id', 'payment_id', 'product_id'], 'integer'],
            [['data'], 'string'],
            [['sell_price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['id'], 'unique'],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payments::className(), 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_id' => 'Payment ID',
            'product_id' => 'Product ID',
            'data' => 'Data',
            'sell_price' => 'Sell Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payments::className(), ['id' => 'payment_id']);
    }
}
