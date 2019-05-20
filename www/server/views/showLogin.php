<!--
Titre : Page de connexion
Date : 8 mai 2019
Auteur : Romain Peretti
Version : 1.0
Description : La vue de la page connexion contenant un formulaire
-->
<!DOCTYPE html>
<html>

<head>
    <?php include_once '../inc/head.php'; ?>
</head>

<body>
    <div class='container col-md-12'>
        <div class='row'>
            <?php include_once '../inc/navbar.php'; ?>
        </div>
        <div class='row justify-content-center'>
            <div class='col-md-6'>
                <form class='m-2'>
                    <div class='form-group'>
                        <label for='email'>Adresse email</label>
                        <input type='email' class='form-control my-input' id='email' placeholder='Entrez un email valide'>
                    </div>
                    <div class='form-group'>
                        <label for='password'>Mot de passe</label>
                        <input type='password' class='form-control my-input' id='password'>
                    </div>
                    <div class='form-group'>
                        <small><a href='../controllers/signIn.php'>Pas encore de compte ?</a></small>
                    </div>
                    <button type='submit' class='btn btn-outline-primary my-btn' id='send'>Connexion</button>
                </form>
            </div>
        </div>
        <div class='row'>
            <?php include_once '../inc/footer.php'; ?>
        </div>
    </div>

</body>
<script>
    const VALIDATE_URL = '../ajax/validateLogin.php';
    const ON_SUCCESS_URL = '../controllers/home.php';
    $(document).ready(function() {
        $('#send').click(validateLogin)
    });

    /**
     * Call-back lorsqu'on clique sur le bouton de connexion 
     */
    function validateLogin(event) {
        // Prevent form submission
        if (event) {
            event.preventDefault();
        }
        //Récupération de l'email
        var email = $('#email').val();

        //Récupération du mot de passe
        var password = $('#password').val();

        // Tests sur les champs du formulaire
        if (email.length == 0) {
            $('#email').focus(); // Met le focus sur le champ email

            return;
        }
        if (password.length == 0) {
            $('#password').focus(); // Met le focus sur le champ password

            return;
        }

        $.ajax({
            method: 'POST',
            url: VALIDATE_URL,
            data: {
                'email': email,
                'password': password
            },
            dataType: 'json',
            success: function(data) {
                switch (data.ReturnCode) {
                    case 0:
                        swal('Mauvais email ou mot de passe', '', 'error')
                        break;
                    case 1:
                        swal('Mauvais email ou mot de passe', '', 'error')
                        break;
                    case 2:
                        location.href = ON_SUCCESS_URL;
                        break;
                }
            }, // #end success
            error: function(jqXHR) {
                msg = 'Une erreur est survenue : ';
                switch (jqXHR.status) {
                    case 200:
                        msg = msg + jqXHR.status + ' json invalide.'
                        break;
                    case 404:
                        msg = msg + jqXHR.status + ' page introuvable.'
                        break;
                }
            } // #end error
        });
    }
</script>

</html>