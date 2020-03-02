<?php
    $title = 'Connexion';
    $validations = [
        'email' => [ 'placeholder' => 'Email *', 'maxlength' => '60', 'required' ],
        'password' => [ 'placeholder' => 'Mot de passe *', 'maxlength' => '50', 'required' ]
    ];
?>

<div class="parallax" style="background-image: url('/assets/images/piscine-restaurant.jpg')">
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <div class="mb-5"></div>
            <h2 class="text-center"><?php echo $title ?></h2>
            <div class="mb-5"></div>

            <div class="text-danger"><?php echo $error; ?></div>
            <form id="login" name="login" action="/user/loginConfirm/<?php echo $url ?>" method="post">
                <div class="form-group">
                    <?php Form::Input( 'email', $validations['email'], 'email' ); ?>
                </div>
                <div class="form-group">
                    <?php Form::Input( 'password', $validations[ 'password' ], 'password' ) ?>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                    <a class="btn btn-primary" href="/user/register">Inscription</a>
                </div>
            <form>
        </div>
    </div>
</div>

<?php 
$this->section[ "scripts" ] = 
'
    <script>
        $("#login").validate({ lang: \'fr\' });
    </script>
'; 
?>
