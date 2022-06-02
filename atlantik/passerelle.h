/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef PASSERELLE_H
#define PASSERELLE_H
#include "bateauvoyageur.h"
#include "equipement.h"
#include "jeuenregistrement.h"
#include <QVector>

/**
 * @brief La classe Passerelle
 * Elle est dépendante des classes BateauVoyageur et Equipement
 */
class Passerelle
{
private:

public:
    Passerelle();
    static QVector<Equipement> chargerLesEquipements(int unIdBateau);
    static QVector<BateauVoyageur> chargerLesBateauxVoyageurs();
};

#endif // PASSERELLE_H
