<?php

namespace backend\modules\scenery\models;

use Yii;

/**
 * This is the model class for table "categ_sim".
 *
 * @property integer $id_catsimulator
 * @property string $catsimulator
 * @property string $color
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
            [['color'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_catsimulator' => Yii::t('app', 'Id Catsimulator'),
            'catsimulator' => Yii::t('app', 'Simulator'),
            'color' => Yii::t('app', 'Color HEX'),
        ];
    }
}
