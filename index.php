<?php
    include ('includes/header.php');

    $header = 'Dashboard';

    if (!isset($_SESSION['loggedin']))
    {
        header ('Location: auth/login.php');
        exit ();
    }
    
?>

    <!-- Css, fontawesome icons, bootstrap --> 
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/icons/css/all.min.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- End -->

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-light sticky-top shadow-lg p-3">
        <?php include ('includes/navbar.php')?>
    </nav>
    <!-- Navigation Bar End -->

    <!-- Header -->
    <header>
    </header>
    <!-- Header End -->


    <!-- Main Content -->
    <main class="">
    <div class="container bg-dark mt-5">
        <h2 class="text-center text-light">Hello world</h2>
    </div>
    </main>
    <!-- End Main Content -->

    <!-- Section -->
    <section>

    </section>
    <!-- Section End -->
    
    <!-- Footer -->
    <footer>
        <?php include ('includes/footer.php'); ?>
    </footer>
    <!-- End Footer -->


