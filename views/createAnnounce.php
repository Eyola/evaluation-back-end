<?php
require "../views/head.php";
?>

<title>Créer une nouvelle annonce</title>

<?php
require "../views/header.php";
require_once '../Controller/announceManager.php';
require_once '../models/announceModel.php';

$announceManager = new AnnounceManager();

if ($_POST) {
    $job = $_POST["job"];
    $place = $_POST["place"];
    $description = $_POST["description"];
    try {
        $announce = new Announce([
            "job" => $job,
            "place" => $place,
            "description" => $description
        ]);
        $announceManager->addAnnounce($announce);
    } catch (PDOException $e) {
        echo $errorMessage = $e->getMessage();
    }
}

?>


<form method="post" enctype="multipart/form-data" class="container w-25">
    <div class="d-flex flex-column"
    <label class="form-label" for="job">Intitulé du poste</label>
    <input type="text" name="job" id="job" class="form-control">

    <label class="form-label" for="place">Lieu</label>
    <input type="text" name="place" id="place" class="form-control">

    <label class="form-label" for="description">Description</label>
    <textarea name="description" id="description" class="form-control" placeholder="Merci de détailler le poste (horaire, salaire...)"
    rows="10"></textarea>

    <input type="submit" value="Publier l'annonce" class="btn btn-success mt-3 btn-inscription">

</form>