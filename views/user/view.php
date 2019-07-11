<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="striped-border"></div>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table'],
        'attributes' => [
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
            'phone',
            'active:boolean',
            'dead:boolean',
            'lang:ntext',
        ],
    ]) ?>

</div>
