<?php
namespace SB\Site\ExchangeLog;

use Bitrix\Main\Mail\Event;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use SB\Site\ExchangeLog\ExchangeLogService;

class ExchangeLogMailer
{

    public function sendEmailToReceivers()
    {
        $exchangeLogService = new ExchangeLogService();
        $mailer = new PHPMailer();
        $mailer->setFrom(\COption::GetOptionString('main', 'email_from'), '');

        $mailSubject = 'Отчет об интеграциях';
        $mailer->Subject = $mailSubject;

        //$footer = $this->getMailFooter();
        $html = $exchangeLogService->generateHtmlTable();
        $mailer->Body = "
        <table>
            <tr>
                <td colspan='2'>
                    $html
                </td>
            </tr>
        </table>        
    ";

        $receivers = $exchangeLogService->getEmailReceivers();

        foreach ($receivers as $receiver) {
        $mailer->addAddress($receiver);
        }

        $mailer->CharSet = "UTF-8";
        $mailer->ContentType = $mailer::CONTENT_TYPE_TEXT_HTML;


        if (!$mailer->send()) {
            throw new \Exception('Email sending failed: ' . $mailer->ErrorInfo);
        }
    }
}