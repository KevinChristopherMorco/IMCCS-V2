 <header class="navbar-header">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <nav class="navbar navbar-expand-lg">
                     <a class="navbar-brand" id="navbar-brand">
                         <img src="assets/images/website-main-logo/IMCCS-white.png" width="100px" height="50px" alt="Logo" />
                     </a>
                     <button class="navbar-toggler">
                         <span class="toggler-icon"> </span>
                         <span class="toggler-icon"> </span>
                         <span class="toggler-icon"> </span>
                     </button>

                     <div class="navbar-collapse">
                         <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>
                             <!--
                             <ul class="navbar-nav me-auto">
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-home">Home</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-topics">IMCCS Topics</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-assessment">Assessments</a>
                                 </li>
                                 <div class="user-btn">
                                     <h5 class="mt-4 mb-2"><i class="fa-solid fa-circle-user"></i>
                                        <?php echo $_SESSION["username"] ?></h5>
                                     <li class="nav-item">
                                         <a href="home-page.php?page=user-update-profile-password&subpage=personal-info" class="btn-custom-secondary sign-in login-btn">
                                             <i class="fa-solid fa-gear"></i>
                                             Account Settings
                                         </a>
                                     </li>
                                     <li class="nav-item">
                                         <a href="logout.php" id="sign-in" class="btn-custom-secondary signout">
                                             <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                             Sign Out
                                         </a>
                                     </li>
                                 </div>

                             </ul>
                         -->

                             <ul id="nav" class="navbar-nav mx-auto home-item" style="display:none">

                                 <li class="nav-item">
                                     <a class="ud-menu-scroll" href="#home">Home</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu-scroll" href="#features">Features</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu-scroll" href="#faq">FAQ's</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu-scroll" href="#team">Team</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu-scroll" href="#contact">Contact</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                 </li>

                                 <!--
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-topics">IMCCS Topics</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-assessment">Assessments</a>
                                 </li>
                         -->
                             </ul>

                             <ul id="nav2" class="navbar-nav home-item2" style="display:none">
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-topics">IMCCS Topics</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-page.php?page=user-browse-assessment">Assessments</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                                 </li>
                             </ul>


                         <?php else : ?>


                             <ul id="nav3" class="navbar-nav home-item3 ms-auto">
                                 <li class="nav-item">
                                     <a href="index.php?page=login" class="ud-menu">
                                         <i class="fa-sharp fa-solid fa-right-to-bracket"></i>
                                         Sign In
                                     </a>
                                 </li>
                             </ul>

                     </div>


                 <?php endif; ?>



                 </nav>
             </div>
         </div>
     </div>
 </header>

 <?php

    if (!isset($_SESSION['loggedin'])) {
        $_SESSION['loggedin'] = false;
    }
    if ($_SESSION['loggedin']) {
        echo '<script>document.getElementById("navbar-brand").href = "index.php?page=imccs-home";</script>';
    } else {
        echo '<script>document.getElementById("navbar-brand").href = "index.php";</script>';
    }
    ?>