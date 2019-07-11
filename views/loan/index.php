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

    <p>
        <?= Html::a(Yii::t('app', 'Create Loan'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
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
