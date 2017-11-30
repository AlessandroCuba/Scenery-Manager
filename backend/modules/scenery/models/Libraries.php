<?php

namespace backend\modules\scenery\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\AttributeBehavior;
use nemmo\attachments\behaviors\FileBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

use backend\modules\scenery\models\Scenery;
use yeesoft\models\User;
use nemmo\attachments\models\File;
use yeesoft\comments\models\Comment;

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
    const COMMENT_STATUS_CLOSED = 0;
    const COMMENT_STATUS_OPEN = 1;
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
                                return Scenery::STATUS_ACTIVE;
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
            [['id', 'created_at', 'updated_at', 'comment_status','created_by', 'status', 'updated_by', 'ranking'], 'integer'],
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
            'comment_status' => Yii::t('app', 'Comments'),
        ];
    }
    
     public static function getStatusList(){
        return [
            self::STATUS_ACTIVE => Yii::t('yee', 'Active'),
            self::STATUS_INACTIVE => Yii::t('yee', 'Pending'),
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
    
    /**
    * @return array
    */
    public static function getLibrariesList($id = null)
    {
        $libraries = self::find();
        if(is_null($id)){
            $query = $libraries->where(['status' => Libraries::STATUS_ACTIVE])->orderBy('name')->all();
            return ArrayHelper::map($query, 'id', 'name');
        }
        $query = $libraries->where(['status' => Libraries::STATUS_ACTIVE, 'id'])->orderBy('name')->all();
        return ;
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSceneries(){
        return $this->hasMany(Scenery::className(), ['id' => 'scenery_id'])
                            ->viaTable('libreries_to_scenery', ['librery_id' => 'id'])
                            ->orderBy('icao');
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAuthor(){
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    
    /**
    * @return \yii\db\ActiveQuery
    */
    public function getAttachment(){
        return $this->hasMany(File::className(), ['itemId' => 'id']);
    }
    
    public static function getCommentStatusList()
    {
        return [
            self::COMMENT_STATUS_OPEN => Yii::t('yee', 'Open'),
            self::COMMENT_STATUS_CLOSED => Yii::t('yee', 'Closed')
        ];
    }

    public static function getCommentCount($id)
    {
        $comment = Comment::find()->where(['model' => self::className()])
                                  ->andWhere(['model_id' => $id])
                                  ->andWhere(['status' => Comment::STATUS_APPROVED])->count();
        return $comment;
    }
}
