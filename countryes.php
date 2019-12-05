<?php include "_header.php"; ?>



<?php
$errors = array();
$country = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

}
?>

<?php include_once "input-helper.php"?>
<?php include_once "_scripts.php"?>

<div class="row mt-3">
    <div class="offset-md-3 col-md-6">
        <h3>Створення нового акаунта</h3>
        <form method="post" id="form_register" enctype="multipart/form-data">

        <?php create_input("text", "Країна", "text", $errors); ?>

        <select class="selectpicker">
        <option>Mustard</option>
         <option>Ketchup</option>
         <option>Relish</option>
        </select>


            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Добавити"/>
            </div>
        </form>
    </div>

</div>


<?php include "_footer.php"; ?>
