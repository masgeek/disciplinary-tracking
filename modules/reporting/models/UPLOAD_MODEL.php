<?php
/**
 * Created by PhpStorm.
 * User: KRONOS
 * Date: 3/14/2017
 * Time: 21:40
 */

namespace app\modules\reporting\models;


use app\modules\tracking\models\CASEINCIDENCES;
use app\modules\tracking\models\FILEUPLOAD;
use yii\db\Expression;
use Yii;

class UPLOAD_MODEL extends FILEUPLOAD
{
    public $imageFiles;
    public $FILE_SELECTOR;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FILE_NAME', 'FILE_PATH'], 'required'],
            [['FILE_UPLOAD_ID', 'INCIDENCE_ID'], 'integer'],
            [['DATE_UPLOADED'], 'safe'],
            [['FILE_NAME'], 'string', 'max' => 100],
            [['FILE_PATH'], 'string', 'max' => 200],
            [['FILE_UPLOAD_ID'], 'unique'],
            [['INCIDENCE_ID'], 'exist', 'skipOnError' => true, 'targetClass' => CASEINCIDENCES::className(), 'targetAttribute' => ['INCIDENCE_ID' => 'INCIDENCE_ID']],
        ];
    }

    public function upload($user_id)
    {
        $imagesFolder = Yii::$app->params['uploadsFolder'];
        $path = Yii::$app->basePath . $imagesFolder . $user_id . '/';

        if (!file_exists($path)) {
            mkdir($path, 0777); //if directory does not exists create it with full permissions
        }

        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $file_name = $path . $file->baseName . '.' . $file->extension;
                $file->saveAs($file_name);
            }
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {

        $date = new Expression('SYSDATE');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->DATE_UPLOADED = $date;
            }
            return true;
        }
        return false;
    }
}