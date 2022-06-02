<?php
session_start();
//fonction qui permet de se connecter à la base de donnée
function getBdd(){
    $user = 'userAtlantik';
    $passwd = 'XyW+s129!';
    $server = 'localhost';
    $dbname = 'dbAtlantik';

    //connexion à la base de données
    $bdd = mysqli_connect($server,$user,$passwd,$dbname);

    if(!$bdd){
        mysqli_connect_error();//renvoi un message d'erreur
    }
    return $bdd;
}?>