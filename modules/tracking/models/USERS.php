<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_USERS".
 *
 * @property integer $USER_ID
 * @property integer $OFFICE_ACTOR_ID
 * @property string $PF_NO
 * @property string $ROLE
 * @property string $EMAIL_ADDRESS
 *
 * @property OFFICEACTORS $oFFICEACTOR
 */
class USERS extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_USERS';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['USER_ID', 'OFFICE_ACTOR_ID', 'PF_NO', 'ROLE'], 'required'],
            [['USER_ID', 'OFFICE_ACTOR_ID'], 'integer'],
            [['PF_NO'], 'string', 'max' => 10],
            [['ROLE', 'EMAIL_ADDRESS'], 'string', 'max' => 50],
            [['USER_ID'], 'unique'],
            [['OFFICE_ACTOR_ID'], 'exist', 'skipOnError' => true, 'targetClass' => OFFICEACTORS::className(), 'targetAttribute' => ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'USER_ID' => Yii::t('app', 'User  ID'),
            'OFFICE_ACTOR_ID' => Yii::t('app', 'Office  Actor  ID'),
            'PF_NO' => Yii::t('app', 'Pf  No'),
            'ROLE' => Yii::t('app', 'Role'),
            'EMAIL_ADDRESS' => Yii::t('app', 'Email  Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOFFICEACTOR()
    {
        return $this->hasOne(OFFICEACTORS::className(), ['OFFICE_ACTOR_ID' => 'OFFICE_ACTOR_ID']);
    }
}
