<?php
    include 'init.php';

    //on fait une requête qui nous donne les informations dont on a besoin pour notre tableau
    $requete = "SELECT codeLiaison,sect.libelleSecteur,distanceLiaison,pdep.libellePort as depart,parr.libellePort as arrivee FROM Liaison 
                        INNER JOIN Port pdep ON Liaison.depart = pdep.numeroPort
                        INNER JOIN Port parr ON Liaison.arrivee = parr.numeroPort
                        INNER JOIN Secteur sect ON Liaison.numeroSecteur = sect.numeroSecteur
                        ORDER BY sect.numeroSecteur;";
    $resultat = mysqli_query(getBdd(),$requete);
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Atlantik</title>
    </head>
    <body>
        <h1>Atlantik</h1>
        <table>
            <tr>
                <th rowspan="2">Secteur</th>
                <th colspan="4">Liaison</th>
            </tr>
            <tr>
                <td>Code Liaison</td>
                <td>Distance en milles marin</td>
                <td>Port de départ</td>
                <td>Port d'arrivée</td>
            </tr>
            <?php 
                $secteur = "";
                //on affiche toutes les liaisons
                while($tab=mysqli_fetch_array($resultat)){?>
                <tr>
                    <td>
                        <?php
                        //si la variable est différente du résultat de la base on insère le secteur
                        if($secteur != $tab['libelleSecteur']){
                            $secteur = $tab['libelleSecteur'];
                            ?>
                            <?=$secteur;?>
                            <?php
                        }
                        ?>
                    </td>
                    <td><?=$tab['codeLiaison'];?></td>
                    <td><?= $tab['distanceLiaison'];?></td>
                    <td><?= $tab['depart'];?></td>
                    <td><?= $tab['arrivee'];?></td>
                </tr>
            <?php
                } ?>
        </table>
    </body>
</html>