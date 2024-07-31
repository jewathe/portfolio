<?php


session_start();
define("INDEX_LOADED", true); //indique que l'entrée du système a été franchie

require_once 'php/globals.php';
require_once 'php/tools.php';
//require_once 'view/webpage.php';
require_once 'php/contact.php';
//require_once 'php/admin.php';
//require_once 'view/manager/content.php';


function main()
{
    //lire code opération exemple index.php?op=10
    if (isset($_REQUEST['op'])) {
        $op = $_REQUEST['op'];
    } else {
        $op = 0; //home page par défaut
    }

    $pageData = DEFAULT_PAGE_DATA;
    setcookie('Timestamps_last_visit', date("d-m-y h:i:s"), time() + 300);
    switch ($op) {
        case 0:
            // HOME PAGE
            $article =  admin::getHomeArticles();
            $title1 = 'Jean Waston Therane';
            $content1 = '
                     <p> <img src="view/logo/super.jpg" alt="Photo Jean" class="super" />
                       Développeur web avec expérience de 2 ans, J’ai  complété mes études supérieures et reçu 
                       un diplôme de licence en sciences informatiques et un diplôme de master en système de gestion 
                       de base de données. Dans le but de faciliter mon intégration sur le marché du travail 
                       international, je suis entrain de compléter mes études en programmation et technologie 
                       Internet au collège universel. J’ai travaillé chez Smart Solutions and Services au poste 
                       de développeur web pendant 2 ans et j’ai développé le site  web de  optimiste+ . 
                       Je viens de remettre mon projet de fin d’études intitulé KIWI le 19 mai 2023, 
                       développé en JavaScript  avec REST API, pour environnement d’exécution j’ai utilisé 
                       Node avec le serveur Express, le système de gestion de base de données PostgreSQL et 
                       pour le Front-end, j’ai utilisé ReactJS,un projet de 2 mois,un mois d’analyse et un mois 
                       de développement avec la méthode SCRUM. Avec mes études et  mes expériences, je connais 
                       davantage le JavaScript et la Programmation Orienté Objet. Mon employeur et mes professeurs 
                       m’ont toujours félicité pour les travaux d’équipe de ma capacité d’analytique et logique et 
                       je me démarque toujours par mon sens d’innovation. Étant organisé, passionné de la 
                       programmation, avec mes expériences et les connaissances acquises de mes études, 
                       je serai capable d’acquitter à toute tâche qui me sera confiée.
                       ISIDrone, Une application Web qui fait la gestion de vente de Drones en ligne, developpé en Java,
                       avec MySQL comme Systeme de gestion de base de données, Apache Maven comme outil de gestion et de 
                       compréhension de projet logiciel, JSP pour l\'interface client. Pour ce travail on a utilisé la 
                       méthodologie Agile. Responsabilité: Analyser et s\'approprier le code source d\'une application 
                       déjà fonctionnelle qui m\' est inconnue. Corriger des problèmes de conflits lors de l\'utilisation 
                       de systèmes de gestion de codes sources. Lancer/récupérer des nouvelles versions compilées d\'une
                        application sur un environnement servant à effectuer des builds en continu dans le but de tester
                         la stabilité d\'une application. Déploiement d\'une nouvelle version d\'application sur un 
                         serveur web. Effectuer des tests de fonctionnalités dans le but de valider le bon fonctionnement
                          d\'une application.</p>
                       ';

            $images = admin::getSlide();
            $pageData['title'] = COMPANY_NAME . '  Acceuil';
            $pageData['content'] = datas::setAccueilConteneur($title1,  $content1, $images);
            $pageData['nav'] = file_get_contents('view/sections/nav.php');
            //affiche la page
            webpage::render($pageData);
            break;

        case 1:

            $articles =  admin::getAboutArticles();
            $title1 = $articles[0]['title1'];
            $title2 = $articles[0]['title2'];
            $article1 = $articles[0]['article1'];
            $article2 = $articles[0]['article2'];
            $pageData['title'] = COMPANY_NAME . '  &Agrave; propos';
            $pageData['content'] = datas::setConteneur($title1, $title2, $article1, $article2);
            webpage::render($pageData);
            break;

        case 2:
            admin::login();
            break;
        case 3:
            contacts::registerContact('');
            break;
        case 4:

            $articles =  admin::getOTHAArticles();
            $title1 = $articles[0]['title1'];
            $title2 = $articles[0]['title2'];
            $article1 = $articles[0]['article1'];
            $article2 = $articles[0]['article2'];
            $pageData['title'] = COMPANY_NAME . '  &Agrave; propos';
            $pageData['content'] = datas::setConteneur($title1, $title2, $article1, $article2);
            $pageData['title'] = COMPANY_NAME . '  &Agrave; propos OTHA';
            webpage::render($pageData);
            break;
        case 5:
            admin::logout();
            break;
        case 10:
            admin::updateCarousel('');
            break;
        case 11:
            admin::updateAbout('');
            break;
        case 12:
            admin::updateOtha('');
            break;
        case 19:
            admin::updateCarouselVerify();
            break;
        case 20:
            admin::updateHomeArticleVerify();
            break;
        case 21:
            admin::updateAboutVerify();
            break;
        case 24:
            admin::updateOthaVerify();
            break;
        case 50:
            // TÉLÉCHARGER
            // le type de fichier, dans ce cas PDF, voir lien ci-dessous pour autres types
            header('Content-Type: application/pdf');
            // le nom du fichier sera un_fichier.pdf, navigateur peut demander permission
            header('Content-Disposition: attachment; filename="CV_de_Jean_Waston_Therane.pdf"');
            // ok envoyer le fichier, lire et envoyer directement avec readfile()
            readfile('CV_Jean_Waston_Therane.pdf');
            break;
        case 51:
            // TÉLÉCHARGER
            // le type de fichier, dans ce cas PDF, voir lien ci-dessous pour autres types
            header('Content-Type: application/pdf');
            // le nom du fichier sera un_fichier.pdf, navigateur peut demander permission
            header('Content-Disposition: attachment; filename="RESUME_Jean_Waston_Therane.pdf"');
            // ok envoyer le fichier, lire et envoyer directement avec readfile()
            readfile('RESUME_Jean_Waston_Therane.pdf');
            break;
        case 60:
            $pageData['title'] = COMPANY_NAME . '  Projets';
            $pageData['content'] = file_get_contents('view/sections/projet.php');
            webpage::render($pageData);
            break;
        case 100:
            admin::guests();
            break;
        case 101:
            admin::guest();
            break;
        case 102:
            admin::deleteGuest();
            break;
        case 105:
            admin::addUser('');
        case 106:
            admin::addUserVerify();
            break;
        case 107:
            $tabContent = admin::users();
            break;
        case 121:
            admin::deleteUser();
            break;
        case 201:
            admin::guest();
            break;
        case 222:
            admin::loginVerify();
            break;
        case 410:
            contacts::registerContactVerify('');
            break;
        case 420:
            // HOME PAGE

            $title2 = 'Compétences techniques';
            $content2 = '<div id="list"> <table class="skill">
           
            <tbody>
                     <tr>
                     <th>
                     Base de données
                     </th>
                      <td>
                     C++, C#, JAVA, PHP, JavaScript, PHP, Android
                     </td>
                     </tr>
                     <tr>
                     <th>
                       Langages de programmations
                     </th>
                      <td>
                     C++, C#, JAVA, Android
                     </td>
                     </tr>
                    <tr>
                    <th>
                     Programmation web
                     </th>
                      <td>
                     ReactJS JSP, HTML, CSS,PHP, JavaScript
                     </td>
                    </tr>
                    <tr>
                     <th>
                     IDE
                     </th>
                     <td>
                     Eclipse,Visual Studio Code, Android studio,  Visual      Studio, Netbeans
                     </td>
                    </tr>
                    <tr>
                    <th>
                    Gestionnaire de versions
                     </th>
                     <td>
                     Github
                     </td>
                    </tr>
                     <tr>
                    <th>
                    Gestionnaire de dépendances
                     </th>
                     <td>
                     Maven, Gradle, NPM
                     </td>
                    </tr>
                    <tr>
                    <th>
                     Serveurs HTTP
                     </th>
                     <td>
                     Apache, Apache Tomcat, Express
                     </td>
                    </tr>
                    <tr>
                    <th>
                     Pattern de conception
                     </th>
                     <td>
                     MVC , Observer, Factory, Adapter
                     </td>
                    </tr>
                    <tr>
                     <th>
                    Environnement d\'éxécution
                     </th>
                   <td>
                    NodeJS
                     </td>
                    </tr>
                    </tbody>
            </table></div>';
            $images = admin::getSlide();
            $pageData['title'] = COMPANY_NAME . '  Competences techniques';
            $pageData['content'] =
                '<main class="home">
              
              </div>
              <div id="services-container">
                <div class="services-element">
                <article>
                  <h1>' . $title2 . '</h1>
                  ' . $content2 . '
                </article>
                
           </div>
         </div>
        </main>';
            $pageData['nav'] = file_get_contents('view/sections/nav.php');
            //affiche la page
            webpage::render($pageData);
            break;
        default:
            crash(404, "Opération invalide dans index.php");
            break;
    }
}
//démarrage du programme
main();
