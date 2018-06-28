<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Subcategory */

$this->title = 'Create Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="category" class="category-index">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
