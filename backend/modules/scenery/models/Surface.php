<?php

namespace backend\modules\scenery\models;

use Yii;

/**
 * This is the model class for table "surface_types".
 *
 * @property string $SurfaceType
 * @property string $Description
 *
 * @property Runways[] $runways
 */
class Surface extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'surface_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SurfaceType'], 'required'],
            [['SurfaceType'], 'string', 'max' => 3],
            [['Description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'SurfaceType' => Yii::t('app', 'Surface Type'),
            'Description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRunways()
    {
        return $this->hasMany(Runways::className(), ['Surface' => 'SurfaceType']);
    }
}
