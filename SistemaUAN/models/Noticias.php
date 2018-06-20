<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "noticias".
 *
 * @property int $id
 * @property string $titulo
 * @property string $conteudo
 * @property string $data
 * @property imageFile
 * @property int isAtivo
 */
class Noticias extends ActiveRecord
{
    /**
     * @var UploadedFile 
     */
    public $foto;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'noticias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo', 'conteudo'], 'required', 'message' => 'Campo obrigatório'],
            [['conteudo'], 'string'],
            [['data'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
            [['imageFile'],'image'],
            ['foto', 'file', 'extensions'=>'png, jpg, jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id Noticia',
            'titulo' => 'Título',
            'conteudo' => 'Conteúdo',
            'data' => 'Data',
            'imageFile' => 'Imagem',
            'foto' => 'Imagem'
        ];
    }
}
