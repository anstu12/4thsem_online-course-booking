<?php
session_start();

include("../include/config.php");

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $id = intval($_GET['id']);
    if (isset($_POST['submit'])) {
        $coursecode = $_POST['coursecode'];
        $coursename = $_POST['coursename'];
        $courseunit = $_POST['courseunit'];
        $seatlimit = $_POST['seatlimit'];
        $ret = mysqli_query($con, "UPDATE course SET courseCode='$coursecode',courseName='$coursename',courseUnit='$courseunit',noofSeats='$seatlimit' WHERE id='$id'");
        if ($ret) {
            $_SESSION['msg'] = "Course Updated Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Course not Updated";
        }
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
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Course
                            </div>

                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </font>

                            <div class="panel-body">
                                <form name="dept" method="post">
                                    <?php
                                    $sql = mysqli_query($con, "SELECT * FROM course WHERE id='$id'");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                        <div class="form-group">
                                            <label for="coursecode">Course Code </label>
                                            <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" value="<?php echo htmlentities($row['courseCode']); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="coursename">Course Name </label>
                                            <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" value="<?php echo htmlentities($row['courseName']); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="courseunit">Course unit </label>
                                            <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" value="<?php echo htmlentities($row['courseUnit']); ?>" required />
                                        </div>

                                        <div class="form-group">
                                            <label for="seatlimit">Seat limit </label>
                                            <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" value="<?php echo htmlentities($row['noofSeats']); ?>" required />
                                        </div>
                                    <?php } ?>
                                    <button type="submit" name="submit" class="btn btn-default">Update</button>
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