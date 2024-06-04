<?php
function extracted()
{
    $hostname = 'daab';
    $username = 'root';
    $password = 'painelka_art';
    $database = 'web';
    $port = 3306;

    $test = new mysqli($hostname, $username, $password);

    if (mysqli_connect_errno()) {
        echo "<p>" . "Error! It's unable to connect to MySQL " . mysqli_connect_error() . "</p>";
    }
    return $test;
}
?>
