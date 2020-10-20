<?php include('header.php'); ?>
<?php include('config.php'); ?>
<?php include('sidebar.php'); ?>

<div id="main-content"> <!-- Main Content Section with everything -->

<noscript> <!-- Show a notification if the user has disabled javascript -->
<div class="notification error png_bg">
<div>
Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
</div>
</div>
</noscript>

<!-- Page Head -->
<h2>Welcome John</h2>
<p id="page-intro">What would you like to do?</p>



<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

<h3>Products</h3>

<ul class="content-box-tabs">
<li><a href="#tab1" class="default-tab">MANAGE</a></li> <!-- href must be unique and match the id of target div -->
<li><a href="#tab2">ADD</a></li>
</ul>

<div class="clear"></div>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->



<table>

<thead>
<tr>
<th><input class="check-all" type="checkbox" /></th>
<th>Name</th>
<th>Price</th>
<th>Tags</th>
<th>Category</th>
<th>Color</th>
<th>Image</th>
<th>Long_description</th>
<th>Action</th>
</tr>

</thead>

<tfoot>
<tr>
<td colspan="6">
<div class="bulk-actions align-left">
<select name="dropdown">
<option value="option1">Choose an action...</option>
<option value="option2">Edit</option>
<option value="option3">Delete</option>
</select>
<a class="button" href="#">Apply to selected</a>
</div>

<div class="pagination">
<a href="#" title="First Page">&laquo; First</a><a href="#" title="Previous Page">&laquo; Previous</a>
<a href="#" class="number" title="1">1</a>
<a href="#" class="number" title="2">2</a>
<a href="#" class="number current" title="3">3</a>
<a href="#" class="number" title="4">4</a>
<a href="#" title="Next Page">Next &raquo;</a><a href="#" title="Last Page">Last &raquo;</a>
</div> <!-- End .pagination -->
<div class="clear"></div>
</td>
</tr>
</tfoot>
<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE id = '$id' ";
    mysqli_query($conn, $sql);
  }
?>
<tbody>
  <?php 
    $sql = "SELECT * FROM product";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {

  ?>
<tr>
<td><input type="checkbox" /></td>
<td><?php echo $row['name'] ?></td>
<td><a href="#" title="title"><?php echo $row['price'] ?></a></td>
<td><?php echo $row['tags'] ?></td>
<td><?php echo $row['category'] ?></td>
<td><?php echo $row['color'] ?></td>
<td><img src="productImage/<?php echo $row['image'] ?>" alt="" height="100" wdith="100"></td>
<td><?php echo $row['long_description'] ?></td>
<td>
<!-- Icons -->
<a href="#" title="Edit"><img src="resources/images/icons/pencil.png" alt="Edit" /></a>
<a href="products.php?id=<?php echo $row['id']; ?>" title="Delete"><img src="resources/images/icons/cross.png" alt="Delete" /></a> 
<a href="#" title="Edit Meta"><img src="resources/images/icons/hammer_screwdriver.png" alt="Edit Meta" /></a>
</td>
</tr>
    <?php } ?>


</tbody>

</table>

</div> <!-- End #tab1 -->
<?php
  if (isset($_POST['submit'])) {
    // echo "hiii";
    // $name = $_POST['name'];
    // $price = $_POST['price'];
    // $dropdown = $_POST['dropdown'];
    // $tags = implode(",", $_POST['fashion']);
    // $description = $_POST['description'];

    // $image = $_FILES['image']['name'];
    // $desc = $_FILES['image']['tmp_name'];

    // if (move_uploaded_file($desc, "productImage/".$image)) {
    //   $sql = "INSERT INTO product (`name`, `price`, `image`, `long_description`, tags) VALUES ('$name', '$price', '$image', '$description', '$tags')";
    //   // echo $sql;
    //   // exit();
    //   mysqli_query($conn, $sql);
    // } else {
    //   echo "file not uploaded";
    // }
  }
?>

<div class="tab-content" id="tab2">

<form action="update.php" method="post" enctype="multipart/form-data">

<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets 
to divide the form into columns -->

<p>
<label>Name</label>
<input class="text-input medium-input datepicker" type="text" id="medium-input" name="name" /> 
</p>

<p>
<label>Price</label>
<input class="text-input small-input" type="text" id="small-input" name="price" />  <!-- Classes for input-notification: success, error, information, attention -->
</p>

<p>
<label>Image</label>
<input class="text-input small-medium" type="file" id="small-medium" name="image" />
</p>

<p>
<label>Category</label>
<select name="dropdown" class="small-input">
  <?php
    $sql = "SELECT * FROM categories";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
    
  ?>
<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
  <?php } ?>
<!-- <option value="women">Women</option>
<option value="kids">Kids</option>
<option value="electronics">Electronics</option>
<option value="sports">Sports</option> -->
</select >
</p>
<p>
<label for="Tags">Tags</label>
<?php
    $sql = "SELECT * FROM tags";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
    
  ?>
<input type="checkbox" value="<?php echo $row['name']; ?>" name="fashion[]" /> <?php echo $row['name'] ?>
    <?php } ?>
<!-- <input type="checkbox" value="ecommerce" name="fashion[]" /> Ecommerce
<input type="checkbox" value="shop" name="fashion[]" /> Shop
<input type="checkbox" value="handbag" name="handbag[]" /> Hand Bag
<input type="checkbox" value="laptop" name="laptop[]" /> Laptop
<input type="checkbox" value="headphone" name="headphone[]" /> Headphone -->
</p>

<p>
<label for="color">Color</label>
<?php
    $sql = "SELECT * FROM colors";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
    
  ?>
<input type="checkbox" value="<?php echo $row['color']; ?>" name="color[]" /> <?php echo $row['color'] ?>
    <?php } ?>
<!-- <input type="checkbox" value="ecommerce" name="fashion[]" /> Ecommerce
<input type="checkbox" value="shop" name="fashion[]" /> Shop
<input type="checkbox" value="handbag" name="handbag[]" /> Hand Bag
<input type="checkbox" value="laptop" name="laptop[]" /> Laptop
<input type="checkbox" value="headphone" name="headphone[]" /> Headphone -->
</p>

<p>

<p>
<label>Description</label>
<textarea class="text-input textarea wysiwyg" id="textarea" name="description" cols="79" rows="15"></textarea>
</p>

<p>
<input class="button" type="submit" value="Submit" name="submit"/>
</p>

</fieldset>

<div class="clear"></div><!-- End .clear -->

</form>

</div> <!-- End #tab2 -->        

</div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->




<div class="clear"></div>


<!-- Start Notifications -->
<!--
<div class="notification attention png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
</div>
</div>

<div class="notification information png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>

<div class="notification success png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>

<div class="notification error png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>
-->
<!-- End Notifications -->

<?php include('footer.php'); ?>
