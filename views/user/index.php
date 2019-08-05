<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="section-header-panel">
        <div class="pull-left"><h1><?= Html::encode($this->title) ?></h1></div>
        <div class="pull-right"><?= Html::a('Create User', ['create'], ['class' => 'btn btn-success pull-right']) ?></div>
    </div>

    <div class="striped-border"></div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table'],
            'columns' => [
                'id',
                'first_name:ntext',
                'last_name:ntext',
                [
                    'attribute' => 'age',
                    'label' => 'Age',
                    'format' => 'integer',
                ],
                'email:ntext',
                'personal_code',
                //'phone',
                'active:boolean',
                //'dead:boolean',
                //'lang:ntext',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
