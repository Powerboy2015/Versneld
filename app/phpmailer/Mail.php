<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

class Mail
{
    private $mail;

    public function __construct(string $email, string $username = null)
    {
        $this->mail = new PHPMailer(true);

        //Server settings
        $this->mail->SMTPDebug = 0;
        //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->Username   = 'windschool12@gmail.com';                     //SMTP username
        $this->mail->Password   = 'nncg ahxs noco davd';                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $this->mail->Port       = 587;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->setFrom('windschool12@gmail.com', 'Windkracht 12');

        //instantly set email destination aswell
        $this->mail->addAddress($email, $username);
    }

    //could be used for multiple people reserving 
    public function addCC(string $email): void
    {
        $this->mail->addCC($email);
    }

    public function addFile(string $path, string $fileName = null)
    {
        $this->mail->addAttachment($path, $fileName);    //Optional name
    }

    // sets subject and retrieves HTML(in php for variables) template for the body.
    // returns error if template does not exists.
    public function body(string $subject, string $mailTemplate, object $user): string|bool
    {
        if (file_exists(APPROOT . '/views/mailTemplates/' . $mailTemplate . '.php')) {
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = $subject;

            // gets the template and also executes the code within the template for proper results
            ob_start();
            include APPROOT . '/views/mailTemplates/' . $mailTemplate . '.php';
            $this->mail->Body = ob_get_clean();

            return true;
        } else {
            return "error";
        }
    }

    public function send()
    {
        try {
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            echo json_encode("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
        }
    }
}
