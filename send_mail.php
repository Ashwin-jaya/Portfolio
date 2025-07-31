 <?php
    require_once 'PHPMailer/src/PHPMailer.php';
    require_once 'PHPMailer/src/SMTP.php';
    require_once 'PHPMailer/src/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name    = htmlspecialchars($_POST['name']);
        $email   = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $custmail = new PHPMailer(true);
        try {
            $custmail->isSMTP();
            $custmail->Host       = 'smtp.gmail.com';
            $custmail->SMTPAuth   = true;
            $custmail->Username   = 'ashwinjaya333+sendmail@gmail.com';
            $custmail->Password   = 'xupsxwdahnkvzkgm';
            $custmail->SMTPSecure = 'tls';
            $custmail->Port       = 587;

            $custmail->setFrom('ashwinjaya333+sendmail@gmail.com', 'Ashwin JS');
            $custmail->addAddress($email, $name);

            $custmail->isHTML(true);
            $custmail->Subject = 'Conformation Mail for contacting me';
            $custmail->Body    = "
            <h2>Hello $name,</h2>
            <p>Thanks for contacting me. </p>
            <p>I'll get back to you as soon as possible</p>
            <p>Your message is `$message`</p>
            <p>– Ashwin</p>
        ";
            $custmail->send();

            echo "Conformation Email has been sent to you & an ";
        } catch (Exception $e) {
            echo "Error: {$custmail->ErrorInfo}";
        }
    }
    // To store in databse
    $conn = mysqli_connect("localhost", "root", "", "contactme");
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name    = htmlspecialchars($_POST['name']);
        $email   = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        $sql = ("Insert into usermail(name, email, msg) values('$name', '$email', '$message')");
        if ($conn->query($sql)) {
            header("Location: Contact.php");
        } else {
            echo  "DB insert failed";
        }
    }
    ?>