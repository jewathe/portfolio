<?php
require_once "db_pdo.php";
require_once "view/adminwebpage.php";

class admin
{
    static public function login($errMsg = "")
    {
        $pageData = DEFAULT_PAGE_DATA;

        $pageData['content'] = <<<HTML
         <div id="login">
         <main class="contact">
            <form action="index.php" method="POST" id="form_id">
                <fieldset>
                    <legend>Connectez-vous</legend>
           
           <div> <input type="hidden" name="op" value="222"></div>
            <div><input type="hidden" name="form_id" value="login_form"></div>
            <div><label>Email</label><input type="email" name="email"  required placeholder="Email" size="30" autofocus /></div>
            <div><label>Mot de passe</label><input type="password" name="pw"  required  size="30" ></div>
    <div class="errMsg">{$errMsg}</div>
        </fieldset>
          <div>  <button>Continuez</button>
            <button type="button" onclick="history.back();">Annuler</button>
    </div>
    
        </form>
    </main>
    </div>
  HTML;

        $pageData['title'] = "Page de connexion";
        webpage::render($pageData);
    }

    static public function updateCarousel($errMsg)
    {
        $content = '<main class="home">
        <div id="slider">
       
        </div>
        <div id="services-container">
        <div>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <legend>Modifier image du carousel</legend>
                <div>
                    <input type="hidden" name="op" value="19">
                </div>
                <div>
                    <label>Image 1</label> <input type="file" name="image1"/>
                </div>
                <div>
                    <label>Image 2</label> <input type="file" name="image2"/>
                </div>
                <div>
                    <label>Image 3</label> <input type="file" name="image3"/>
                </div>
                <div>
                    <label>Image 4</label> <input type="file" name="image4"/>
                </div>
                <div>
                    <label>Image 5</label> <input type="file" name="image5"/>
                </div>
                <div>
                    <input type="submit" value="Soumettre"><label>' . $errMsg .
            '</label>
                </div>
            </form>
        </div><div>
            <form method="post" action="index.php">
                <legend>Modifier les articles de la page d\'accueil</legend>
                <div>
                    <input type="hidden"  name="op" value="20">
                </div>
                <div>
                    <input type="text" name="title" placeholder="Titre">
                </div>
                <div>
                    <textarea name="article" placeholder="section"></textarea>
                </div>

                <div>
                    <input type="submit" value="Soumettre">
                </div>
            </form>
            </div>
            </div>
           </main>';
        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['content'] = $content;
        $pageData['title'] = "Modifier image de la carroussel";
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    static public function updateCarouselVerify()
    {
        $errMsg = admin::picture_Uploaded_Save_File('image1', 'images/slides/');
        if ($errMsg == 'OK') {
            $errMsg = admin::picture_Uploaded_Save_File('image2', 'images/slides/');
        }
        if ($errMsg == 'OK') {
            $errMsg = admin::picture_Uploaded_Save_File('image3', 'images/slides/');
        }
        if ($errMsg == 'OK') {
            $errMsg = admin::picture_Uploaded_Save_File('image4', 'images/slides/');
        }
        if ($errMsg == 'OK') {
            $errMsg = admin::picture_Uploaded_Save_File('image5', 'images/slides/');
        }
        $DB = new db_pdo();
        $DB->connect();
        $id = 1;
        $image1=$_FILES['image1']['name'];
        $image2=$_FILES['image2']['name'];
        $image3=$_FILES['image3']['name'];
        $image4=$_FILES['image4']['name'];
        $image5=$_FILES['image5']['name'];
        $params = [
            $image1,
            $image2,
            $image3,
            $image4,
            $image5,
            $id
        ];

        $sql = "UPDATE carousel SET image1 = ?, image2 = ?, image3 = ?,image4= ?,image5= ? WHERE id=? ";
        $res = $DB->queryParams($sql, $params);
        if ($res === '') {
            $errMsg = "Modification  non réussie";
        }
        admin::updateCarousel($errMsg);
    }
    static public function updateHomeArticle($errMsg)
    {
        $content = '<main class="home">
       <div id="slider">
       
        </div>
        <div id="services-container">
        <div>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <legend>Modifier image du carousel</legend>
                <div>
                    <input type="hidden" name="op" value="19">
                </div>
                <div>
                    <label>Image 1</label> <input type="file"/>
                </div>
                <div>
                    <label>Image 2</label> <input type="file"/>
                </div>
                <div>
                    <label>Image 3</label> <input type="file"/>
                </div>
                <div>
                    <label>Image 4</label> <input type="file"/>
                </div>
                <div>
                    <label>Image 5</label> <input type="file">
                </div>
                <div>
                    <input type="submit" value="Soumettre"><label>
                </div>
            </form>
        </div><div>
            <form method="post" action="index.php">
                <legend>Modifier les articles de la page d\'accueil</legend>
                <div>
                    <input type="hidden" name="op" value="20">
                </div>
                <div>
                    <input type="text" name="title" placeholder="Titre">
                </div>
                <div>
                    <textarea name="article" placeholder="section"></textarea>
                </div>

                <div>
                    <input type="submit" value="Soumettre"><label>' . $errMsg . '</label>
                </div>
            </form>
            </div>
            </div>
           </main>';
        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['content'] = $content;
        $pageData['title'] = "Modifier article d'Accueil";
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    static public function updateHomeArticleVerify()
    {

        $errMsg = '';
        $title = admin::checkInput('title');
        $article = admin::checkInput('article');
        if ($title == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($article == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($errMsg != '') {
            //réafficher le formulaire s'il y a eu des erreurs
            admin::updateHomeArticle($errMsg);
        }

        $DB = new db_pdo();
        $DB->connect();


        //version avec requête paramétrée
        $id = 1;
        $params = [
            $title,
            $article,
            $id = 1
        ];

        $sql = "UPDATE welcome SET title = ?, article = ? WHERE id=? ";
        $res = $DB->queryParams($sql, $params);
        if ($res === '') {
            $errMsg = "Modification  non réussie";
        } else {
            $errMsg = "Modification  réussie";
        }
        admin::updateHomeArticle($errMsg);
    }

    static public function updateAbout($errMsg)
    {
        $content = '<main class="home"><div id="services-container">
        <form method="post" action="index.php">
            <legend>Modifier les articles de la page d\'&agrave; propos</legend>
            <div>
                <input type="hidden" name="op" value="21">
            </div>
            <div>
                <input type="text" name="title1" placeholder="Titre">
            </div>
            <div>
                <textarea name="article1" placeholder="section 1"></textarea>
            </div>
            <div>
                <input type="text" name="title2" placeholder="Titre">
            </div>
            <div>
                <textarea name="article2" placeholder="section 2"></textarea>
            </div>

            <div>
                <input type="submit" value="Soumettre"><label>' . $errMsg . '</label>
            </div>

        </form>
    </div>
    </div>
</main>';
        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['content'] = $content;
        $pageData['title'] = "Modifier article d'accueil";
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    static public function updateAboutVerify()
    {

        $errMsg = '';
        $title1 = admin::checkInput('title1');
        $article1 = admin::checkInput('article1');
        $title2 = admin::checkInput('title2');
        $article2 = admin::checkInput('article2');
        if ($title1 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($article1 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($title2 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($article2 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($errMsg != '') {
            //réafficher le formulaire s'il y a eu des erreurs
            admin::updateAbout($errMsg);
        }

        $DB = new db_pdo();
        $DB->connect();


        //version avec requête paramétrée
        $id = 1;
        $params = [
            $title1,
            $title2,
            $article1,
            $article2,
            $id
        ];

        $sql = "UPDATE about SET title1 = ?, title2 = ?, article1 = ?,article2= ? WHERE id=? ";
        $res = $DB->queryParams($sql, $params);
        if ($res === '') {
            $errMsg = "Modification  non réussie";
        } else {
            $errMsg = "Modification  réussie";
        }
        admin::updateAbout($errMsg);
    }

    static public function updateOtha($errMsg)
    {
        $content = '<main class="home"><div id="services-container">
        <form method="post" action="index.php">
            <legend>Modifier les articles de la page d\'&agrave; propos</legend>
            <div>
                <input type="hidden" name="op" value="24">
            </div>
            <div>
                <input type="text" name="title1" placeholder="Titre">
            </div>
            <div>
                <textarea name="article1" placeholder="section 1"></textarea>
            </div>
            <div>
                <input type="text" name="title2" placeholder="Titre">
            </div>
            <div>
                <textarea name="article2" placeholder="section 2"></textarea>
            </div>

            <div>
                <input type="submit" value="Soumettre"><label>' . $errMsg . '</label>
            </div>

        </form>
    </div>
    </div>
</main>';
        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['content'] = $content;
        $pageData['title'] = "Modifier article d'OTHA";
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    static public function updateOthaVerify()
    {
        $errMsg = '';
        $title1 = admin::checkInput('title1');
        $article1 = admin::checkInput('article1');
        $title2 = admin::checkInput('title2');
        $article2 = admin::checkInput('article2');
        if ($title1 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($article1 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($title2 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($article2 == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($errMsg != '') {
            //réafficher le formulaire s'il y a eu des erreurs
            admin::updateOtha($errMsg);
        }

        $DB = new db_pdo();
        $DB->connect();
        //version avec requête paramétrée
        $id = 1;
        $params = [
            $title1,
            $title2,
            $article1,
            $article2,
            $id
        ];
        $sql = "UPDATE otha SET title1 = ?, title2 = ?, article1 = ?,article2= ? WHERE id=? ";
        $res = $DB->queryParams($sql, $params);
        if ($res === '') {
            $errMsg = "Modification  non réussie";
        } else {
            $errMsg = "Modification  réussie";
        }
        admin::updateOtha($errMsg);
    }
    static public function addUser($errMsg)
    {
        $content = <<<HTML
        </header>
        <main class="contact">
            <form method="POST" action="index.php">
            <div> <input type="hidden" name="op" value="106"></div>
            <div>
                <label for="fullname">Nom</label>
                <input type="text" maxlength="50" name="fullname" id="fullname" placeholder="Nom" required autofocus>
            </div>
            <div>
                <label for="userEmail">Courriel</label>
                <input type="email" maxlength="100" name="userEmail" id="userEmail" placeholder="courriel@exemple.com" required>
            </div>
            <div>
                <label for="userEmailVerify">Vérifier Courriel</label>
                <input type="email" maxlength="100" name="userEmailVerify" id="userEmailVerify" placeholder="Vérifier courriel@exemple.com" required>
            </div>
            <div>
                <label for="userName">Nom d'utilisateur</label>
                <input type="text" maxlength="100" name="userName" id="userName" placeholder="Nom d'utilisateur" required>
            </div>
            <div>
                <label for="userPassword">Mot de passe</label>
                <input type="password" maxlength="100" name="userPassword" id="userPassword" placeholder="Mot de passe" required>
            </div>
            <div>
                <label for="sexe">Sexe:</label>
                <select id="sexe" name="sexe">
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                    <option value="autre">Autre</option>
                </select>
            </div>
            <div>
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="adm">Administrateur</option>
                    <option value="emp">Employé</option>
                </select>
            </div>
         <div>
            <input type="submit" value="Soumettre">
             <span class="confirm">{$errMsg}</span>
        </div>
        </form>
        </main>
        HTML;
        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['content'] = $content;
        $pageData['title'] = "Ajouter Utilisateur";
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    static public function addUserVerify()
    {
        $errMsg = '';
        $fullname = admin::checkInput('fullname');
        if ($fullname == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        $email = admin::checkInput('userEmail');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg .= 'Email format erroné. ';
        }
        if ($email == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        $email2 = admin::checkInput('userEmailVerify');
        if (!filter_var($email2, FILTER_VALIDATE_EMAIL)) {
            $errMsg .= 'Email format erroné. ';
        }
        if ($email !== $email2) {
            $errMsg .= 'Les 2 courriels ne sont pas identiques. ';
        }
        $username = admin::checkInput('userName');
        if ($username == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        $password = admin::checkInput('userPassword');
        if ($password == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        $sex = $_REQUEST['sexe'];
        if ($sex == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        $role = $_REQUEST['role'];
        if ($role == '') {
            $errMsg = 'Vous devez remplir tous les champs. ';
        }
        if ($errMsg !== '') {
            //réafficher le formulaire s'il y a eu des erreurs
            admin::addUser($errMsg);
        }
        $DB = new db_pdo();
        $DB->connect();
        $params = [
            'name' => $fullname,
            'email' => $email,
            'username' => $username,
            'password' => $password,
            'sex' => $sex,
            'role' => $role
        ];

        $DB->queryParams("INSERT INTO users (name,email,username,password,sex,role) VALUES (:name,:email,:username,:password,:sex,:role)", $params);
        if ($DB != null) {
            $errMsg = "Utilisateur ajouté";
        } else {
            $errMsg = "Utilisateur non ajouté";
        }
        admin::addUser($errMsg);
    }
    public static function users()
    {
        $erreMsg = ' ';
        $DB = new db_pdo();
        $DB->connect();
        // $sql = 'SELECT name,username,email FROM users';
        // $users = $DB->querySelect($sql);
        if (!isset($_POST['user'])) {
            $sql = 'SELECT id,name,username,email FROM users';
            $users = $DB->querySelect($sql);
        } else {
            $userEmail = $_POST['customer'];
            // $sql = "SELECT * FROM customers WHERE id=$customerNumber";
            $user = $DB->querySelectParams("SELECT id,name,username,email FROM customers WHERE email=?", [$userEmail]);
            // si aucun customer pour l'ID n'est dans la table on reaffiche la table et un message d'erreur est apparu
            if (count($user) == 0) {
                $erreMsg = "Invalid user 's email";
                //on demande tous les clients
                $sql = 'SELECT id,name,username,email FROM users';
                $users = $DB->querySelect($sql);
            }
        }

        // formulaire pour rechercher un client si la liste des clients est affiche
        if (count($users) > 0) {
            $content = <<<HTML
           <main class="contact">
            <div id="list">
                <div>
            <h4>Liste d'Utilisateurs</h4>
        <form action="index.php" method="POST" id="search_id_form">
            <div id="err-msg">{$erreMsg} </div>
        <div> <input type="hidden" name="op" value="400"></div>
        <div><input type="hidden" name="search_id" value="search_id_form"></div>
        <div><label>Search for email</label><input type="email" maxlength="25" name="user" required placeholder="searched email" size="30" autofocus/>
        <button>Go</button><a href="index.php?op=107" class="list">Show all</a></div>
       </form>
        </div>
        </main>
       HTML;

            $tabRetourner = null;
            $tabRetourner = $content;
            if ($users === []) {
                $tabRetourner = null;
            } else {
                $tabRetourner .= '<div id="services-container"> <table id="custotab">';
                $tabRetourner .= '<tr>';
                foreach ($users as $one_users) {
                    foreach ($one_users as $key => $value) {

                        $tabRetourner .= '<th>' . $key . '</th>';
                    }
                    $tabRetourner .= '<th colspan="3">Options</th>';
                    break;
                }
                $tabRetourner .= '</tr>';
                foreach ($users as $one_user) {
                    $tabRetourner .= '<tr>';
                    foreach ($one_user as $key => $value) {
                        if ($key == 'id') {
                            $id = $value;
                            $tabRetourner .= '<td><a class="detail" value="' . $value . '" href="index.php?op=401&id=' . $value . '">' . $value . '</a></td>';
                        } else {
                            $tabRetourner .= '<td>' . $value . '</td>';
                        }
                    }
                    $tabRetourner .= '<td><a  href="index.php?op=121&id=' . $id . '" name="delete" id="delete" value="' . $value . '" class="delete">Delete</a></td>';
                    $tabRetourner .= '<td><a href="index.php?op=105" class="list">Add</a></td>';
                    $tabRetourner .=  '</tr>';
                }
                $tabRetourner .=  '</table></div>';

                $pageData = DEFAULT_PAGE_DATA;
                $pageData['content'] = $tabRetourner;
                $pageData['title'] = COMPANY_NAME . '- Liste d\'utilisateurs';
                $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
                adminwebpage::render($pageData);
            }
        }
    }
    public static function guests()
    {
        $erreMsg = ' ';
        $DB = new db_pdo();
        $DB->connect();
        $sql = 'SELECT * FROM guests';
        $guests = $DB->querySelect($sql);
        if (!isset($_POST['guest'])) {
            $sql = 'SELECT * FROM guests';
            $guests = $DB->querySelect($sql);
        } else {
            $guestEmail = $_POST['guest'];
            $guests = $DB->querySelectParams("SELECT * FROM guests WHERE email=?", [$guestEmail]);
            // si aucun guest pour l'ID n'est dans la table on reaffiche la table et un message d'erreur est apparu
            if (count($guests) == 0) {
                $erreMsg = "Invalid guests 's email";
                //on demande tous les clients
                $sql = 'SELECT * FROM guests';
                $guests = $DB->querySelect($sql);
            }
        }

        // formulaire pour rechercher un client si la liste des clients est affiche
        if (count($guests) > 0) {
            $content = <<<HTML
           <main class="contact">
            <div id="list">
                <div>
            <h4>Liste contacts</h4>
        <form action="index.php" method="POST" id="search_id_form">
            <div id="err-msg">{$erreMsg} </div>
        <div> <input type="hidden" name="op" value="100"></div>
        <div><input type="hidden" name="search_id" value="search_id_form"></div>
        <div><label>Search for email</label><input type="email" maxlength="25" name="guest" required placeholder="searched email" size="30" autofocus/>
        <button>Go</button><a href="index.php?op=100" class="list">Show all</a></div>
       </form>
        </div>
        </main>
       HTML;

            $tabRetourner = null;
            $tabRetourner = $content;
            if ($guests === []) {
                $tabRetourner = null;
            } else {
                $tabRetourner .= ' <div id="services-container"><table id="custotab">';
                $tabRetourner .= '<tr>';
                foreach ($guests as $one_users) {
                    foreach ($one_users as $key => $value) {

                        $tabRetourner .= '<th>' . $key . '</th>';
                    }
                    $tabRetourner .= '<th colspan="3">Options</th>';
                    break;
                }
                $tabRetourner .= '</tr>';
                foreach ($guests as $one_user) {
                    $tabRetourner .= '<tr>';
                    foreach ($one_user as $key => $value) {
                        if ($key == 'id') {
                            $id = $value;
                            $tabRetourner .= '<td><a class="detail" value="' . $value . '" href="index.php?op=401&id=' . $value . '">' . $value . '</a></td>';
                        } else {
                            $tabRetourner .= '<td>' . $value . '</td>';
                        }
                    }
                    $tabRetourner .= '<td><a href="index.php?op=101&id=' . $id . '" name="see" id="see" value="' . $value . '" class="detail">Detail</a></td>';
                    $tabRetourner .= '<td><a  href="index.php?op=102&id=' . $id . '" name="delete" id="delete" value="' . $value . '" class="delete">Delete</a></td>';
                    $tabRetourner .=  '</tr>';
                }
                $tabRetourner .=  '</table></div>';

                $pageData = DEFAULT_PAGE_DATA;
                $pageData['content'] = $tabRetourner;
                $pageData['title'] = COMPANY_NAME . '- Liste de contacts';
                $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
                adminwebpage::render($pageData);
            }
        }
    }
    public static function guest()
    {
        $erreMsg = ' ';
        $DB = new db_pdo();
        $DB->connect();
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];

            $guests = $DB->querySelectParams("SELECT * FROM guests WHERE id=?", [$id]);
            if (count($guests) == 0) {
                $erreMsg = "Invalid guest 's number";
                return $erreMsg;
            } else {
                foreach ($guests as $one_guest) {

                    $content = '<div id="services-container"><div id="detail">
                    <h3>Guest </h3>
                    
                    <div>
                    <label>Name: </label> <label>' . $one_guest['name'] . ' </label> 
                    </div>
                   
                    <div>
                    <label>Email: </label><label>' . $one_guest['email'] . ' </label> 
                    </div>
                    <div>
                    <label>Phone: </label><label>' . $one_guest['phone'] . ' </label> 
                    </div>
                    <div>
                    <label>Genre: </label><label>' . $one_guest['sex'] . ' </label> 
                    </div>
                    <div>
                    <label>Commentaire: </label><label>' . $one_guest['comment'] . ' </label> 
                    </div>
                    <div>
                    <label>Date: </label><label>' . $one_guest['date'] . ' </label> 
                    </div>
                   </div> </div>';
                }

                $pageData = DEFAULT_PAGE_DATA;
                $pageData['content'] =  $content;
                $pageData['title'] = COMPANY_NAME . '- Description par contact';
                $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
                adminwebpage::render($pageData);
            }
        } else {
            crash(404, 'Champs Id introuvable');
        }
    }
    static public function getSlide()
    {
        $DB = new db_pdo();
        $DB->connect();
        $images = $DB->querySelect("SELECT * FROM carousel");
        return $images;
    }

    static public function getHomeArticles()
    {
        $DB = new db_pdo();
        $DB->connect();
        $articles = $DB->querySelect("SELECT * FROM welcome");
        return $articles;
    }
    static public function getAboutArticles()
    {
        $DB = new db_pdo();
        $DB->connect();
        $articles = $DB->querySelect("SELECT * FROM about");
        return $articles;
    }
    static public function getOTHAArticles()
    {
        $DB = new db_pdo();
        $DB->connect();
        $articles = $DB->querySelect("SELECT * FROM otha");
        return $articles;
    }

    static public function loginVerify()
    {

        if (!isset($_REQUEST['form_id']) or $_REQUEST['form_id'] !== "login_form") {
            crash(400, "mauvais formulaire reçu");
        }

        // verifier Email
        $email = admin::checkInput("email");

        $errMsg = '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg = 'email format erroné';
            users::login($errMsg, $_REQUEST);
        }

        // verifer mot de passe
        $pw = admin::checkInput("pw");
        $DB = new db_pdo();
        $DB->connect();

        $users = $DB->querySelect("SELECT email,password FROM users WHERE email='$email' AND password='$pw'");
        // var_dump($users[0]['email']);
        if (count($users) > 0 and $users[0]['email'] !== null) {
            $pageData = DEFAULT_PAGE_DATA;
            $pageData['title'] = "Vous êtes connecté";
            $pageData['content'] = admin::updateCarousel('');
            session_start();
            $_SESSION['email'] = $email;
            webpage::render($pageData);
        }
        //reafficher le formulaire
        admin::login("Erreur, mauvais mot de passe et/ou email");
    }
    static public function deleteGuest()
    {

        $id = $_REQUEST['id'];
        $msg = '';
        $DB = new db_pdo();
        $DB->connect();
        $code = $DB->query("DELETE  FROM guests  WHERE id='$id'");
        $pageData['title'] = COMPANY_NAME . '- Page contact';
        $tabContent = admin::guests();
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = "Liste de contact";
        $pageData['content'] = $tabContent;
        webpage::render($pageData);
    }
    static public function deleteUser()
    {

        $id = $_REQUEST['id'];
        $msg = '';
        $DB = new db_pdo();
        $DB->connect();
        $code = $DB->query("DELETE  FROM users  WHERE id='$id'");
        $tabContent = admin::users();
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . '- Liste d\'utilisateurs';
        $pageData['nav'] = file_get_contents('view/sections/navadmin.php');
        adminwebpage::render($pageData);
    }
    public static function logout()
    {
        $_SESSION['email'] = null;
        header("location:index.php?op=2");
    }

    static public function checkInput($nomChamp)
    {
        if (!isset($_REQUEST[$nomChamp])) {
            crash(400,  $nomChamp . "  not found.");
        }

        if (isset($_REQUEST[$nomChamp]) && $_REQUEST[$nomChamp] !== '') {
            $valeur = htmlspecialchars($_REQUEST[$nomChamp]);
            return $valeur;
        } else {
            return '';
        }
    }
    static function picture_Uploaded_Save_File($file_input, $target_dir)
    {
        $message = admin::picture_Uploaded_Is_Valid($file_input); // voir fonction
        if ($message === 'OK') {
            $target_file = $target_dir . basename($_FILES[$file_input]['name']);
            if (file_exists($target_file)) {
                return 'This file already exists';
            }

            // Create the file with move_uploaded_file()
            if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $target_file)) {
                return 'OK';
            } else {
                return 'Error in move_upload_file';
            }
        } else {
            // upload error, invalid image or file too big
            return $message;
        }
    }
    static function picture_Uploaded_Is_Valid($file_input)
    {
        //Form must have <form enctype="multipart/form-data" ..
        //otherwise $_FILE is undefined
        // $file_input is the file input name on the HTML form
        if (!isset($_FILES[$file_input])) {
            return 'No image uploaded';
        }

        //check for upload error
        if ($_FILES[$file_input]['error'] != UPLOAD_ERR_OK) {
            return 'Error picture upload: code=' . $_FILES[$file_input]['error'];
        }


        // Check that file actually contains an image
        $check = getimagesize($_FILES[$file_input]['tmp_name']);
        if ($check === false) {
            return 'This file is not an image';
        }

        // Check extension is jpg,JPG,gif,png
        $filePathArray = pathinfo($_FILES[$file_input]['name']);
        $fileExtension = $filePathArray['extension'];
        if ($fileExtension != 'jpg' && $fileExtension != 'JPG' && $fileExtension != 'gif' && $fileExtension != 'png'&& $fileExtension != 'PNG') {
            return 'Invalid image file type, valid extensions are: .jpg .JPG .gif .png';
        }

        return 'OK';
    }
}
