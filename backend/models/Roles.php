<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "backend_user_roles".
 *
 * @property int $id
 * @property string $name
 * @property int $description
 * @property int $status
 *
 * @property BackendPermission[] $backendPermissions
 */
class Roles extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;
    const STATUS_DELETED    = -1;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'backend_user_roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'status'], 'required'],
            [['status'], 'integer'],
            [['name', 'description'], 'string', 'max' => 200],
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
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackendPermissions()
    {
        return $this->hasMany(BackendPermission::className(), ['roles' => 'id']);
    }
}
