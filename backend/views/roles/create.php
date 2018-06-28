<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\activerecord\Roles */

$this->title = 'Create Roles';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="category" class="category-index" style="float: left;width: 100%;background-color: #ecf0f5;">

    <h1 class="category-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => false
    ]) ?>

</div>
