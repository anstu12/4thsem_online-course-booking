<?php
session_start();
error_reporting(0);

include("../include/config.php");

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = mysqli_query($con, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $num = mysqli_fetch_array($query);
    if ($num > 0) {
        $extra = "session.php";
        $_SESSION['alogin'] = $_POST['username'];
        $_SESSION['id'] = $num['id'];
        $host = $_SERVER['HTTP_HOST'];
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        header("location:http://$host$uri/$extra");
        exit();
    } else {
        $_SESSION['errmsg'] = "Invalid username or password";
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
    <title>Admin Login</title>
    <link href="../assets/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <header>
        <?php include('../admin/include/header.php') ?>
    </header>

    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="page-head-line">Please Login To Enter </h4>
                </div>
            </div>

            <div class="row">
                <span style="color:red;">
                    <?php echo htmlentities($_SESSION['errmsg']); ?>
                    <?php echo htmlentities($_SESSION['errmsg'] = ""); ?>
                </span>

                <form name="admin" method="POST">
                    <div class="col-md-6">
                        <label>Enter Username : </label>
                        <input type="text" name="username" class="form-control" required>
                        <br>
                        <label>Enter Password : </label>
                        <input type="password" name="password" class="form-control" required>
                        <br>
                        <button type="submit" name="submit" class="btn btn-info">
                            &nbsp;Log Me In&nbsp;
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <?php include('include/footer.php'); ?>
    </footer>

</body>

</html>