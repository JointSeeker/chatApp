<?php
    include_once('html/header.php');
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header><span>J</span>oint<span>S</span>eeker chat app</header>
            <form action="#" method="post">
                <!-- Chybová hláška -->
                <div class="error-txt"></div>
                <!-- email -->
                <div class="field input">
                    <label for="">Email Address</label>
                    <input type="email" name="email" placeholder="Enter your email">
                </div>    
                <!-- heslo -->
                <div class="field input">
                    <label for="">Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <!-- Tlačítko odeslání formuláře -->
                <div class="field button">
                    <input type="submit" name="submit" value="Continue to Chat">
                </div>
            </form>
            <!-- Přesměrování na přihlášení, pokud se uživatel již zaregistroval -->
            <div class="link">
                Not yet signed up? <a href="index.php">Signup now</a>
            </div>
        </section>
    </div>

    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>
</html>