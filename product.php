<?php
session_start();

require 'admin/config.php';

if (isset($_GET['pid'])) {
$id = $_GET['pid'];
$sql = "SELECT * FROM product WHERE id = '$id' ";
$res = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($res);

$cart = array(
$data['id']=>array(
"id"=>$data['id'],
"name"=>$data['name'],
"price"=>$data['price'],
"image"=>$data['image'],
"qty"=>1
)
);

$itemQty = "";
foreach ($cart as $key => $value) {
$itemQty = $value['qty'];
}

if (empty($_SESSION['cartProduct'])) {
$_SESSION['cartProduct'] = $cart;
} else {
if (in_array($data['id'], array_keys($_SESSION['cartProduct']))) {
$_SESSION['cartProduct'][$key]['qty'] += $itemQty; 
} else {
$_SESSION['cartProduct']
= array_merge($_SESSION['cartProduct'], $cart);
}
}
}
// echo count($_SESSION['cartProduct']);

require 'header.php';
?> 

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
<img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
<div class="aa-catg-head-banner-area">
<div class="container">
<div class="aa-catg-head-banner-content">
<h2>Fashion</h2>
<ol class="breadcrumb">
<li><a href="index.html">Home</a></li>         
<li class="active">Women</li>
</ol>
</div>
</div>
</div>
</section>
<!-- / catg header banner section -->

