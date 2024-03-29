<?php
/** INCLUDES */
include_once("classes/Database.php"); 
include_once("classes/User.php"); 

if (!empty($_POST)){
    // get values
    $mail = $_POST['email'];
    $password = $_POST['password'];
        $user = new User;
        $user->setMail($mail);
        $user->setPassword($password);
    
        try {
            $user->checkLogin();
            $username = $user->findUsername(); 
            $user->setUsername($username); 
            $user->login(); 

            if ($user->checkAdmin()){
                header("Location: adminView.php");
            } else {
                header("Location: index.php");
            }

        } catch (Exception $e) {
            $error = $e->getMessage(); 
        }
}

/** header */
include_once("header.php"); 
?>
    <div class="login">
        <form method="post">
            <h2>To Do Application</h2>
            <div class="illustration">
                <i class="fas fa-file-alt"></i>
            </div>

            <?php if(isset($error) ): ?>
                <div class="error"><p>
                <?php echo $error ?></p></div>
            <?php endif; ?>
            
            <!-- keep value after validating the form
            source: https://stackoverflow.com/questions/33276966/php-keep-entered-values-after-validation-error -->

            <div class="form-group">
                <input class="form-control" type="text" name="email" placeholder="Email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">Log In</button>
            </div>
            <a href="register.php" class="registerlink">Register here</a>
        </form>
    </div>
<?php 
/** footer */
include_once("footer.php"); 
?>