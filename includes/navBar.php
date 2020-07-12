<?php 
include 'headLinks.php'; 
require_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php");
?>
<?php 
  if (!isset($_SESSION['user_id'])) {
          header("Location: login.php");
  }
?>  
 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1D5394;">
 <div>
   <!-- <a class="navbar_txt navbar-brand" href="dashboard.php" style="color: #fff; font-weight: 600;"><img src="img/logo-white (1).png" style="width: 100px; height: 40px;"></a> -->
  <a style="color: #fff; font-weight: 600; font-size: 25px;">Project Tracking Application</a>
 </div> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavItemsCollapse" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" id="nav-button">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="myNavItemsCollapse">
  <ul class="navbar-nav ml-auto">  
      <li class="nav-item mr-3">
        <a class="nav-link" href="index.php" style="color: #fff; font-weight: 600;">Dashboard</a>
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="createProject.php" style="color: #fff; font-weight: 600;">Add Project</a>
      </li>      
      <li class="nav-item mr-3">
        <a class="nav-link" href="ongoing_projects.php" style="color: #fff; font-weight: 600;">Ongoing Projects</a>
      </li> 
      <?php 
        if ($_SESSION['user_role'] == 'admin' ) {
          echo '<li class="nav-item mr-3">
        <a class="nav-link" href="completed_projects.php" style="color: #fff; font-weight: 600;">Completed Projects</a>
      </li>';
        } else{
          echo '<li class="nav-item mr-3">
              <a class="nav-link" href="member_completed_projects.php" style="color: #fff; font-weight: 600;">Completed Projects</a>
            </li>';
        }
      ?>  
      
      <?php 
        if ($_SESSION['user_role'] == 'admin' ) {
          echo '<li class="nav-item mr-3"><a class="nav-link" href="test_all_projects.php" style="color: #fff; font-weight: 600;">All Projects</a></li>';
        }
      ?>
      <li class="nav-item dropdown">  
        <a class="nav-link" href="#dropdown_menu_user" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-weight: 600;"><img src="img/avatar.svg" style="height: 35px; width: 40px;"></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" id="dropdown_menu_user">
          <a class="dropdown-item" href="#"><?php echo $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></a>
          <?php 
            if ($_SESSION['user_role'] == 'admin' ) {
              echo '<a class="dropdown-item" href="users.php">Users</a>';
            }
          ?>
          <?php 
            if ($_SESSION['user_role'] == 'admin' ) {
              echo '<a class="dropdown-item" href="administrators.php">Administrators</a>';
            }
          ?>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="includes/logout.php">Log Out</a>
        </div>
      </li>       
    </ul>  
  </div>
</nav>
