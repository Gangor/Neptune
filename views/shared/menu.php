<!-- Image and text -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMobile" aria-controls="navbarMobile" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/room/index">Chambres</a>
                </li>
            </ul>
        </div>

        <a class="navbar-brand mx-auto" href="/">
            <img src="/favicon.png" width="30px" height="30px" /> Neptune
        </a>
    
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav ml-auto">
            <?php if ( Session::Loggin() && $user->admin ) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    </ul>
                </li>
            <?php } ?>

            <?php if ( Session::Loggin() ) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Mon compte<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/manage/index">Paramètres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/logout">Déconnexion</a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/User/Login">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/User/Register">Inscription</a>
                </li>
            <?php } ?>
            </ul>
        </div>
        
        <div class="collapse" id="navbarMobile">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/room/index">Chambres</a>
                </li>
            </ul>
            <ul class="nav navbar-nav">
            <?php if ( Session::Loggin() && $user->admin ) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    </ul>
                </li>
            <?php } ?>

            <?php if ( Session::Loggin() ) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Mon compte<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="/manage/index">Paramètres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/user/logout">Déconnexion</a>
                        </li>
                    </ul>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="/User/Login">Se connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/User/Register">Inscription</a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</nav>