<?php include 'db/db.php' ?>

<?php include 'includes/refs.php' ?>
<?php
// Start the session
session_start();
?>
<?php include 'includes/header.php' ?>

<?php
if (isset($_SESSION['mID'])) {
    $id = $_SESSION['mID'];
    $role = $_SESSION['role'];
} else {
    echo "Wrong ID";
}
if (isset($_POST['update_std'])) {
    $key = 0;
    $std_id = $_POST['mID'];
    $std_fName = $_POST['fName'];
    $std_lName = $_POST['lName'];
    $std_fullName = $_POST['fullName'];
    $std_address = $_POST['address'];
    $pass1 = $_POST['password1'];
    $pass = $_POST['password'];
    $std_dob = $_POST['dob'];
    $std_nic = $_POST['nic'];
    $std_email = $_POST['email'];
    $std_phone = $_POST['phone'];
    $std_gender = $_POST['gender'];
    $std_joined = $_POST['joined'];
    $std_emgPhone = $_POST['emgphone'];
    $std_course = $_POST['course'];
    $std_cName = $_POST['cName'];
    $resume = $_POST['resume'];
    $sub1 = $_POST['sub0'];
    $sub2 = $_POST['sub1'];
    $sub3 = $_POST['sub2'];
    $sub4 = $_POST['sub3'];
    $earlyImg = $_POST['EarlyImg'];
    $sub = array($sub1, $sub2, $sub3, $sub4);
    $std_subjects = implode("|", $sub);
    $std_image = $_POST['EarlyImg'];

    //------Img Upload-------//
    if ($pass == $pass1) {
        if (strlen($pass) >= 6) {
            $key = 1;
        } else {
            $key = 0;
            echo "<h3 class='alert alert-danger'>Password must be larger than 6 characters!</h3>";
        }
    } else {
        $key = 0;
        echo "<h3 class='alert alert-danger'>Passwords do not match!</h3>";
    }
    if ($key == 1) {

        $uploadOk = 1;
        $upError = "";
        if (!empty($_FILES["image"]["tmp_name"])) {
            $target_dir = "../admin/images/";
            $fileName = $std_email . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $fileName;

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $upError = "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $upError = "Sorry, Profile Image already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["image"]["size"] > 2000000) {
                $upError = "Sorry,Profile Image is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                $upError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $upError = "Sorry, your Profile Image was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $std_image = $fileName;
                    if ($earlyImg != "user.jpg") {
                        $dir = "../admin/images/$earlyImg";
                        unlink($dir);
                    };
                } else {
                    $upError = "Sorry, there was an error uploading your Profile Image.";
                }
            }
        }


        //-------QUERY TO UPDATE DATA STORE IN POST TABLE---------
        $update_query = "UPDATE member SET fName='{$std_fName}',";
        $update_query .= "role='{$role}',lName='{$std_lName}',";
        $update_query .= "fullName='{$std_fullName}',address='{$std_address}',";
        $update_query .= "dob='{$std_dob}', nic='{$std_nic}',phone='{$std_phone}', gender='{$std_gender}',";
        $update_query .= "joined='{$std_joined}', emgphone='{$std_emgPhone}',resume='{$resume}', password='{$pass}',course='{$std_course}', coursename='{$std_cName}',";
        $update_query .= "subjects='{$std_subjects}',image='{$std_image}',";
        $update_query .= "email='{$std_email}' WHERE mID='{$std_id}'";
        $run_update_query = mysqli_query($con, $update_query);
        $err = mysqli_error($con);
        if ($run_update_query) {
            echo "<h3 class='alert alert-success'>Updated Successfully</h3>";
        } else {
            echo "<h3 class='alert alert-danger'>Error,$err<small><a href='../students.php'>View All</a></small></h3>";
        }
    } else {
    }
}

//<<<<<<<<<<<<<<<<<<<<----START QUERY---<<<<<<<<<<<<<<<<<<<<<<<
//---------QUERY TO CALL ALL THE DATAS IN POSTS TABLE----
$edit_query = "SELECT * FROM user WHERE username='{$_SESSION['username']}'";
$post_run_query = mysqli_query($con, $edit_query);

while ($row = mysqli_fetch_assoc($post_run_query)) {
    $std_id = $row['uID'];
    $std_fName = $row['role'];
    $std_lName = $row['username'];
    $std_fullName = $row['email'];
    $std_address = $row['username'];
    $pass = $row['address'];
    $std_dob = $row['district'];
    $std_nic = $row['phone'];
    $std_email = $row['zipCode'];
    $std_phone = $row['phone'];
    $std_gender = $row['username'];
    $resume = $row['username'];
    $std_joined = $row['username'];
    $std_emgPhone = $row['username'];
    $std_course = $row['username'];
    $std_cName = $row['username'];

    // $std_age = date_diff(date_create($std_dob), date_create('now'))->y;


}



