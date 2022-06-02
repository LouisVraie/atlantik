#include "equipement.h"
/**
 * @brief Equipement::Equipement
 * Constructeur de la classe Equipement qui permet de remplir les propriétés privées de l'équipement avec les valeurs passées en paramètre
 * @param sonId: QString Identifiant de l'équipement
 * @param sonLibelle: QString Libelle de l'équipement
 */
Equipement::Equipement(QString sonId, QString sonLibelle)
{
    idEquip = sonId;
    libEquip = sonLibelle;
}

/**
 * @brief Equipement::Equipement
 * Constructeur vide de la classe Equipement nécessaire car il y a des vecteurs de Equipement
 */
Equipement::Equipement()
{
    //constructeur vide
}

/**
 * @brief Equipement::versChaine
 * Méthode publique qui renvoie la chaîne de caractère utilisée pour obtenir le libellé d'un équipement
 * @return QString Une chaîne de caractères qui correspont au libellé de l'équipement
 */
QString Equipement::versChaine()
{
    return libEquip;
}
