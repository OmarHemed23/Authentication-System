<?php
    include ('../includes/header.php');
    include ('../config/connection.php');

    $otp = rand(100000,999999);
    $otp_hash = password_hash($otp,PASSWORD_DEFAULT);
    $_SESSION['otp'] = $otp_hash;

    require "../vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $developmentMode = false;
    $mailer = new PHPMailer($developmentMode);
    try {
        // $mailer->SMTPDebug = 2;
        $mailer->isSMTP();
        if ($developmentMode) {
        $mailer->SMTPOptions = [
            'ssl'=> [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ];
        }
        $mailer->Host = 'smtp.elasticemail.com';
        $mailer->SMTPAuth = true;
        $mailer->Username = 'omarhemed800@gmail.com';
        $mailer->Password = '551AB595CB530583E42C330F9AD643DB8219';
        // 551AB595CB530583E42C330F9AD643DB8219
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 2525;
        $mailer->setFrom('omarhemed800@gmail.com', 'Omar Hemed');
        $mailer->addAddress($_SESSION['mail'], $_SESSION['username']);

        $mailer->isHTML(true);
        $mailer->Subject = 'Email Verification';
        $mailer->Body = "<p>Dear, " .$_SESSION['username']. " </p> <h3>Your OTP code is: ".$otp." <br></h3>";
        if ($mailer->send())
        {
            $mailer->ClearAllRecipients();
            $_SESSION['success'] = 'OTP resent. Check your email';
            header ("Location: verification.php");
            exit ();

        } else {
            $_SESSION['error'] = "Error sending OTP";
            header ("Location: verification.php");
            exit ();
        }
    } catch (Exception $e) {
        echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
    }
?>