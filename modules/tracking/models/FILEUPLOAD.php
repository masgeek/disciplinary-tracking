<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "{{%FILE_UPLOAD}}".
 *
 * @property integer $FILE_UPLOAD_ID
 * @property integer $INCIDENCE_ID
 * @property string $FILE_NAME
 * @property string $FILE_PATH
 * @property integer $FILE_DELETED
 * @property string $DATE_UPLOADED
 *
 * @property CASEINCIDENCES $iNCIDENCE
 */
class FILEUPLOAD extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%FILE_UPLOAD}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FILE_UPLOAD_ID', 'FILE_NAME', 'FILE_PATH'], 'required'],
            [['FILE_UPLOAD_ID', 'INCIDENCE_ID', 'FILE_DELETED'], 'integer'],
            [['DATE_UPLOADED'], 'safe'],
            [['FILE_NAME'], 'string', 'max' => 100],
            [['FILE_PATH'], 'string', 'max' => 200],
            [['FILE_UPLOAD_ID'], 'unique'],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'FILE_UPLOAD_ID' => Yii::t('app', 'File  Upload  ID'),
            'INCIDENCE_ID' => Yii::t('app', 'Incidence  ID'),
            'FILE_NAME' => Yii::t('app', 'File  Name'),
            'FILE_PATH' => Yii::t('app', 'File  Path'),
            'FILE_DELETED' => Yii::t('app', 'This is a soft delete flag 0|1|3 3 permanent deletion'),
            'DATE_UPLOADED' => Yii::t('app', 'Date  Uploaded'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getINCIDENCE()
    {
        return $this->hasOne(CASEINCIDENCES::className(), ['INCIDENCE_ID' => 'INCIDENCE_ID']);
    }
}
