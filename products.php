<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'horticulture');
session_start();

 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if(!isset($_SESSION['login']) || $_SESSION['login'] != TRUE){
    header("location: login.php");
    exit;
}
?>
<body>
    
<div  class="container mn-vh-100" style="min-height:85vh">
<?php require("./components/navbar.php");?>

<h3 id="filter">Filter by </h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<div class="filter">

    <select name="category" class="form-select" aria-label="category">
      <option value="all" selected>All</option>
      <option value="vegetables">vegetables</option>
      <option value="fruits">fruits</option>
      <option value="flowers">flowers</option>
      
    </select>
    <button type="submit" name="filter" class="btn btn-primary">Submit</button>
</div>
</form>
<!-- product card -->
<?php
 $sql = "SELECT  * FROM  product ORDER BY id DESC";
if(isset($_POST["filter"])){
    $filter = $_POST['category'];
    
    if ($filter !=="all") {
        
        $sql = "SELECT  * FROM  product WHERE category='{$filter}' ORDER BY id DESC";
    }
    else{
        $sql = "SELECT  * FROM  product ORDER BY id DESC";

    }
}


$result = mysqli_query($conn,$sql);
  



?>
    <div class="row">

    <?php 
if (mysqli_num_rows($result)>0) {
    $rows = mysqli_fetch_assoc($result);
    while($row = mysqli_fetch_assoc($result))
    // foreach($rows as $row)
    {?>
<div class="col-sm-12 col-md-6 col-xl-4">
<form action="product.php" method="post">
<div class="d-flex flex-wrap gap-2">
    <div class="card bg-light" >
        <div class="row g-0">
            <div class="col-4">
                 <?php echo "<img src='data:image/jpg;base64,".base64_encode($row['image'])."' class='img-fluid rounded-start'>"?>
            </div>
            <div class="col-8">
                <div class="card-body">
                    <h5 class="card-title text-primary"><?php echo $row['name'] ?></h5>
                    <p class="card-text"><?php echo $row['description']?></p>
                    <b><p class="card-text">Ksh: <?php echo $row['price']?></p></b>
                    <input name="product" value="<?php echo $row['id'] ?>" type="hidden" >
                    <!-- <?php echo $row['id'];?> -->
                    <button type="submit" name="view" class="btn btn-success">view</button>
                </div>
            </div>
        </div>
    </div> 
</div> 
</form> 
</div>
 <?php   }
}
?>
        
<!-- end product card -->
</div>         
</div>
<?php 
if(isset($_POST["product"])){
    $_POST = array();
}
require("./components/footer.php");?>
</body>
</html>