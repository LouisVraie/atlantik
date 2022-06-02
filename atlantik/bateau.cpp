#include "bateau.h"

/**
 * @brief Bateau::Bateau
 * Constructeur de la classe Bateau qui permet de remplir les propriétés privées du bateau avec les valeurs passées en paramètre
 * @param unId: QString C'est l'identifiant du bateau
 * @param unNom: QString Il s'agit du nom du bateau exemple "Queen Mary"
 * @param uneLongueur: float Longueur du bateau exprimée en mètres exemple: 14.5
 * @param uneLargeur: float Largeur du bateau exprimée en mètres exemple: 8.2
 */
Bateau::Bateau(QString unId,QString unNom,float uneLongueur,float uneLargeur)
{
    idBat = unId;
    nomBat = unNom;
    longueurBat = uneLongueur;
    largeurBat = uneLargeur;
}

/**
 * @brief Bateau::Bateau
 * Constructeur vide de la classe Bateau nécessaire car il y a des vecteurs de Bateau
 */
Bateau::Bateau()
{
    //constructeur vide
}

/**
 * @brief Bateau::versChaine
 * Cette méthode publique renvoie la chaîne de caractère utilisée pour décrire le bateau\n
 * Exemple :\n
 * Nom du bateau : Queen Mary\n
 * Longueur : 14.5 mètres\n
 * Largeur : 8.2 mètres
 * @return QString Une chaine de caractère sur plusieurs lignes présentant le Nom du bateau et ses différentes informations
 */
QString Bateau::versChaine()
{
    QString resultat;
    QString sautLigne = "<br>";
    resultat = "Nom du bateau : "+nomBat+sautLigne;
    resultat += "Longueur : "+QString::number(longueurBat)+" mètres"+sautLigne;
    resultat += "Largeur : "+QString::number(largeurBat)+" mètres"+sautLigne;
    return resultat;
}
