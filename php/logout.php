<?php
    session_start();
    if(isset($_SESSION['unique_id'])){ // pokud je uživatel přihlášený na teto strance prejde na přihlašovací stranku
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($connect, $_GET['logout_id']);
        if(isset($logout_id)) {// pokud je nastaveno odhlašovací id
            $status = "Offline now";
            //když se uživatel odhlásí změní se status na offline 
            // uděláme znovu update statusu na aktivní aby jsme zjistily jestli přihlášení bylo uspěšné
            $sql = mysqli_query($connect, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$logout_id}'");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else {
            header("location: ../user.php");
        }
    }else {
            header("location: ../login.php");
        }

?>