<?php

namespace voskobovich\mandrill\models;

use voskobovich\base\db\ActiveRecord;
use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "{{%mail}}".
 *
 * @property integer $id
 * @property string $slug
 * @property string $name
 * @property string $template_slug
 * @property string $from_email
 * @property string $from_name
 * @property string $bcc_email
 * @property string $subject
 * @property string $background_color
 * @property string $background_url
 * @property string $logo_url
 * @property string $header
 * @property string $footer
 * @property boolean $is_default
 */
class MandrillTemplate extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%mod_mandrill_template}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['is_default'], 'boolean'],
            [['slug'], 'unique'],
            [
                [
                    'name',
                    'slug',
                    'template_slug',
                    'from_email',
                    'from_name',
                    'bcc_email',
                    'subject',
                    'background_url',
                    'logo_url',
                ],
                'string',
                'max' => 255
            ],
            [['header', 'footer'], 'string'],
            [['background_color'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('mail', 'ID'),
            'slug' => Yii::t('mail', 'Slug'),
            'name' => Yii::t('mail', 'Name'),
            'template_slug' => Yii::t('mail', 'Template Slug in Mandrill'),
            'from_email' => Yii::t('mail', 'From Email'),
            'from_name' => Yii::t('mail', 'From Name'),
            'bcc_email' => Yii::t('mail', 'Bcc Email(s)'),
            'subject' => Yii::t('mail', 'Subject'),
            'background_color' => Yii::t('mail', 'Background Color'),
            'background_url' => Yii::t('mail', 'Background Url'),
            'logo_url' => Yii::t('mail', 'Logo Url'),
            'header' => Yii::t('mail', 'Header'),
            'footer' => Yii::t('mail', 'Footer'),
            'is_default' => Yii::t('mail', 'Use as defaults')
        ];
    }

    /**
     * Поиск моделей
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort = [
            'defaultOrder' => [
                'is_default' => SORT_DESC,
                'name' => SORT_ASC,
            ],
        ];

        // Загружаем данные с формы в модель
        if (!$this->load($params)) {
            return $dataProvider;
        }

        return $dataProvider;
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     * @return bool
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($this->is_default) {
            self::updateAll(['is_default' => false], 'id <> :id', [':id' => $this->id]);
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        if ($this->is_default) {
            return false;
        }

        return parent::beforeDelete();
    }

    /**
     * Bcc address array
     * @return array
     */
    public function getBccAddress()
    {
        $emails = explode(',', $this->bcc_email);
        return array_map(function ($item) {
            return trim($item);
        }, $emails);
    }
}