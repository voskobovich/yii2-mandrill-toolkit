<?php

use voskobovich\mandrill\Module;
use voskobovich\alert\widgets\Alert;


/**
 * @var \yii\web\View $this
 * @var voskobovich\mandrill\models\MandrillTemplate $model
 */

$this->title = Module::t('core', 'Mandrill');
$formTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => Module::t('core', 'Mandrill'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>

<div class="row">
    <div class="col-lg-12">
        <?= Alert::widget(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <?= $this->render('_form', ['model' => $model, 'formTitle' => $formTitle]) ?>
    </div>
</div>