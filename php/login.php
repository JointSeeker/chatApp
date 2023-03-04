<?php
    session_start();

    include_once('config.php');
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    // $pass_veryfi = password_verify($password, $pass_hash);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if(!empty($email) && !empty($password)){
        // jdeme zkotrolovat uživatelsky email a heslo
        $sql = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if(mysqli_num_rows($sql) > 0){ //pokud se uživatelské vstupy shodují
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            // update uživatelského statusu na 'Active now' pokud přihlášení uživatele bylo úspěšné
            $sql2 = mysqli_query($connect, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'");
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id']; // použitím tehle session použijeme uživatelovo unique_id v ostatních php souborech
                echo "success";
            }
        }else {
            echo "Email or Password is incorrect!";
        }
    }else {
        echo "All inputs field are required!";
    }
?>
