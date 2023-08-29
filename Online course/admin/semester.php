<?php
session_start();

include('../include/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $semester = $_POST['semester'];
        $ret = mysqli_query($con, "INSERT INTO semester(semester) VALUES('$semester')");
        if ($ret) {
            $_SESSION['msg'] = "Semester Created Successfully !!";
        } else {
            $_SESSION['msg'] = "Error : Semester not created";
        }
    }

    if (isset($_GET['del'])) {
        mysqli_query($con, "DELETE FROM semester WHERE id = '" . $_GET['id'] . "'");
        $_SESSION['delmsg'] = "semester deleted !!";
    }
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Admin | Semester</title>

        <link href="../assets/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <header>
            <?php include('../admin/include/header.php') ?>
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
                        <h1 class="page-head-line">Semester </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Semester
                            </div>

                            <font color="green" align="center">
                                <?php echo htmlentities($_SESSION['msg']); ?>
                                <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                            </font>

                            <div class="panel-body">
                                <form name="semester" method="post">
                                    <div class="form-group">
                                        <label for="semester">Add Semester </label>

                                        <input type="text" class="form-control" id="semester" name="semester" placeholder="semester" required>
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

                <div class="col--md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Manage Semester
                        </div>

                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Semester</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($con, "SELECT * FROM semester");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($sql)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo htmlentities($row['semester']); ?></td>
                                                <td><?php echo htmlentities($row['creationDate']); ?></td>
                                                <td>
                                                    <a href="semester.php?id=<?php echo $row['id'] ?>&del=delete" onClick="return confirm('Are you sure you want to delete?')">
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