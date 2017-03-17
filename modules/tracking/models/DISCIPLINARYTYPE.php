<?php

namespace app\modules\tracking\models;

use Yii;

/**
 * This is the model class for table "DT_DISCIPLINARY_TYPE".
 *
 * @property integer $DISCIPLINARY_TYPE_ID
 * @property string $DISCIPLINARY_TYPE_NAME
 *
 * @property DISCIPLINARYCASETYPES[] $dISCIPLINARYCASETYPESs
 */
class DISCIPLINARYTYPE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'DT_DISCIPLINARY_TYPE';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['DISCIPLINARY_TYPE_ID', 'DISCIPLINARY_TYPE_NAME'], 'required'],
            [['DISCIPLINARY_TYPE_ID'], 'integer'],
            [['DISCIPLINARY_TYPE_NAME'], 'string', 'max' => 200],
            [['DISCIPLINARY_TYPE_ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'DISCIPLINARY_TYPE_ID' => Yii::t('app', 'Disciplinary  Type  ID'),
            'DISCIPLINARY_TYPE_NAME' => Yii::t('app', 'Disciplinary  Type  Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDISCIPLINARYCASETYPESs()
    {
        return $this->hasMany(DISCIPLINARYCASETYPES::className(), ['DISCIPLINARY_TYPE_ID' => 'DISCIPLINARY_TYPE_ID']);
    }
}
