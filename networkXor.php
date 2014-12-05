<!DOCTYPE html>
<?php
require_once 'ANN_xor.php';
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//ini_set("display_startup_errors", 1);
$network = new ANN_xor();
$result = "?";
if (!$network->isTrainingComplete()) {
    $network->train();


    $result = "sieć jeszcze nie jest gotowa";
} else {
    if (isset($_POST) && isset($_POST['v1']) && isset($_POST['v2'])) {
        $objValues = new ANN\Values();
        $objValues->input((float) $_POST['v1'], (float) $_POST['v2']);
        $network->setValues($objValues);
        $result = $network->getOutputs();
        $result = $result[0][0];
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Trening Sieci <?php echo $network->getName(); ?></title>

        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="main.css">
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1>
                        Trening sieci <?php echo $network->getName(); ?>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="<?php echo $network->getImagePath(); ?>"/>
                </div>
            </div>
            <div class="row">
                <br/>
                <br/>
                <form method="POST">
                    <div class="col-md-4 text-right">
                        <div>
                            <h4>
                                Pierwszy bit
                            </h4>
                            <label class="checkbox-inline">
                                <input type="radio" id="inlineCheckbox1" name="v1" <?php if (isset($_POST['v1']) && $_POST['v1'] == '0') echo "checked"; ?> value="0"> 0
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" id="inlineCheckbox2" name="v1" <?php if (isset($_POST['v1']) && $_POST['v1'] == '1') echo "checked"; ?> value="1"> 1
                            </label>
                        </div>
                        <div>
                            <h4>
                                Drugi bit
                            </h4>
                            <label class="checkbox-inline">
                                <input type="radio" id="inlineCheckbox3" name="v2" <?php if (isset($_POST['v2']) && $_POST['v2'] == '0') echo "checked"; ?> value="0"> 0
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" id="inlineCheckbox4" name="v2" <?php if (isset($_POST['v2']) && $_POST['v2'] == '1') echo "checked"; ?> value="1"> 1
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <input type="submit" class="btn btn-success"/>
                    </div>
                    <div class="col-md-4 text-left">
                        Wynik: <?php echo $result; ?>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php echo $network->getInfo(); ?>
                </div>
            </div>

        </div>
    </body>

</html>