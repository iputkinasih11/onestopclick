<?php 

namespace frontend\controllers;

use Yii;
use common\models\Category;
use common\models\Subcategory;
use common\models\Product;
use yii\data\Pagination;

class CategoryController extends \yii\web\Controller
{
	public function behavior()
	{
		$this->layout = 'main';
	}

	public function actionIndex( $cats = false, $subcategory = false )
	{

		$maincats = $subcheck = false;

		if ( $cats )
		{
			$this->view->params['menu'] = $cats;
			$maincats 					= Category::findOne(['slug' => $cats]);

			if ( !$maincats )
			{
				throw new \yii\web\NotFoundHttpException();
			}

			if ( $maincats && $subcategory )
			{
				$subcheck 	= Subcategory::findOne( ['category_id' => $maincats->id, 'slug' => $subcategory] );
				if ( !$subcheck )
				{
					throw new \yii\web\NotFoundHttpException();
				}

				$item_list 	= Product::find()->where( ['category_id' => $subcheck->id] );
			}
			else
			{
				$item_list 	= Product::find()
								->join('LEFT JOIN','subcategory','product.category_id = subcategory.id')
								->join('LEFT JOIN','category','category.id=subcategory.category_id')
								->where(['category.id' => $maincats->id]);
			}
			
			$countQuery 	= clone $item_list;
			$pages 			= new Pagination(['totalCount' => $countQuery->count()]);
			$models 		= $item_list->offset($pages->offset)
								->limit($pages->limit)
								->all();
		}
		else
		{
			throw new \yii\web\NotFoundHttpException();
		}

		$this->view->params['category'] = $cats;
		$this->view->params['subcategory'] = $subcategory;

		return $this->render('index',
			[
				'pages' 		=> $pages,
				'products' 		=> $models,
				'category' 		=> $maincats,
				'subcategory' 	=> $subcheck
			]
		);
	}
}

?>