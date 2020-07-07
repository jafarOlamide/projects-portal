<?php include 'headLinks.php'; ?>
<?php include "server.php"; ?>
<?php 
  if (!isset($_SESSION['user_id'])) {
          header("Location: index.php"); 
  }
?>  
 <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1D5394;">
 <div>
   <!-- <a class="navbar_txt navbar-brand" href="dashboard.php" style="color: #fff; font-weight: 600;"><img src="img/logo-white (1).png" style="width: 100px; height: 40px;"></a> -->
   Project Monitor
 </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavItemsCollapse" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" id="nav-button">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="myNavItemsCollapse">
  <ul class="navbar-nav ml-auto">
      <!-- <div id="search_pane" class="mr-3">
        <form class="form-group search-example form-inline my-2 my-lg-0 search" action="search.php" method="post" autocomplete="off">
          <input type="text" name="search_input" placeholder="Search Projects" class="form-control" id="search_input">
           <button type="submit" id="search_btn" name="search_button" class="btn btn-primary"><i><img src="img/if_icon-111-search_314478.svg" class="" style="font-size: 10px;"></i></button>
        </form>
        <div class="liveSearch">
        </div>
      </div> -->
      
      <li class="nav-item mr-3">
        <a class="nav-link" href="dashboard.php" style="color: #fff; font-weight: 600;">Dashboard</a>
      </li>
      <li class="nav-item mr-3">
        <a class="nav-link" href="createProject.php" style="color: #fff; font-weight: 600;">Add Project</a>
      </li>      
      <li class="nav-item mr-3">
        <a class="nav-link" href="ongoing_projects_rebrand.php" style="color: #fff; font-weight: 600;">Ongoing Projects</a>
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
