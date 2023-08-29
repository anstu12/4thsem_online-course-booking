<?php
session_start();

include('../include/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $coursecode = $_POST['coursecode'];
        $coursename = $_POST['coursename'];
        $courseunit = $_POST['courseunit'];
        $seatlimit = $_POST['seatlimit'];
        $ret = mysqli_query($con, "INSERT INTO course(courseCode,courseName,courseUnit,noofSeats) VALUES('$coursecode','$coursename','$courseunit','$seatlimit')");
        if ($ret) {
            $_SESSION['msg'] = "Course Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Course not created";
        }
    }

    if (isset($_GET['del'])) {
        mysqli_query($con, "DELETE FROM course WHERE id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "Course deleted !!";
    }
?>

    <!DOCTYPE html>

    <head>
        <title>Admin | Course</title>

        <link rel="stylesheet" href="../assets/style.css" type="text/css">
    </head>

    <body>
        <header>
            <?php include('../admin/include/header.php'); ?>
        </header>

        <?php
        if ($_SESSION['alogin'] != "") {
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
                                    <div class="form-group">
                                        <label for="coursecode">Course Code </label>
                                        <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="coursename">Course Name </label>
                                        <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="courseunit">Course unit </label>
                                        <input type="text" class="form-control" id="courseunit" name="courseunit" placeholder="Course Unit" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="seatlimit">Seat limit </label>
                                        <input type="text" class="form-control" id="seatlimit" name="seatlimit" placeholder="Seat limit" required>
                                    </div>

                                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

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
                                            <th>Course Code</th>
                                            <th>Course Name </th>
                                            <th>Course Unit</th>
                                            <th>Seat limit</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM course");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo htmlentities($row['courseCode']); ?></td>
                                                <td><?php echo htmlentities($row['courseName']); ?></td>
                                                <td><?php echo htmlentities($row['courseUnit']); ?></td>
                                                <td><?php echo htmlentities($row['noofSeats']); ?></td>
                                                <td><?php echo htmlentities($row['creationDate']); ?></td>
                                                <td>
                                                    <a href="edit-course.php?id=<?php echo $row['id'] ?>">
                                                        <button class="btn btn-primary"> Edit</button>
                                                    </a>

                                                    <a href="course.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
                                                        <button class="btn btn-danger">Delete</button>
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

        <footer>
            <?php include('../include/footer.php'); ?>
        </footer>
    </body>

    </html>
<?php } ?>