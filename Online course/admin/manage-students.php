<?php
session_start();
include("../include/config.php");
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        mysqli_query($con, "DELETE FROM students WHERE StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Student record deleted !!";
    }

    if (isset($_GET['pass'])) {
        $password = "Test@123";
        $newpass = md5($password);
        mysqli_query($con, "UPDATE students SET password='$newpass' WHERE StudentRegno = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Password Reset. New Password is Test@123";
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin | Course</title>
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
                        <h1 class="page-head-line">Course </h1>
                    </div>
                </div>

                <div class="row">
                    <font color="red" align="center">
                        <?php echo htmlentities($_SESSION['delmsg']); ?>
                        <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                    </font>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Manage Course
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Reg No </th>
                                                <th>Student Name </th>
                                                <th>Reg Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "SELECT * FROM students");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlentities($row['StudentRegno']); ?></td>
                                                    <td><?php echo htmlentities($row['studentName']); ?></td>
                                                    <td><?php echo htmlentities($row['creationdate']); ?></td>
                                                    <td>
                                                        <a href="edit-student-profile.php?id=<?php echo $row['StudentRegno'] ?>">
                                                            <button class="btn btn-primary">Edit</button>
                                                        </a>

                                                        <a href="manage-students.php?id=<?php echo $row['StudentRegno'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                            <button class="btn btn-danger">Delete</button>
                                                        </a>

                                                        <a href="manage-students.php?id=<?php echo $row['StudentRegno'] ?>&pass=update" onClick="return confirm('Are you sure you want to reset password?')">
                                                            <button type="submit" name="submit" id="submit" class="btn btn-default">Reset Password</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                                $cnt++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
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