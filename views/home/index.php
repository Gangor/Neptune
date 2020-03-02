<?php

$admin = false;

if ( isset( $user ) )
{
    $admin = $user->admin;
}

?>

<div id="home-background" class="col-md-12">
    <div class="container">Accueil</div>
</div>

<div class="mt-5"></div>

<div class="container">
    <div class="col-md-12">
        <h2 class="text-center"><?php echo $title ?></h2>
        <p>Connecté : <?php echo Session::Loggin() ? 'oui' : 'non' ?>
        <p>Administrateur : <?php echo $admin ? 'oui' : 'non' ?>
    </div>
</div>

<div class="mb-5"></div>
