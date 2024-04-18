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
    $id = $_SESSION['id'];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];

    if ($_SESSION['status'] == 'Candidat') {
        $cv = $_FILES['cv']['name'];
        $address = '';
        $business = '';
        try {
            if (!$_FILES['cv']['type'] == 'application/pdf') {
                echo 'Le fichier doit être en PDF.';
            } else {
                $user = new User([
                    "id" => $id,
                    "firstName" => $firstName,
                    "lastName" => $lastName,
                    "cv" => $cv,
                    "business" => $business,
                    "address" => $address,
                ]);
                $userManager->updatePrivate($user);

                $uploadDir = '../img/cv/';
                $uploadFile = $uploadDir . basename($_FILES['cv']['name']);
                move_uploaded_file($_FILES['cv']['tmp_name'], $uploadFile);
            }
            echo "<meta http-equiv='refresh' content='0'>";
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'L\'enregistrement à échoué';
        }
    }
    else if ($_SESSION['status'] == 'Recruteur') {
    $business = $_POST["business"];
    $address = $_POST["address"];
    $cv = '';
    }
try {
        $user = new User([
            "id" => $id,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "business" => $business,
            "address" => $address,
            "cv" => $cv,
            ]);
        $userManager->updatePrivate($user);
        echo "<meta http-equiv='refresh' content='0'>";
    } catch (PDOException $e) {
        echo $e->getMessage();
}
    //echo "<meta http-equiv='refresh' content='0'>";
}
?>

<form method="post" enctype="multipart/form-data" class="container w-25">
    <div class="d-flex flex-column"
    <label class="form-label" for="firstName">Prénom</label>
    <input type="text" name="firstName" id="firstName" class="form-control">

    <label class="form-label" for="lastName">Nom</label>
    <input type="text" name="lastName" id="lastName" class="form-control">

    <?php
        if ($_SESSION['status'] == 'Candidat') {
            echo
            '<div class="cv">
                <label class="form-label" for="cv">CV</label>
                <input type="file" name="cv" id="cv" class="form-control" >
            </div>';
        }
        else if ($_SESSION['status'] == 'Recruteur') {
            echo
                '<div  class="business">
    <label class="form-label" for="business">Entreprise</label>
    <input type="text" name="business" id="business" class="form-control"  >
    </div>

    <div   class="address">
    <label class="form-label" for="address">Adresse</label>
    <input type="text" name="address" id="address" class="form-control" >
    </div>';
        }
    ?>





    <input type="submit" value="Accepter les modifications" class="btn btn-success mt-3 btn-inscription">
    </form>
<script src="../JS/createUser.js"></script>
