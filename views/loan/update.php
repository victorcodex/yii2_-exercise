<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Loan */

$this->title = Yii::t('app', 'Update Loan: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Loans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="loan-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="striped-border"></div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
