#include "jeuenregistrement.h"

/**
 * @brief JeuEnregistrement::JeuEnregistrement
 * Constructeur de la classe JeuEnregistrement qui permet de lire un jeu d'enregistrement et de renseigner le paramètre de la classe QSqlQuery
 * avec la chaîne SQL passées en paramètre
 * Le constructeur de JeuEnregistrement appelle le constructeur de QSqlQuery
 * @param chaineSql: QString Requête SQL qui souhaite sélectionner des enregistrements dans une base de données
 */
JeuEnregistrement::JeuEnregistrement(QString chaineSql):QSqlQuery(chaineSql)
{
    //ouvre la requête et place sur le premier enregistrement
    first();
}

/**
 * @brief JeuEnregistrement::suivant
 * Méthode publique qui permet de passer à l'enregistrement suivant
 */
void JeuEnregistrement::suivant()
{
    next();
}

/**
 * @brief JeuEnregistrement::fin
 * Méthode publique qui renvoie un booléen pour savoir si la fin du jeu d'enregistrement est atteint
 * @return bool Booléen qui permet de savoir si la fin du jeu d'enregistrement est atteint
 */
bool JeuEnregistrement::fin()
{
    return !isValid();
}

/**
 * @brief JeuEnregistrement::getValeur
 * Méthode publique qui renvoie la valeur du champ passé en paramètre
 * @param nomChamp: QString Nom du champs à récupérer dans l'enregistrement courant
 * @return QVariant Variable non typé qui possède la valeur courante du champ donné en paramètre
 */
QVariant JeuEnregistrement::getValeur(QString nomChamp)
{
    return value(nomChamp);
}

/**
 * @brief JeuEnregistrement::fermer
 * Méthode publique qui permet de marquer la fermeture de la requête
 */
void JeuEnregistrement::fermer()
{
    //fermeture de la requête
    //nothing to do
}
