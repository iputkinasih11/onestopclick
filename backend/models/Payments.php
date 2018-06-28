<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property int $id
 * @property string $payment_id
 * @property string $date
 * @property string $total
 * @property string $total_usd
 * @property int $voucher_id
 * @property string $discount
 * @property string $grand_total
 * @property string $grand_total_usd
 * @property int $status 0 = 'waiting verification', 1 = 'confirmed'
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PaymentDetail[] $paymentDetails
 * @property Voucher $voucher
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['payment_id', 'total', 'total_usd', 'voucher_id', 'discount', 'grand_total', 'grand_total_usd'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['total', 'total_usd', 'discount', 'grand_total', 'grand_total_usd'], 'number'],
            [['voucher_id', 'status'], 'integer'],
            [['payment_id'], 'string', 'max' => 200],
            [['voucher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Voucher::className(), 'targetAttribute' => ['voucher_id' => 'id']],
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
            'date' => 'Date',
            'total' => 'Total',
            'total_usd' => 'Total USD',
            'voucher_id' => 'Voucher ID',
            'discount' => 'Discount',
            'grand_total' => 'Grand Total',
            'grand_total_usd' => 'Grand Total USD',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentDetails()
    {
        return $this->hasMany(PaymentDetail::className(), ['payment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucher()
    {
        return $this->hasOne(Voucher::className(), ['id' => 'voucher_id']);
    }
}
