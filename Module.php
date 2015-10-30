<?php

namespace voskobovich\mandrill;

use Yii;


/**
 * Class Module
 * @package voskobovich\mandrill
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'voskobovich\mandrill\controllers';

    /**
     * Backend controller layout
     * @var string
     */
    public $controllerLayout;

    /**
     * Подключение переводов к системе
     */
    public static function registerTranslations()
    {
        // Register translates code
    }

    /**
     * Метод перевода
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        self::registerTranslations();

        return Yii::t('modules/mandrill/' . $category, $message, $params, $language);
    }
}