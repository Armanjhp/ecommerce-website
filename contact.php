<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require __DIR__ . '/PHPMailer/src/Exception.php';
require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['comments'];
    $option = $_POST['dd-contact'];
    
    if (empty($name)) {
        $errors[] = 'Name is empty';
    }

    if (empty($email)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($message)) {
        $errors[] = 'Message is empty';
    }

    // passing true in constructor enables exceptions in PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Username = 'chrmerce@gmail.com'; // YOUR gmail email
        $mail->Password = 'Chromerce2020'; // YOUR gmail password

        // Sender and recipient settings
        $mail->setFrom('chrmerce@gmail.com', 'Chromerce Support');
        $mail->addAddress($email, $name);
        $mail->addReplyTo('chrmerce@gmail.com', 'Chromerce Support'); // to set the reply to

        // Setting the email content
        $mail->IsHTML(true);
        $mail->Subject = "Chromerce Inquiry Confirmation";
        $bodyParagraphs = ["Thank you for your question. We will get back to you shortly.", "Copy of Message:", "Name: {$name}", "Email: {$email}", "Inquiry: {$option}", "Message:", nl2br($message)];
        $body = join('<br />', $bodyParagraphs);
        $mail->Body = $body;
        //$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
        $mail->send();
        echo "Email message sent.";
        header('Location: index.html'); // redirect to 'index' page
    } catch (Exception $e) {
        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Contact Us</title>
        <link rel="stylesheet" type="text/css" href="contact.css">
    </head>
    <body>
        <div class="navbar">
            <div class="logo"><img src="images/logo_transparent.png" height="250" width="250"></div>
            <div class="links">
                <a href="index.html">Home</a>
                <a href="">About</a>
                <a href="contact.php">Contact</a>
                <a href="">Account</a>
                <a href="">Product</a>
                <a href=""><img src="images/cart.png" height="30" width="30"></a>
            </div>
        </div>
        <section id="contact-us">
            <div class="wrap chromerce-contactus">
                <div class="panel-left">
                    <h3 class="margin-t0">Get in Touch</h3>
                    <p>Please fill out the form and we will be in touch ASAP, or email us directly at <a
                            href="mailto:support@chromerce.com" target="_blank">support@chromerce.com</a></p>
                    <div class="contact-form">
                        <form method="POST" action="" accept-charset="UTF-8"><input name="_token" type="hidden" value="">
                            <input type="hidden" name="_token" value="">
                            <input type="text" required placeholder="Name" name="name" class="contact-form-field">
                            <input type="email" required placeholder="Your email address" class="contact-form-field"
                                name="email">
                            <select name="dd-contact" id="dd-contact" class="contact-form-field">
                                <option value="General Inquiries">General Inquiries</option>
                                <option value="Order Issue">Order Issue</option>
                                <option value="Return Request">Return Request</option>
                            </select>
                            <textarea required placeholder="Message" id="comments" class="contact-form-field"
                                name="comments"></textarea>
                            <button name="login" type="submit" class="contact-form-field submit-btn button v-chromerce-blue margin-t25">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>