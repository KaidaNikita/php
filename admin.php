<?php include "_header.php"; ?>


<div class="container">
  <h2>Список клієнтів</h2>
  <a href="/register.php" class="btn btn-success">Додати</a>
  <table class="table">
    <thead>
      <tr>  
        <th>Id</th>
        <th>Email</th>
        <th>Password</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>

<?php
include_once "connection_database.php";
$sth = $dbh->prepare("SELECT Id, Email, Password FROM `tbl_users`");
$sth->execute();
while($result = $sth->fetch(PDO::FETCH_ASSOC))
{
    echo '
    <tr>
        <th scope="row">'.$result["Id"].'</th>
        <td>'.$result["Email"].'</td>
        <td>'.$result["Password"].'</td>
        <td><a href="delete.php?id='.$result["Id"].'">Видалити</a> | <a href="edit.php?id='.$result["Id"].'">Edit</a> </td>
    </tr>
    ';
}
?>
    </tbody>
  </table>
</div>


<?php include "_scripts.php"; ?>

<?php include "_footer.php"; ?>