<?php

namespace SB\Site\ExchangeLog;

use Bitrix\Main\Application;
use Bitrix\Main\Entity;
use Bitrix\Main\Mail\Event;
use CAdminList;
use SB\Site\ExchangeLog\Enums\ExchangeInterface;
use SB\Site\ExchangeLog\Enums\ExchangeLastStatus;
use SB\Site\ExchangeLog\Enums\ExchangeSystem;
use SB\Site\ExchangeLog\Enums\ExchangeType;
use SB\Tools\DateTools;

class ExchangeLogService
{

    private $db;

    private string $tableName = 'sb_exchange_log';

    public function __construct(bool $isManual = false){
        $this->connection = Application::getConnection();
        $this->db = \Bitrix\Main\Application::getConnection();
    }

    public function push(
        ExchangeSystem $system,
        ExchangeType $type,
        ExchangeInterface $interface,
        ExchangeLastStatus $lastStatus,
        \DateTime $timestamp,
        string $lastEnd,
        string $loadDate,
        string $direction,
        string $started,
        int $records,
        int $errors
    ): bool
    {
//        $this->cleanupLogs();
        $duration = $this->calculateDuration($timestamp);
//        $hasErrors = $errors > 0 ? true : false;
        // переделать на д7
        $this->connection->add($this->tableName, [
                'SYSTEM' => $system->getValue(),
                'INTERFACE' => $interface->getValue(),
                'LAST_STATUS' => $lastStatus->getValue(),
                'TIMESTAMP' => $timestamp->format(DateTools::getDbFormat()),
                'LAST_END' => $lastEnd,
                'DIRECTION' => $direction,
                'TYPE' => $type->getValue(),
                'DURATION' => $duration,
                'RECORDS' => $records,
                'ERRORS' => $errors,
                'LAST_LOAD_DATE' => $loadDate,
                'LAST_START' => $started
            ]
        );
        return true;
    }

    public function generateHtmlTable(): string
    {
        $rows = ExchangeLogTable::query()->addSelect('*')->fetchAll();
        $query = "SELECT * FROM sb_exchange_log";
        $result = $this->db->query($query);

        $html = '<table>';
        $html .= '<tr>
                    <th>SYSTEM</th>
                    <th>TYPE</th>
                    <th>INTERFACE</th>
                    <th>LAST_STATUS</th>
                    <th>LAST_START</th>
                    <th>LAST_END</th>
                    <th>DURATION</th>
                    <th>RECORDS</th>
                    <th>ERRORS</th>
                    <th>LAST_LOAD_DATE</th>
                    <th>TIMESTAMP</th>
                   </tr>';

        while ($row = $result->fetch())
        {
            $html .= '<tr>';
            $html .= '<td>'.$row['SYSTEM'].'</td>';
            $html .= '<td>'.$row['TYPE'].'</td>';
            $html .= '<td>'.$row['INTERFACE'].'</td>';
            $html .= '<td>'.$row['LAST_STATUS'].'</td>';
            $html .= '<td>'.$row['LAST_START'].'</td>';
            $html .= '<td>'.$row['LAST_END'].'</td>';
            $html .= '<td>'.$row['DURATION'].'</td>';
            $html .= '<td>'.$row['RECORDS'].'</td>';
            $html .= '<td>'.$row['ERRORS'].'</td>';
            $html .= '<td>'.$row['LAST_LOAD_DATE'].'</td>';
            $html .= '<td>'.$row['TIMESTAMP'].'</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        return $html;
    }

    private function calculateDuration(\DateTime $timestamp): int
    {
        $now = new \DateTime();
        $interval = $now->diff($timestamp);
        return $interval->s;
    }

    public function getEmailReceivers(): array
    {
        $hlblockId = 12;

        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($hlblockId)->fetch();

        if ($hlblock) {
            $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
            $entityDataClass = $entity->getDataClass();

            $result = $entityDataClass::getList();

            $receivers = [];
            while ($row = $result->fetch()) {
                $email = $row['UF_MAIL_RECEIVERS'];
                $receivers[] = $email;
            }

            return $receivers;
        }

        return [];
    }
}