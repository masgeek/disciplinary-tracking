<?php
/**
 * Created by PhpStorm.
 * User: barsa
 * Date: 3/23/2017
 * Time: 1:25 PM
 */

namespace app\components;


class CONSTANTS
{

    /**
     * Indicated the status of a record
     */
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CANCELLED = 4;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const DELETED = 1;
    const NOT_DELETED = 0;
}