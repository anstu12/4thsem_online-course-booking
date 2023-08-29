<?php
session_start();
include("include/config.php");
error_reporting(0);
if (isset($_POST['submit'])) {
    $regno = $_POST['regno'];
    $password = $_POST['password'];
    $query = mysqli_query($con, "SELECT * FROM students WHERE StudentRegno='$regno' and password='$password'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        $extra = "change-password.php";
        $_SESSION['login'] = $_POST['regno'];
        $_SESSION['id'] = $num['studentRegno'];
        $_SESSION['sname'] = $num['studentName'];
        $status = 1;
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid Reg no or Password";
        $extra = "index.php";
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Login</title>
    <link href="assets/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <?php include('include/header.php') ?>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
            </div>

            <span style="color:red;">
                <?php echo htmlentities($_SESSION['errmsg']); ?>
                <?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
            </span>

            <form name="admin" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label>Enter Reg no : </label>
                        <input type="text" name="regno" class="form-control">
                        <label>Enter Password : </label>
                        <input type="password" name="password" class="form-control" />
                        <hr />
                        <button type="submit" name="submit" class="btn btn-info">&nbsp;Log Me In&nbsp;</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <?php include('include/footer.php'); ?>
    </footer>
</body>

</html>