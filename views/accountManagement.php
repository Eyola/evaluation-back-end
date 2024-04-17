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

if ($_POST) {
var_dump($_POST);
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    try {
        $user = new User([
                "firstName" => $firstName,
                "lastName" => $lastName,
                "email" => $email,
                "password" => $password
        ]);
        $userManager->addConsultant($user);
    } catch (Exception $e) {
        echo $errorMessage = $e->getMessage();
    }
}

?>
<div class="container d-flex flex-column align-items-center">

<div class="container d-flex justify-content-center align-items-center choiceButtons">
    <button type="button" class="btn btn-info newConsultantBtn m-3">Nouveau consultant</button>
    <button type="button" class="btn btn-info showUsersBtn m-3">Liste des utilisateurs</button>
</div>

<div class="container showUsers" hidden>

    <?php
try {
    echo '<table class="table usersTable">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Type</th>
                <th>Mail</th>
                <th>Enregistré</th>
                <th>Modifier</th>
            </tr>
        </thead>';
    foreach ($listUsers as $user) {
        echo '<td>' . ($user->getLastName()) . '</td>';
        echo '<td>' . ($user->getFirstName()) . '</td>';
        echo '<td>' . ($statusManager->getStatusFromId($user->getStatusId())) . '</td>';
        echo '<td>' . ($user->getEmail()) . '</td>';
        echo '<td>' . ($user->getApproved()) . '</td>';
        echo '<td><a href="../views/UserManagement.php?id=' . ($user->getId()) . '" class="btn btn-warning">Modifier</a></td></tr>';
    }
    echo '</table>';
} catch (PDOException $e) {
    var_dump($e->getMessage());
    echo "La connexion a échouée";
}

?>
</div>

<div class="createConsultant w-25" hidden>
    <form method="post" class="d-flex flex-column">
        <label class="form-label" for="firstName">Prénom</label>
        <input type="text" name="firstName" id="firstName" class="form-control">

        <label class="form-label" for="lastName">Nom</label>
        <input type="text" name="lastName" id="lastName" class="form-control">

        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">

        <label class="form-label" for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">

        <input type="submit" value="Ajouter Consultant" class="btn btn-success m-3">
    </form>
</div>
</div>
<script src="../JS/accountManagement.js"></script>
