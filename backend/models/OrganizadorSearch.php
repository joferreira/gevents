<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Cliente;

/**
 * OrganizadorSearch represents the model behind the search form about `common\models\Cliente`.
 */
class OrganizadorSearch extends Cliente
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['INT_ID_CLIENTE'], 'integer'],
			[['STR_NOME_COMPLETO', 'STR_EMAIL', 'STR_CPF', 'STR_CNPJ'], 'safe'],
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
		$query = Cliente::find();

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$query->andFilterWhere([
			'TIPO_CLIENTE_INT_ID_TIPO_CLIENTE' => 2,
			'INT_STATUS'=>1, 
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}		

		$query->andFilterWhere([
			'INT_ID_CLIENTE' => $this->INT_ID_CLIENTE,
		]);

		$query->andFilterWhere(['like', 'STR_NOME_COMPLETO', $this->STR_NOME_COMPLETO])
			->andFilterWhere(['like', 'STR_EMAIL', $this->STR_EMAIL])
			->andFilterWhere(['like', 'STR_CPF', $this->STR_CPF])
			->andFilterWhere(['like', 'STR_CNPJ', $this->STR_SENHA]);

		return $dataProvider;
	}
}
