<?php
require_once  dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use App\Database;
use App\Personnes;

define('BASE_PATH', '');
define('SERVER_URI', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['REMOTE_PORT'] . BASE_PATH);

// pour initialiser altorouter
$router = new AltoRouter();
$router->setBasePath(BASE_PATH);


$router->map('GET|POST', '/ajouter', function () {

    session_start();
    $ajout = new \App\Personnes();
    $ajout->ajouts();
});
$router->map('GET|POST', '/pid', function () {
    session_start();
    $pid = new \App\Pid();
    $pid->ajoutsPid();
});

$router->map('GET|POST', '/ressources', function () {
    session_start();
    $ressources = new \App\Ressources();
    $ressources->ajoutsRessources();
});

$router->map('GET|POST', '/', function () {
    $afficheBdd = new \App\Afficher();
    $afficheBdd->afficheTous();
});

$router->map('GET|POST', '/supprimer', function () {
    $supprimerAffiche = new \App\Supprimer();
    $supprimerAffiche->supprimePersonnes();
});
$router->map('GET|POST', '/modifier', function () {
    session_start();
    $modifierAfficheper = new \App\ModifierPer();
    $modifierAfficheper->recupereFormper();
});
$router->map('GET|POST', '/modifierPid', function () {
    session_start();
    $modifierfichepid = new \App\ModifierPid();
    $modifierfichepid->recupereFormpid();
});
$router->map('GET|POST', '/modifierRes', function () {
    session_start();
    $modifierfichepid = new \App\ModifierRes();
    $modifierfichepid->recupereFormres();
});
$router->map('GET|POST', '/modifierNui', function () {
    session_start();
    $modifierfichepid = new \App\ModifierNui();
    $modifierfichepid->recupereFormnui();
});
$router->map('GET|POST', '/nuitees', function () {
    session_start();
    $ajoutNui = new \App\Nuitees();
    $ajoutNui->ajoutsNuitees();
});
$router->map('GET|POSTGET|POST', '/plusnui', function () {
    session_start();
    $autresNui = new \App\plusNui();
    $autresNui->autresNui();
});
$router->map('GET|POSTGET|POST', '/affichenuitees', function () {
    session_start();
    $afficherNui = new \App\AfficherNui();
    $afficherNui->afficheNuitees();
});

//404 Page __________________________________
$router->map('GET|POST', '/[*]', function () {
    $chargeTwig = new \App\Twig('pages/404.html.twig');
    $chargeTwig->render([]);
});


$match = $router->match();

// fermeture d'appel ou lance le status 404
if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} else {
    // Aucune route ne correspond
    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
