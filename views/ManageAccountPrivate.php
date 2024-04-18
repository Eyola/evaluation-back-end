<?php
require_once 'head.php';
?>

<title>Créer un compte</title>

<?php
require_once 'header.php';
require_once '../Controller/userManager.php';
require_once '../models/statusModel.php';
require_once '../Controller/statusManager.php';

$statusManager = new StatusManager();
$listStatus = $statusManager->getStatusForRegister();
$userManager = new UserManager();
if ($_POST) {
    var_dump($_POST);
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $cv = $_POST["cv"];
    $business = $_POST["business"];
    $address = $_POST["address"];
    try {
        $user = new User([
            "firstName" => $firstName,
            "lastName" => $lastName,
            "cv" => $cv,
            "business" => $business,
            "address" => $address,
        ]);
        $userManager->addUser($user);
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo 'L\'enregistrement à échoué';
    }
}

?>

<div method="post" class="container w-25">
    <div class="d-flex flex-column"
    <label class="form-label" for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" class="form-control">

    <label class="form-label" for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" class="form-control">

    <fieldset>
        <legend>Profil</legend>
        <?php
        foreach ($listStatus as $status) {
            ?>
            <div class="form-check status">
                <input class="form-check-input" type="radio" name="statusId" value="<?= $status->getId() ?>" id="<?= $status->getStatus_name() ?>">
                <label class="form-check-label" for="<?= $status->getId() ?>">
                    <?= $status->getStatus_name() ?>
                </label>
            </div>
            <?php
        }
        ?>
    </fieldset>

    <div class="cv">
        <label class="form-label" for="cv">CV</label>
        <input type="text" name="cv" id="cv" class="form-control" >
    </div>

    <div  class="business">
    <label class="form-label" for="business">Entreprise</label>
    <input type="text" name="business" id="business" class="form-control"  >
    </div>

    <div   class="address">
    <label class="form-label" for="address">Adresse</label>
    <input type="text" name="address" id="address" class="form-control" >
    </div>

    <input type="submit" value="Accepter les modifications" class="btn btn-success mt-3 btn-inscription">
    </div>
</form>
<script src="../JS/createUser.js"></script>
