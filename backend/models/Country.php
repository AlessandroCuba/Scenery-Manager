<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "icao_country".
 *
 * @property integer $id_icao_country
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
            'id_icao_country' => Yii::t('app', 'Id Icao Country'),
            'regionId' => Yii::t('app', 'Region ID'),
            'icao_country' => Yii::t('app', 'Icao Country'),
            'country_name' => Yii::t('app', 'Country Name'),
            'alpha2code' => Yii::t('app', 'Alpha2code'),
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
