/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef BATEAU_H
#define BATEAU_H
#include <QString>
/**
 * @brief La classe Bateau
 * C'est la classe mère de la classe BateauVoyageur
 * Chaque bateau dispose de 4 propriétés
 */
class Bateau
{
private:
    QString idBat,nomBat;
    float longueurBat,largeurBat;
public:
    Bateau(QString unId,QString unNom,float uneLongueur,float uneLargeur);
    Bateau();
    QString versChaine();
};

#endif // BATEAU_H
