<?php

namespace backend\modules\scenery\models;

use Yii;

/**
 * This is the model class for table "model_rating".
 *
 * @property integer $id
 * @property string $model
 * @property integer $model_id
 * @property string $last_ip
 */
class ModelRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'model_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'model_id', 'last_ip'], 'required'],
            [['model_id'], 'integer'],
            [['model'], 'string', 'max' => 50],
            [['last_ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model' => Yii::t('app', 'Model'),
            'model_id' => Yii::t('app', 'Model ID'),
            'last_ip' => Yii::t('app', 'Last Ip'),
        ];
    }
    
    public function getTemprate() {
        return 100;     
        
    }
    
    public function getTemprateval() {
        if ($this->id) {
            if ($this->rating_count > 0) {
                return round($this->rating_sum / $this->rating_count);
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
