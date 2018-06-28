<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $author
 * @property int $category_id
 * @property string $price
 * @property string $picture
 * @property int $status
 * @property int $created_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;
    const STATUS_DELETED    = -1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'slug', 'author', 'category_id', 'price'], 'required'],
            [['description'], 'string'],
            [['category_id', 'status', 'created_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'name', 'slug', 'author', 'price'], 'string', 'max' => 200],
            [['picture'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function getSmallAvatar()
    {
        return $this->getImage('_small');
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'author' => 'Author',
            'category_id' => 'Category ID',
            'price' => 'Price (IDR)',
            'picture' => 'Picture',
            'status' => 'Status',
            'created_by' => 'Created By',
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

    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'category_id'])->select('name')->scalar();
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
