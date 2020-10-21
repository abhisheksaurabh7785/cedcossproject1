<?php

ob_start();
require 'config.php';
require 'header.php';
require 'sidebar.php';

if (isset($_POST['updateProduct'])) {
$id = $_POST['pid'];
$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['longdesc'];
$image = $_FILES['image']['name'];
$srouce = $_FILES['image']['tmp_name'];

if ($image != "") {
if (move_uploaded_file($srouce, "productImage/".$image)) {
$sql = "UPDATE product SET `name` = '$name', `price` = '$price', `long_description` = '$desc', `image` = '$image' WHERE id = '$id' ";

mysqli_query($conn, $sql);
header('location: products.php');
} else {
echo "Image Not Upload";
}
} else {
$sql = "UPDATE product SET `name` = '$name', `price` = '$price', `long_description` = '$desc' WHERE id = '$id' ";
// echo $sql;
// exit();
mysqli_query($conn, $sql);
header('location: products.php');
}
}
?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript> 
<!-- Show a notification if the user has disabled javascript -->
<div class="notification error png_bg">
<div>
Javascript is disabled or is not supported by your browser.
Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
</div>
</div>
</noscript>
<!-- Page Head -->
<h2>Welcome John</h2>
<p id="page-intro">What would you like to do?</p>
<div class="clear"></div> 
<!-- End .clear -->
<div class="content-box">
<!-- Start Content Box -->
<div class="content-box-header">
<h3>Products</h3>
<ul class="content-box-tabs">
<!-- <li><a href="#tab1">Manage</a></li>  -->
<!-- href must be unique and match the id of target div -->
<li><a href="#tab2" class="default-tab">Add</a></li>
</ul>
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">

<?php
$id = $_GET['id'];
// echo $id;
$sql = "SELECT * FROM product WHERE id = '$id' ";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
?>
<div class="tab-content default-tab" id="tab2">
<form action="productEdit.php" method="post" 
enctype="multipart/form-data">
<input type="hidden" name="pid" 
value="<?php echo $row['id'] ?>">
<fieldset> 
<!-- Set class to "column-left" or "column-right" 
on fieldsets to divide the form into columns -->

<p>
<label>Product Name</label>
<input class="text-input small-input" type="text" 
id="small-input" name="name" 
value="<?php echo $row['name'] ?>" required /> 
<!-- <span class="input-notification success png_bg">
Successful message</span>  -->
<!-- Classes for input-notification: success, 
error, information, attention -->
<!-- <br /><small>A small description of the field
</small> -->
</p>
<p>
<label>Product Price</label>
<input type="text" class="text-input small-input"
name="price" id="price"
value="<?php echo $row['price'] ?>" required>
</p>
<p>
<label>Product Image</label>
<input type="image" 
src="productImage/<?php echo $row['image'] ?>" 
alt="" class="text-input small-input"><br>
<input type="file" name="image" id="image"
class="text-input small-input">
</p>
<p>
<label>Long Description</label>
<textarea class="text-input textarea wysiwyg" 
id="textarea" name="longdesc" cols="79" rows="15">
<?php echo $row['long_description'] ?>
</textarea>
</p>

<p>
<input class="button" type="submit" value="Update"
name="updateProduct" />
<a href="products.php" class="button">Back</a>
</p>
</fieldset>
<div class="clear"></div>
<!-- End .clear -->
</form>
</div> 
<!-- End #tab2 -->
</div> 
<!-- End .content-box-content -->
</div> 

<?php
require 'footer.php';
?>
