<?php
    $errors=array();
    $email='';
    $password='';
    $id='';
    $login=false;
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if(isset($_POST['email']) and !empty($_POST['email']))
        {
            $email=$_POST['email'];
        }
        else
            $errors["email"]="Поле пошта є обов'язковим";

            if (isset($_POST['password']) and !empty($_POST['password'])) {
                $password = $_POST['password'];
            } else {
                $errors["password"] = "Поле пароль є обов'язковим";
            }

            include_once "connection_database.php";
            $sth = $dbh->prepare("SELECT Id, Email, Password FROM `tbl_users`");
            $sth->execute();
            while($result = $sth->fetch(PDO::FETCH_ASSOC))
            {      
              if($email==$result['Email']&&$password==$result['Password'])
              {
                 $login=true;
                 $id=$result['Id'];
                 break;
              }
            }
            if(!$login)
            {
                $errors["login"]="Користувач не знайдений!";
            }
        if(count($errors)==0&&$login==true) {
            
            $_SESSION['id']=$id;
            header("Location: /index.php");
            exit;
        }
    }
?>

<?php include "_header.php"; ?>
<?php include_once "input-helper.php"/*Використав input-helper.php для зручності*/?>



       
      </div>
        <div class="login-container">
            <div class="row"> 
            <!-- <h3 class="center">Вхід в акаунт</h3> -->
                <div class="offset-md-3 col-md-6">
                    
                    <?php if(count($errors)!=0) { ?>
                        <div class="alert alert-danger" role="alert">
                              <?php 
                                if(!empty($errors["email"]))                              
                                echo $errors["email"];
                                echo "<br/>";
                                if(!empty($errors["password"]))
                                echo $errors["password"];
                                if(!empty($errors["login"]))
                                echo $errors["login"];
                              ?>
                        </div>
                    <?php } ?>
                    <form method="post" id="form_register">

                    <?php create_input("email", "Електронна пошта", "email", $errors); ?>

                    <?php create_input("password","Пароль", "password", $errors); ?>
                    <div class="form-group">
                    <input type="submit" class="btnSubmit" value="Логін"/>
                    </div>
                        <div class="form-group">
                            <a href="register.php" class="ForgetPwd">Реєстрація</a>
                        </div>
                    </form>
                </div>

  </div>
</div>





<?php include "_scripts.php"; ?>

<?php include "_footer.php"; ?>
