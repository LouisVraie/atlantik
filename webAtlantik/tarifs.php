<?php
    include 'init.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title>Atlantik - Tarifs</title>
    </head>
    <body>
        <h1>Atlantik - Tarifs</h1>
        <h3>Tarifs en euros</h3>
        <table>
            <?php 
                $secteur = "";
                //on affiche toutes les liaisons
                $requeteLiaison = "SELECT DISTINCT Liaison.codeLiaison,CONCAT(pdep.libellePort,' - ',parr.libellePort) as libelleLiaison FROM Liaison
                                    INNER JOIN Port pdep ON Liaison.depart = pdep.numeroPort
                                    INNER JOIN Port parr ON Liaison.arrivee = parr.numeroPort
                                    INNER JOIN Tarif tar ON Liaison.codeLiaison = tar.codeLiaison";
                $resultLiaison = mysqli_query(getBdd(),$requeteLiaison);
                while($tabLiaison=mysqli_fetch_array($resultLiaison)){
                    ?>
                    <tr>
                        <td colspan="5"><b>Liaison</b> <?=$tabLiaison['codeLiaison'];?> : <?=$tabLiaison['libelleLiaison'];?></td>
                    </tr>
                    <tr>
                        <th rowspan="2">Catégorie</th>
                        <th rowspan="2">Type</th>
                        <th colspan="3">Période</th>
                    </tr>
                    <tr>
                        <?php 
                        //on affiche les périodes
                        $requetePeriode = "SELECT dateDebPeriode,dateFinPeriode FROM Periode;";
                        $resultPeriode = mysqli_query(getBdd(),$requetePeriode);
                        while($tabPeriode=mysqli_fetch_array($resultPeriode)){
                        ?>
                            <td><?= $tabPeriode['dateDebPeriode'];?><br><?=$tabPeriode['dateFinPeriode']?></td>
                        <?php
                        }
                        ?>
                    </tr>
                <?php
                    //on affiche les catégories
                    $requeteCategorie = "SELECT cat.lettreCategorie,cat.libelleCategorie,CONCAT(typ.codeTypeCategorie,' - ',typ.libelleTypeCategorie) as type 
                                            FROM Categorie cat
                                            INNER JOIN TypeCategorie typ ON cat.lettreCategorie = typ.lettreCategorie";
                    $resultatCategorie = mysqli_query(getBdd(),$requeteCategorie);
                    $lettre = "";

                    while($tabCategorie=mysqli_fetch_array($resultatCategorie)){?>
                    <tr>
                        <?php
                        //si la lettre est différente de celle déjà connue
                        if($lettre != $tabCategorie['lettreCategorie']){
                            $lettre = $tabCategorie['lettreCategorie'];
                            //on affiche la catégorie avec un rowspan
                            $requeteNbType = "SELECT COUNT(*) FROM TypeCategorie WHERE lettreCategorie = '".$lettre."'"; 
                            $resultNbType = mysqli_query(getBdd(),$requeteNbType);
                            $tabInfo=mysqli_fetch_row($resultNbType);
                            ?>
                            <td class="center" rowspan="<?=$tabInfo[0]?>"><?= $lettre?><br><?= $tabCategorie['libelleCategorie']?></td>
                            <?php
                        }
                        ?>
                        <td><?= $tabCategorie['type'];?></td>
                        <?php 
                        //on récupère uniquement le codeTypeCategorie
                        $codeTypeCategorie = explode(' ',$tabCategorie['type'],2);

                        //on affiche les tarifs
                        $requeteTarif = "SELECT prix FROM Tarif WHERE codeTypeCategorie='".$codeTypeCategorie[0]."' AND codeLiaison=".$tabLiaison['codeLiaison'];
                        $resultatTarif = mysqli_query(getBdd(),$requeteTarif);

                        while($tabTarif = mysqli_fetch_array($resultatTarif)){
                        ?>
                            <td><?= $tabTarif['prix'];?></td>
                        <?php 
                        }
                        ?>
                    </tr>
                <?php
                    } 
                }?>
        </table>
    </body>
</html>