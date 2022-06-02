<?php
    include 'init.php';
    //si le numéro de la traversée est transmis
    if(isset($_GET['choixTraversee'])){
        $numeroTraversee = mysqli_real_escape_string(getBdd(),$_GET['choixTraversee']);

        //on fait la requête pour obtenir la liaison sélectionné
        $reqLibLiai = "SELECT CONCAT(pdep.libellePort,' - ',parr.libellePort) as libelleLiaison FROM Liaison
                        INNER JOIN Port pdep ON Liaison.depart = pdep.numeroPort
                        INNER JOIN Port parr ON Liaison.arrivee = parr.numeroPort
                        INNER JOIN Traversee trav ON trav.codeLiaison = Liaison.codeLiaison
                        AND trav.numeroTraversee = $numeroTraversee";
        $resultLibLiai = mysqli_query(getBdd(),$reqLibLiai);
        $tabLibLiai = mysqli_fetch_array($resultLibLiai);
        $libLiai = $tabLibLiai['libelleLiaison'];

        //requête qui nous donne la date d'une traversée
        $reqDateTrav = "SELECT dateTraversee,heureTraversee FROM Traversee WHERE numeroTraversee = $numeroTraversee";
        $resultDateTrav = mysqli_query(getBdd(),$reqDateTrav);
        $tabDateTrav = mysqli_fetch_array($resultDateTrav);
        $date = $tabDateTrav['dateTraversee'];
        $heure = $tabDateTrav['heureTraversee'];
        
        //on met la date au format voulu
        $dateElement = explode("-",$date);
        $cleanDate = $dateElement[2]."/".$dateElement[1]."/".$dateElement[0];
        //on met l'heure au format voulu
        $heureElement = explode(":",$heure);
        $cleanHeure = $heureElement[0]."h".$heureElement[1];
    }else{
        //on redirige sur la page de choix de la traversée
        header("Location: ./horairesTraversees.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Atlantik - Écran de réservation</title>
    </head>
    <body>
        <h1>Atlantik - Écran de réservation</h1>
        <form action="./resumeReservation.php" method="POST">
            <?php 
                $nomLiaison = "Liaison ".$libLiai;
                $infoTraversee = "Traversée n°$numeroTraversee le $cleanDate à $cleanHeure";
            ?>
            <p><?=$nomLiaison;?></p>
            <p><?=$infoTraversee;?></p>
            <p>Saisir les informations relatives à la réservation</p>
            <input type="hidden" name="nomLiaison" value="<?=$nomLiaison;?>">
            <input type="hidden" name="infoTraversee" value="<?=$infoTraversee;?>">
            <input type="hidden" name="choixTraversee" value="<?=$numeroTraversee;?>">
            <p>
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom"  min="3" placeholder="Dupont">
            </p>
            <p>
                <label for="adresse">Adresse :</label>
                <input type="text" name="adresse" id="adresse" min="10" placeholder="2 Rue des Mimosas">
            </p>
            <p>
                <label for="cp">Cp :</label>
                <input type="text" name="cp" id="cp" pattern="[0-9]{5}" maxlenght="5" placeholder="05000">
                <label for="ville">Ville :</label>
                <input type="text" name="ville" id="ville"  min="3" placeholder="Gap">
            </p><br>
            <table>
                <tbody>
                    <tr>
                        <td>Entité</td>
                        <td>Tarif en €</td>
                        <td>Quantité</td>
                    </tr>
                    <?php
                    //requête qui nous donne les libellés de type catégorie et les prix associés en fonction de la liaison et de la période
                    $reqTypPrix = "SELECT typ.libelleTypeCategorie,tar.prix FROM TypeCategorie typ
                                    INNER JOIN Tarif tar ON tar.codeTypeCategorie = typ.codeTypeCategorie
                                    INNER JOIN Traversee trav ON trav.codeLiaison = tar.codeLiaison
                                    INNER JOIN Periode per ON per.numeroPeriode = tar.numeroPeriode
                                    AND '$date' BETWEEN per.dateDebPeriode AND per.dateFinPeriode
                                    AND trav.numeroTraversee = $numeroTraversee";
                    $resultTypPrix = mysqli_query(getBdd(),$reqTypPrix);
                    //on affiche le contenu du tableau
                    while($tabTypPrix = mysqli_fetch_array($resultTypPrix)){?>
                        <tr>
                            <td><?=$tabTypPrix['libelleTypeCategorie'];?></td>
                            <td class="center"><?=$tabTypPrix['prix'];?></td>
                            <input type="hidden" name="tabPrix['<?=$tabTypPrix['libelleTypeCategorie']?>']" value="<?=$tabTypPrix['prix'];?>">
                            <td class="center"><input type="number" name="tabNbPlace['<?=$tabTypPrix['libelleTypeCategorie']?>']" size="2" value="0" min="0" max="99"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <button type="submit" id="reserver">Réserver</button>
            </div>
        </form>
    </body>
</html>