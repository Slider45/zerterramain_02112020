<?php
session_start();
// include '../PagesFunction/connection.php';
include 'connection.php';
include 'Buttons/usersButtonFunction.php';
?>
<!DOCTYPE html>
<html>
<title>Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
<link rel="icon" href="../images/plainlogo.png" type="image/x-icon" />
<link rel="stylesheet" href="sass/users.css">
<body>

  <?php
  include 'Pages/salesViewPage.php'; 
  ?>
  <nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="navbar-brand navbar-start">
      <a class="navbar-item" href="index.php">
        <img src="images/logowhite.png" width="112" height="28" class="img-logo">
      </a>
    </div>
    <!-- search button -->
  <!--   <div>
      <form action="admin.php" method="POST">
        <input class="input" type="text" id=input name="searchValue" placeholder="Search...">
        <span><button id="search-btn" name="search_btn" value="submit"><i class="fa fa-search"></i></button></span>

      </form>
    </div> -->

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
         <a class="button btn-logout modal-button" data-target="#userSearchModal" aria-haspopup="true">
          <i class="fa fa-search"></i></i> &nbspSearch
        </a>
        <a class="button btn-user">
          <i class="far fa-user"></i> &nbspUser
        </a>
        <a class="button btn-logout">
          <i class="fas fa-sign-out-alt"></i> &nbspLogout
        </a>
      </div>
    </div>
  </div>
</div>
</nav>

<?php include 'Buttons/userSearch.php'?>

<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left" style="width:200px;" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large w3-hide-large" onclick="w3_close()" id="close">&times;</button>
  <a href="index.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-th-large"></i> &nbsp Dashboard</a>
  <a href="admin.php" class="w3-bar-item w3-button" id="item-hover"> <i class="fas fa-user-shield"></i> &nbsp Admin</a>
  <a href="users.php" class="w3-bar-item w3-button" id="dashboard"><i class="fas fa-user"></i> &nbsp Users</a>
  <a class="w3-bar-item w3-button w3-dropdown-hover modal-button" id="sendmodal" data-target="#ordersModal" aria-haspopup="true"><i class="fas fa-cubes"></i> &nbsp Orders</a>
  <a href="request.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-envelope-open-text"></i> &nbsp Request</a>
  <a href="sales.php" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-hand-holding-usd"></i> &nbsp Sales</a>
  <a href="#" class="w3-bar-item w3-button" id="item-hover"><i class="fas fa-print"></i> &nbsp Consolidate</a>
</div>

<div class="w3-main" style="margin-left:200px">
  <div class="w3-teal">
    <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
  </div>

  <div class="w3-container">
    <div class="columns">
      <div class="column">
        <h1 class="button-category">USERS</h1>
      </div>
      <div class="column">
        <button style="margin-top: 30px ; margin-left: 430px;" id="btn-add" class="button modal-button is-success" data-target="#myModal" aria-haspopup="true">
          <i class="fas fa-user-plus"></i> &nbspADD</button>
          <?php 
          include 'Buttons/addUsersModal.php';
          ?>
        </div>
      </div>

      <section class="section">
        <div class="container"> 
         <table class="table">
          <thead>
           <tr>
            <th>#</th>
            <th>Serial #</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>R. Days</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>

          <?php 

          if (isset($_POST['search_btn'])){
            $searchValue = $_POST['searchValue'];

            if ($searchValue===''){
              echo '<script>window.location.href="?"</script>';
            }else{
              include 'searchFunction/searchUsersFunction.php';
            }
          }else{     
            $sql = "SELECT * FROM tblusers WHERE is_active='1' ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
            $res_data = $con->query($sql);
            while($row = mysqli_fetch_array($res_data)){
              $id = $row['id'];
              $serialNum = $row['Serial_Number'];
              $fname = $row['Firstname'];
              $lname = $row['Lastname'];
              $rdays = $row['remaining_days'];
              $email = $row['email'];
              $dateReg = $row['dateRegistered'];
              $dateEnd= $row['dateExpired'];
              $contact = $row['ContactNumber'];   
              ?>
              <tbody>
               <tr>
                 <td>
                   # <?php echo $id; ?>
                 </td>
                 <td>
                  <?php echo $serialNum; ?>
                </td>

                <td>
                  <?php echo $fname; ?>
                </td>
                <td>
                  <?php echo $lname; ?>
                </td>
                <td>
                  <?php echo $rdays; ?>
                </td>
                <td>
                  <button data-target="#edit<?php echo $id;?>" class="button is-primary is-small modal-button" id="btn_update" name="btn-update"><i class="far fa-edit"></i>
                  </button>
                  <?php
                  include 'Buttons/usersEditModal.php';
                  ?>
                  <button data-target="#delete<?php echo $id;?>" class="button is-danger is-small modal-button"  id="btn_delete" name="acnt_remove"><i class="fas fa-trash-alt"></i>
                  </button>
                  <?php
                  include 'Buttons/usersRemoveModal.php';
                  ?>
                  <button data-target="#view<?php echo $id;?>" class="button is-success is-small modal-button"  id="btn_delete" name="acnt_view"><i class="far fa-eye"></i>
                  </button>
                  <?php
                  include 'Buttons/usersViewModal.php';
                  ?>
                </td>
              </tr>

              <?php 
            }  
          }        
          ?>
        </tbody>
      </table>
      <nav class="pagination is-small" role="navigation" aria-label="pagination">
        <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" class="pagination-previous" >Previous</a>
        <a href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>" class="pagination-next">Next page</a>
        <ul class="pagination-list">
          <li><a href="?page=1" class="pagination-link" >1</a></li>
          <li>
            <span class="pagination-ellipsis">&hellip;</span>
          </li>
          <li><a href="?page=<?php echo $total_pages; ?>" class="pagination-link"><?php echo $total_pages; ?></a></li>
        </ul>
      </nav>
    </div>
  </section>


</div>

<script>
  function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
  }

  function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
  }
</script>


<!-- modal orders -->

<?php
include 'ordersModal.php';
?>
  
  <script>
    function w3_open() {
      document.getElementById("mySidebar").style.display = "block";
    }
    function w3_close() {
      document.getElementById("mySidebar").style.display = "none";
    }
    
  </script>

</body>
</html>
