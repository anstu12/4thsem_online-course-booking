<?php
session_start();
include('include/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $sql = mysqli_query($con, "SELECT password FROM  students WHERE password='" . $_POST['cpass'] . "' && studentRegno='" . $_SESSION['login'] . "'");
        $num = mysqli_fetch_array($sql);
        if ($num > 0) {
            $con = mysqli_query($con, "UPDATE students SET password='" . $_POST['newpass'] . "' WHERE studentRegno='" . $_SESSION['login'] . "'");
            $_SESSION['msg'] = "Password Changed Successfully !!";
        } else {
            $_SESSION['msg'] = "Current Password not match !!";
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin | Student Password</title>
        <link href="assets/style.css" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            function valid() {
                if (document.chngpwd.cpass.value == "") {
                    alert("Current Password Filed is Empty !!");
                    document.chngpwd.cpass.focus();
                    return false;
                } else if (document.chngpwd.newpass.value == "") {
                    alert("New Password Filed is Empty !!");
                    document.chngpwd.newpass.focus();
                    return false;
                } else if (document.chngpwd.cnfpass.value == "") {
                    alert("Confirm Password Filed is Empty !!");
                    document.chngpwd.cnfpass.focus();
                    return false;
                } else if (document.chngpwd.newpass.value != document.chngpwd.cnfpass.value) {
                    alert("Password and Confirm Password Field do not match  !!");
                    document.chngpwd.cnfpass.focus();
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body>
        <?php include('include/header.php') ?>

        <?php if ($_SESSION['login'] != "") {
            include('include/menubar.php');
        }
        ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student Change Password </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Change Password
                            </div>

                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </font>

                            <div class="panel-body">
                                <form name="chngpwd" method="post" onSubmit="return valid();">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Current Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="cpass" placeholder="Password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword2" name="newpass" placeholder="Password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword3" name="cnfpass" placeholder="Password" />
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-default">Submit</button>

                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php include('include/footer.php'); ?>
        </footer>
    </body>

    </html>
<?php } ?>