<?php

namespace backend\modules\scenery\models;

use Yii;

/**
 * This is the model class for table "categ_sim".
 *
 * @property integer $id_catsimulator
 * @property string $catsimulator
 */
class Sim extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categ_sim';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catsimulator'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_catsimulator' => Yii::t('app', 'Id Catsimulator'),
            'catsimulator' => Yii::t('app', 'Catsimulator'),
        ];
    }
}
