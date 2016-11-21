<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "status".
 *
 * @property integer $id
 * @property string $message
 * @property integer $permissions
 * @property integer $created_at
 * @property integer $updated_at
 */
class Status extends \yii\db\ActiveRecord
{
	
	const PERMISSIONS_PRIVATE=10;
	const PERMISSIONS_PUBLIC=20;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status';
    }

	public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'created_at', 'updated_at'], 'required'],
            [['message'], 'string'],
            [['permissions', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'message' => '消息',
            'permissions' => '权限',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
	
	public function getPermissions(){
		return array(self::PERMISSIONS_PRIVATE=>'Private',self::PERMISSIONS_PUBLIC=>'Public');
	}
	
	public function getPermissionsLabel($permissions){
		if($permissions==self::PERMISSIONS_PUBLIC){
			return 'Public';
		}else{
			return 'Private';
		}
	}
}
