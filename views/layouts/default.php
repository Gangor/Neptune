<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" type="image/png" href="./favicon.png">

    <title>Neptune - <?php echo $title ?></title>

    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <!-- Image and text -->
    <nav class="navbar navbar-expand-lg navbar-light">        
        <div class="collapse navbar-collapse navbar-left">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/Test/Index/1/Bonjour">Chambres</a>
                </li>
            </ul>
        </div>

        <a class="navbar-brand  navbar-collapse" href="/">
            <img src="/favicon.png" width="30px" height="30px" /> Neptune
        </a>
        
        <?php if ( !Session::Loggin() ) { ?>
        <ul class="navbar-nav  navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/User/Login">Se connecter</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/User/Register">Inscription</a>
            </li>
        </ul>
        <?php } else { ?>
        <ul class="navbar-nav  navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="/home/test"><?php echo $user->prenom.' '.$user->nom ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/logout">Déconnexion</a>
            </li>
        </ul>
        <?php } ?>
    </nav>

    <?php echo $this->section[ "body" ]; ?>
    
    <script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
</body>
</html>