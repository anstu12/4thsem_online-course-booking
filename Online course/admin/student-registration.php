<?php
session_start();

include("../include/config.php");

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $studentregno = $_POST['studentregno'];
        $password = $_POST['password'];
        $ret = mysqli_query($con, "INSERT INTO students(studentName,StudentRegno,password) VALUES('$studentname','$studentregno','$password')");
        if ($ret) {
            $_SESSION['msg'] = "Student Registered Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student  not Register";
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin | Student Registration</title>

        <link href="../assets/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php include('../admin/include/header.php') ?>
        </header>

        <?php if ($_SESSION['alogin'] != "") {
            include('../admin/include/menubar.php');
        }
        ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Student Registration </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Student Registration
                            </div>

                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </font>

                            <div class="panel-body">
                                <form name="dept" method="post">
                                    <div class="form-group">
                                        <label for="studentname">Student Name </label>

                                        <input type="text" class="form-control" id="studentname" name="studentname" placeholder="Student Name" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="studentregno">Student Reg No </label>
                                        <input type="text" class="form-control" id="studentregno" name="studentregno" placeholder="Student Reg no" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password </label>

                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
                                    </div>

                                    <button type="submit" name="submit" id="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php include('../include/footer.php'); ?>
        </footer>
    </body>

    </html>
<?php } ?>