<?php

namespace backend\modules\scenery\models;

use Yii;

/**
 * This is the model class for table "runways".
 *
 * @property integer $id
 * @property integer $AirportID
 * @property string $Ident
 * @property double $TrueHeading
 * @property integer $Length
 * @property integer $Width
 * @property string $Surface
 * @property double $Latitude
 * @property double $Longtitude
 * @property integer $Elevation
 *
 * @property Airports $airport
 * @property SurfaceTypes $surface
 */
class Runways extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'runways';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'AirportID', 'Length', 'Width', 'Elevation'], 'integer'],
            [['TrueHeading', 'Latitude', 'Longtitude'], 'number'],
            [['Ident', 'Surface'], 'string', 'max' => 3],
            [['AirportID'], 'exist', 'skipOnError' => true, 'targetClass' => Airports::className(), 'targetAttribute' => ['AirportID' => 'ID']],
            [['Surface'], 'exist', 'skipOnError' => true, 'targetClass' => Surface::className(), 'targetAttribute' => ['Surface' => 'SurfaceType']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'AirportID' => Yii::t('app', 'Airport Name'),
            'Ident' => Yii::t('app', 'Ident'),
            'TrueHeading' => Yii::t('app', 'True Heading'),
            'Length' => Yii::t('app', 'Length'),
            'Width' => Yii::t('app', 'Width'),
            'Surface' => Yii::t('app', 'Surface'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'Longtitude' => Yii::t('app', 'Longtitude'),
            'Elevation' => Yii::t('app', 'Elevation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAirport()
    {
        return $this->hasOne(Airports::className(), ['ID' => 'AirportID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSurface()
    {
        return $this->hasOne(Surface::className(), ['SurfaceType' => 'Surface']);
    }
}
