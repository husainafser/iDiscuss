<?php include 'partials/dbconnect.php'; ?>
<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $usernme = $_POST['loginuser'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `user` WHERE user_name = '$usernme'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if($numRows==1){
       $row=mysqli_fetch_assoc($result);
       if(password_verify($pass,$row['password'])){
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['sno']=$row['sno'];
          $_SESSION['username']=$usernme;
            header("Location: /forum/index.php?loginsuccess=true");
            exit();
       }
       $showError = "wrong credentials";
       header("Location: /forum/index.php?loginsuccess=false&error=$showError");
    }
    header("Location: /forum/index.php?loginsuccess=false&error=$showError");
}
?>




<!-- <?php
$ShowError ="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $usernme = $_POST['loginemail'];
    $pass = $_POST['loginPassword'];

    $sql = "SELECT * FROM `user` WHERE user_email = '$usernme'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);

    if($numRows==1){
       $row=mysqli_fetch_assoc($result);
       if(password_verify($pass,$row['password'])){
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['useremail']=$usernme;
            header("Location: /forum/index.php?loginsuccess=true");

       }
       header("Location: /forum/index.php?signupsuccess=false&error=$showError");
    }
}
?> -->