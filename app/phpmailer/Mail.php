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
        //UPDATED. This used to be done through the webserver from gmail. But due to school's cybersecurity this is not an available option anymore.
        // use docker mailhog by the following: docker run --name mailhog -d -p 1025:1025 -p 8025:8025 mailhog/mailhog
        //This will instal mailhog and run it on the proper port.
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host = 'localhost';
        $this->mail->SMTPAuth = false;
        $this->mail->Port = 1025;

        $this->mail->setFrom('windschool12@gmail.com', 'Windkracht 12');

        //instantly set email destination aswell
        $this->mail->addAddress($email, $username);
    }

    //could be used for multiple people reserving 
    public function addCC(string $email, string $name = null): void
    {
        $this->mail->addCC($email, $name);
    }

    public function addFile(string $path, string $fileName = null)
    {
        $this->mail->addAttachment($path, $fileName);    //Optional name
    }

    // sets subject and retrieves HTML(in php for variables) template for the body.
    // returns error if template does not exists.
    public function body(string $subject, string $mailTemplate, object $user, $data = [])
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
