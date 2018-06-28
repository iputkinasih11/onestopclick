<?php 
namespace frontend\controllers;
use Yii;

use common\models\Category;
use common\models\Subcategory;
use common\models\Product;
use frontend\components\CMS;


class ProductController extends \yii\web\Controller
{


    // Inside init() function, use checkLoginAccess() method to be called
	public function init() {
		parent::init();
		/*if(!Yii::$app->user->isGuest) {
			$this->checkLoginAccess();
		}*/

		Category::find()->orderBy(['name' => SORT_ASC]);
	}

	/**
	 * [actionIndex description]
	 * @param  boolean $slug [description]
	 * @return [type]        [description]
	 */
	public function actionIndex($slug = false)
	{
		if(!$slug){
			throw new \yii\web\NotFoundHttpException();
		}

		$product 	= Product::find()
						->select(['product.*','category.name category_name', 'category.slug category_slug'])
						->where(['`product`.slug' => $slug])
						->leftJoin('category', '`category`.`id` = `product`.`category_id`')
						->one();
		$product_id = $product->id;
		$cat_id 	= $product->category_id;
		$subcat 	= Subcategory::find()->where(['id' => $cat_id])->one();
		$cats 		= Category::find()->where(['id' => $subcat->category_id])->one();
		$related 	= Product::find()
						->select(['product.*','category.name category_name', 'category.slug category_slug'])
						->andWhere(['not like', 'product.id', $product_id])
						->andWhere(['product.category_id' => $cat_id])
						->leftJoin('category', '`category`.`id` = `product`.`category_id`')
						->limit(3)
						->all();
						
		if(!$product){
			throw new \yii\web\NotFoundHttpException();
		}

		$this->view->params['menu'] = CMS::getFirstCategory()->slug;
		$this->view->params['category'] = $cats->slug;
		$this->view->params['subcategory'] = $subcat->slug;

		return $this->render('index', ['product' => $product, 'related' => $related]);
	}

}