<!-- product category -->
<section id="aa-product-category">
<div class="container">
<div class="row">
<div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
<div class="aa-product-catg-content">
<div class="aa-product-catg-head">
<div class="aa-product-catg-head-left">
<form action="" class="aa-sort-form">
<label for="">Sort by</label>
<select name="">
<option value="1" selected="Default">Default</option>
<option value="2">Name</option>
<option value="3">Price</option>
<option value="4">Date</option>
</select>
</form>
<form action="" class="aa-show-form">
<label for="">Show</label>
<select name="">
<option value="1" selected="12">12</option>
<option value="2">24</option>
<option value="3">36</option>
</select>
</form>
</div>
<div class="aa-product-catg-head-right">
<a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
<a id="list-catg" href="#"><span class="fa fa-list"></span></a>
</div>
</div>
<div class="aa-product-catg-body">
<ul class="aa-product-catg">
<!-- start single product item -->
<?php 
if (isset($_GET['cname']) && $_GET['cname'] != "") {
$cname = $_GET['cname'];
$limit = 12;
$stratFrom = '';
if (isset($_GET['at'])) {
  $at = $_GET['at'];
} else {
  $at = 1;
}
$stratFrom = ($at-1)*$limit;

$sql = "SELECT * FROM product WHERE `category` = '$cname' LIMIT $stratFrom, $limit";
$res = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($res)) {

?>
<li>
<figure>
<a class="aa-product-img" href="product-detail.php?id=<?php echo $data['id']; ?>">
<img src="admin/productImage/<?php echo  $data['image']; ?>" alt="polo shirt img" width="250" height="300">
</a>
<a class="aa-add-card-btn"href="product.php?pid=<?php echo $data['id']; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
<figcaption>
<h4 class="aa-product-title"><a href="#"><?php echo $data['name']; ?></a></h4>
<span class="aa-product-price">$<?php echo $data['price'] ?></span><span class="aa-product-price"><del>$65.50</del></span>
<p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
</figcaption>
</figure>                         
<div class="aa-product-hvr-content">
<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
</div>
<!-- product badge -->
<span class="aa-badge aa-sale" href="#">SALE!</span>
</li>
<?php

} 
} else if (isset($_GET['tag']) && $_GET['tag'] != "") {
$tag = $_GET['tag'];
$limit = 12;
$stratFrom = '';
if (isset($_GET['at'])) {
$at = $_GET['at'];
} else {
$at = 1;
}
$stratFrom = ($at-1)*$limit;

$sql = "SELECT * FROM product WHERE `tags` = '$tag' LIMIT $stratFrom, $limit";
$res = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($res)) {

?>
<li>
<figure>
<a class="aa-product-img" href="product-detail.php?id=<?php echo $data['id']; ?>">
<img src="admin/productImage/<?php echo  $data['image']; ?>" alt="polo shirt img" width="250" height="300">
</a>
<a class="aa-add-card-btn"href="product.php?pid=<?php echo $data['id']; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
<figcaption>
<h4 class="aa-product-title"><a href="#"><?php echo $data['name']; ?></a></h4>
<span class="aa-product-price">$<?php echo $data['price'] ?></span><span class="aa-product-price"><del>$65.50</del></span>
<p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
</figcaption>
</figure>                         
<div class="aa-product-hvr-content">
<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
</div>
<!-- product badge -->
<span class="aa-badge aa-sale" href="#">SALE!</span>
</li>
<?php

}
} else if (isset($_GET['color']) && $_GET['color'] != "") {
$color = $_GET['color'];
$limit = 12;
$stratFrom = '';
if (isset($_GET['at'])) {
$at = $_GET['at'];
} else {
$at = 1;
}
$stratFrom = ($at-1)*$limit;

$sql = "SELECT * FROM product WHERE `color` = '$color' LIMIT $stratFrom, $limit";
$res = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($res)) {

?>
<li>
<figure>
<a class="aa-product-img" href="product-detail.php?id=<?php echo $data['id']; ?>">
<img src="admin/productImage/<?php echo  $data['image']; ?>" alt="polo shirt img" width="250" height="300">
</a>
<a class="aa-add-card-btn"href="product.php?pid=<?php echo $data['id']; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
<figcaption>
<h4 class="aa-product-title"><a href="#"><?php echo $data['name']; ?></a></h4>
<span class="aa-product-price">$<?php echo $data['price'] ?></span><span class="aa-product-price"><del>$65.50</del></span>
<p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
</figcaption>
</figure>                         
<div class="aa-product-hvr-content">
<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
</div>
<!-- product badge -->
<span class="aa-badge aa-sale" href="#">SALE!</span>
</li>
<?php

} 
} else {
$limit = 12;
$stratFrom = '';
if (isset($_GET['at'])) {
  $at = $_GET['at'];
} else {
  $at = 1;
}
$stratFrom = ($at-1)*$limit;

$sql = "SELECT * FROM product ORDER BY id DESC LIMIT $stratFrom, $limit";
$res = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_assoc($res)) {

?>
<li>
<figure>
<a class="aa-product-img" href="product-detail.php?id=<?php echo $data['id']; ?>">
<img src="admin/productImage/<?php echo  $data['image']; ?>" alt="polo shirt img" width="250" height="300">
</a>
<a class="aa-add-card-btn"href="product.php?pid=<?php echo $data['id']; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
<figcaption>
<h4 class="aa-product-title"><a href="#"><?php echo $data['name']; ?></a></h4>
<span class="aa-product-price">$<?php echo $data['price'] ?></span><span class="aa-product-price"><del>$65.50</del></span>
<p class="aa-product-descrip">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam accusamus facere iusto, autem soluta amet sapiente ratione inventore nesciunt a, maxime quasi consectetur, rerum illum.</p>
</figcaption>
</figure>                         
<div class="aa-product-hvr-content">
<a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
<a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
<a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
</div>
<!-- product badge -->
<span class="aa-badge aa-sale" href="#">SALE!</span>
</li>
<?php } 
}?>
<!-- start single product item -->
                                
</ul>
<!-- quick view modal -->                  
<div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">                      
<div class="modal-body">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<div class="row">
<!-- Modal view slider -->
<div class="col-md-6 col-sm-6 col-xs-12">                              
  <div class="aa-product-view-slider">                                
    <div class="simpleLens-gallery-container" id="demo-1">
      <div class="simpleLens-container">
          <div class="simpleLens-big-image-container">
              <a class="simpleLens-lens-image" data-lens-image="img/view-slider/large/polo-shirt-1.png">
                  <img src="img/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
              </a>
          </div>
      </div>
      <div class="simpleLens-thumbnails-container">
          <a href="#" class="simpleLens-thumbnail-wrapper"
              data-lens-image="img/view-slider/large/polo-shirt-1.png"
              data-big-image="img/view-slider/medium/polo-shirt-1.png">
              <img src="img/view-slider/thumbnail/polo-shirt-1.png">
          </a>                                    
          <a href="#" class="simpleLens-thumbnail-wrapper"
              data-lens-image="img/view-slider/large/polo-shirt-3.png"
              data-big-image="img/view-slider/medium/polo-shirt-3.png">
              <img src="img/view-slider/thumbnail/polo-shirt-3.png">
          </a>

          <a href="#" class="simpleLens-thumbnail-wrapper"
              data-lens-image="img/view-slider/large/polo-shirt-4.png"
              data-big-image="img/view-slider/medium/polo-shirt-4.png">
              <img src="img/view-slider/thumbnail/polo-shirt-4.png">
          </a>
      </div>
    </div>
  </div>
