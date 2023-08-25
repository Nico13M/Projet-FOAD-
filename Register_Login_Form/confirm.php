<?php 

$user_id = $_GET['id'   ];
$token = $_GET['token'];
require 'inc/db.php';
$pdo -> prepare('SELECT confirmation_token FROM UtilisateurConnecte WHERE id = ?');

$req -> execute([$user_id]);
$user = $req ->fetch();

if($user && $user->confirmation_token == $token){
    die('ok');

}else{
die('pas ok ');
}
