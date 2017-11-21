<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "icao_region".
 *
 * @property integer $id_icao_region
 * @property string $icao_region
 * @property string $name_region
 * @property string $comentare
 *
 * @property IcaoCountry[] $icaoCountries
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icao_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icao_region', 'comentare'], 'required'],
            [['icao_region'], 'string', 'max' => 2],
            [['name_region'], 'string', 'max' => 120],
            [['comentare'], 'string', 'max' => 60],
            [['icao_region'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_icao_region' => Yii::t('app', 'Id'),
            'icao_region' => Yii::t('app', 'Icao Region'),
            'name_region' => Yii::t('app', 'Name Region'),
            'comentare' => Yii::t('app', 'Comentare'),
        ];
    }
    
    public static function getRegionList(){
        $region = self::find()->orderBy('name_region ASC')->asArray()->all();
        return ArrayHelper::map($region, 'id_icao_region', 'name_region');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIcaoCountries()
    {
        return $this->hasMany(IcaoCountry::className(), ['regionId' => 'id_icao_region']);
    }
}
