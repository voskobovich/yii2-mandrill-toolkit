<?php

namespace voskobovich\mandrill\controllers\backend;

use voskobovich\admin\controllers\BackendController;
use voskobovich\mandrill\Module;
use Yii;


/**
 * Class DefaultController
 * @package voskobovich\mandrill\controllers\backend
 */
class DefaultController extends BackendController
{
    /**
     * Класс модели
     * @var string
     */
    public $modelClass = 'voskobovich\mandrill\models\MandrillTemplate';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        /** @var Module $module */
        $module = Yii::$app->module;
        if ($module->controllerLayout) {
            $this->layout = $module->controllerLayout;
        }
    }

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();

        $actions['grid-handler'] = [
            'class' => 'voskobovich\grid\advanced\actions\HandlerAction',
            'modelClass' => $this->modelClass,
        ];

        return $actions;
    }
}