 <header class="navbar-header">
     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <nav class="navbar navbar-expand-lg">
                     <a class="navbar-brand" href="index.php">
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
                                     <a class="ud-menu" href="home-student.php?page=user-home">Home</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-student.php?page=user-browse-topics">IMCCS Topics</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-student.php?page=user-browse-assessment">Assessments</a>
                                 </li>
                                 <div class="user-btn">
                                     <h5 class="mt-4 mb-2"><i class="fa-solid fa-circle-user"></i>
                                        <?php echo $_SESSION["username"] ?></h5>
                                     <li class="nav-item">
                                         <a href="home-student.php?page=user-update-profile-password&subpage=personal-info" class="btn-custom-secondary sign-in login-btn">
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

                             <ul id="nav" class="navbar-nav mx-auto home-item">

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
                                     <a class="sign-out" href="logout.php">Logout</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-student.php?page=user-browse-topics">IMCCS Topics</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="ud-menu" href="home-student.php?page=user-browse-assessment">Assessments</a>
                                 </li>

                             </ul>


                         <?php else : ?>

                     </div>

                     <div class="navbar-btn d-none d-sm-inline-block">
                         <a href="index.php?page=login" class="btn-custom-secondary login-btn">
                             Sign In
                         </a>
                         <!--
                         <a href="javscript:void(0)" id="sign-in" class="btn-custom-primary btn-custom-primary-highlight sign-in">
                             Register
                         </a>
                         -->
                     </div>
                 <?php endif; ?>



                 </nav>
             </div>
         </div>
     </div>
 </header>