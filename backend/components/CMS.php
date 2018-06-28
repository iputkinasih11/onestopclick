<?php
namespace backend\components;

use yii;
use yii\helpers\Html;
use common\models\Category;

class CMS {

    private static $_menu = '';


    /**
    * [getMenu description]
    * @return [type] [description]
    */
    public function getMenu(){
        $session = Yii::$app->session;
        return $session['menu'];
    }


    public function getOtherMenu(){
        return ['Brand' => 'brand', 'Contact' => 'contact'];
    }


    public function activeMenu($source, $comparator, $stringreturn = 'class="active"', $default = false){
        if($source == $comparator){
            return $stringreturn;
        }

        return $default;
    }

    public function check_permission($access_type = Permission::FULL_ACCESS){
        $session = Yii::$app->session;
        if(!isset($session['menu']['list'][strtolower(Yii::$app->controller->id)])){
            return false;
        }
        if($session['menu']['list'][strtolower(Yii::$app->controller->id)]['access'] == $access_type){
            return TRUE;
        }
        return false;
    }

    public function get_permission(){
        $session = Yii::$app->session;
        return $session['menu']['list'][strtolower(Yii::$app->controller->id)]['access'];  
    }
}
?>