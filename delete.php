<?php 
include "_header.php";
?>
<div class="container">
  <h2>Ви впевнені що хочете видалити цього користувача?</h2>
  <table class="table">
    <thead>
      <tr>  
        <th>Id</th>
        <th>Email</th>
        <th>Password</th>
        <th>Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    <?php
    include_once "connection_database.php";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $id=$_POST['id'];
      $dbh->exec("DELETE FROM tbl_users WHERE Id=$id");
      header("Location: /admin.php");
      exit;
    }
    ?>


<?php


$id=$_GET["id"];
$sth = $dbh->prepare("SELECT Id, Email, Password,Image FROM `tbl_users` WHERE Id=$id");
$sth->execute();

while($result = $sth->fetch(PDO::FETCH_ASSOC))
{
    echo '
    <form method="post">
    <tr>
        <input type="hidden" name="id" value="'.$result["Id"].'"/>
        <th scope="row">'.$result["Id"].'</th>
        <td>'.$result["Email"].'</td>
        <td>'.$result["Password"].'</td>
        <td><img src="'.$result["Image"].'"/></td>
        <td><input type="submit" class="btnSubmit" value="Видалити"/></td>
    </tr>
    </tbody>
    </table>
  </div>
    </form>
    ';
}
?>


<?php include "_footer.php"; ?>