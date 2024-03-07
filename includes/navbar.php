
    <div class="container-fluid">
        <a href="" class="navbar-brand">
            <?= $pageTitle ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a href="" aria-current="page" class="nav-link active">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link active">
                        Contacts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link active">
                        Services
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a href="" id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                    aria-expanded="false" v-pre>
                        <?php echo $_SESSION['username'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a href="" class="dropdown-item">
                            <i class="fa fa-sign-out"></i>
                            Profile
                        </a>
                        <a href="" class="dropdown-item">
                            <i class="fa fa-sign-out"></i>
                            Settings
                        </a>
                        <a href="/auth/logout.php" class="dropdown-item">
                            <i class="fa fa-sign-out"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>