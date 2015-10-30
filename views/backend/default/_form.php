<?php

use voskobovich\mandrill\Module;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 * @var \yii\web\View $this
 * @var \voskobovich\mandrill\models\MandrillTemplate $model
 */
?>
    <div class="box-header">
        <h3 class="box-title"><?= $formTitle ?></h3>
    </div><!-- /.box-header -->

<?php $form = ActiveForm::begin(['id' => 'category-form']) ?>
    <div class="nav-tabs-custom" role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#main" aria-controls="main" role="tab" data-toggle="tab">
                    <?= Module::t('core', 'Main') ?>
                </a>
            </li>
            <li role="presentation">
                <a href="#setting-styles" aria-controls="setting-styles" role="tab" data-toggle="tab">
                    <?= Module::t('core', 'Style') ?>
                </a>
            </li>
            <li role="presentation">
                <a href="#advanced-options" aria-controls="advanced-options" role="tab" data-toggle="tab">
                    <?= Module::t('core', 'Advanced') ?>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="main">
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'from_name') ?>
                <?= $form->field($model, 'from_email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model,
                    'bcc_email')->hint('You can enter multiple emails separated by comma') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="setting-styles">
                <?= $form->field($model, 'background_color') ?>
                <?= $form->field($model, 'background_url') ?>
                <?= $form->field($model, 'logo_url') ?>
                <?= $form->field($model, 'header')->widget(Widget::className(), [
                    'settings' => [
                        'minHeight' => 200,
                        'plugins' => [
                            'fontcolor',
                            'fontfamily',
                            'fontsize',
                            'clips',
                            'fullscreen',
                            'counter',
                            'imagemanager',
                            'table',
                            'video',
                            'textexpander',
                        ]
                    ]
                ]); ?>
                <?= $form->field($model, 'footer')->widget(Widget::className(), [
                    'settings' => [
                        'minHeight' => 200,
                        'plugins' => [
                            'fontcolor',
                            'fontfamily',
                            'fontsize',
                            'clips',
                            'fullscreen',
                            'counter',
                            'imagemanager',
                            'table',
                            'video',
                            'textexpander',
                        ]
                    ]
                ]); ?>
                <?= $form->field($model, 'is_default')->checkbox() ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="advanced-options">
                <?= $form->field($model, 'slug') ?>
                <?= $form->field($model, 'template_slug') ?>
            </div>
            <?= Html::submitButton(Yii::t('backend', $model->isNewRecord ? 'Add' : 'Save'),
                ['class' => 'btn btn-primary']) ?>
        </div>

    </div>
<?php ActiveForm::end() ?>