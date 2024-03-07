<?php

    if (isset($_SESSION['success']))
    {
        echo "
        <div class='alert alert-success text-center alert-dismissible fade-show role='alert' '>
            <i class='fa-solid fa-circle-check flex-shrink-0 me-2' aria-hidden='true'></i>
                ".$_SESSION['success']."
        </div>

        ";
        unset($_SESSION['success']);
    }

    if (isset($_SESSION['error']))
    {
        echo "
            <div class='alert alert-danger text-center alert-dismissible fade-show role='alert''>
                <i class='fa fa-exclamation-triangle flex-shrink-0 me-2' aria-hidden='true'></i>
                    ".$_SESSION['error']."
            </div>
        ";
        unset($_SESSION['error']);

    }
?>