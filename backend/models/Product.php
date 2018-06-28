<?php

namespace backend\models;

use Yii;

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
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
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
            [['code', 'name', 'slug', 'description', 'author', 'category_id', 'price', 'picture'], 'required'],
            [['description', 'picture'], 'string'],
            [['category_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'name', 'slug', 'author', 'price'], 'string', 'max' => 200],
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
            'code' => 'Code',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'author' => 'Author',
            'category_id' => 'Category ID',
            'price' => 'Price',
            'picture' => 'Picture',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
