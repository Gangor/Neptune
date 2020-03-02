<?php
    $title = "Mon compte";
    $civilites = [
        [ 'value' => 'Monsieur' ],
        [ 'value' => 'Mademoiselle' ],
        [ 'value' => 'Madame' ],
    ];
    $validations = [
        'civilite' => [ "required" ],
        'firstname' => [ "placeholder" => "Prénom *", "maxlength" => '70', "required" ],
        'lastname' => [ "placeholder" => "Nom *", "maxlength" => '100', "required" ],
        'adresse' => [ "placeholder" => "Adresse", "maxlength" => '200' ],
        'ville' => [ "placeholder" => "Ville", "maxlength" => '200' ],
        'codepostal' => [ "placeholder" => "Code postal", "minlength" => '5', "maxlength" => '5' ],
        'pays' => [ ]
    ];
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>

            <hr>
            
            <h5 class="text-center">Modifier le mot de passe</h5>
            <div class="text-center">
                <a class="btn btn-success" href="/manage/editpassword">Modifier</a>
            </div>

            <hr>

            <form id="edit" name="edit" action="/manage/editConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <?php if ( isset( $success ) ) { ?>
                    <p class="text-center text-success">Vos informations personnelles ont été mise à jour avec succès.</p>
                <?php } ?>

                <h5 class="text-center">Modifier les informations personnelles</h5>

                <div class="form-group">
                    <?php Form::Select( 'civilite', $validations[ 'civilite' ], $civilites, array( 'value', 'value' ), $user->civilite ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", $validations[ 'firstname' ], 'firstname', $user->prenom ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( "text", $validations[ 'lastname' ], 'lastname', $user->nom ) ?>
                </div>

                <?php if ( !$user->admin ) { ?>
                    <div class="form-group">
                        <?php Form::Select( 'pays', $validations[ 'pays' ], $pays, array( 'id', 'nom' ), $user->pays_id ) ?>
                    </div>
                    <div class="form-group">
                        <?php Form::Input( 'text', $validations[ 'adresse' ], 'adresse', $user->adresse ) ?>
                    </div>
                    <div class="form-group">
                        <?php Form::Input( 'text', $validations[ 'ville' ], 'ville', $user->ville ) ?>
                    </div>
                    <div class="form-group">
                        <?php Form::Input( 'text', $validations[ 'codepostal' ], 'codepostal', $user->codePostal ) ?>
                    </div>
                <?php } ?>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                </div>
            </form>

            <hr>
            
            <h5 class="text-center">Gestion du compte</h5>
            <div class="text-center">
                <a class="btn btn-warning" href="/manage/recoveData" target="_blank">Données du compte</a>
                <a class="btn btn-danger" href="/manage/delete">Supprimer mon compte</a>
            </div>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php 
$this->section[ "scripts" ] = 
'
    <script>
        $("#edit").validate({ lang: \'fr\' });
    </script>
'; 
?>
