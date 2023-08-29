<?php
session_start();
include('include/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $studentname = $_POST['studentname'];
        $cgpa = $_POST['cgpa'];
        $ret = mysqli_query($con, "UPDATE students SET studentName='$studentname',cgpa='$cgpa'  WHERE StudentRegno='" . $_SESSION['login'] . "'");
        if ($ret) {
            $_SESSION['msg'] = "Student Record updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Student Record not update";
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Student Profile</title>
        <link href="assets/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <?php include('include/header.php'); ?>

        <?php if ($_SESSION['login'] != "") {
            include('include/menubar.php');
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

                            <?php $sql = mysqli_query($con, "SELECT * FROm students WHERE StudentRegno='" . $_SESSION['login'] . "'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                            ?>
                                <div class="panel-body">
                                    <form name="dept" method="post">
                                        <div class="form-group">
                                            <label for="studentname">Student Name </label>
                                            <input type="text" class="form-control" id="studentname" name="studentname" value="<?php echo htmlentities($row['studentName']); ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label for="studentregno">Student Reg No </label>
                                            <input type="text" class="form-control" id="studentregno" name="studentregno" value="<?php echo htmlentities($row['StudentRegno']); ?>" placeholder="Student Reg no" readonly />

                                        </div>

                                        <div class="form-group">
                                            <label for="CGPA">CGPA </label>
                                            <input type="text" class="form-control" id="cgpa" name="cgpa" value="<?php echo htmlentities($row['cgpa']); ?>" required />
                                        </div>

                                        <button type="submit" name="submit" id="submit" class="btn btn-default">Update</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php include('includes/footer.php'); ?>
        </footer>

    </body>

    </html>
<?php } ?>