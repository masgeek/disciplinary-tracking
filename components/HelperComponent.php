<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/15/2017
 * Time: 11:59 AM
 */

namespace app\components;


class HelperComponent
{
    /**
     * Create a proper download link for a file
     * @param $file_path
     * @return string
     */
    public static function GenerateDownloadLink($file_path)
    {

        $web_root = \Yii::$app->request->hostInfo;// . \Yii::getAlias('@web');
        $file_url = $web_root . \Yii::$app->request->baseUrl . $file_path;
        return $file_url;
    }
}