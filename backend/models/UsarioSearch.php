<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Usuario;

/**
 * UsarioSearch represents the model behind the search form about `backend\models\Usuario`.
 */
class UsarioSearch extends Usuario
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['INT_ID_USUARIO', 'PERFIL_INT_ID_PERFIL'], 'integer'],
            [['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_SENHA'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Usuario::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'INT_ID_USUARIO' => $this->INT_ID_USUARIO,
            'PERFIL_INT_ID_PERFIL' => $this->PERFIL_INT_ID_PERFIL,
        ]);

        $query->andFilterWhere(['like', 'STR_NOME_COMPLETO', $this->STR_NOME_COMPLETO])
            ->andFilterWhere(['like', 'STR_EMAIL', $this->STR_EMAIL])
            ->andFilterWhere(['like', 'STR_SENHA', $this->STR_SENHA]);

        return $dataProvider;
    }
}
