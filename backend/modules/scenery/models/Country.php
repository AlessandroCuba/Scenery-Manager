<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "icao_country".
 *
 * @property integer $id
 * @property integer $regionId
 * @property string $icao_country
 * @property string $country_name
 * @property string $alpha2code
 *
 * @property IcaoRegion $region
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'icao_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionId', 'icao_country', 'alpha2code'], 'required'],
            [['regionId'], 'integer'],
            [['icao_country', 'alpha2code'], 'string', 'max' => 2],
            [['country_name'], 'string', 'max' => 45],
            [['icao_country'], 'unique'],
            [['regionId'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['regionId' => 'id_icao_region']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'regionId' => Yii::t('app', 'Region ID'),
            'icao_country' => Yii::t('app', 'Icao Country'),
            'country_name' => Yii::t('app', 'Country Name'),
            'alpha2code' => Yii::t('app', 'Alpha2code'),
        ];
    }
    
    /*public function getCodeCountry()
    {
        return $this->icao_country.' '.$this->country_name;
    }*/

    public static function getCountryList($id)
    {
        $country = self::find()->select(['icao_country', 'CONCAT(icao_country," ",country_name) AS codeCountry'])
                               ->where(['regionId' => $id])->asArray()->all();
        return ArrayHelper::map($country, 'icao_country', 'codeCountry');
    }

    public static function getCountryDepent($regionId)
    {
        $data = self::find()->select(['icao_country', 'CONCAT(icao_country," ",country_name) AS codeCountry'])
                ->where(['regionId' => $regionId])
                ->asArray()->all();
        
        
        foreach ($data as $dat) {
        $out[] = ['id' => $dat['icao_country'], 'name' => $dat['codeCountry']];
        }
        return $output = [
            'output' => $out,
            'selected' => ''
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id_icao_region' => 'regionId']);
    }
}
