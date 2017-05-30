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
    const STATUS_ALL = 5;
    const STATUS_APPROVED = 1;
    const STATUS_COMPLETE = 2;
    const STATUS_REJECTED = 3;
    const STATUS_CANCELLED = 4;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    const DELETED = 1;
    const NOT_DELETED = 0;

    const ACTION_PENDING = 'PENDING';
    /**
     * Minimum count is 1
     */
    const FIRST_PROCESS_COUNT = 1;

    /* scenarios */
    CONST SCENARIO_SEARCH = 'SEARCH';
    CONST SCENARIO_INSERT = 'INSERT';
}