
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'horticulture');
 
/* Attempt to connect to MySQL database */
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div  class="container mn-vh-100" style="min-height:90vh">
    <?php require("./components/navbar.php");?>
        <h1>Add Product</h1>
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <!-- image name -->
  <div class="mb-3">
    <label for="name" class="form-label">name</label>
    <input required type="text" class="form-control" id="name" name="name">
  </div>
  <!--price  -->
  <div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input required type="number" class="form-control" name="price" id="price">
  </div>
  <!-- image -->
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input required type="file" class="form-control" name="image" id="image" >
  </div>
  <!-- description -->
  <div class="mb-3">
    <label for="textarea" class="form-label">Description</label>
    <textarea required class="form-control" name="description" rows="3"></textarea>
  </div>
<!-- select category -->
<select name='category' required class="form-select" aria-label="category">
      <option value="vegetables">vegetables</option>
      <option value="fruits">fruits</option>
      <option value="flowers">flowers</option>
      
</select>
  <button type="submit" name="insert" value="insert" class="btn btn-primary">Submit</button>
</form>

<p>To view all products, click <a class="link-primary" href="products.php">here</a></p>

    
<?php
if(isset($_POST['insert'])){
  session_start();
    $name = $_POST['name'];
    $price = $_POST['price'];
    $producerId = $_SESSION['producerId'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $file = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $sql = "INSERT INTO product(name,price,description,image,producerId,category) VALUES('{$name}','{$price}','{$description}','{$file}','{$producerId}','{$category}');";
    if(mysqli_query($conn, $sql)){
        echo '<p class="text-success h4 p-3 mb-2 bg-light">Insert success</p>';
    }
    else{
        echo 'not inserted'.mysqli_error($conn);
    }
}


?>
</div>
<?php require("./components/footer.php");?>
</body>
</html>