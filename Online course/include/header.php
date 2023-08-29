<?php
include("include/config.php");
error_reporting(0);
if ($_SESSION['login'] != "") {
?>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <strong>Welcome: </strong><?php echo htmlentities($_SESSION['sname']); ?>
                    &nbsp;&nbsp;
                </div>
            </div>
        </div>
    </header>
<?php } ?>

<div class="navbar navbar-inverse set-radius-zero">
    <div class="container">
        <div class="navbar-brand">
            Online Course Registration
        </div>
        <div class="left-div">
        </div>
    </div>
</div>