<?php
    include ('../includes/header.php');
    include ('../config/connection.php');

    $_SESSION['confirm-email'] = true;


    if (isset($_POST['confirm-email'])) 
    {
        $email = $_POST['email'];

        $query = "SELECT COUNT(*) as total FROM users WHERE email = :email";
        $stmt = $conn->prepare ($query);
        $stmt = bindParam (':email',$email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['total'] > 0) 
        {
            require "../config/mailer.php";

            // $otp = rand(100000,999999);
            // $otp_hash = password_hash($otp,PASSWORD_DEFAULT);
            // $_SESSION['otp'] = $otp_hash;
        
            // require "../vendor/autoload.php";
        
            // $developmentMode = false;
            // $mailer = new PHPMailer($developmentMode);
            // try {
            //     // $mailer->SMTPDebug = 2;
            //     $mailer->isSMTP();
            //     if ($developmentMode) {
            //     $mailer->SMTPOptions = [
            //         'ssl'=> [
            //         'verify_peer' => false,
            //         'verify_peer_name' => false,
            //         'allow_self_signed' => true
            //         ]
            //     ];
            //     }
            //     $mailer->Host = 'smtp.elasticemail.com';
            //     $mailer->SMTPAuth = true;
            //     $mailer->Username = 'omarhemed800@gmail.com';
            //     $mailer->Password = '551AB595CB530583E42C330F9AD643DB8219';
            //     // 551AB595CB530583E42C330F9AD643DB8219
            //     $mailer->SMTPSecure = 'tls';
            //     $mailer->Port = 2525;
            //     $mailer->setFrom('omarhemed800@gmail.com', 'Omar Hemed');
            //     $mailer->addAddress($_POST['email'], $result['username']);
        
                // $mailer->isHTML(true);
                // $mailer->Subject = 'Verify Email To Reset Password';
                // $mailer->Body = "<p>Dear, " .$result['username']. " </p> 
                // <h3>Your OTP code is: ".$otp." <br></h3>";
                // if ($mailer->send())
                // {
                //     $mailer->ClearAllRecipients();
                //     $_SESSION['success'] = "Check your email and <a href='reset-password.php'>verify</a> 
                //     to reset password";
                // } else 
                // {
                //     $_SESSION['error'] = "Error Sending Otp";
                // }
            // } catch (Exception $e) {
            //     echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
            // }
        } 
        else 
        {
            $_SESSION['error'] = "Email does not exist";
        }
    }

?>
    <div class="container rounded-3">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white p-3 m-auto shadow-lg rounded-3">
                <h4 class="text-center p-2">ENTER REGISTERED EMAIL</h4>
                <?php
                if (isset($_POST['confirm-email']))
                {
                    include ('../includes/messages.php');
                }
                ?>  
                <form action="" method="post">
                    <input type="hidden" name="id">
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fa fa-envelope text-white"></i>
                        </span>
                        <input type="email" name="email" class="form-control shadow-none" 
                        placeholder="Enter email" required>
                    </div>
                    <div class="d-grid mt-3 p-3">
                        <button type="submit" name="confirm-email" class="btn btn-primary">
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>