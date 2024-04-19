</head>

<?php
require_once '../Controller/userManager.php';

$userManager = new UserManager();
var_dump($_SESSION);
?>
<body>
    <div class="container-fluid">

        <header>
            <h1 class="text-center"><a styles="none" href="../views/index.php">TRT Conseils</a></h1>
            <?php
            if (isset($_SESSION['status'])) {
            echo '<p class="text-end">Bonjour ' . $_SESSION['firstName'] . '</p>';
            }
            ?>
            <ul class="nav justify-content-around bg-primary">
                <?php
                if (!$_SESSION) {
                    echo ' 
                            <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="../views/createAccount.php">Créer un compte</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="../views/userConnect.php">Se connecter</a>
                            </li>';
                         }
                else if ($_SESSION['status'] == 'Candidat' || 'Recruteur') {
                    echo '
                            <li class="nav-item">
                            <a class="nav-link  text-light" href="../views/ManageAccountPrivate.php">Gestion de compte</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link text-light" href="#">Voir les annonces</a>
                            </li>';
                        if ($_SESSION['status'] == 'Recruteur') {
                            echo
                            '<li class="nav-item">
                            <a class="nav-link  text-light" href="../views/createAnnounce.php">Publier une annonce</a>
                            </li>';
                        }
                        else if ($_SESSION['status'] == 'Consultant') {
                            echo
                            '<li class="nav-item">
                            <a class="nav-link text-light" href="#">Gerer les annonces</a>
                            </li>';
                        }
                        else if ($_SESSION['status'] == 'Administrateur') {
                        echo
                            '<li class="nav-item">
                            <a class="nav-link text-light" href="../views/accountManagement.php">Gerer les utilisateurs</a>
                            </li>';
                        }
                            echo
                            '<li class="nav-item">
                            <a class="nav-link text-light" href="?logout">Deconnexion</a>';
                            if (isset($_GET['logout'])) {
                            session_unset();
                            header('location:' . '../views/index.php');
                    }
                }
                    ?>
            </ul>
        </header>
        <div style="min-height: 50em">