<?php
include 'header.php';
include 'sidebar.php';
include 'config.php';


$msg = '';

if (isset($_POST['user'])) {
    $pid = isset($_POST['pid'])?$_POST['pid']:"";
    $username = isset($_POST['uname'])?$_POST['uname']:"";
    $password = isset($_POST['pass'])?$_POST['pass']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    $dob = isset($_POST['dob'])?$_POST['dob']:"";
    $address = isset($_POST['add'])?$_POST['add']:"";

    // echo $pid, $color, $pass;
    $sql ="INSERT INTO users( `id`, `username`, `password`, `email`, `dob`, `address`)VALUES('$pid', '$username', '$password', '$email', '$dob','$address'  )";
    // echo "<script>alert($sql)</script>";
     //echo $sql;
    mysqli_query($conn, $sql);
    // echo $sql;
    // exit();
    
    // $addCate = array("name"=>$name, "cid"=>$cid);
    
    // $msg = addCategory($addCate);
    // exit();
}
if (isset($_POST['delete'])) {
    $id = $_POST['pid'];
    
}

if (isset($_POST['delete'])) {
    $id = $_POST['pid'];
    $sql = "DELETE FROM users WHERE id = '$id' ";
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
                <h3>Manage Users</h3>
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
                                <!-- <th>Product Id</th> -->
                                <th>UserName</th>
                                 <!-- <th>Password</th>  -->
                                <th>DOB</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
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
                            $sql = "SELECT * FROM users";
                            $res = mysqli_query($conn, $sql);
                            $a = 1;
                            while($row = mysqli_fetch_assoc($res)){
                                ?>
                            <tr>
                                <td><input type="checkbox" /></td>
                                <td><?php echo $a++; ?></td>
                                <!-- <td><?php //echo $row['id']; ?></td> -->
                                <td><a href="#" title="title">
                                <?php echo $row['username']; ?></a></td>
                                 <!-- <td><?php //echo $row['password']; ?></a></td> -->
                                <td><?php echo $row['dob']; ?></a></td>
                                <td><?php echo $row['email']; ?></a></td>
                                <td><?php echo $row['address']; ?></a></td>
                                <!-- <td>Consectetur adipiscing</td>
                                <td>Donec tortor diam</td> -->
                                <td>
                                    <!-- Icons -->
                <a href="catedit.php?id=<?php//  ?>"
                                    title="Edit"><img 
                                    src="resources/images/icons/pencil.png" 
                                    alt="Edit" /></a>
                                    <form action="catedit.php" method="post"
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
                                <!-- <a href="#" title="Edit Meta">
                        <img src="resources/images/icons/hammer_screwdriver.png" 
                                    alt="Edit Meta" /></a> -->
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div> 
                <!-- End #tab1 -->
                <div class="tab-content" id="tab2">
                    <form action="users.php" method="post">
                        <fieldset> 
                     
                        <!-- <p>
                            <label>Product Id</label>
                            <input class="text-input small-input" type="text" 
                            id="small-input" name="pid" required />
                        </p> -->
                        <p>
                            <label>Username</label>
                            <input class="text-input small-input" type="text" 
                            id="small-input" name="uname" required />
                        </p>
                        <p>
                            <label>Password</label>
                            <input class="text-input small-input" type="text" 
                            id="small-input" name="pass" required />
                        </p>
                        <p>
                            <label>Email</label>
                            <input class="text-input small-input" type="text" 
                            id="small-input" name="email" required />
                        </p>
                        <p>
                            <label>dob</label>
                            <input class="text-input small-input" type="date" 
                            id="small-input" name="dob" required />
                        </p>
                        <p>
                            <label>address</label>
                            <input class="text-input small-input" type="text" 
                            id="small-input" name="add" required />
                        </p>
                        
                           
                        
                        <p>
                            <input class="button" type="submit" value="Submit" 
                            name="user" />
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