<?php
require_once "db_pdo.php";
class contacts
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    static public function registerContact($errMsg)
    {
        $content = <<<HTML
        </header>
        <main class="contact">
            <form method="POST" action="index.php">
                <fieldset>
            <legend>Vous êtes</legend>
            <div> <input type="hidden" name="op" value="410"></div>
            <div>
                <label for="fullname">Nom</label>
                <input type="text" maxlength="50" name="fullname" id="fullname" placeholder="Nom" required autofocus>
            </div>
           
            <div>
                <label for="userPhone">Téléphone</label>
                <input type="text" name="userPhone" id="userPhone" placeholder="514-888-9999" pattern="^\(?\d{3}\)?(-| )?\d{3}(-| )?\d{4}$">
            </div>

            <div>
                <label for="userEmail">Courriel</label>
                <input type="email" maxlength="100" name="userEmail" id="userEmail" placeholder="courriel@exemple.com" required>
            </div>
            <div>
                <label for="userEmailVerify">Vérifier Courriel</label>
                <input type="email" maxlength="100" name="userEmailVerify" id="userEmailVerify" placeholder="Vérifier courriel@exemple.com" required>
            </div>
        </fieldset>
                 <fieldset>
            <legend>Écrivez nous</legend>
            <div>
                <textarea name="commentaire" id="commentaire" placeholder="votre commentaire"></textarea>
            </div>
            
        </fieldset>
        
         <div>
            <input type="submit" value="Soumettre">
             <span class="confirm">{$errMsg}</span>
        </div>
        </form>
        </main>
        HTML;

        // afficher la page
        $pageData = DEFAULT_PAGE_DATA;
        $pageData['title'] = COMPANY_NAME . ' Contactez-nous';
        $pageData['content'] = $content;
        webpage::render($pageData);
    }

    /**
     * verifie formulaire inscription
     */
    static public function registerContactVerify()
    {
        $fullname = checkInput('fullname', 50, true);
        $sexe = 'inconnu';

        //email
        $email = checkInput('userEmail', 126, true);
        $errMsg = '';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errMsg .= 'Email format erroné. ';
        }
        $email2 = $email;
        //le phone
        $phone = $_REQUEST["userPhone"];

        $commentaire = $_REQUEST['commentaire'];

        if ($errMsg !== '') {
            //réafficher le formulaire s'il y a eu des erreurs
            //users::registerContact($errMsg);
        }

        $DB = new db_pdo();
        $DB->connect();


        //version avec requête paramétrée

        $params = [
            'name' => $fullname,
            'sex' => $sexe,
            'phone' => $phone,
            'email' => $email,
            'comment' => $commentaire
        ];

        $DB->queryParams("INSERT INTO guests (name,sex,phone,email,comment) VALUES (:name,:sex,:phone,:email,:comment)", $params);
        if ($DB != null) {
            $errMsg = "Message envoyé";
        } else {
            $errMsg = "Message non envoyé";
        }
        contacts::registerContact($errMsg);
    }
}
