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
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cv = $_POST["cv"];
    $business = $_POST["business"];
    $address = $_POST["address"];
    $statusId = $_POST["statusId"];
    try {
        $user = new User([
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "password" => $password,
            "cv" => $cv,
            "business" => $business,
            "address" => $address,
            "statusId" => $statusId,
        ]);
        $userManager->addUser($user);
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo 'L\'enregistrement à échoué';
    }
}

?>

<form method="post" class="container">
    <label class="form-label" for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" class="form-control">

    <label class="form-label" for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" class="form-control">

    <label class="form-label" for="email">Email</label>
    <input type="email" name="email" id="email" class="form-control">

    <label class="form-label" for="password">Mot de passe</label>
    <input type="password" name="password" id="password" class="form-control">

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

    <div hidden class="cv">
        <label class="form-label" for="cv">CV</label>
        <input type="text" name="cv" id="cv" class="form-control" >
    </div>

    <div hidden class="business">
    <label class="form-label" for="business">Entreprise</label>
    <input type="text" name="business" id="business" class="form-control"  >
    </div>

    <div hidden  class="address">
    <label class="form-label" for="address">Adresse</label>
    <input type="text" name="address" id="address" class="form-control" >
    </div>

    <input type="submit" value="S'inscrire" class="btn btn-success mt-3 btn-inscription" hidden>
</form>
<script src="../JS/createUser.js"></script>
