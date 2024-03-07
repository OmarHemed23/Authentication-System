<?php
    include ('../includes/header.php');
    include ('../config/connection.php');

    $_SESSION['registration'] = true;

    $create_time = date('Y-m-d H:i:s');
    if (isset($_POST['register']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = ($_POST['password']);
        $confirm_password = ($_POST['confirm-password']);
        
        try 
        {
            /*  Check if phone number exists
                Check for password confirmation
            */
            $query = "SELECT COUNT(*) as total FROM users WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email',$email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0)
            {
                $_SESSION['error'] = "Email already exists";
            }
            elseif ($password != $confirm_password)
            {
                $_SESSION['error'] = "Password does not match";
            }
            else
            {
                // Ecncrypt password
                $password = password_hash($_POST['password'],PASSWORD_DEFAULT);

                // Insert new user data to db
                $sql = "INSERT INTO users (username,email,password,create_time)
                VALUES (:username,:email,:password,:create_time)";
                $stmt = $conn->prepare ($sql);
                $stmt->bindParam(':username',$username);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':password',$password);
                $stmt->bindParam(':create_time',$create_time);

                
                if($stmt->execute())
                {
                    require "../config/mailer.php";
                    $username = $_SESSION['username'];
                    $email = $_SESSION['mail'];
                }
                else 
                {
                    $_SESSION['error'] = "Fill up the registration form";
                }   
            }
        }
        catch (PDOException $e)
        {
            echo "Error:".$e->getMessage();
        }
    }
?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white p-3 m-auto shadow-lg rounded-3">
                <h2 class="text-center">SIGN UP</h2>
                <?php 
                    if (isset ($_POST['register']))
                    {
                        include ('../includes/messages.php');
                    }
                 ?>
                <form action="" method="post">
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fa fa-user text-white"></i>
                        </span>
                        <input type="text" name="username" class="form-control shadow-none" 
                        placeholder="Enter Username" required>
                    </div>
                    <div class="input-group mt-3">
                        <span class="input-group-text bg-primary border-1">
                            <i class="fas fa-envelope text-white"></i>
                        </span>
                        <input type="email" name="email" class="form-control 
                        shadow-none" placeholder="Enter Email" required>
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
                        <button type="submit" name="register" class="btn btn-primary">
                            SIGN UP
                        </button>
                        <p class="text-center mt-3">
                            Already A Member? 
                            <a href="login.php" class="text-decoration-none" >
                                Login
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    include ('../includes/footer.php');
?>