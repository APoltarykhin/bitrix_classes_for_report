<?php

namespace SB\Site\ExchangeLog;

use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\DateField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class ActivityReportTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TICKET_NUMBER string(20) optional
 * <li> CREATE_DATE date optional
 * <li> CREATE_TIME unknown optional
 * <li> NUMBER_SAP string(20) optional
 * <li> TICKET_TYPE string(30) optional
 * <li> TICKET_CATEGORY string(30) optional
 * <li> TICKET_PRIORITY string(10) optional
 * <li> TICKET_DESCRIPTION string(255) optional
 * <li> DEDICATED_SLA string(4) optional
 * <li> ACTUAL_SLA string(4) optional
 * <li> TIMELY_CLOSED string(10) optional
 * <li> TICKET_INITIATOR_DEPARTMENT string(20) optional
 * <li> TICKET_INITIATOR string(30) optional
 * <li> BANNER_CODE string(20) optional
 * <li> NAME_CODE string(50) optional
 * <li> CODE_PAYER string(20) optional
 * <li> NAME_PAYER string(50) optional
 * <li> SOLD_TO string(20) optional
 * <li> NAME_SOLD_TO string(50) optional
 * <li> ASSIGNED_CF_COMPANY string(30) optional
 * <li> TICKET_STATUS string(15) optional
 * <li> CHANGE_DATE date optional
 * <li> CHANGE_TIME unknown optional
 * <li> ASSIGNED_TICKET_DEPARTMENT string(20) optional
 * <li> ASSIGNED_TICKET string(30) optional
 * <li> CLOSED_DATE date optional
 * <li> CLOSED_TIME unknown optional
 * <li> CLOSED_ASSIGNED string(30) optional
 * <li> SUM_TIME string(4) optional
 * <li> ASSIGNED_TIME string(4) optional
 * </ul>
 *
 * @package Bitrix\Tickets
 **/
class ExchangeLogTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName ()
    {
        return 'sb_exchange_log';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap ()
    {
        return [
            new IntegerField(
                'ID',
                [
                    'primary'      => true,
                    'autocomplete' => true,
                    'title'        => 'ID_LOG_TABLE_ENTITY',
                ]
            ),
            new StringField(
                'SYSTEM',
                [
                    'nullable' => true,
                    'title'      => 'SYSTEM_NAME_LOG_FIELD',
                ]
            ),
            new StringField(
                'TYPE',
                [
                    'nullable' => true,
                    'title'      => 'TYPE_STREAM_LOG_FIELD',
                ]
            ),
            new StringField(
                'INTERFACE',
                [
                    'nullable' => true,
                    'title'      => 'INTERFACE_NAME_LOADER_LOG_FIELD',
                ]
            ),
            new StringField(
                'LAST_STATUS',
                [
                    'nullable' => true,
                    'title'      => 'LAST_STATUS_LOADER_LOG_FIELD',
                ]
            ),
            new StringField(
                'LAST_START',
                [
                    'nullable' => true,
                    'title'      => 'LAST_START_DATE_TIME_LOG_FIELD',
                ]
            ),
            new StringField(
                'LAST_END',
                [
                    'nullable' => true,
                    'title'      => 'LAST_END_DATE_TIME_LOG_FIELD',
                ]
            ),
            new StringField(
                'DURATION',
                [
                    'nullable' => true,
                    'title'      => 'DURATION_DATE_TIME_LOG_FIELD',
                ]
            ),
            new IntegerField(
                'RECORDS',
                [
                    'nullable' => true,
                    'title'      => 'RECORDS_COUNT_LOG_FIELD',
                ]
            ),
            new IntegerField(
                'ERRORS',
                [
                    'nullable' => true,
                    'title'      => 'ERRORS_COUNT_LOG_FIELD',
                ]
            ),
            new StringField(
                'LAST_LOAD_DATE',
                [
                    'nullable' => true,
                    'title' => 'LAST_LOAD_DATE_LOG_FIELD',
                ]
            ),
            new StringField(
                'TIMESTAMP',
                [
                    'nullable' => true,
                    'title'      => 'TIMESTAMP_LOG_FIELD',
                ]
            ),
        ];
    }
}
