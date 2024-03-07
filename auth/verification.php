<?php
    include ('../includes/header.php');
    include ('../config/connection.php');

    $status = 'verified';
    if (isset($_POST['verify']))
    {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $username = $_SESSION['username'];
        $otp_code = $_POST['otp'];
        
        if (password_verify($otp_code,$otp))
        {
            $stmt = $conn->prepare ("UPDATE users SET status=:status WHERE email=:email ");
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()){
                $_SESSION['success'] = 'Email verified successfully. You can now login';
                header ("location: login.php");
                exit();
            }
        }
        else
        {
            $_SESSION['error'] = "Check your OTP and try again";
        }
    }
?>
    <div class="container rounded-3">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white p-3 m-auto shadow-lg rounded-3">
                <h4 class="text-center p-2">EMAIL VERIFICATION</h4>
                <?php
                // if (isset($_POST['verify']))
                // {
                    include ('../includes/messages.php');
                // }
                ?>  
                <form action="" method="post">
                    <input type="hidden" name="id">
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fa fa-key text-white"></i>
                        </span>
                        <input type="text" name="otp" class="form-control shadow-none" 
                        placeholder="Enter OTP" required>
                    </div>
                    <div class="d-grid mt-3 p-3">
                        <button type="submit" name="verify" class="btn btn-primary">
                            VERIFY
                        </button>
                    </div>
                    <p class="text-center mt-3"> 
                            <a href="resend_otp.php" class="text-decoration-none" >
                                Resend Otp?
                            </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
