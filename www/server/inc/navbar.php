<!--
Titre : Barre de navigation
Date : 9 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : Cette page permet l'affichage de la barre de navigation avec les possibilitées de se connecter, se déconnecter et s'inscrire qui apparaissent ou disparaissent suivant si on est connecté ou pas.
-->
<div class='col-md-12 p-0'>
    <nav class='navbar navbar-expand-lg navbar-dark my-navbar'>
        <a class='navbar-brand' href='../controllers/home.php'>Direct Prod</a>
        <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarText' aria-controls='navbarText' aria-expanded='false' aria-label='Toggle navigation'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <div class='collapse navbar-collapse' id='navbarText'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='../controllers/home.php'><span class='fa fa-home'></span> Accueil</a>
                </li>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='../controllers/profil.php?email=<?= $_SESSION['email'] ?>'>
                        <span class='fa fa-user'></span> Profil
                    </a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '2') : ?>
                    <li class='nav-item'>
                        <a class='nav-link' href='../controllers/admin.php'>Administrateur</a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php if (isset($_SESSION['email'])) : ?>
                <span class='navbar-text'><a href='../controllers/logout.php' class='btn btn-outline-danger my-btn'>Déconnexion</a></span>
            <?php else : ?>
                <span class='navbar-text'><a href='../controllers/signIn.php' class='btn btn-outline-primary my-btn'>Inscription</a></span>
                <span class='navbar-text'><a href='../controllers/login.php' class='btn btn-outline-primary my-btn'>Connexion</a></span>
            <?php endif; ?>
        </div>
    </nav>
</div>