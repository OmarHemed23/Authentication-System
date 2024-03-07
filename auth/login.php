<?php
    include ('../config/connection.php');
    include ('../includes/header.php');


    if  (isset($_POST['login']))   
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try
        {
            $sql = "SELECT *  FROM users WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password,$result['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $result['username'];
                if ($result['status'] == 'not verified'){
                    header ('location: verification.php');
                    exit ();
                }
                header ('location: ../index.php');
                exit ();
            }
            else
            {
                $_SESSION['error'] = 'User does not exist';
            }
        }
        catch (PDOException $e)
        {
            echo "Error:".$e->getMessage();
        }
    }
?>

    <div class="container rounded-3">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white p-3 m-auto shadow-lg rounded-3">
                <h2 class="text-center p-2">SIGN IN</h2>
                <?php
                    include ('../includes/messages.php');
                ?>  
                <form action="" method="post">
                    <input type="hidden" name="id">
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fas fa-envelope text-white"></i>
                        </span>
                        <input type="email" name="email" class="form-control shadow-none" 
                        placeholder="Enter Phone Email" required>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fas fa-lock text-white"></i>
                        </span>
                        <input type="password" name="password" id="password" class="form-control shadow-none" 
                        placeholder="Enter Password" required>
                    </div>
                    <div class="d-grid mt-3 p-3">
                        <button type="submit" name="login" class="btn btn-primary">
                            SIGN IN
                        </button>
                    </div>
                    <p class="text-center mt-3"> 
                            <a href="confirm-email.php" class="text-decoration-none" >
                                Forgot Password?
                            </a>
                    </p>
                    <p class="text-center">
                        New Member? 
                        <a href="register.php" class="text-decoration-none">
                            Register
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
