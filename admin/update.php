<?php
include ('config.php');

// echo "hii";

$name = $_POST['name'];
$price = $_POST['price'];
$dropdown = $_POST['dropdown'];
$tags = implode(",", $_POST['fashion']);
$description = $_POST['description'];
$color = implode(",", $_POST['color']);

$image = $_FILES['image']['name'];
$desc = $_FILES['image']['tmp_name'];

if (move_uploaded_file($desc, "productImage/".$image)) {
$sql = "INSERT INTO product (`name`, `price`, `image`, `long_description`, `tags`, `category`, `color`) VALUES ('$name', '$price', '$image', '$description', '$tags', '$dropdown', '$color')";
// echo $sql;
// exit();
mysqli_query($conn, $sql);
header('LOCATION:products.php');
} else {
echo "file not uploaded";
}

?>
