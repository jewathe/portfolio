
<?php
/* Exercice 3-1b propriétés d'une compagnie */
define('COMPANY_NAME', 'Jean Waston Therane');
define('COMPANY_STREET_ADDRESS', 'Port-au-prince, Haiti');
define('COMPANY_CITY', 'Montréal');
define('COMPANY_PROVINCE', 'QC');
define('COMPANY_COUNTRY', 'Canada');
define('COMPANY_POSTAL_CODE', 'J0P 1T0');

define('COMPANY_TEL', '514-123-4567');
define('COMPANY_EMAIL', 'info@scooterelectrique.com');

define('VISITOR_LOG_FILE', 'visitors.log');

const DEFAULT_PAGE_DATA = [
    'lang' => 'fr-CA',
    'title' => 'Jean Waston Therane',
    'description' => 'Jean Waston Therane',
    'author' => 'Jean Waston Therane',
    'icon' => 'view/jean.PNG',
    'content' => 'ERREUR - CONTENU NON SPÉCIFIÉ',
    'compteVues' => null
];
const DEFAULT_PAGE_DATA_ADNIN = [
    'title' => 'Jean Waston Therane',
    'author' => 'Jean Waston Therane',
    'icon' => 'view/jean.PNG',
    'content' => 'ERREUR - CONTENU NON SPÉCIFIÉ',
];
