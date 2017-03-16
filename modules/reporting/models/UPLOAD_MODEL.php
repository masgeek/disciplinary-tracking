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
            [['FILE_NAME', 'FILE_PATH', 'INCIDENCE_ID'], 'required'],
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
            $this->INCIDENCE_ID = $incidence_id;
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

    public function behaviors()
    {
       /* return [
            'bedezign\yii2\audit\AuditTrailBehavior'
        ];*/

        return [
            'AuditTrailBehavior' => [
                'class' => 'bedezign\yii2\audit\AuditTrailBehavior',
                // Array with fields to save. You don't need to configure both `allowed` and `ignored`
                //'allowed' => ['some_field'],
                // Array with fields to ignore. You don't need to configure both `allowed` and `ignored`
                //'ignored' => ['another_field'],
                // Array with classes to ignore
                'ignoredClasses' => ['common\models\Model'],
                // Is the behavior is active or not
                'active' => true,
                // Date format to use in stamp - set to "Y-m-d H:i:s" for datetime or "U" for timestamp
                'dateFormat' => 'Y-m-d H:i:s',
                //Indicates whether the database value is used
                'useDatabaseValue' => false,
                //Function for date in the respective database
                'databaseDateFunction'=>'SYSDATE'
            ]
        ];
        /*return [
            'LoggableBehavior' => [
                'class' => 'sammaye\audittrail\LoggableBehavior',
                'ignored' => ['DATE_UPLOADED'], // This ignores fields from a selection of all fields, not needed with allowed
                //'allowed' => ['another_field'] // optional, not needed if you use ignore
            ]
        ];*/
    }
}