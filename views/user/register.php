<?php
    $title = "Inscription";
    $civilites = [
        [ 'value' => 'Monsieur' ],
        [ 'value' => 'Mademoiselle' ],
        [ 'value' => 'Madame' ],
    ];
    $validations = [
        'email' => [ 'placeholder' => 'Email *', 'maxlength' => '60', 'required' ],
        'password' => [ 'placeholder' => 'Mot de passe *', 'maxlength' => '50', 'required' ],
        'civilite' => [ 'required' ],
        'firstname' => [ 'placeholder' => 'Prénom *', 'maxlength' => '70', 'required' ],
        'lastname' => [ 'placeholder' => 'Nom *', 'maxlength' => '100', 'required' ],
        'adresse' => [ 'placeholder' => 'Adresse', 'maxlength' => '200' ],
        'ville' => [ 'placeholder' => 'Ville', 'maxlength' => '200' ],
        'codepostal' => [ 'placeholder' => "Code postal", 'minlength' => '5', 'maxlength' => '5' ],
        'pays' => [],
    ];
?>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>
            <form id="register" name="register" action="/user/registerConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <h5 class="text-center">Information de connexion</h5>
                <div class="form-group">
                    <?php Form::Input( 'email', $validations[ 'email' ], 'email' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'password', $validations[ 'password' ], 'password' ) ?>
                </div>
                <div class="mb-3"></div>

                <h5 class="text-center">Information personnelle</h5>

                <div class="form-group">
                    <?php Form::Select( 'civilite', $validations[ 'civilite' ], $civilites, array( 'value', 'value' ) ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Select( 'pays', $validations[ 'pays' ], $pays, array( 'id', 'nom' ) ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'text', $validations[ 'firstname' ], 'firstname' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'text', $validations[ 'lastname' ], 'lastname' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'text', $validations[ 'adresse' ], 'adresse' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'text', $validations[ 'ville' ], 'ville' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'text', $validations[ 'codepostal' ], 'codepostal' ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="mb-5"></div>

<?php 
$this->section[ "scripts" ] = 
'
    <script>
        $("#register").validate({ lang: \'fr\' });
    </script>
'; 
?>
