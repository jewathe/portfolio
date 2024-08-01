<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width-device-width, initial-scale=1.0">
  <title>Responsive Portfolio Website</title>
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  <header class="header">
    <a href="#home" class="logo">Jean Waston
      <span>Therane</span></a>

    <i class='bx bx-menu' id="menu-icon"></i>

    <nav class="navbar">
      <a href="#home" class="active">Home</a>
      <a href="#education">Education</a>
      <a href="#services">Servces</a>

    </nav>
  </header>
  <section class="home" id="home">
    <div class="home-content">
      <h1>Hello, je suis <span>Jean</span></h1>
      <h6 class="text-animation">Je suis un<span> </span></h6>
      <p>
        Développeur Full Stack passionné par la création d'applications web robustes et évolutives.
        Expertise en technologies front-end et back-end telles que HTML, CSS, JavaScript (React, Angular), Express,
        Node.js, Spring Boot, PHP, Java, et SQL. Approche rigoureuse incluant l'utilisation de systèmes de contrôle
        de version comme Git, des méthodologies agiles, et des pratiques de tests approfondis.
      </p>

      <div class="social-icons">
        <a href="https://www.linkedin.com/in/jean-therane-analyst-programmer/"><i class='bx bxl-linkedin'></i></a>
        <a href="#"><i class='bx bxl-github'></i></box-icon></a>
        <a href="#"><i class='bx bxl-twitter'></i></box-icon></a>
      </div>
      <!--
      <div class="btn-group">
        <a href="#" class="btn">Hire</a>
        <a href="#contact" class="btn">Contact</a>
      </div>
      -->
    </div>
    <div class="home-img">
      <img src="image.png" alt="image">
    </div>
  </section>
  <section class="education" id="education">
    <h2 class="heading">&Eacute;ducation</h2>
    <div class="timeline-items">

      <div class="timeline-item">
        <!--<div class="timeline-dot"></div>-->
        <div class="timeline-date">2023</div>

        <div class="timeline-content">
          <h3>Programmation et Technologies d'Internet - dipl&ocirc;me AEC -Collège Universel -Montréal</h3>

          <p>Un programme dans lequel j'ai appris les recentes technologies de d'Internet
            et j'ai pu developper beaucoup d'application Web avec les frameworks modernes.

            Formation de janvier 2022 - janvier 2024.
          </p>
        </div>
      </div>


      <div class="timeline-item">
        <!--<div class="timeline-dot"></div>-->
        <div class="timeline-date">2014</div>

        <div class="timeline-content">
          <h3>Sciences informatiques - dipl&ocirc;me de Master -&Eacute;cole supérieur d'Infotronique d'Haiti</h3>
          <p> Formations universitaire.
            De septembre 2013 - juillet 2014
          </p>
        </div>
      </div>


      <div class="timeline-item">
        <!--<div class="timeline-dot"></div>-->
        <div class="timeline-date">2013</div>
        <div class="timeline-content">
          <h3>Sciences informatiques - dipl&ocirc;me de Licence -&Eacute;cole supérieur d'Infotronique d'Haiti</h3>

          <p> Formation universitaire.
            De octobre 2009 - juillet 2013.
          </p>
        </div>
      </div>

    </div>
  </section>
  <section class="services" id="services">
    <h2 class="heading">Services</h2>
    <div class="services-container">
      <div class="service-box">
        <div class="service-info">
          <h4>Développeur UI</h4>
          <p> Conception et Développement d'Interfaces Utilisateur (UI)
            Création d'Interfaces Intuitives et Esthétiques : Utilisation de
            technologies front-end telles que HTML, CSS, SCSS, Bootstrap et JavaScript (React, Angular)
            pour concevoir des interfaces utilisateur attractives et faciles à naviguer.
            <a href="#" class="plus"><i class='bx bxl-github'></i></box-icon></i></a>
          </p>

        </div>
      </div>
      <div class="service-box">
        <div class="service-info">
          <h4>Développeur Front-end</h4>
          <p>
            1.Développement d'Interfaces Réactives : Frameworks modernes
            comme React, Angular pour développer des interfaces réactives et
            dynamiques qui fonctionnent sur divers appareils et résolutions d'écran.
            2. Intégration des APIs et Services Backend
            Connexion avec les APIs : Intégration des services backend via des APIs RESTful
            pour assurer une communication efficace entre le front-end et le back-end.
            Gestion des États : bibliothèques de gestion des états comme Hooks
            pour maintenir l'état de l'application de manière prévisible et scalable.
            <a href="#" class="plus"><i class='bx bxl-github'></i></box-icon></i></a>
          </p>

        </div>
      </div>
      <div class="service-box">
        <div class="service-info">
          <h4>Développeur Back-end</h4>
          <p> Conception et Développement de Systèmes Backend
            Développement de Serveurs et d'API : Conception et développement de serveurs
            robustes et d'API RESTful en utilisant des technologies telles que Node.js,
            Express, et Spring Boot.
            Gestion de Bases de Données : Conception et gestion de bases de données
            relationnelles (MySQL, PostgreSQL, SQL Server) et non relationnelles pour
            garantir la fiabilité et la performance des applications.
            <a href="#" class="plus"><i class='bx bxl-github'></i></box-icon></i></a>
          </p>

        </div>
      </div>
      <div class="service-box">
        <div class="service-info">
          <h4>Tests et QA de Logiciel</h4>
          <p>
            Tests Unitaires et Intégration : Écriture et exécution de tests unitaires et d'intégration
            en utilisant des frameworks comme Jest, Mocha, et Cypress pour garantir la qualité et la
            fiabilité des applications.
            Débogage et Résolution de Problèmes : Utilisation d'outils de débogage et d'inspection tels
            que Chrome DevTools pour identifier et corriger rapidement les bugs et les problèmes de performance.
            <a href="#" class="plus"><i class='bx bxl-github'></i></box-icon></i></a>
          </p>


        </div>
      </div>
    </div>
  </section>
  <footer class="footer">
    <div class="social">
      <a href="https://www.linkedin.com/in/jean-therane-analyst-programmer/"><i class='bx bxl-linkedin'></i></a>
      <a href="#"><i class='bx bxl-github'></i></box-icon></a>
      <a href="#"><i class='bx bxl-twitter'></i></box-icon></a>
    </div>
    <ul>
      <li>Email: jewathe@gmail.com</li>
      <li>Phone: (418) 655 2586</li>
    </ul>
    <p class="copyright">
      &copy; Jean Therane | Tout droit r&eacute;serv&eacute;
    </p>
  </footer>
  <script src="script.js"></script>
</body>

</html>