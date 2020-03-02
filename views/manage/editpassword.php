<?php
    $title = "Changer de mot de passe";
    $validations = [
        'oldpassword' => [ 'placeholder' => 'Actuel *', 'maxlength' => '50', 'required' ],
        'newpassword' => [ 'placeholder' => 'Nouveau *', 'maxlength' => '50', 'required' ],
        'confirm' => [ 'placeholder' => 'Confirmation *', 'maxlength' => '50', 'equalTo' => '#newpassword', 'required' ],
    ];
?>

<div class="mt-5"></div>

<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <h2 class="text-center"><?php echo $title ?></h2>

            <div class="mb-5"></div>
            <form id="changepassword" name="changepassword" action="/manage/editpasswordConfirm" method="post">
                <div class="text-danger"><?php echo $error; ?></div>

                <?php if ( isset( $success ) ) { ?>
                    <p class="text-center text-success">Vos informations personnelles ont été mise à jour avec succès.</p>
                <?php } ?>

                <div class="form-group">
                    <?php Form::Input( 'password', $validations[ 'oldpassword' ], 'oldpassword' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'password', $validations[ 'newpassword' ], 'newpassword' ) ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'password', $validations[ 'confirm' ], 'confirm' ) ?>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/manage">Retour</a>
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
        $("#changepassword").validate({ lang: \'fr\' });
    </script>
'; 
?>
