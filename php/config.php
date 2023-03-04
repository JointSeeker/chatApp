<?php
    $connect = mysqli_connect("localhost", "root", "", "chat_app");
    if(!$connect){
        echo "Database connected" . mysqli_connect_error();
    }
?>