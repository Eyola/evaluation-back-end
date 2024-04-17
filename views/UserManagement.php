<?php
require_once '../views/head.php';
?>

<title>Gérer les comptes</title>

<?php
require_once 'header.php';
require_once '../Controller/userManager.php';
require_once '../Controller/statusManager.php';
require_once '../models/userModel.php';

$userManager = new UserManager();
$listUsers = $userManager->showUsers();
$statusManager = new StatusManager();
var_dump($_POST);
var_dump($_GET);
if ($_POST) {
    echo "updateApproved";
    $approved = $_POST['approved'];
    try {
    $updateUser = new User([
            "approved" => $approved
    ]);
    $userManager->changeApproved($_GET['id'], $approved);
        echo "<meta http-equiv='refresh' content='0'>";
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
    }
}

?>

<div class="container">
    <form method="post">5
        <table class="table usersTable">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Type</th>
                    <th>Mail</th>
                    <th>Enregistré</th>
                </tr>
            </thead>
        <?php foreach ($listUsers as $user) { ?>
             <tr>
             <td><?= $user->getLastName() ?></td>
             <td><?= $user->getFirstName() ?></td>
             <td><?= $statusManager->getStatusFromId($user->getStatusId()) ?></td>
             <td><?= $user->getEmail() ?></td>
             <td><?= $user->getApproved() ?></td>
             </tr>
    <?php } ?>
             <tr>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td>
                 <label for="updateApproved">
                        <select name="approved">
                            <option value="Oui">Oui</option>
                            <option value="Non">Non</option>
                        </select>
                    </label>
                 </td>
             </tr>
        </table>

        <div class="container d-flex justify-content-center ">
        <input type="submit" name="btnApproved" value="Mettre à jour" class="btn btn-warning" id="updateApproved">
    </form>
        <input type="submit" name ="btnDelete" value="Supprimer" class="btn btn-danger">

        </div>
</div>
