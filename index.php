<?php
    include_once('html/header.php');
?>
<body>
    <div class="wrapper">
        <section class="form singup">
            <header><span>J</span>oint<span>S</span>eeker chat app</header>
            <form action="#" enctype="multipart/form-data">
                <!-- Chybová hláška -->
                <div class="error-txt"></div>
                <!-- Jméno a příjmení -->
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="fName" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" name="lName" placeholder="Last Name" required>
                    </div>
                </div>
                <!-- email -->
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>    
                <!-- heslo -->
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter new password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <!-- Profilová fotka -->
                <div class="field image">
                    <label for="">Select Image</label>
                    <input type="file" name="img" required>
                </div>
                <!-- Tlačítko odeslání formuláře -->
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <!-- Přesměrování na přihlášení, pokud se uživatel již zaregistroval -->
            <div class="link">
                Already signed up? <a href="login.php">Login now</a>
            </div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/singup.js"></script>
</body>
</html>