/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef EQUIPEMENT_H
#define EQUIPEMENT_H
#include <QString>
/**
 * @brief La classe Equipement
 * C'est une dépendance de la classe Passerelle
 * Chaque équipement possède 2 propriétés
 */
class Equipement
{
private:
    QString idEquip,libEquip;
public:
    Equipement(QString sonId, QString sonLibelle);
    Equipement();
    QString versChaine();
};

#endif // EQUIPEMENT_H
