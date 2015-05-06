<?php
// Connexion à la base de données
try
{
   
$bdd = new PDO('mysql:host=mathieuptc.mysql.db;dbname=mathieuptc', 'mathieuptc', 'ploplop123');
$bdd-> setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,"SET NAMES 'UTF8'");
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
?>