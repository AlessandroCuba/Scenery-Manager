<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;
use nemmo\attachments\behaviors\FileBehavior;
use arogachev\ManyToMany\behaviors\ManyToManyBehavior;
use arogachev\ManyToMany\validators\ManyToManyValidator;
use v0lume\yii2\metaTags\MetaTagBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


use yeesoft\models\User;
use nemmo\attachments\models\File;
use backend\modules\scenery\models\Sim;
use backend\modules\scenery\models\Libraries;
use backend\modules\scenery\models\SceneryTag;
use backend\modules\scenery\models\Country;

/**
 * This is the model class for table "scenerysim".
 *
 * @property integer $id
 * @property string $icao
 * @property string $creator
 * @property string $description
 * @property integer $catesim
 * @property string $url_video
 * @property string $url_download
 * @property integer $author_id
 * @property integer $created_at
 * @property integer $updater_id
 * @property integer $updated_at
 * @property integer $ranking
 * @property integer $status
 *
 * @property Airports $icao0
 * @property CategSim $catesim0
 */
class Scenery extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const STATUS_PIRATE = 50;
    
    /**
    * @var array
    */
    public $editableLibrary;
    public $editableTag;
    public $region;
    public $icao_country;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scenerysim';
    }
    
    public function behaviors()
    {
        return [
            'MetaTag' => [
                'class' => MetaTagBehavior::className(),
            ],
            'manytomany'=>[
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                [
                    'editableAttribute' => 'editableLibrary',     // Editable attribute name
                    'table' => 'libreries_to_scenery',          // Name of the junction table
                    'ownAttribute' => 'scenery_id',             // Name of the column in junction table that represents current model
                    'relatedModel' => Libraries::className(),        // Related model class
                    'relatedAttribute' => 'librery_id',          // Name of the column in junction table that represents related model
                ]],
            ],
            FileBehavior::className(),
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['updated_at', 'created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
                ]
            ],
            'userstamp' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'author_id',
                'updatedByAttribute' => 'updater_id',
            ],
            'status' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'status',
                    //ActiveRecord::EVENT_BEFORE_UPDATE => 'status',
                ],
                'value' => function ($event) {
                                return Scenery::STATUS_INACTIVE;
                            },
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['icao', 'creator', 'description', 'catesim', 'url_download'], 'required'],
            [['catesim', 'ranking', 'status'], 'integer'],
            [['icao'], 'string', 'max' => 4],
            ['editableTag', ManyToManyValidator::className()],
            [['creator', 'url_video'], 'string', 'max' => 45],
            [['description'], 'string', 'max' => 500],
            [['url_download'], 'string', 'max' => 250],
            [['editableLibrary'], ManyToManyValidator::className()],
            [['icao'], 'exist', 'skipOnError' => true, 'targetClass' => Airports::className(), 'targetAttribute' => ['icao' => 'ICAO']],
            [['catesim'], 'exist', 'skipOnError' => true, 'targetClass' => Sim::className(), 'targetAttribute' => ['catesim' => 'id_catsimulator']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'icao' => Yii::t('app', 'Icao'),
            'creator' => Yii::t('app', 'Creator'),
            'description' => Yii::t('app', 'Description'),
            'catesim' => Yii::t('app', 'Catesim'),
            'url_video' => Yii::t('app', 'Url Video'),
            'url_download' => Yii::t('app', 'Url Download'),
            'author_id' => Yii::t('app', 'Created by'),
            'created_at' => Yii::t('app', 'Created'),
            'updater_id' => Yii::t('app', 'Updated by'),
            'updated_at' => Yii::t('app', 'Updated'),
            'ranking' => Yii::t('app', 'Ranking'),
            'status' => Yii::t('app', 'Status'),
            'editableLibrary' => Yii::t('app', 'Libraries'),
            'tagValues' => Yii::t('yee', 'Tags'),
        ];
    }
    
    public function getCodeCountry()
    {
        return $this->icao_country;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getTagValues()
    {
        $tags = SceneryTag::find()->asArray()->all();
        if(!empty($tags)){
            return ArrayHelper::map($tags, 'id', 'tag');
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getSceneryTags()
    {
        return $this->hasMany(SceneryTag::className(), ['id' => 'tag_id'])
                    ->viaTable('{{%scenery_to_tag}}', ['scenery_id' => 'id']);
    }
    
    // Obtiene Subdirectorio Image **Funciona, No tocar
    public static function getSubDirs($id, $depth = 3)
    {
        $fileHash = File::findOne(['id' => $id]);
        $depth = min($depth, 9);
        $path = '';
        
        for ($i = 0; $i < $depth; $i++) {
            $folder = substr($fileHash->hash, $i * 3, 2);
            $path .= $folder;
            if ($i != $depth - 1) $path .= DIRECTORY_SEPARATOR;
        }
        return $path.DIRECTORY_SEPARATOR.$fileHash->hash.'.'.$fileHash->type;
    }
    
    // =========== getLists =============
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('yee', 'Active'),
            self::STATUS_PIRATE => Yii::t('yee', 'Pirate'),
            self::STATUS_INACTIVE => Yii::t('yee', 'Pending'),
        ];
    }
    
    public static function getSimList()
    {
        $sims = Sim::find()->select(['id_catsimulator', 'catsimulator'])->asArray()->all();
        return ArrayHelper::map($sims, 'id_catsimulator', 'catsimulator');
    }
    
    public static function getAirportList(){
        $airport = Airports::find()->asArray()->all();
        return ArrayHelper::map($airport, 'ID', 'ICAO');
    }
    
    public static function getCountyList(){
        $country = Country::find()->asArray()->all();
        return ArrayHelper::map($country, 'regionId', 'country_name');
    }

    public static function getStatus($value)
    {
        if($value == Scenery::STATUS_ACTIVE) { 
            return '<span class="label label-success">Active</span>';
        }elseif ($value == Scenery::STATUS_INACTIVE) {
            return '<span class="label label-info">Inactive</span>';
        }elseif ($value == Scenery::STATUS_PIRATE) {
            return '<span class="label label-danger">Pirate</span>';
        }
    }
    
    public static function getdataTime($date)
    {
        return Yii::$app->formatter->asTime($this->isNewRecord ? time() : $date)
               .' '.Yii::$app->formatter->asDate($this->isNewRecord ? date() : $date);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getLibraries()
    {
        return $this->hasMany(Libraries::className(), ['id' => 'librery_id'])
                            ->viaTable('libreries_to_scenery', ['scenery_id' => 'id'])
                            ->orderBy('name');
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAirport()
    {
        return $this->hasOne(Airports::className(), ['ICAO' => 'icao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSimulator()
    {
        return $this->hasOne(Sim::className(), ['id_catsimulator' => 'catesim']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachment(){
        return $this->hasMany(File::className(), ['itemId' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }
}
