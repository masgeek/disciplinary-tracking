<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 26-Apr-17
 * Time: 15:37
 */

namespace app\components;


use app\modules\extended\STUDENT_PERIOD_MODEL;
use yii\base\InvalidParamException;
use yii\behaviors\TimestampBehavior;

class DATA_FACTORY
{


    public static function GetTimeStamp()
    {
        $date = new \DateTime();
        return $date->getTimestamp();
    }

    /**
     * Convert timestamp back to date
     * @param $timestamp
     * @return false|string
     */
    public static function TimeStampToDateTime($timestamp)
    {
        if (!is_integer((int)$timestamp)) { //check if timestamp is an integer
            throw new InvalidParamException('Timestamp has to be an integer');
        }
        $date = date('d-m-Y H:i:s', $timestamp);
        return $date;
    }

    public static function StringToDateTime($date_string)
    {
        $date_arr = explode(' ', $date_string, 2);
        $timestamp = strtotime($date_arr[0]);

        return self::TimeStampToDateTime($timestamp);
    }

    /**
     * REmove slashes from strings like registration number
     * @param $reg_number
     * @param $replacement Null value is used to replace the slashes
     * @return mixed
     */
    public static function RemoveSlashes($reg_number, $replacement = null)
    {
        $cleaned = preg_replace("/[^0-9,.aA-aZ]/", $replacement, $reg_number);

        return $cleaned;
    }

    public static function seoUrl($string, $replacement = null)
    {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", $replacement, $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", $replacement, $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", $replacement, $string);
        return $string;
    }
}