?>
<br>
<style>
    .avatar-upload .avatar-edit {
        position: absolute;
        right: 12px;
        z-index: 1;
        top: 10px;
    }

    .avatar-upload .avatar-edit input {
        display: none;
    }

    .avatar-upload .avatar-edit input+label {
        display: inline-block;
        width: 34px;
        height: 34px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
    }

    .avatar-upload .avatar-edit input+label:hover {
        background: #f1f1f1;
        border-color: #d6d6d6;
    }

    .avatar-upload .avatar-edit input+label:after {
        content: "\f303";
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        color: #757575;
        position: absolute;
        top: 5px;
        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview>div {
        width: 350px;
        height: 350px;
        margin-bottom: 15px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    @media only screen and (max-width: 600px) {
        .admin_form_img {
            width: 50%;
            height: 22%;
            margin-bottom: 10%;
            margin-left: 25%;
        }

        .admin_form_div_halfTop {
            width: 100%;
        }

        .admin_form_div_top {
            width: 100%;
        }

        .admin_form_div_bottom {
            width: 100%;
        }

        .avatar-upload .avatar-preview>div {
            width: 250px;
            height: 250px;
            margin-bottom: 15px;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    /* @media only screen and (min-width: 600px) {
   
     .admin_form_img{
    width:25%;
    margin-bottom: 20%;
    margin-bottom: 10%;
   
    }
    .admin_form_div_halfTop{
    width:35%;
    }
    .admin_form_div_top{
   width:74%;
    }
    .admin_form_div_bottom{
    width:100%;
    }
    .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 200px;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
}  */


    /* @media only screen and (min-width: 768px) {
    .admin_form_img{
    width:25%;
    margin-bottom: 6%;
    margin-bottom: 13%;

    }
    .admin_form_div_halfTop{
        width:35%;
     }
    .admin_form_div_top{
       width:74%;
    }
    .admin_form_div_bottom{
        width:100%;
    }
     .avatar-upload .avatar-preview > div {
        width: 100%;
        height: 200px;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
}  */

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    /* @media only screen and (min-width: 1200px) {
    .admin_form_img{
    width:30%;
    margin-bottom: 6%;
    margin-top: 5%;
    }
    .admin_form_div_halfTop{
        width:38%;
     
     }
    .admin_form_div_top{
       width:79%;
     
    }
    .admin_form_div_bottom{
        width:100%;
     
    }
    .avatar-upload .avatar-preview > div {
        width: 250px;
        height: 250px;
        border-radius: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    } 
} */
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-12">
            <!-- Blog Details Text -->
            <div class="blog-details-text">
                <div class="container-fluid">
                    <!-- Row -->
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-5 col-xlg-4 col-md-12">
                            <form action="" class="form-horizontal form-material" method="POST" enctype="multipart/form-data" id="profile">
                                <div class="card-block ">
                                    <center class="p-4 ">
                                        <div class="avatar-upload ">
                                            <div class="avatar-edit">
                                                <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                <input name="EarlyImg" type='hidden' value="<?php echo $std_image ?>" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url(<?= $configs['host'] ?>/components/admin/images/<?php echo $std_image; ?>);"></div>
                                            </div>
                                        </div>
                                        <h4 class="card-title m-t-10"><?php echo $std_fName; ?> <?php echo $std_lName; ?></h4>
                                        <h6 class="card-subtitle"><?php echo $role ?></h6>
                                        <div class="row text-center justify-content-md-center">
                                        </div>
                                    </center>
                                </div>

                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-7 col-xlg-8 col-md-12">

                            <div class="card-block">

                                <div class="form-group">
                                    <label class="col-md-12">First Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="fName" value="<?php echo $std_fName; ?>" class="form-control form-control-line" required>
                                        <input type="hidden" name="mID" value="<?php echo $std_id; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Last Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="lName" value="<?php echo $std_lName; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Full Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="fullName" value="<?php echo $std_fullName; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" pattern="^([^.@]+)(\.[^.@]+)*@([^.@]+\.)+([^.@]+)$" value="<?php echo $std_email; ?>" class="form-control form-control-line" id="example-email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Password</label>
                                    <div class="col-md-12">
                                        <input type="password" value="<?php echo $pass; ?>" name="password" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Verify Password</label>
                                    <div class="col-md-12">
                                        <input type="password" value="<?php echo $pass; ?>" name="password1" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12">Gender</label>
                                    <div class="col-sm-12">
                                        <select name="gender" class="form-control form-control-line">
                                            <option value="<?php echo $std_gender; ?>"><?php echo $std_gender; ?></option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" name="phone" pattern="^\d{3}\d{3}\d{4}$" value="<?php echo $std_phone; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Emergency Phone No</label>
                                    <div class="col-md-12">
                                        <input type="text" name="emgphone" pattern="^\d{3}\d{3}\d{4}$" value="<?php echo $std_emgPhone; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Date of birth</label>
                                    <div class="col-md-12">
                                        <input type="date" name="dob" value="<?php echo $std_dob; ?>" class="form-control form-control-line">
                                    </div>
                                </div>
                                <?php if ($role == "Teacher") { ?>
                                    <div class="form-group">
                                        <label class="col-md-12">About You</label>
                                        <div class="col-md-12">
                                            <textarea form="profile" id="mytextarea" name="resume" class="form-control form-control-line"><?php echo $resume; ?></textarea>
                                        </div>
                                    </div>


                                <?php  } ?>
                                <div class="form-group">
                                    <label class="col-md-12">NIC</label>
                                    <div class="col-md-12">
                                        <input type="text" name="nic" pattern="^[0-9]{9}[vVxX]$" value="<?php echo $std_nic; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Address</label>
                                    <div class="col-md-12">
                                        <input type="text" name="address" value="<?php echo $std_address; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12">Course</label>
                                    <div class="col-md-12">
                                        <select name="course" class="form-control form-control-line" value="<?php echo $std_course; ?>">
                                            <option value="Management">Management</option>
                                            <option value="ICT">ICT</option>
                                            <option value="Language">Language</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Course Name</label>
                                    <div class="col-md-12">
                                        <input type="text" name="cName" value="<?php echo $std_cName; ?>" class="form-control form-control-line" required>
                                    </div>
                                </div>

                                <br>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" name="update_std" class="btn btn-outline-info" value="Update Profile">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php' ?>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>