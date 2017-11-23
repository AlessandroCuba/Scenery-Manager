<?php

namespace backend\modules\scenery\models;

use Yii;

use backend\modules\scenery\models\Country;


/**
 * This is the model class for table "airports".
 *
 * @property integer $ID
 * @property string $Name
 * @property string $ICAO
 * @property integer $PrimaryID
 * @property double $Latitude
 * @property double $Longitude
 * @property integer $Elevation
 * @property string $country_name
 * 
 * @property Runways[] $runways
 */
class Airports extends \yii\db\ActiveRecord
{
    public $country_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'airports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID', 'PrimaryID', 'Elevation'], 'integer'],
            [['Latitude', 'Longitude'], 'number'],
            [['Name'], 'string', 'max' => 38],
            [['ICAO'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'ICAO' => Yii::t('app', 'Icao'),
            'PrimaryID' => Yii::t('app', 'Primary ID'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longitude' => Yii::t('app', 'Longtitude'),
            'Elevation' => Yii::t('app', 'Elevation'),
            'country_name' => Yii::t('app', 'Country'),
        ];
    }
    
    public function getCountry(){
        $country = Country::find()->select('country_name')->where(['icao_country' => substr($this->ICAO, 0,2)]);
        return $country;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRunways()
    {
        return $this->hasMany(Runways::className(), ['AirportID' => 'ID']);
    }
}
