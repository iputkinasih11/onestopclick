<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $status
 * @property int $category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 */
class Subcategory extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;
    const STATUS_DELETED    = -1;

    public $parent_name;
    public $parent_slug;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug', 'category_id'], 'required'],
            [['status', 'category_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 200],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])->select('name')->scalar();
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
