<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id
 * @property string $descricao
 */
class Categoria extends ActiveRecord
{
    /*CONST STATUS_ACTIVE = 1;
    CONST STATUS_INACTIVE = 0;
    CONST STATUS_ACTIVE_STRING = 'Active';
    CONST STATUS_INACTIVE_STRING = 'Inactive';*/

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'],  'required', 'message' => 'Campo obrigatório'],
            [['descricao'], 'string', 'max' => 30],
            ['descricao', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'descricao' => 'Descrição',
        ];
    }

    /*public function getStatusItems()
    {
        return [
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_STRING,
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_STRING,
        ];
    }

    public function getAllCategorias()
    {
        return Categoria::find()
                    ->select('id, descricao')
                    ->where(['isAtivo' => self::STATUS_ACTIVE])
                    ->orderBy('descricao')
                    ->all();
    }
    public function getAllCategoriasAsArray()
    {
        return ArrayHelper::map($this->getAllCategorias(), 'id', 'descricao');
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduto()
    {
        return $this->hasMany(Produto::className(), ['categoria_id' => 'id']);
    }
}
