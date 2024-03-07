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