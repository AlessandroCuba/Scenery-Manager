<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;
use nemmo\attachments\behaviors\FileBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "libraries".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $author
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $videoUrl
 * @property string $url
 * @property integer $ranking
 * @property integer $status
 */
class Libraries extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'libraries';
    }
    
    public function behaviors()
    {
        return [
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
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
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
            [['description', 'name', 'author', 'url'], 'required'],
            [['id', 'created_at', 'updated_at', 'created_by', 'status', 'updated_by', 'ranking'], 'integer'],
            [['description', 'videoUrl', 'url'], 'string'],
            [['author'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'author' => Yii::t('app', 'Author'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'videoUrl' => Yii::t('app', 'Video Url'),
            'status' => Yii::t('app', 'Status'),
            'url' => Yii::t('app', 'Url'),
            'ranking' => Yii::t('app', 'Ranking'),
        ];
    }
    
    public static function getStatus($value)
    {
        if($value == Libraries::STATUS_ACTIVE) { 
            return '<span class="label label-success">Active</span>';
        }elseif ($value == Libraries::STATUS_INACTIVE) {
            return '<span class="label label-info">Inactive</span>';
        }
    }
    
    /**
    * @return array
    */
    public static function getLibrariesList()
    {
        $models = static::find()->where(['status' => Libraries::STATUS_ACTIVE])->orderBy('name')->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
}
