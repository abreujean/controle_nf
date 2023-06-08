<?php

namespace App\Notifications;

use App\Http\Controllers\GraphicController;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class EmailNotification extends Notification
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

    public function sendEmail($email)
    {

        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = config('mail.host');
            $mail->Port = config('mail.port');
            $mail->SMTPAuth = true;
            $mail->Username = config('mail.username');
            $mail->Password = config('mail.password');
            $mail->SMTPSecure = config('mail.encryption');

            // Remetente e destinatário
            $mail->setFrom('jeandcabreu@gmail.com', 'Jean Abreu');
            $mail->addAddress($email, 'Cliente');

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Alerta de Faturamento ';
            $mail->Body = 'Atenção você ainda tem '. $this->graphicController->retrieveAvailableBillingAmount(date('Y')) . 'disponivel para seu faturamento ';

            // Envia o e-mail
            $mail->send();

            return "E-mail enviado com sucesso!";
        } catch (Exception $e) {
            return "Erro ao enviar o e-mail: " . $mail->ErrorInfo;
        }
    }
}
