<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property int $id
 * @property string $name
 * @property string $slug 
 * @property string $code
 * @property string $description
 * @property int $discount_prosentase
 * @property int $discount_price
 * @property string $start_date
 * @property string $end_date
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property VoucherDetail[] $voucherDetails
 */
class Voucher extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;
    const STATUS_DELETED    = -1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'code', 'status'], 'required'],
            [['description'], 'string'],
            [['discount_prosentase', 'discount_price', 'status'], 'integer'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 200],
            [['code'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'code' => 'Code',
            'description' => 'Description',
            'discount_prosentase' => 'Discount Prosentase',
            'discount_price' => 'Discount Price',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoucherDetails()
    {
        return $this->hasMany(VoucherDetail::className(), ['voucher_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        date_default_timezone_set("Asia/Singapore");
        if (parent::beforeSave($insert)) 
        {
            if ($this->isNewRecord)
                $this->created_at = date('Y-m-d H:i:s');

            $this->updated_at = date('Y-m-d H:i:s');

            return true;
        } 
        else 
        {
            return false;
        }
    }
}
