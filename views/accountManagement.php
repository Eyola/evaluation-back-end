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

?>
<div class="container">

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
