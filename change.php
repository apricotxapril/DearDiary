<?php

    session_start();
    $_SESSION["lang"] = $_GET["lang"];
    session_write_close();

    $_SESSION["filename"] = $_GET["filename"];
    header("location:".$_SESSION["filename"]);
    
    # if(include("login.php")){
    #     header("location:login.php");
    # }

?>