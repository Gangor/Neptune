<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-light">        
    <div class="collapse navbar-collapse navbar-left">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/room/index">Chambres</a>
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