<?php

namespace voskobovich\mandrill\models;

use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "{{%mod_mandrill_template}}".
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
class MandrillTemplateSearch extends MandrillTemplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'from_name', 'from_email', 'subject'], 'string'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = static::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name]);
        $query->andFilterWhere(['like', 'from_name', $this->from_name]);
        $query->andFilterWhere(['like', 'from_email', $this->from_email]);
        $query->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }
}