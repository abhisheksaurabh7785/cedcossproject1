<?php
include ('config.php');

// echo "hii";

// echo $name = $_POST['name'];

// $price = $_POST['price'];
// $dropdown = $_POST['dropdown'];
// $tags = implode(",", $_POST['fashion']);
// $description = $_POST['description'];

// $image = $_FILES['image']['name'];
// $desc = $_FILES['image']['tmp_name'];

// if (move_uploaded_file($image, "productImage/".$desc)) {
//   $sql = "INSERT INTO product (`name`, `price`, `image`, `long_description`, tags) VALUES ('$name', '$price', '$dropdown', '$tags', '$description', '$image')";
//   echo $sql;
//   exit();
//   mysqli_query($conn, $sql);
// }




// $errors = array();
// $message = '';
$name = $_POST['name'];
$price = $_POST['price'];
$dropdown = $_POST['dropdown'];
$tags = implode(",", $_POST['fashion']);
$description = $_POST['description'];

$image = $_FILES['image']['name'];
$desc = $_FILES['image']['tmp_name'];

if (move_uploaded_file($desc, "productImage/".$image)) {
  $sql = "INSERT INTO product (`name`, `price`, `image`, `long_description`, `tags`, `category`) VALUES ('$name', '$price', '$image', '$description', '$tags', '$dropdown')";
  // echo $sql;
  // exit();
  mysqli_query($conn, $sql);
  header('LOCATION:products.php');
} else {
  echo "file not uploaded";
}



?>
