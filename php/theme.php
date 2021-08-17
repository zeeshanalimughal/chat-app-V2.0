<!-- <?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $output = "";
        $sql = "SELECT theme FROM  users WHERE unique_id = {$_SESSION['unique_id']}";
        $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($query);
            if($row['theme']=="light"){
                $pdateTheme1 ="UPDATE users set theme='dark' WHERE unique_id = {$_SESSION['unique_id']}";
                $q2 = mysqli_query($conn,$pdateTheme1);
                $output .= '<i id="day" class="fas fa-sun"></i>';
            }else{
                $pdateTheme2 ="UPDATE users set theme='light' WHERE unique_id = {$_SESSION['unique_id']}";
                $q2 = mysqli_query($conn,$pdateTheme2);
                $output .= '<i id="night" class="fas fa-moon"></i>';
            }
            echo $output;
    }
?> -->