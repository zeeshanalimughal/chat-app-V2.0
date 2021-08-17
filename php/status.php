<!-- <?php 
  session_start();
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
          $user =  $_GET['user_id'];
          $selectSql = "SELECT * FROM users WHERE unique_id = {$user}";
          $result = mysqli_query($conn,$selectSql);
          if(mysqli_num_rows($result) > 0 ){
            $rows = mysqli_fetch_assoc($result);
            echo $rows['status'];
          }
        ?> -->