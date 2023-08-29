<?php
session_start();
include('include/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Enroll History</title>
        <link rel="stylesheet" href="assets/style.css" type="text/css">
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
                        <h1 class="page-head-line">Enroll History </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Enroll History
                            </div>

                            <div class="panel-body">
                                <div class="table-responsive table-bordered">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name </th>
                                                <th>Session </th>
                                                <th> Department</th>
                                                <th>Level</th>
                                                <th>Semester</th>
                                                <th>Enrollment Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sql = mysqli_query($con, "SELECT courseenrolls.course AS cid, course.courseName AS courname,session.session AS session,department.department AS dept,level.level AS level,courseenrolls.enrollDate AS edate ,semester.semester AS sem FROM courseenrolls JOIN course ON course.id=courseenrolls.course JOIN session ON session.id=courseenrolls.session JOIN department ON department.id=courseenrolls.department JOIN level ON level.id=courseenrolls.level  JOIN semester ON semester.id=courseenrolls.semester  WHERE courseenrolls.studentRegno='" . $_SESSION['login'] . "'");
                                            $cnt = 1;
                                            while ($row = mysqli_fetch_array($sql)) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo htmlentities($row['courname']); ?></td>
                                                    <td><?php echo htmlentities($row['session']); ?></td>
                                                    <td><?php echo htmlentities($row['dept']); ?></td>
                                                    <td><?php echo htmlentities($row['level']); ?></td>
                                                    <td><?php echo htmlentities($row['sem']); ?></td>
                                                    <td><?php echo htmlentities($row['edate']); ?></td>
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
            <?php include('include/footer.php'); ?>
        </footer>
    </body>

    </html>
<?php } ?>