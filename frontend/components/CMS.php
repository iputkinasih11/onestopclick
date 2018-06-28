<?php
namespace frontend\components;


use Yii;
use yii\helpers\Html;
use common\models\Category;
use common\models\Subcategory;

class CMS {
   

   /**
    * [getMenu description]
    * @return [type] [description]
    */
    public function getMenu(){
        return Category::find()->where(['status' => Category::STATUS_ACTIVE])->orderBy(['name' => SORT_ASC])->all();
    }

    public function getFirstCategory(){
        return Category::find()->where(['status' => Category::STATUS_ACTIVE])->orderBy(['name' => SORT_ASC])->one();
    }

    public function getSubCategory(){
        $subcategory = Subcategory::find()
                        ->select(['subcategory.*','parent_name' => 'category.name', 'parent_slug' => 'category.slug'])
                        ->where(['category.status' => Category::STATUS_ACTIVE, 'subcategory.status' => Category::STATUS_ACTIVE])
                        ->join('left join','category','category.id=subcategory.category_id')
                        ->orderBy(['category.name' => SORT_ASC,'subcategory.name' => SORT_ASC])
                        ->all();

        $return = [];
        foreach($subcategory as $item){
            $return[$item->parent_slug][] = $item;
        }

        return $return;
    }

    public function getOtherMenu(){
        return ['Brand' => 'brand', 'Contact' => 'contact'];
    }

    public function getTotalCart(){
        $session    = Yii::$app->session;
        $items      = $session->get('cart');
        $total      = 0;
        if($items){
            foreach($items as $item){
                $total += $item['price'] * $item['qty'];
            }
        }

        return number_format($total);
    }

    public function getCountCart() 
    {
        $session    = Yii::$app->session;
        $items      = $session->get('cart');
        $count      = 0;
        if($items){
            foreach($items as $item){
                $count += 1;
            }
        }

        return $count;
    }
}
?>