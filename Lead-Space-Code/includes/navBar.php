<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary bgNavBar">
  <div class="container-fluid">
    <h1 class="navbar-brand navTitle" >👽 Lead Space Code 🛸</h1>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Accueil</a>
        </li>
        <!-- Création d'une liste por les cathégories -->
        <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Outils: 
                </a>
                <ul class="dropdown-menu outils" aria-labelledby="navbarDropdown">
                  <li class="textOutils"><a class="dropdown-item colorOutils" href="http://urllite.devpeyroteric.fr/" target="_blank">Réducteur de lien</a></li>
                </ul>
              </li>
        <!-- Condition d'affichage en fonction de connecter ou non -->
        <?php
          if(isset($_SESSION['auth'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="edit-question.php">Publier une question? </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="edit-article.php">Publier un article? </a>
              </li>
              <!-- Profile & logout -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Mon espace: 
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="user-question.php">Mes questions</a></li>
                  <li><a class="dropdown-item" href="user-article.php">Mes articles</a></li>
                  <li><a class="dropdown-item" href="profil.php?id=<?= $_SESSION['id']?>">Profile</a></li>
                  <li><a class="dropdown-item" href="actions/connection/logoutAction.php">Déconnexion</a></li>
                </ul>
              </li>
            </ul>
            <?php
          }else{
            ?>
                <!--  Lien pour la connection -->
                <li class="nav-item">
                  <a class="nav-link" href="edit-question.php">Connexion </a>
                </li>
                <!--  Lien poru créer un compte  -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="edit-question.php">Inscription  </a>
                </li> -->
              </ul>
            <?php
          }
         ?>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form> -->
    </div>
  </div>
</nav>