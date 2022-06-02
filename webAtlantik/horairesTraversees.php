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
        <title>Atlantik - Horaires de Traversées</title>
    </head>
    <body>
        <h1>Atlantik - Horaires de Traversées</h1>
        <div class="flex">
            <div>
                <!--on liste les différents secteurs-->
                <ul>
                    <?php 
                    $reqSecteur = "SELECT numeroSecteur,libelleSecteur FROM Secteur ORDER BY libelleSecteur ASC";
                    $resultSecteur = mysqli_query(getBdd(),$reqSecteur);
                    while($tabSecteur = mysqli_fetch_array($resultSecteur)){ 
                        $codeSecteur = "horairesTraversees.php?secteur=".$tabSecteur['numeroSecteur']."&libelleSecteur=".$tabSecteur['libelleSecteur']?>
                        <li><a href="<?=$codeSecteur?>"><?=$tabSecteur['libelleSecteur']?></a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div>
                <?php 
                //si le secteur est set
                if(isset($_GET['secteur']) || isset($_SESSION['secteur'])){
                    //si le secteur change
                    if(isset($_GET['secteur'])){
                        $_SESSION['secteur'] = mysqli_real_escape_string(getBdd(),$_GET['secteur']);
                        $_SESSION['libelleSecteur'] = mysqli_real_escape_string(getBdd(),$_GET['libelleSecteur']);
                    }
                    //on fait la requête qui nous donne les liaisons du secteur
                    $reqLiaison = "SELECT Liaison.codeLiaison,CONCAT(pdep.libellePort,' - ',parr.libellePort) as libelleLiaison FROM Liaison
                                            INNER JOIN Port pdep ON Liaison.depart = pdep.numeroPort
                                            INNER JOIN Port parr ON Liaison.arrivee = parr.numeroPort
                                            INNER JOIN Secteur sect ON sect.numeroSecteur = Liaison.numeroSecteur
                                            AND sect.numeroSecteur =".$_SESSION['secteur'];
                    $resultLiaison = mysqli_query(getBdd(),$reqLiaison);
                    //on récupère le nombre de lignes
                    $numLiaison = mysqli_num_rows($resultLiaison);
                    //si il y a au moins une liaison
                    if($numLiaison>0){                 
                    ?>
                        <form action="horairesTraversees.php" method="GET">
                            <p>Sélectionner la liaison et la date souhaitée</p>
                            
                            <!--on liste les différentes liaisons possibles selon le secteur sélectionné-->
                            <select name="liaison" id="liaison">
                                <?php
                                while($tabLiaison = mysqli_fetch_array($resultLiaison)){
                                    //si le liaison est connue
                                    if(isset($_GET['liaison'])){
                                        //si la liaison et le codeLiaison sont les mêmes 
                                        if($_GET['liaison']==$tabLiaison['codeLiaison']){
                                            //on sélectionne la traversée
                                            ?>
                                            <option value=<?=$tabLiaison['codeLiaison']?> selected><?=$tabLiaison['libelleLiaison']?></option>
                                            <?php
                                        } else {?>
                                            <option value=<?=$tabLiaison['codeLiaison']?> ><?=$tabLiaison['libelleLiaison']?></option>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <option value=<?=$tabLiaison['codeLiaison']?>><?=$tabLiaison['libelleLiaison']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <!--on liste les différentes dates possibles de traversée-->
                            <select name="date" id="date">
                            <?php 
                                $_SESSION['liaison'] = mysqli_real_escape_string(getBdd(),$_GET['liaison']);
                                $reqDate = "SELECT DISTINCT dateTraversee FROM Traversee";
                                $resultDate = mysqli_query(getBdd(),$reqDate);
                                while($tabDate = mysqli_fetch_array($resultDate)){ ?>
                                    <option value=<?= $tabDate['dateTraversee']?>><?=$tabDate['dateTraversee']?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <button type="submit">Afficher les traversées</button>
                        </form>
                    <?php
                    }else{
                    ?>
                        <p>Le secteur <?=$_SESSION['libelleSecteur'];?> n'a pas de liaisons.</p>
                    <?php
                    }
                }else{
                ?>
                    <p>Sélectionner un secteur</p>
                <?php
                }
                //si les GET sont remplit
                if(isset($_GET['liaison'])&&isset($_GET['date'])){
                    $liaison = mysqli_real_escape_string(getBdd(),$_GET['liaison']);
                    $date = mysqli_real_escape_string(getBdd(),$_GET['date']);
                    //on fait la requête qui récupère les données de la traversée
                    $reqTraversee = "SELECT trav.numeroTraversee,trav.heureTraversee,bat.libelleBateau,bat.numeroBateau FROM Traversee trav
                                                    INNER JOIN Bateau bat ON bat.numeroBateau = trav.numeroBateau
                                                    AND trav.codeLiaison = $liaison
                                                    AND trav.dateTraversee = '$date'
                                                    ORDER BY trav.heureTraversee ASC";
                    $resultTraversee = mysqli_query(getBdd(),$reqTraversee);
                    //on récupère le nombre de lignes
                    $numTraversee = mysqli_num_rows($resultTraversee);
                    //si il y a au moins une traversee
                    if($numTraversee>0){
                        //on fait la requête pour obtenir la liaison sélectionné
                        $reqLibLiai = "SELECT CONCAT(pdep.libellePort,' - ',parr.libellePort) as libelleLiaison FROM Liaison
                                            INNER JOIN Port pdep ON Liaison.depart = pdep.numeroPort
                                            INNER JOIN Port parr ON Liaison.arrivee = parr.numeroPort
                                            AND Liaison.codeLiaison = $liaison";
                        $resultLibLiai = mysqli_query(getBdd(),$reqLibLiai);
                        while($tabLibLiai = mysqli_fetch_array($resultLibLiai)){
                            $libLiai = $tabLibLiai['libelleLiaison'];
                        }
                    ?>
                        <!--on crée le tableau des traversées-->
                        <form action="./reservation.php" method="GET">
                            <p id="horaire"><?=$libLiai;?></p>
                            <p>Traversée pour le <?=$_GET['date']?>. Sélectionner la traversée souhaitée</p>
                            <table >
                                <tbody>
                                    <tr>
                                        <td class="center" colspan="3">Traversée</td>
                                        <td class="center" colspan="3">Places disponibles par catégorie</td>
                                    </tr>
                                    <tr>
                                        <td class="center" rowspan="2">N°</td>
                                        <td class="center" rowspan="2">Heure</td>
                                        <td class="center" rowspan="2">Bateau</td>
                                        <?php //on fait la requête qui affiche les types des catégories
                                        $reqCategorie = "SELECT DISTINCT cat.lettreCategorie,cat.libelleCategorie FROM Categorie cat
                                                            INNER JOIN TypeCategorie typ ON cat.lettreCategorie = typ.lettreCategorie";
                                        $resultCategorie=mysqli_query(getBdd(),$reqCategorie);
                                        //on affiche les types de catégories
                                        while($tabCategorie=mysqli_fetch_array($resultCategorie)){?>
                                            <td class="center" rowspan="2"><?=$tabCategorie['lettreCategorie'];?><br><?=$tabCategorie['libelleCategorie'];?></td>
                                        <?php
                                        }
                                        ?>
                                    <tr></tr>
                                    </tr>
                                    <?php 
                                    //on affiche le numéro, l'heure et le nom du bateau lié à la Traversée
                                    while($tabTraversee = mysqli_fetch_array($resultTraversee)){
                                    ?>
                                    <tr>
                                        <td class="center"><?=$tabTraversee['numeroTraversee'];?></td>
                                        <td class="center"><?=$tabTraversee['heureTraversee'];?></td>
                                        <td class="center"><?=$tabTraversee['libelleBateau'];?></td>

                                        <?php //on fait la requête qui nous donne la capacité de chaque bateau
                                        $reqContient = "SELECT cont.nombrePlace FROM Contient cont
                                                            INNER JOIN Bateau bat ON bat.numeroBateau = cont.numeroBateau
                                                            AND bat.numeroBateau =".$tabTraversee['numeroBateau']."
                                                            ORDER BY lettreCategorie ASC";

                                        $resultContient = mysqli_query(getBdd(),$reqContient);
                                        //on affiche la capacité de chaque bateau
                                        while($tabContient = mysqli_fetch_array($resultContient)){
                                        ?>
                                            <td class="center"><?= $tabContient['nombrePlace'];?></td>
                                        <?php
                                        }
                                        ?>
                                        <!--On ajoute les boutons radio pour choisir la traversée-->
                                        <td class="center"><input type="radio" name="choixTraversee" value="<?=$tabTraversee['numeroTraversee']?>" checked/></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div id="reserver">
                                <button type="submit">Réserver cette traversée</button>
                            </div>
                        </form>
                <?php
                    }else{
                    ?>
                        <p>Il n'y a pas de liaisons pour les données choisies.</p>
                    <?php
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>