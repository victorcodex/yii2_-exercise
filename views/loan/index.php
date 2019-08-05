<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Loans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <div class="section-header-panel">
        <div class="pull-left"><h1><?= Html::encode($this->title) ?></h1></div>
        <div class="pull-right"><?= Html::a(Yii::t('app', 'Create Loan'), ['create'], ['class' => 'btn btn-success pull-right']) ?></div>
    </div>

    <div class="striped-border"></div>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table'],
        'columns' => [
            'id',
            [
                'attribute' => 'user',
                'label' => 'User',
                'value' => 'user.fullName',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Search by first name'
                ]
            ],
            'user_id',
            'amount',
            'interest',
            'duration',
            //'start_date',
            //'end_date',
            //'campaign',
            //'status:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
