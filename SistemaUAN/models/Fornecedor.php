<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "fornecedor".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $telefone
 * @property string $cnpj
 * @property string $rua
 * @property int $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $estado
 * @property int $isAtivo
 */
class Fornecedor extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fornecedor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome','email','cnpj','telefone','rua','numero','bairro','cidade','estado'],  'required', 'message' => 'Campo obrigatório'],
            [['numero'],'number','integerOnly'=>true],
            [['nome', 'email', 'rua', 'complemento', 'bairro', 'cidade'], 'string', 'max' => 50],
            [['telefone'], 'string', 'max' => 15],
            [['cnpj'], 'string', 'max' => 20],
            [['estado'], 'string', 'max' => 30],
            ['email','email'],
            ['nome','unique'],
            ['cnpj','unique'],
            ['nome','unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Empresa',
            'email' => 'E-mail',
            'telefone' => 'Telefone',
            'cnpj' => 'CNPJ',
            'rua' => 'Rua',
            'numero' => 'Número',
            'complemento' => 'Complemento',
            'bairro' => 'Bairro',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
        ];
    }
}
