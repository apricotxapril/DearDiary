<?php 

    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "mydb";

    try {
        $db = new PDO("mysql:host={$db_host};dbname={$db_name}", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        $e->getMessage();
    }

    $connect = mysqli_connect($db_host, $db_user, $db_password);
    $connection = mysqli_select_db($connect, $db_name);

?>