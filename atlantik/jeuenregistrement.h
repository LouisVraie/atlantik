/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef JEUENREGISTREMENT_H
#define JEUENREGISTREMENT_H
#include <QString>
#include <QVariant>
#include <QSqlQuery>
/**
 * @brief La classe JeuEnregistrement
 * Elle hérite de la classe QSqlQuery
 * Elle permet de manipuler un jeu de données
 */
class JeuEnregistrement : public QSqlQuery
{
public:
    JeuEnregistrement(QString chaineSql);
    void suivant();
    bool fin();
    QVariant getValeur(QString nomChamp);
    void fermer();
};

#endif // JEUENREGISTREMENT_H
