<?php

namespace voskobovich\mandrill\forms;

use voskobovich\admin\forms\IndexFormAbstract;
use voskobovich\mandrill\models\MandrillTemplate;
use Yii;
use yii\data\ActiveDataProvider;


/**
 * @property string $name
 * @property string $from_email
 * @property string $from_name
 * @property string $subject
 */
class MandrillTemplateSearchForm extends IndexFormAbstract
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
        $query = MandrillTemplate::find();

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