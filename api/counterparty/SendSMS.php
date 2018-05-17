<?php
/**
 * Created by PhpStorm.
 * User: dreamwhite
 * Date: 05.03.2018
 * Time: 16:07
 */

namespace dreamwhiteAPI;
require_once 'imports.php';


class SendSMS
{

  function send($phone, $name)
  {
    $smsru = new \SMSRU('255cfabf-5372-1c14-31ee-9fb931afd3b1');
    $data = new \stdClass();
    $data->to = $phone;
    $data->text = 'Твоя скидка постоянного покупателя DreamWhite: \nhttps://dreamwhite.ru/reg?p=' . $this->prepare_phone($phone); // Текст сообщения
    $data->from = 'DreamWhite'; // Если у вас уже одобрен буквенный отправитель, его можно указать здесь, в противном случае будет использоваться ваш отправитель по умолчанию
// $data->time = time() + 7*60*60; // Отложить отправку на 7 часов
// $data->translit = 1; // Перевести все русские символы в латиницу (позволяет сэкономить на длине СМС)
    $data->test = 1; // Позволяет выполнить запрос в тестовом режиме без реальной отправки сообщения
// $data->partner_id = '1'; // Можно указать ваш ID партнера, если вы интегрируете код в чужую систему
    $sms = $smsru->send_one($data); // Отправка сообщения и возврат данных в переменную

    if ($sms->status == "OK") { // Запрос выполнен успешно
      echo "Сообщение отправлено успешно. ";
      echo "ID сообщения: $sms->sms_id. ";
      echo "Ваш новый баланс: $sms->balance";
    } else {
      echo "Сообщение не отправлено. ";
      echo "Код ошибки: $sms->status_code. ";
      echo "Текст ошибки: $sms->status_text.";
    }
  }

  function prepare_phone($phone)
  {
    $phone = str_replace("+7 ", "", $phone);
    $phone = str_replace("-", "", $phone);
    $phone = str_replace(" ", "", $phone);
    return $phone;
  }

}
