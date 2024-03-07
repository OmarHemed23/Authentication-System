<?php 
    include ('../includes/header.php');
    include ('../config/connection.php');

    if (isset($_POST['reset'])) 
    {
        $otp = $_SESSION['otp'];
        $email = $_SESSION['mail'];
        $otp_code = $_POST['otp'];
        $password = ($_POST['password']);
        $confirm_password = ($_POST['confirm-password']);

        if (password_verify($otp_code,$otp)) 
        {
            if ($password == $confirm_password)
            {
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                $stmt = $conn->prepare ("UPDATE users SET password=:password WHERE email=:email ");
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':email', $email);

                if ($stmt->execute())
                {
                    $_SESSION['success'] = 'Password reset successfully';
                    header ('Location: login.php');
                    exit ();
                } else 
                {
                    $_SESSION['error'] = 'Error reseting password';
                }
            }
        } else 
        {
            $_SESSION['error'] = 'Check your Otp code and try again';
        }
    }
?>    

    <div class="container rounded-3">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white p-3 m-auto shadow-lg rounded-3">
                <h4 class="text-center p-2">RESET PASSWORD</h4>
                <?php
                if (isset($_POST['reset']))
                {
                    include ('../includes/messages.php');
                }
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
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fas fa-lock text-white"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control
                        shadow-none" placeholder="Enter Password" required>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fas fa-lock text-white"></i>
                        </span>
                        <input type="password" name="confirm-password" id="password" class="form-control  
                        shadow-none" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid mt-3 p-3">
                        <button type="submit" name="reset" class="btn btn-primary">
                            RESET PASSWORD
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>