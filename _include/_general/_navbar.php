<nav class="navbar custom-container navbar-expand-md px-md-2 navbar-light ">
    <div class="container border-bottom pb-2 mx-2 mx-md-0 px-md-2">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand mr-0" href="index.php">
            <img src="favicon.ico" width="30" height="30" class="d-inline-block align-top" alt="">
            LK Properties
        </a>
        <div class="collapse navbar-collapse" id="main-navbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link nav-hover" href="index.php"><?php echo $lang['navbar']['home']; ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Popular</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        <!-- <div class="dropdown-divider"></div> -->
                        <h5 class="dropdown-header"><?php echo $lang['navbar']['popular']['subCat1']; ?></h5>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="?show=popular">Praia da Rocha</a>
                        <a class="dropdown-item" href="?show=popular">Meia-Praia</a>
                        <a class="dropdown-item" href="?show=popular">Praia do Vau</a>
                        <div class="dropdown-divider"></div>
                        <h5 class="dropdown-header"><?php echo $lang['navbar']['popular']['subCat2']; ?></h5>
                        <!-- <div class="dropdown-divider"></div> -->
                        <a class="dropdown-item" href="?show=popular">Lisboa</a>
                        <a class="dropdown-item" href="?show=popular">Porto</a>
                        <a class="dropdown-item" href="?show=popular">Vilamoura</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?show=activities"><?php echo $lang['navbar']['activities']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?show=faq"><?php echo $lang['navbar']['faq']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?show=for-sale"><?php echo $lang['navbar']['realEstate']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?show=contact-us"><?php echo $lang['navbar']['contactUs']; ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>