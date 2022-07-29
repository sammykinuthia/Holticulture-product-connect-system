<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'horticulture');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<?php
session_start();
if(isset($_POST['remove'])){
   echo $_SESSION['productId'];

    $sql = "DELETE FROM product WHERE id='{$_SESSION['productId']}'";
    if(mysqli_query($conn,$sql)){
        // echo mysqli_connect_error($conn);
        header("location: products.php");
    }
    else{
        //  header("location: products.php");
        echo "<h3 class='bg-danger'>Remove failed</h3>";
    }
}

   ?>