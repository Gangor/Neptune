<?php
    $title = 'Connexion';
?>

<div class="parallax" style="background-image: url('/assets/images/piscine-restaurant.jpg')">
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>

            <form id="login" name="login" action="/user/loginConfirm?redirect=<?php echo $url ?>" method="post">
                <div class="text-center text-danger">
                    <div class="mb-3"></div>
                    <?php echo $error; ?>
                    <div class="mb-3"></div>
                </div>
                
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Email' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Email' ], $models->Email ); ?>
                </div>
                <div class="form-group">
                    <?php Form::Label( $models->Validations[ 'Password' ] ) ?>
                    <?php Form::Input( $models->Validations[ 'Password' ], $models->Password ) ?>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/user/register">Inscription</a>
                </div>
            <form>
        </div>
    </div>
</div>

<?php $this->renderPartial( VIEWS. '/shared/validationScript.php', 'login' ); ?>
