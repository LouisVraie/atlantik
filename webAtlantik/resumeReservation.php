<?php
    include 'init.php';
    //si toutes les informations nécessaires sont transmises
    if(isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['ville']) 
        && isset($_POST['tabNbPlace']) && isset($_POST['tabPrix']) && isset($_POST['choixTraversee']) 
        && isset($_POST['nomLiaison']) && isset($_POST['infoTraversee'])){

        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $tabNbPlace = $_POST['tabNbPlace'];
        $tabPrix = $_POST['tabPrix'];
        $numeroTraversee = $_POST['choixTraversee'];
        $nomLiaison = $_POST['nomLiaison'];
        $infoTraversee = $_POST['infoTraversee'];
        //requête qui nous donne le nouveau numéro de réservation
        $reqNewNumReservation = "SELECT ifnull((SELECT MAX(numeroReservation)+1 FROM Reservation),9181458910)";
        $resultNewNumReservation = mysqli_query(getBdd(),$reqNewNumReservation);
        $tabNewNumReservation = mysqli_fetch_array($resultNewNumReservation);
        $newNumReservation = $tabNewNumReservation[0];
        //on calcul le montant de la réservation
        $montantTotal = 0;
        //pour chaque typeCatégorie
        foreach($tabPrix as $key => $prix){
            //si le nombre est différent de 0
            if($tabNbPlace[$key]>0){
                //on calcul le montantTotal
                $montantTotal += $prix * $tabNbPlace[$key];
            }
        }
        //requête qui ajoute une réservation
        $reqNewReservation = "INSERT INTO Reservation VALUES ($newNumReservation,'$nom','$adresse','$cp','$ville',$montantTotal,$numeroTraversee)";
        mysqli_query(getBdd(),$reqNewReservation);
    }else{
        //on redirige sur la page de réservation
        header("Location: ./reservation.php");
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
        <title>Atlantik - Résumé de réservation</title>
    </head>
    <body>
        <h1>Atlantik - Résumé de réservation</h1>
        <p><?=$nomLiaison;?></p>
        <p><?=$infoTraversee;?></p>
        <br>
        <p>Réservation enregistrée sous le n°<?=$newNumReservation;?></p>
        <p><?=$nom;?> <?=$adresse;?> <?=$cp;?> <?=$ville;?></p>
        <?php 
        //pour chaque typeCatégorie
        foreach($tabNbPlace as $key => $nbPlace){
            //si le nombre est différent de 0
            if($nbPlace>0){
                $cleanKey = str_replace("'","",$key);
                ?>
                <p><?=$cleanKey;?> : <?=$nbPlace;?></p>
                <?php
                //requête qui nous donne le codeTypeCatégorie en fonction du libelleTypeCategorie
                $reqCodeTypeCategorie = "SELECT codeTypeCategorie FROM TypeCategorie WHERE libelleTypeCategorie = $key";
                $resultCodeTypeCategorie = mysqli_query(getBdd(),$reqCodeTypeCategorie);
                $tabCodeTypeCategorie = mysqli_fetch_array($resultCodeTypeCategorie);
                $codeTypeCategorie = $tabCodeTypeCategorie[0];

                //requête qui insère les places réservées
                $reqInsertReserver ="INSERT INTO reserver VALUES ($nbPlace,'$codeTypeCategorie',$newNumReservation)";
                mysqli_query(getBdd(),$reqInsertReserver);
            }
        }
        ?>
        <br>
        <p>Montant total à régler : <?=$montantTotal;?> euros</p>
        <p>[Voir les modalités de paiement]</p>
    </body>
</html>