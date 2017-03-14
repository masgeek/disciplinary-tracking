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

    /**
     * @param $incidence_id
     */
    public function upload($incidence_id)
    {
        $imagesFolder = Yii::$app->params['uploadsFolder'];
        $rel_folder = $imagesFolder . $incidence_id . '/';
        $path = Yii::$app->basePath . $rel_folder;
        if (!file_exists($path)) {
            mkdir($path, 0777); //if directory does not exists create it with full permissions
        }

        foreach ($this->imageFiles as $file) {
            $file_name = $file->baseName . '.' . $file->extension;
            $relative_path = $rel_folder . $file_name;
            $save_path = $path . $file->baseName . '.' . $file->extension;
            $file->saveAs($save_path);

            $this->FILE_PATH = $relative_path;
            $this->FILE_NAME = $file_name;
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