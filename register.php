<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'horticulture');
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// require("parent.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<div class="container mn-vh-100" style="min-height:85vh">
<?php require("./components/navbar.php");?>
    <h2 class="text-primary text-center">Register here</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
 <!-- full name -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Full name</label>
    <input type="text" required class="form-control" placeholder="john smith" name="name" id="name"">
  </div>
    <!-- Email -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input required type="email" placeholder="johnsmith.gmail.com"  class="form-control" name="email" id="email" ">
  </div>
 <!-- username -->
 
  <div class="mb-3">
    <label for="username" class="form-label">username</label>
    <input required type="text" class="form-control" placeholder="john" name="username" id="username"">
    
  </div>
  <!-- contact -->
  <div class="mb-3">
    <label for="contact" class="form-label">Contact</label>
    <input required type="text" class="form-control" id="contact" placeholder="0700 000 000" name="contact" aria-describedby="emailHelp">
  </div>

  <!-- address -->
  <div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <input required type="text" class="form-control" id="address" placeholder="Nairobi kenya" name="address" aria-describedby="emailHelp">
  </div>
  <!--password  -->
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input required type="password" class="form-control" name="password" id="password">
  </div>
  <!-- confirm password -->
  <div class="mb-3">
    <label for="password" class="form-label">Confirm Password</label>
    <input required type="password" class="form-control" name="confirm_password" id="confirm_password">
  </div>
<!-- select membership -->
<select name='membership'required class="form-select" aria-label="membership">
  <option selected>Select your membership</option>
  <option value="producer">Producer</option>
  <option value="consumer">Consumer</option>
 
</select>
 <p>
  <button name="register" type="submit" class="btn btn-primary">Submit</button>
  <a href="login.php" class="btn btn-secondary">LOGIN</a>
</p>
</form>

<?php
if(isset($_POST["register"])){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $address = $_POST['address'];
  $membership = $_POST['membership'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  if ($membership == "producer") {
    
    $sql = "INSERT INTO producer(name,email,address,contact,username,password) VALUES('{$name}','{$email}','{$address}','{$contact}','{$username}','{$password}'); ";
  } if ($membership == "consumer") {
    
    $sql = "INSERT INTO consumer(name,email,address,contact,username,password) VALUES('{$name}','{$email}','{$address}','{$contact}','{$username}','{$password}'); ";
  }
  
  if (mysqli_query($conn,$sql)) {
    echo "success reg";
    header("location: login.php");
  }
  else{
    echo "reg failed";
  }

}


?>
</div>
<?php require("./components/footer.php");?>
</body>
</html>