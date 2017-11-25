<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\helpers\ArrayHelper;

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
    
    public static function getLonDMS($longitude){
        $Hemisphere = $longitude < 0 ? 'W' : 'E';
        $lonDMS = self::getDECtoDMS($longitude);
               
        return $Hemisphere.$lonDMS;
    }
    
    public static function getLatDMS($latitude){
        $Hemisphere = $latitude < 0 ? 'S' : 'N';
        $latDMS = self::getDECtoDMS($latitude);
               
        return $Hemisphere.$latDMS;
    }

    /* ====== Coordenate Converter ============*/
    public static function getDECtoDMS($dec){
        // Converts decimal longitude / latitude to DMS
        // ( Degrees / minutes / seconds ) 

        // This is the piece of code which may appear to 
        // be inefficient, but to avoid issues with floating
        // point math we extract the integer part and the float
        // part by using a string function.

        $vars = explode(".",$dec);
        $deg = $vars[0];
        $tempma = "0.".$vars[1];
        
        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min*60);
        
        $coordenate = abs($deg).'&deg; '.$min."' ".round($sec, 0).'"';

        return $coordenate;
    }

    public static function getAirportList(){
        $airport = self::find()->asArray()->all();
        return ArrayHelper::map($airport, 'ID', 'ICAO');
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
