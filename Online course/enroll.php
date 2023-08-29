<?php
session_start();
include('include/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $studentregno = $_POST['studentregno'];
        $session = $_POST['session'];
        $dept = $_POST['department'];
        $level = $_POST['level'];
        $course = $_POST['course'];
        $sem = $_POST['sem'];
        $ret = mysqli_query($con, "INSERT INTO courseenrolls(studentRegno,session,department,level,course,semester) VALUES('$studentregno','$session','$dept','$level','$course','$sem')");
        if ($ret) {
            $_SESSION['msg'] = "Enroll Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Not Enroll";
        }
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Course Enroll</title>
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
                        <h1 class="page-head-line">Course Enroll </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Course Enroll
                            </div>

                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </font>

                            <?php $sql = mysqli_query($con, "SELECT * FROM students WHERE StudentRegno='" . $_SESSION['login'] . "'");
                            $cnt = 1;
                            while ($row = mysqli_fetch_array($sql)) { ?>
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
                                            <label for="Session">Session </label>
                                            <select class="form-control" name="session" required="required">
                                                <option value="">Select Session</option>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM session");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                        <?php echo htmlentities($row['session']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Department">Department </label>
                                            <select class="form-control" name="department" required="required">
                                                <option value="">Select Depertment</option>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM department");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                        <?php echo htmlentities($row['department']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Level">Level </label>
                                            <select class="form-control" name="level" required="required">
                                                <option value="">Select Level</option>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM level");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                        <?php echo htmlentities($row['level']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Semester">Semester </label>
                                            <select class="form-control" name="sem" required="required">
                                                <option value="">Select Semester</option>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM semester");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                        <?php echo htmlentities($row['semester']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="Course">Course </label>
                                            <select class="form-control" name="course" id="course" required="required">
                                                <option value="">Select Course</option>
                                                <?php
                                                $sql = mysqli_query($con, "SELECT * FROM course");
                                                while ($row = mysqli_fetch_array($sql)) {
                                                ?>
                                                    <option value="<?php echo htmlentities($row['id']); ?>">
                                                        <?php echo htmlentities($row['courseName']); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                            <span id="course-availability-status1" style="font-size:12px;">
                                        </div>

                                        <button type="submit" name="submit" id="submit" class="btn btn-default">Enroll</button>
                                    </form>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <?php include("include/footer.php"); ?>
        </footer>
    </body>

    </html>
<?php } ?>