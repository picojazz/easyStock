
    <?php if(isset($_GET['sign']) && ($_GET['sign'] == "ok")) {  ?>
    <p class="alert success"><span class="closebtn">&times</span>Inscription Reussie</p>
    <?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) {  ?>
   <p class="alert error"><span class="closebtn">&times</span>Echec d'authentification !!!  login ou mot de passe ou privilege incorrect</p>
    <?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) {  ?>
    <p class="alert success"><span class="closebtn">&times</span>Déconnexion réussie... A bientôt <?php echo $_GET['prenom'];?> !</p>
    <?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) {  ?>
    <p class="alert error"><span class="closebtn">&times</span>Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page</p>
    <?php } ?>

    <?php if(isset($_GET['sign']) && ($_GET['sign'] == "in")) {  ?>
    <p class="alert success"><span class="closebtn">&times</span>Connexion reussie ! bienvenue <?php echo $_SESSION['prenom'];?> </p>
    <?php } ?>
    <?php if(isset($_GET['sign']) && ($_GET['sign'] == "no")) {  ?>
    <p class="alert error"><span class="closebtn">&times</span>Echec de l'inscription </p>
    <?php } ?>