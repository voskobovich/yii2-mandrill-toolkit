<?php

namespace voskobovich\mandrill\components;

use voskobovich\mandrill\models\MandrillTemplate;
use yii\helpers\ArrayHelper;


/**
 * Class Mailer
 * @package voskobovich\mandrill\components
 */
class Mailer extends \nickcv\mandrill\Mailer
{
    /**
     * @var bool|MandrillTemplate
     */
    private static $_defaultModel = false;

    /**
     * Объект данных из базы
     * @param $name string
     * @return MandrillTemplate|null
     */
    public static function findModel($name)
    {
        return MandrillTemplate::findOne(['slug' => $name]);
    }

    /**
     * @return MandrillTemplate|bool|null|static
     */
    public static function findDefaultModel()
    {
        if (self::$_defaultModel === false) {
            self::$_defaultModel = MandrillTemplate::findOne(['is_default' => true]);
        }

        return self::$_defaultModel;
    }

    /**
     * @param $params
     * @param $attribute
     * @return MandrillTemplate|null
     */
    public static function setParamDefaultValue($params, $attribute)
    {
        self::$_defaultModel = self::findDefaultModel();
        if (self::$_defaultModel) {
            $params[$attribute] = self::$_defaultModel->getAttribute($attribute);
        }

        return $params;
    }

    /**
     * @inheritdoc
     */
    public function compose($view = null, array $params = [])
    {
        $model = self::findModel($view);

        if ($model != null) {
            if ($model->template_slug) {
                $view = $model->template_slug;
            }

            $params = ArrayHelper::merge($params, [
                'background_color' => $model->background_color,
                'background_url' => $model->background_url,
                'logo_url' => $model->logo_url,
                'header' => $model->header,
                'footer' => $model->footer
            ]);
        }

        if (empty($params['background_color'])) {
            $params = self::setParamDefaultValue($params, 'background_color');
        }

        if (empty($params['background_url'])) {
            $params = self::setParamDefaultValue($params, 'background_url');
        }

        if (empty($params['logo_url'])) {
            $params = self::setParamDefaultValue($params, 'logo_url');
        }

        if (empty($params['header'])) {
            $params = self::setParamDefaultValue($params, 'header');
        }

        if (empty($params['footer'])) {
            $params = self::setParamDefaultValue($params, 'footer');
        }

        $message = parent::compose($view, $params);

        if (!empty($params['background_url'])) {
            $message->embed($params['background_url'], [
                'fileName' => 'background_cid'
            ]);
        }

        if (!empty($params['logo_url'])) {
            $message->embed($params['logo_url'], [
                'fileName' => 'logo_cid'
            ]);
        }

        if ($model != null) {
            if ($model->from_email) {
                $fromEmail = $model->from_email;
                if ($model->from_name) {
                    $fromEmail = [$model->from_email => $model->from_name];
                }
                $message->setFrom($fromEmail);
            }

            $message->setBcc($model->getBccAddress());

            if ($model->subject) {
                $message->setSubject($model->subject);
            }
        }

        return $message;
    }
}