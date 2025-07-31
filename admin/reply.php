
<?php

require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
require_once '../PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $subject   = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $usermail = new PHPMailer(true);
    try {
        $usermail->isSMTP();
        $usermail->Host       = 'smtp.gmail.com';
        $usermail->SMTPAuth   = true;
        $usermail->Username   = 'ashwinjaya333+sendmail@gmail.com';
        $usermail->Password   = 'xupsxwdahnkvzkgm';
        $usermail->SMTPSecure = 'tls';
        $usermail->Port       = 587;


        $usermail->setFrom('ashwinjaya333+sendmail@gmail.com', 'Ashwin');
        $usermail->addAddress($email, $name);
        $usermail->isHTML(true);
        $usermail->Subject = "$subject";
        $usermail->Body    = "
            <h2>Hello $name,</h2>
            <p>$message</p>
            <p>-Ashwin</p>
            
        ";
        $usermail->send();

        header("Location:show_msg.php");
        
        // header("Location: home.php");
        exit();
    } catch (Exception $e) {
        echo "Error: {$usermail->ErrorInfo}";
    }
}
?>