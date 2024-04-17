<?php
require_once '../views/head.php';
?>

    <title>Connexion</title>

<?php
require_once '../views/header.php';
require_once '../controller/UserManager.php';

$userManager = new UserManager();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        try {
            $userConnect = $userManager->connectUser($email, $password);
    } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

?>
<form method="post" class="d-flex justify-content-evenly">
    <div class="w-25 d-flex flex-column">
        <label class=" form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control">

        <label class="form-label" for="password">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control">
        <input type="submit" value="Se connecter" class="btn btn-success m-3">
    </div>
</form>
