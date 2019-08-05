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

    <div class="section-header-panel">
        <div class="pull-left">
            <h1><?= Html::encode($this->title) ?>
                <sup class="badge badge-danger user-age-badge"><?php echo $model->age ?>, years old</sup>
            </h1>
        </div>
        <div class="pull-right">
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
        </div>
    </div>

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
