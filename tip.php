<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <title>Tip Calculator</title>
</head>
<body>
<?php
$Bill = 0;
if (isset($_POST['bill'])) {
    $Bill = $_POST['bill'];
}

$Tip = 0;

if (isset($_POST['custom'])) {
    $Tip = $_POST['custom'] / 100;
} elseif (isset($_POST['tip'])) {
    $Tip = $_POST['tip'];
}

$split = 1;
if(isset($_POST['split']))
{
    $split = $_POST['split'];
}


$number_error = !is_numeric($Bill) || $Bill < "1 ";
$split_error = !is_numeric($split) || $split < "1";

$tip_error = $Tip == NULL;
$clean = $Bill == NULL && $Tip == NULL && $split == NULL;
$show_error = 0;

if (isset($_POST['calculate'])) {
    $show_error = $_POST['calculate'];
}


if ($clean) {
    echo '<section>';
} elseif ($tip_error || $number_error) {
   // $_POST = array();
    echo '<section class=error>';
} else {
    echo '<section class=success>';
}

?>
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Tip Calculator</h2></div>
                <div class="panel-body">
                    <form tip="tip.php" method="post">
                        <div class="form-group">
                            <label for="bill">
                                Bill Subtotal $:
                            </label>

                            <input type="text" class="form-control input-sm" id="bill" name="bill"
                                   value="<?php if (isset($_POST['bill'])) {
                                       echo $_POST['bill'];
                                   } ?>">
                            <br>
                            <label for="tip">Tip Percentage:</label>


                            <?php
                            for ($i = 10; $i <= 20; $i = $i + 5) {
                                echo "<div class='radio'><label><input onclick='customDisable()' type=radio  name=tip value=.$i";
                                if (isset($_POST['tip'])) {
                                    echo $_POST['tip'] == $i / 100 ? ' checked' : $_POST['tip'];
                                }
                                echo ">$i% </input></label></div>";
                            }

                            ?>
                            <div class="radio"><label><input onclick="myFunction()" type="radio" name="tip"
                                                             value='custom' <?php if (isset($_POST['tip'])) {
                                        echo $_POST['tip'] == 'custom' ? ' checked' : $_POST['tip'];
                                    } ?> >custom
                                    </input></label></div>
                            <label for="custom">Custom Tip Percentage</label>
                            <input type="text" disabled class="form-control input-sm" id="custom" name="custom"
                                   value="<?php if (isset($_POST['custom'])) {
                                       echo $_POST['custom'];
                                   } ?>">
                            <br>
                            <label for="split">Split Bill between</label>
                            <input type="text" class="form-control" id="split" name="split"
                                   value="<?php if (isset($_POST['split'])) {
                                       echo $_POST['split'];
                                   }else{echo 1;} ?>">
                            <br>
                            <input type="hidden" name="calculate" value="1">
                            <input id="button" class="btn btn-default" type="submit">
                    </form>
                </div>

                <?php
                if ($show_error) {
                    if ($number_error) {
                        echo '<p><div class="alert alert-danger"><strong>Danger! </strong>Must enter a number Greater than 0</div></p>';
                    }
                    if ($tip_error) {
                        echo '<p><div class="alert alert-danger"><strong>Danger! </strong>Must select a tip percentage</div></p>';
                    }
                    if($split_error)
                    {
                        echo '<p><div class="alert alert-danger"><strong>Danger! </strong>Split field can not be negative.</div></p>';
                    }
                    elseif (!($number_error || $tip_error || $split_error)) {
                        echo '<div class="alert alert-info">';
                        echo "Total Tip is $";
                        echo $Bill * $Tip . "<br>";
                        if($split>1)
                        {
                            echo "Split Tip is $";
                            echo ($Bill * $Tip)/$split . "<br>";
                        }

                        echo "Total Cost is $";
                        echo $Bill + ($Bill * $Tip) . "<br>";
                        if($split>1)
                        {
                            echo "Split Cost is $";
                            echo ($Bill + ($Bill * $Tip))/$split . "<br>";
                        }
                        echo '</div>';
                    }
                }

                ?></div>
        </div>
    </div>
</div>
</div>
</section>
</body>
<script>
    function myFunction() {
        document.getElementById("custom").disabled = false;
    }
    function customDisable() {
        document.getElementById("custom").disabled = true;
    }
</script>
</html>
