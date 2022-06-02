#include "bateauvoyageur.h"

/**
 * @brief BateauVoyageur::BateauVoyageur
 * Constructeur de la classe BateauVoyageur qui permet de renseigner les propriétés privées du BateauVoyageur ainsi que celles du Bateau avec les valeurs passées en paramètres
 * Le constructeur de BateauVoyageur appelle le constructeur de Bateau
 * @param unId: QString Identifiant du bateau
 * @param unNom: QString Nom du bateau
 * @param uneLongueur: float Longueur du bateau exprimée en mètres
 * @param uneLargeur: float Largeur du bateau exprimée en mètres
 * @param uneVitesse: float Vitesse de croisière du bateau exprimée en noeuds
 * @param uneImage: QString Chemin pour atteindre l'image du bateau
 * @param uneCollEquip: QVector<Equipement> Liste des équipements présents sur le bateau
 */
BateauVoyageur::BateauVoyageur(QString unId,QString unNom,float uneLongueur,float uneLargeur,
                               float uneVitesse,QString uneImage,QVector<Equipement> uneCollEquip)
    :Bateau(unId,unNom,uneLongueur,uneLargeur)
{
    //remplir les propriétés à partir des paramètres reçus
    vitesseBatVoy = uneVitesse;
    imageBatVoy = uneImage;
    lesEquipements = uneCollEquip;
}

/**
 * @brief BateauVoyageur::BateauVoyageur
 * Constructeur vide de la classe BateauVoyageur nécessaire car il y a des vecteurs de BateauVoyageur
 */
BateauVoyageur::BateauVoyageur()
{
    //contructeur vide
}

/**
 * @brief BateauVoyageur::versChaine
 * Méthode publique qui renvoie la chaîne de caractère utilisée pour décrire le bateau
 * Cette méthode utilise la méthode Bateau::versChaine()\n
 * Exemple :\n
 * Nom du bateau : Queen Mary\n
 * Longueur : 14.5 mètres\n
 * Largeur : 8.2 mètres\n
 * Vitesse : 21 noeuds\n
 * Liste des équipements du bateau :\n
 * \- Accès Handicapé\n
 * \- Bar
 * @return QString Une chaîne de caractères sur plusieurs lignes qui renvoie toutes les informations associées à un bateau
 */
QString BateauVoyageur::versChaine()
{
    QString resultat;
    QString sautLigne = "<br>";
    resultat = Bateau::versChaine();
    resultat += "Vitesse : "+QString::number(vitesseBatVoy)+" noeuds"+sautLigne;
    resultat += "Liste des équipements du bateau : "+sautLigne;
    //pour chaque équipement dans lesEquipements
    for(int no=0;no<lesEquipements.size();no++) {
        resultat += "- "+lesEquipements[no].versChaine()+sautLigne;
    }
    resultat += sautLigne;
    return resultat;
}

/**
 * @brief BateauVoyageur::getImageBatVoy
 * Méthode publique qui renvoie le chemin qui permet d'atteindre l'image du bateau
 * @return QString Une chaîne de caractères qui renseigne le chemin d'accès de l'image du bateau
 */
QString BateauVoyageur::getImageBatVoy()
{
    return imageBatVoy;
}
