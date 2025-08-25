<?php
// 代码生成时间: 2025-08-26 04:46:29
// Import Yii framework components
use Yii;
use yii\base\Exception;
use yii\mail\MailInterface;
use yii\mail\MessageInterface;

class NotificationSystem
{
    /**
     * @var MailInterface Yii2 mail component instance.
     */
    private $mail;

    /**
     * NotificationSystem constructor.
     * @param MailInterface $mail Yii2 mail component.
     */
    public function __construct(MailInterface $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Sends a notification to a user via email.
     * @param string $email The email address of the user.
     * @param string $subject The subject of the email.
     * @param string $content The content of the email.
     * @return bool True if the email was sent successfully, false otherwise.
     */
    public function sendNotification($email, $subject, $content)
    {
        try {
            $message = $this->mail->compose()
                ->setFrom(["noreply@example.com" => 'Notification System'])
                ->setTo($email)
                ->setSubject($subject)
                ->setHtmlBody($content);

            if (!$this->mail->send($message)) {
                Yii::error("Failed to send notification to: $email", __METHOD__);
                return false;
            }

            return true;
        } catch (Exception $e) {
            Yii::error("Error sending notification: " . $e->getMessage(), __METHOD__);
            return false;
        }
    }
}
