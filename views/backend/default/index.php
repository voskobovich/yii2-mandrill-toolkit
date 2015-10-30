<?php

use voskobovich\grid\advanced\GridView;
use voskobovich\mandrill\Module;
use voskobovich\alert\widgets\Alert;
use yii\widgets\Pjax;


/**
 * @var \yii\web\View $this
 * @var \voskobovich\mandrill\models\MandrillTemplate $model
 * @var \yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Module::t('backend', 'Mandrill');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <?= Alert::widget(); ?>

        <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table table-striped'],
            'pager' => [
                'class' => 'justinvoelker\separatedpager\LinkPager',
            ],
            'columns' => [
                [
                    'attribute' => 'name',
                    'value' => function ($model) {
                        return $model->name . ($model->is_default ? ' (default styles)' : '');
                    }
                ],
                'from_name',
                'from_email',
                'subject',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {delete}',
                    'options' => [
                        'width' => '70px'
                    ]
                ],
            ],
        ]) ?>
        <?php Pjax::end(); ?>
    </div>
</div>