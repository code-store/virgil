<?php

ob_start();
include('config.php');

$widgetName = $_POST["widgetName"];
$widgetIdentificator = $_POST["widgetIdentificator"];

$content = "text..here..";


if ($widgetName && $widgetIdentificator) {

    $SQL = "SELECT * FROM widgets WHERE widget.identificator='" . $widgetIdentificator . "'";

    $result = mysql_query($SQL);

    if (!mysql_fetch_assoc($result)) {
        $sql = "INSERT INTO widgets VALUES ('', '{$widgetIdentificator}', '{$widgetName}','{$content}')";
        if (!mysql_query($sql)) {
            die('Sorry. Error at saving data! Please try again later!');
        } else {
            header('Location: ./admin.php#widgets');
        }
    } else {
        echo "Widget with this name already exists!";
    }
} else {
    echo "Fill the inputs!";
}
?>