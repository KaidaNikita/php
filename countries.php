<?php include "_header.php"; ?>



<?php
$errors = array();
$country = '';
$correct=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (isset($_POST['text']) and !empty($_POST['text'])) {
        $country = $_POST['text']. "\n";
    } else {
        $errors["text"] = "Поле є обов'язковим";
    }

$fp = fopen("dictionary.txt", "r");
if ($fp)
{
while(!feof($fp))
{
    $text=fgets($fp, 999);
    if($country!=$text)
    {
        $correct=true;
        break;
    }
}
}
    $fp = fopen("countries.txt", "a+");
    if ($fp and count($errors) == 0 and $correct)
    {
        fwrite($fp, $country."\n");
    }
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
       
<?php
$fp = fopen("countries.txt", "r");
if ($fp)
{
while(!feof($fp))
{
    $text=fgets($fp, 999);
    echo '
    <option>
    '.$text.'
    </option>
    ';
}
}
?>
</select>
            <div class="form-group">
                <input type="submit" class="btnSubmit" value="Добавити"/>
            </div>
        </form>
    </div>

</div>


<?php include "_footer.php"; ?>