</div>
<!-- Modal view content -->
<div class="col-md-6 col-sm-6 col-xs-12">
  <div class="aa-product-view-content">
    <h3>T-Shirt</h3>
    <div class="aa-price-block">
      <span class="aa-product-view-price">$34.99</span>
      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
    </div>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
    <h4>Size</h4>
    <div class="aa-prod-view-size">
      <a href="#">S</a>
      <a href="#">M</a>
      <a href="#">L</a>
      <a href="#">XL</a>
    </div>
    <div class="aa-prod-quantity">
      <form action="">
        <select name="" id="">
          <option value="0" selected="1">1</option>
          <option value="1">2</option>
          <option value="2">3</option>
          <option value="3">4</option>
          <option value="4">5</option>
          <option value="5">6</option>
        </select>
      </form>
      <p class="aa-prod-category">
        Category: <a href="#">Polo T-Shirt</a>
      </p>
    </div>
    <div class="aa-prod-view-bottom">
      <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
      <a href="#" class="aa-add-to-cart-btn">View Details</a>
    </div>
  </div>
</div>
</div>
</div>                        
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- / quick view modal -->   
</div>
<div class="aa-product-catg-pagination">
<nav>
<ul class="pagination">
<?php 
$sql = "SELECT COUNT(ID) FROM product";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($res);
$totalRow = $row[0];
$totalPage = ceil($totalRow / $limit);

?>
<!-- <li>
<a href="#" aria-label="Previous">
<span aria-hidden="true">&laquo;</span>
</a>
</li> -->
<?php for ($i = 1; $i <= $totalPage; $i++) { ?>
<li><a href="product.php?at=<?php echo $i; ?>"><?php echo $i; ?></a></li>
<?php } ?>
<!-- <li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li> -->
<!-- <li>
<a href="#" aria-label="Next">
<span aria-hidden="true">&raquo;</span>
</a>
</li> -->
</ul>
</nav>
</div>
</div>
</div>
<div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
<aside class="aa-sidebar">
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Category</h3>
<ul class="aa-catg-nav">
<?php
$sql = "SELECT * FROM categories";
$res = mysqli_query($conn, $sql);
while($data = mysqli_fetch_assoc($res)) {
?>
<li><a href="product.php?cname=<?php echo $data['name'] ?>"><?php echo $data['name'] ?></a></li>
<?php } ?>
<!-- <li><a href="">Women</a></li>
<li><a href="">Kids</a></li>
<li><a href="">Electornics</a></li>
<li><a href="">Sports</a></li> -->
</ul>
</div>
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Tags</h3>
<div class="tag-cloud">
<?php
$sql = "SELECT * FROM tags";
$res = mysqli_query($conn, $sql);
while($data = mysqli_fetch_assoc($res)) {
?>
<a href="product.php?tag=<?php echo $data['name'] ?>"><?php echo $data['name'] ?></a>
<?php } ?>
<!-- <a href="#">Ecommerce</a>
<a href="#">Shop</a>
<a href="#">Hand Bag</a>
<a href="#">Laptop</a>
<a href="#">Head Phone</a>
<a href="#">Pen Drive</a> -->
</div>
</div>
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Shop By Price</h3>              
<!-- price range -->
<div class="aa-sidebar-price-range">
<form action="">
<div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
</div>
<span id="skip-value-lower" class="example-val">30.00</span>
<span id="skip-value-upper" class="example-val">100.00</span>
<button class="aa-filter-btn" type="submit">Filter</button>
</form>
</div>              

