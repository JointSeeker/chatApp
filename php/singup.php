<?php
session_start();

include_once('config.php');
$fname = mysqli_real_escape_string($connect, $_POST['fName']);
$lname = mysqli_real_escape_string($connect, $_POST['lName']);
$email = mysqli_real_escape_string($connect, $_POST['email']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$pass_crypt = password_hash($password, PASSWORD_DEFAULT);

if(!empty($fname) && !empty($lname) && !empty($email) && !empty($pass_crypt)){
    // zkontrolujeme jestli je uživatelský email validní
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        // kontrola zda email již existuje v databázi
        $sql = mysqli_query($connect, "SELECT email FROM users WHERE email = '{$email}'");
        if(mysqli_num_rows($sql) > 0){ // pokud email již existuje
            echo "$email - This email is already exist!";
        }else {
            //kontrola zda se soubor user uploadoval
            if(isset($_FILES['img'])){ // pokud se soubor uploadoval =>
               $img_name = $_FILES['img']['name']; // získaní jmena nahraného obrázku 
               $tmp_name = $_FILES['img']['tmp_name']; // tento nazev složky pouzijeme k uložení/pohybu obrazku v nasi složce

                //jdeme nastavit soubory pouze na jpg a png pomocí "explode"
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); // zde ziskame koncovky z uživatelem nahraného souboru

                $extension = ['png', 'jpeg', 'jpg', 'JPG', 'JPEG', 'PNG']; // zde jsou kocovky validních img souborů uloženy v poli
                if(in_array($img_ext, $extension) === true){ // pokud se shoduje pole s uzivtelským souborem 
                    $time = time(); // tohle vrací aktualní čas nahrání img ..
                                    // zařídíme tím že každá nahraná fotka bude mít unikátní jméno 
                    // jdeme umístit nahrané fotky do složky
                    $new_img_name = $time.$img_name;

                    if(move_uploaded_file($tmp_name, "users_galery/" . $new_img_name)){
                    $status = "Active now"; // jednou prihlaseny uzivatel než se jeho status zmení na aktivní
                    $random_id = rand(time(), 10000000); // vytvoření náhodného id uživatele

                    // jdem vložit uživatelská data dovnitř tabulky
                    $sql_insert_data = mysqli_query($connect, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                       VALUES('{$random_id}', '{$fname}', '{$lname}', '{$email}', '{$pass_crypt}', '{$new_img_name}', '{$status}')");
                    if($sql_insert_data){ // pokud jsou data vložena
                        $sql_email = mysqli_query($connect, "SELECT * FROM users WHERE email = '{$email}'");
                        if(mysqli_num_rows($sql_email) > 0){
                            $row = mysqli_fetch_assoc($sql_email);
                            $_SESSION['unique_id'] = $row['unique_id']; // použitím tehle session použijeme uživatelské unikátní id v ostatních php souborech
                            echo "success";
                        }
                    }else{
                        echo " Something went wrong!";
                    }
                    }
                }else {
                    echo "Please select an image file - .png, .jpeg, .jpg";
                }

            }else {
                echo "Please select an image file!";
            }
        }
    }else {
        echo "$email - Tsis is not a valid email!";
    }
}else {
    echo "All input field are required!";
}
?>