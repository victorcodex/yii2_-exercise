<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Loans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="striped-border"></div>

    <p>
        <?= Html::a(Yii::t('app', 'Create Loan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table'],
        'columns' => [
            'id',
            [
                'attribute' => 'user',
                'label' => 'User',
                'value' => 'user.fullName',
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
