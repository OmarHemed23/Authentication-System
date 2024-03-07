<?php 

    $otp = rand(100000,999999);
    $otp_hash = password_hash($otp,PASSWORD_DEFAULT);
    $_SESSION['otp'] = $otp_hash;
    $_SESSION['mail'] = $_POST['email'];
    $_SESSION['username'] = $_POST['username'];

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
        $mailer->Host = '';
        $mailer->SMTPAuth = true;
        $mailer->Username = '';
        $mailer->Password = '';
        // 551AB595CB530583E42C330F9AD643DB8219
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 2525;
        $mailer->setFrom('','');
        $mailer->addAddress($_SESSION['mail'], $_SESSION['username']);
        $mailer->isHTML(true);

        $mailer->Subject = 'Email Verification';
        $mailer->Body = "<p>Dear, " .$_SESSION['username']. " </p> <h3>Your OTP code is: ".$otp." <br></h3>";
        if ($mailer->send())
        {
            $mailer->ClearAllRecipients();
            $_SESSION['success'] = "Registered Successfully. Check your email and <a href='verification.php' class='alert-link'>
            Verify</a> to login";
        } else {
            $_SESSION['error'] = "Error sending OTP";
        }
        // if (isset($_SESSION['confirm-email']) )
        // {
        //     if ($mailer->send())
        //     {
        //         $mailer->ClearAllRecipients();
        //         $_SESSION['success'] = "Check your email and <a href='reset-password.php'>verify</a> 
        //         to reset password";
        //     } else 
        //     {
        //         $_SESSION['error'] = "Error Sending Otp";
        //     }
        //     unset($_SESSION['confirm-email']);
        // }
    } catch (Exception $e) {
        echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
    }
?>