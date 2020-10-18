<?php
include 'header.php';
include 'sidebar.php';
include 'config.php';


$msg = '';

if (isset($_POST['Category'])) {
$name = isset($_POST['name'])?$_POST['name']:"";
$id = isset($_POST['cid'])?$_POST['cid']:"";
$sql = "INSERT INTO categories(`name`,`id`)VALUES('$name', '$id')" ;
// echo $sql;
mysqli_query($conn, $sql);

}
if (isset($_POST['delete'])) {
$id = $_POST['pid'];
//$msg = delCategory($id);
}
if (isset($_POST['delete'])) {
    $id = $_POST['pid'];
    $sql = "DELETE FROM categories WHERE id = '$id' ";
    mysqli_query($conn, $sql);
    
}
?>
<div id="main-content">
<!-- Main Content Section with everything -->
<noscript> 
<!-- Show a notification if the user has disabled javascript -->
<div class="notification error png_bg">
<div>
    Javascript is disabled or is not supported by your browser.
Please <a href="http://browsehappy.com/" 
title="Upgrade to a better browser">upgrade</a>
your browser or 
<a href="http://www.google.com/support/bin/answer.py?answer=23852" 
title="Enable Javascript in your browser">enable</a> 
Javascript to navigate the interface properly.
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
<h3>Manage Categories</h3>
<ul class="content-box-tabs">
    <li><a href="#tab1" class="default-tab">Manage</a></li> 
    <!-- href must be unique and match the id of target div -->
    <li><a href="#tab2">Add</a></li>
</ul>
<div class="clear"></div>
</div> <!-- End .content-box-header -->
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1"> 
    <!-- This is the target div. id must match the href of this
    div's tab -->
    <?php if ($msg) : ?>
    <div class="notification success png_bg">
    <a href="#" class="close">
    <img src="resources/images/icons/cross_grey_small.png" 
    title="Close this notification" alt="close" /></a>
    <div>
        <?php echo $msg; ?>
    </div>
    </div>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>
                    <input class="check-all" type="checkbox" />
                </th>
                <th>Sr. No.</th>
                <!-- <th>Categories Id</th> -->
                <th>Categories Name</th>
                <th>Action</th>
                <!-- <th>Column 4</th>
                <th>Column 5</th> -->
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="6">
                    <div class="bulk-actions align-left">
                        <select name="dropdown">
                            <option value="option1">Choose an
                            action...</option>
                            <option value="option2">Edit</option>
                            <option value="option3">Delete</option>
                        </select>
                        <a class="button" href="#">Apply to selected
                        </a>
                    </div>
                    <div class="pagination">
                        <a href="#" title="First Page">&laquo; First
                        </a>
                        <a href="#" title="Previous Page">&laquo; 
                        Previous</a>
                        <a href="#" class="number" title="1">1</a>
                        <a href="#" class="number" title="2">2</a>
                        <a href="#" class="number current" title="3">
                        3</a>
                        <a href="#" class="number" title="4">4</a>
                        <a href="#" title="Next Page">Next &raquo;
                        </a>
                        <a href="#" title="Last Page">Last &raquo;
                        </a>
                    </div> 
                    <!-- End .pagination -->
                    <div class="clear"></div>
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php 
            $sql = "SELECT * FROM categories";
            $res = mysqli_query($conn, $sql);
            $a = 1;
            while($row = mysqli_fetch_assoc($res)){
                ?>
            <tr>
                <td><input type="checkbox" /></td>
                <td><?php echo $a++; ?></td>
                <!-- <td><?php //echo $row['id']; ?></td> -->
                <td><a href="#" title="title">
                <?php echo $row['name']; ?></a></td>
                <!-- <td>Consectetur adipiscing</td>
                <td>Donec tortor diam</td> -->
                <td>
                    <!-- Icons -->
<a href="catedit.php?id=<?php// echo $row['category_id'] ?>"
                    title="Edit"><img 
                    src="resources/images/icons/pencil.png" 
                    alt="Edit" /></a>
                    <form action="categories.php" method="post"
                    style="display:inline;">
                    <input type="hidden" name="pid" 
                    value="<?php// echo $row['category_id'] ?>">
                    <button type="submit" name="delete"
                    style="border:none; background: transparent;
                    cursor: pointer;">
                    <img src="resources/images/icons/cross.png" 
                    alt="Delete" />
                    </button>
                    </form>
                    <!-- <a href="" title="Delete"><img 
                    src="resources/images/icons/cross.png" 
                    alt="Delete" /></a> -->
                <a href="#" title="Edit Meta">
        <img src="resources/images/icons/hammer_screwdriver.png" 
                    alt="Edit Meta" /></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div> 
<!-- End #tab1 -->
<div class="tab-content" id="tab2">
    <form action="#" method="post">
        <fieldset> 
        <!-- Set class to "column-left" or "column-right" 
        on fieldsets to divide the form into columns -->
        <!-- <p>
            <label>Categories Id</label>
            <input class="text-input small-input" type="text" 
            id="small-input" name="cid" required />
        </p> -->
        <p>
            <label>Categories Name</label>
            <input class="text-input small-input" type="text" 
            id="small-input" name="name" required /> 
            <!-- <span class="input-notification success png_bg">
            Successful message</span>  -->
            <!-- Classes for input-notification: success, 
            error, information, attention -->
            <!-- <br /><small>A small description of the field
            </small> -->
        </p>
        
        <!--p>
            <label>This is a drop down list</label>
            <select name="dropdown" class="small-input">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
        </p>
        <p>
            <label>Textarea with WYSIWYG</label>
            <textarea class="text-input textarea wysiwyg" 
            id="textarea" name="textfield" cols="79" rows="15">
            </textarea>
        </p> -->
        <p>
            <input class="button" type="submit" value="Submit" 
            name="Category" />
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
<!-- End .content-box -->
<!-- Start Notifications -->
<!-- <div class="notification attention png_bg">
<a href="#" class="close">
<img src="resources/images/icons/cross_grey_small.png" 
title="Close this notification" alt="close" /></a>
<div>
Attention notification. Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. Proin vulputate, sapien 
quis fermentum luctus, libero.
</div>
</div>
<div class="notification information png_bg">
<a href="#" class="close">
<img src="resources/images/icons/cross_grey_small.png" 
title="Close this notification" alt="close" /></a>
<div>
Information notification. Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. Proin vulputate, sapien 
quis fermentum luctus, libero.
</div>
</div>
<div class="notification success png_bg">
<a href="#" class="close">
<img src="resources/images/icons/cross_grey_small.png" 
title="Close this notification" alt="close" /></a>
<div>
Success notification. Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. Proin vulputate, sapien 
quis fermentum luctus, libero.
</div>
</div>
<div class="notification error png_bg">
<a href="#" class="close">
<img src="resources/images/icons/cross_grey_small.png" 
title="Close this notification" alt="close" /></a>
<div>
Error notification. Lorem ipsum dolor sit amet, 
consectetur adipiscing elit. Proin vulputate, sapien 
quis fermentum luctus, libero.
</div>
</div> -->
<!-- End Notifications -->
<?php
require 'footer.php';
?>