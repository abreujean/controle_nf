<?php

namespace App\Notifications;

use App\Http\Controllers\GraphicController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class SmsNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public $graphicController;

    public function __construct()
    {
        $this->graphicController = new GraphicController;
    }

    public function sendSms($number)
    {
        
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');

        $twilio = new Client($sid, $token);

        $message = $twilio->messages->create(
            '+' . $number, // Número de telefone de destino
            [
                'from' => $twilioPhoneNumber,
                'body' => 'Atenção você ainda tem '. $this->graphicController->retrieveAvailableBillingAmount(date('Y')) . 'disponivel para seu faturamento',
            ]
        );

        // Verificar o status do envio
        if ($message->sid) {
            echo 'Mensagem enviada com sucesso!';
        } else {
            echo 'Erro ao enviar mensagem.';
        }
    }
}
