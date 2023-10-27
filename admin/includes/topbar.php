<div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3 MenuBtn">
                        <i class="fa fa-bars"></i>
                    </button>

                        <div class="d-inline-block  mx-2 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light searchbar" id="searchbar" placeholder="Search for..." data-toggle="dropdown">
                                <div class="dropdown-menu  shadow w-100 p-1" id="searchContent">
                                    <h6 class="dropdown-header">
                                    </h6>

                                </div>
                            </div>
                            </div>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="../donar/asset/donarprofile/user.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item text-uppercase" href="">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    <?php
                                       $adminname=mysqli_query($dlink,"SELECT * FROM adminregister WHERE adminemail='$_SESSION[adminemail]'");
                                       while($adminame=mysqli_fetch_assoc($adminname)){
                                        $username = $adminame['adminname'];
                                       }
                                    ?>
                                    <?php echo $username ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?admin">
                                    <i class="fas fa-unlock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Admin
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="?logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                