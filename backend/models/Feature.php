<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "backend_feature".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property BackendPermission[] $backendPermissions
 */
class Feature extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;
    const STATUS_DELETED    = -1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backend_feature';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 200],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendPermissions()
    {
        return $this->hasMany(BackendPermission::className(), ['feature' => 'id']);
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
