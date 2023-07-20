   <body class="sb-nav-fixed">
       <?php include "topbar.php" ?>
       <div id="layoutSidenav">
           <div id="layoutSidenav_nav">
               <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                   <div class="sb-sidenav-menu" style="margin-top: -2vh">
                       <div class="nav">
                           <img src="./assets/img/logo.png" width="200vw" alt="">
                           <?php if ($_SESSION['role'] == 1) {

                            ?>
                               <div class="sb-sidenav-menu-heading">ADMIN</div>
                               <a class="nav-link" href="index.php">
                                   <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                   Halaman Utama
                               </a>
                               <a class="nav-link" href="manajemen-user.php">
                                   <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                   Manajemen User
                               </a>
                               <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseData" aria-expanded="false" aria-controls="collapseData">
                                   <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                   Manajemen Data
                                   <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                               </a>
                               <div class="collapse" id="collapseData" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                   <nav class="sb-sidenav-menu-nested nav">
                                       <a class="nav-link" href="data-tanaman.php">Data Tanaman</a>
                                       <a class="nav-link" href="manajemen-input.php">Data Input</a>
                                   </nav>
                               </div>
                           <?php } ?>
                           <div class="sb-sidenav-menu-heading">USER</div>
                           <?php if ($_SESSION['role'] == 2) {

                            ?>
                               <a class="nav-link" href="index-user.php">
                                   <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                   Halaman Utama
                               </a>
                           <?php } ?>
                           <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProfil" aria-expanded="false" aria-controls="collapseProfil">
                               <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                               Profil
                               <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                           </a>
                           <div class="collapse" id="collapseProfil" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                               <nav class="sb-sidenav-menu-nested nav">
                                   <a class="nav-link" href="profil.php">Lihat Profil</a>
                                   <a class="nav-link" href="password.php">Ubah Password</a>
                               </nav>
                           </div>
                           <a class="nav-link" href="user-input.php">
                               <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                               Data Input
                           </a>
                           <?php if ($_SESSION['role'] > 1) { ?>
                               <a class="nav-link" href="data-all.php">
                                   <div class="sb-nav-link-icon"><i class="fas fa-layer-group"></i></div>
                                   Data Keseluruhan
                               </a>
                           <?php } ?>

                           <a href="logout_fcn.php"><button type="button" class="btn btn-outline-primary" style="position: fixed;left: 50%;bottom: 20px;transform: translate(-50%, -50%);margin: 0 auto;">Keluar</button></a>
                           <!-- <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div> -->
               </nav>
           </div>
           <div id="layoutSidenav_content" style="margin-top: -5rem;">