<?php
    $title = "Confirmation d'inscription";
?>

<div class="mb-5"></div>
<div class="row">
    <div class="offset-md-3 col-md-6 offset-md-3">
        <div class="alert alert-success text-center" role="alert">
            <h2>Félicitations !</h2>
            <p>Un e-mail a été envoyé sur votre adresse mail : <?php echo $models->identifiant ?>.</p>
            <p>L'email envoyé lors de votre inscription peut se trouver dans vos courriers indésirables ou spam.</p>
            <p>Veuillez valider votre inscription en cliquant sur le lien présent dans cet e-mail.</p>
        </div>
    </div>
</div>
