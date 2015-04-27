<?php
// Connexion à la base de données
try
{
   
$bdd = new PDO('mysql:host=localhost;dbname=before-after', 'root', '');
$bdd-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES 'UTF8'");
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>