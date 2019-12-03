<?php
 $errors=array();    
 include_once "connection_database.php";
 include "resize_img.php";
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
   $id=$_POST['id'];
   $email=$_POST['email'];
   if($_FILES['image']['tmp_name']!=null)
{
   $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
   $file_name= uniqid('300_').'.jpg';
   $file_save_path=$uploaddir.$file_name;
   my_image_resize(600,400,$file_save_path,'image');
   $save_name='/uploads/'.$file_name;
    $sql = "UPDATE tbl_users SET Email=?,Image=? WHERE Id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$email, $save_name, $id]);
}
   header("Location: /userprofile.php?id=$id");
   exit;
 }
 ?>

<?php 
include "_header.php";
?>

<?php include_once "input-helper.php"?>
<div class="container">
  <h2>Редагування користувача?</h2>
 
<?php

 if($_SERVER["REQUEST_METHOD"]=="GET")
 {
    $id=$_GET["id"];
    $sth = $dbh->prepare("SELECT Email, Image FROM `tbl_users` WHERE Id=$id");
    $sth->execute();
    
    if($result = $sth->fetch(PDO::FETCH_ASSOC))
    {
        $_POST['email']=$result["Email"];
        $_POST['Image']=$result["Image"];
        $_POST['id']=$id;
    }
 }
?>
<form method="post" id="form_register" enctype="multipart/form-data">

<?php create_input("id", "", "hidden", $errors); ?>
    <?php create_input("email", "Електронна пошта", "email", $errors); ?>

    <?php create_input("image","Фото", "file", $errors); ?>
    <img id="prev" width="200" src="<?php echo $result["Image"]; ?>"/>
    <div class="form-group">
        <input type="submit" class="btnSubmit" value="Зберегти"/>
    </div>
</form>


<?php include "_footer.php"; ?>