<?php include "_header.php"; ?>

<?php
class User
{
  private $login;
  private $pass;
  private $img;
  function __construct($login,$password,$image)
  {
    $this->login=$login;
    $this->pass=$password;
    $this->img=$image;
  }
  function Show()
  {
    echo '
    <table class="table">
    <thead>
      <tr>  
        <th>Email</th>
        <th>Password</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
    <tr>
        <td>'.$this->login.'</td>
        <td>'.$this->pass.'</td>
        <td> <img width="50px" height="50px" src="'.$this->img.'" alt="Фото"/></td>
    </tr>
    </tbody>
    </table>
    ';
  }
}

?>


<?php
$errors = array();
$email = '';
$image = '';
$password = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once "connection_database.php";
     include "resize_img.php";
    if (isset($_POST['email']) and !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $errors["email"] = "Поле є обов'язковим";
    }

    if (isset($_POST['password']) and !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $errors["password"] = "Поле є обов'язковим";
    }

    //session_start();
	if (md5($_POST['norobot']) == $_SESSION['randomnr2'])	{ 
	}	else {  
        $errors["captcha"] = "Не вірна каптча";
	}


    if (count($errors) == 0) {
        $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
        $file_name= uniqid('300_').'.jpg';
        $file_save_path=$uploaddir.$file_name;
        my_image_resize(600,400,$file_save_path,'image');
       $save_name='/uploads/'.$file_name;
       $sql = "INSERT INTO tbl_users (Email, Password, Image) VALUES (?,?,?)";
       $stmt= $dbh->prepare($sql);
       $stmt->execute([$email, $password, $save_name]);

      // session_start();


//        $sth = $dbh->prepare("SELECT Id, Email, Password,Image FROM `tbl_users` WHERE Image=$save_name");
//        $sth->execute();
// if($result = $sth->fetch(PDO::FETCH_ASSOC))
// {
      // $_SESSION['user_id']="22";//витянуть Id нормальний
//}
       
    $user=new User($email,$password,$save_name);
    $user->Show();
       //header("Location: /register.php");
       //exit;
    }
}
?>


<?php include_once "input-helper.php"?>

<div class="row mt-3">
    <div class="offset-md-3 col-md-6">
        <h3>Створення нового акаунта</h3>
        <form method="post" id="form_register" enctype="multipart/form-data">

            <?php create_input("email", "Електронна пошта", "email", $errors); ?>

            <?php create_input("password","Пароль", "password", $errors); ?>

            <input class="input" type="text" name="norobot" />
		    <img id="captcha_img" src="captcha.php" />
            <a  type="button" id="reset_btn"><i style="font-size:150%" class="fa fa-refresh" aria-hidden="true"></i></a>

            <?php create_input("image","Фото", "file", $errors); ?>
<img id="prev"/>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Реєстрація"/>
            </div>
        </form>
    </div>

</div>

<?php include "_scripts.php"; ?>

<script>
    $(function() {

        $('#reset_btn').on('click',function()
        {
            $('#captcha_img').attr("src","captcha.php");
        }
        )

        $('#form_register input[type=email]').on('input', function()
        {
            valid_hide($(this));
        });
        $('#form_register input[type=password]').on('input', function()
        {
            valid_hide($(this));
        });
        $('#form_register #image').on('input', function()
        {
            //let val= $(this).val();
            readURL(this);
            //alert(val);
            //$(this).parent().append("<img src='"+val+"'/>");
            //valid_hide($(this));
        });

        function valid_hide(child)
        {
            if(child.is(".is-invalid")) {
                child.removeClass("is-invalid");
                child.parent().find('.invalid-feedback')[0].remove();
            }
        }


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    //$(this).parent().append("<img src='"+e.target.result+"'/>");
                    $('#prev').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    });
</script>

<?php include "_footer.php"; ?>