</div>
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Shop By Color</h3>
<div class="aa-color-tag">
<?php
$sql = "SELECT * FROM colors";
$res = mysqli_query($conn, $sql);
while($data = mysqli_fetch_assoc($res)) {
?>
<a class="aa-color-<?php echo $data['color'] ?>" href="product.php?color=<?php echo $data['color']; ?>"></a>
<?php } ?>
<!-- <a class="aa-color-green" href="#"></a>
<a class="aa-color-yellow" href="#"></a>
<a class="aa-color-pink" href="#"></a>
<a class="aa-color-purple" href="#"></a>
<a class="aa-color-blue" href="#"></a>
<a class="aa-color-orange" href="#"></a>
<a class="aa-color-gray" href="#"></a>
<a class="aa-color-black" href="#"></a>
<a class="aa-color-white" href="#"></a>
<a class="aa-color-cyan" href="#"></a>
<a class="aa-color-olive" href="#"></a>
<a class="aa-color-orchid" href="#"></a> -->
</div>                            
</div>
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Recently Views</h3>
<div class="aa-recently-views">
<ul>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>                                      
</ul>
</div>                            
</div>
<!-- single sidebar -->
<div class="aa-sidebar-widget">
<h3>Top Rated Products</h3>
<div class="aa-recently-views">
<ul>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>
<li>
<a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
<div class="aa-cartbox-info">
<h4><a href="#">Product Name</a></h4>
<p>1 x $250</p>
</div>                    
</li>                                      
</ul>
</div>                            
</div>
</aside>
</div>

</div>
</div>
</section>
<!-- / product category -->


<!-- Subscribe section -->
<section id="aa-subscribe">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="aa-subscribe-area">
<h3>Subscribe our newsletter </h3>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
<form action="" class="aa-subscribe-form">
<input type="email" name="" id="" placeholder="Enter your Email">
<input type="submit" value="Subscribe">
</form>
</div>
</div>
</div>
</div>
</section>
<!-- / Subscribe section -->

<!-- footer -->  
<footer id="aa-footer">
<!-- footer bottom -->
<div class="aa-footer-top">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="aa-footer-top-area">
<div class="row">
<div class="col-md-3 col-sm-6">
<div class="aa-footer-widget">
<h3>Main Menu</h3>
<ul class="aa-footer-nav">
<li><a href="#">Home</a></li>
<li><a href="#">Our Services</a></li>
<li><a href="#">Our Products</a></li>
<li><a href="#">About Us</a></li>
<li><a href="#">Contact Us</a></li>
</ul>
</div>
</div>
<div class="col-md-3 col-sm-6">
<div class="aa-footer-widget">
<div class="aa-footer-widget">
<h3>Knowledge Base</h3>
<ul class="aa-footer-nav">
<li><a href="#">Delivery</a></li>
<li><a href="#">Returns</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Discount</a></li>
<li><a href="#">Special Offer</a></li>
</ul>
</div>
</div>
</div>
<div class="col-md-3 col-sm-6">
<div class="aa-footer-widget">
<div class="aa-footer-widget">
<h3>Useful Links</h3>
<ul class="aa-footer-nav">
<li><a href="#">Site Map</a></li>
<li><a href="#">Search</a></li>
<li><a href="#">Advanced Search</a></li>
<li><a href="#">Suppliers</a></li>
<li><a href="#">FAQ</a></li>
</ul>
</div>
</div>
</div>
<div class="col-md-3 col-sm-6">
<div class="aa-footer-widget">
<div class="aa-footer-widget">
<h3>Contact Us</h3>
<address>
<p> 25 Astor Pl, NY 10003, USA</p>
<p><span class="fa fa-phone"></span>+1 212-982-4589</p>
<p><span class="fa fa-envelope"></span>dailyshop@gmail.com</p>
</address>
<div class="aa-footer-social">
<a href="#"><span class="fa fa-facebook"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-youtube"></span></a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- footer-bottom -->
<div class="aa-footer-bottom">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="aa-footer-bottom-area">
<p>Designed by <a href="http://www.markups.io/">MarkUps.io</a></p>
<div class="aa-footer-payment">
<span class="fa fa-cc-mastercard"></span>
<span class="fa fa-cc-visa"></span>
<span class="fa fa-paypal"></span>
<span class="fa fa-cc-discover"></span>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
require 'footer.php';
?>
