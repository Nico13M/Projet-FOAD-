
<?php
require_once 'inc/functions.php';
require_once 'inc/db.php';

if (!empty($_POST)) {
    $errors = array();

    if (empty($_POST['Username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['Username'])) {
        $errors['Username'] = "Vous pseudo n'est pas valide (alphanuméric)";

    } else {
        $req = $pdo->prepare('SELECT id FROM UtilisateurConnecte WHERE Username= ?');
        $req -> execute([$_POST['Username']]);
        $user = $req->fetch();
        if($user) {
            $errors['Username'] ='Ce pseudo est déja pris';
        }
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";

    } else {
        $req = $pdo->prepare('SELECT id FROM UtilisateurConnecte WHERE email= ?');
        $req -> execute([$_POST['email']]);
        $user = $req->fetch();
        if($user) {
            $errors['email'] ='Cet email est déja pris';
        }
    }

    if(empty($_POST['password']) || $_POST['password']!= $_POST['confirm_password']) {
        $errors['password'] = "Vous devez rentrer un mot de passe valide";
    }

    if(empty($errors)) {

        $req = $pdo->prepare("INSERT INTO UtilisateurConnecte SET username = ? , password  = ? , email= ?, confirmation_token= ? ");
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = str_random(60);

        $req->execute([$_POST['Username'], $password , $_POST['email'], $token]);
        $user_id = $pdo ->lastInsertId();
        mail($_POST['email'], "Confirmation de votre compte", "afin de valider votre compte, merci de cliquer sur ce lien \n \n http://localhost:8888/confirm.php?id=$user_id&token=$token");
header('location: login.php');
exit();
    }
    debug($errors);
}


require_once './php/head.php';
?>
   </head>
  <?php if(!empty($errors)): ?>
    <div class="alert" style="background-color:#eb7366">
      <p>
        Vous n'avez pas rempli le formulaire correctement
      </p>
      <ul>
        <?php foreach($errors as $error): ?>
          <li><?= $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php endif; ?>

  <body>
    <div class="flex justify-center items-center flex-col mb-6">
      <h1 class="font-bold text-7xl small-h1">Inscription</h1>
        <div class="md:w-1/2 text-center text-lg">
      <p>
        Vous souhaitez vous inscrire à une formation à Mode83 ?
        Voici le formulaire que vous devez remplir.

        Si vous voulez avoir accès uniquement à notre newsletters cliquez 
        <a href="../inc/newsletters.php" class="no-underline  border-blue text-red-500">Ici</a>
      </p>
        </div>
    </div>
    <div class="flex flex-row space-x-10 justify-center">
      <!-- formulaire inscription -->
          <!-- debut form  -->
          <div class="flex flex-col bg-white border border-gray-300 p-6 rounded-lg shadow-md">
            <form action="" method="POST" class="w-full">
              <div class="flex flex-wrap -mx-3 ">
                <!-- prenom -->

                <div class="small md:w-1/2 px-3 mb-6 md:mb-0">
                  <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-first-name"
                  >
                    Prenom
                  </label>

                  <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-first-name"
                    type="text"
                    placeholder="Jane"
                    name = "Username"

                  />
                </div>

                <!-- nom -->

              </div>

              <!-- email -->

              <div class="mb-6">
                <label
                  for="email"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Email address</label
                >

                <input
                  type="email"
                  id="email"
                  class="bg-gray-200 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="john.doe@company.com"
                  name="email"

                />
              </div>

              <!-- mdp -->

              <div class="flex flex-wrap -mx-3 mb-">
                <div class="w-full px-3">
                  <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-password"
                  >
                    Mot de passe
                  </label>

                  <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password"
                    type="password"
                    placeholder="******"
                    name="password"

                  />
                </div>
              </div>
              <div class="flex flex-wrap -mx-3 mb-">
                <div class="w-full px-3">
                  <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-password"
                  >
                    Confirmez votre Mot de passe
                  </label>

                  <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password"
                    type="password"
                    placeholder="******"
                    name="confirm_password"

                  />
                </div>
              </div>

              <!-- genre et date de naissance -->

             
              <!-- submit -->

              <button
                style="background-color: #eb7366"
                type="submit"
                class="w-full text-center py-3 rounded text-white hover:bg-green-dark focus:outline-none my-1"
                
              >
                Continuer
              </button>
            </form>

            <!-- conditions -->

            <div class="text-center text-sm text-grey-dark mt-4">
            En vous inscrivant vous acceptez les


              <a
                class="no-underline border-b border-grey-dark text-red-500"
                href="#"
              >
                Conditions d'utilisation 
              </a>

              et les

              <a
                class="no-underline border-b border-grey-dark text-red-500"
                href="#"
              >
              politiques de confidentialité
              </a>
            </div>

            <!-- loggin -->

            <div class="text-grey-dark mt-6 mx-auto">
            Vous avez déjà un compte ?

              <a
                class="no-underline border-b border-blue text-red-500"
                href="../inc/login.php"
              >
                Connexion </a
              >.
            </div>
          </div>
        </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
  </body>
</html>
