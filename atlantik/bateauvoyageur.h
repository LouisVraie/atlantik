/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef BATEAUVOYAGEUR_H
#define BATEAUVOYAGEUR_H
#include "bateau.h"
#include "equipement.h"
#include <QVector>

/**
 * @brief La classe BateauVoyageur
 * C'est une dépendance de la classe Passerelle
 * Chaque bateau voyageur dispose de 3 propriétés
 */
class BateauVoyageur : public Bateau
{
private:
    float vitesseBatVoy;
    QString imageBatVoy;
    QVector<Equipement> lesEquipements;
public:
    BateauVoyageur(QString unId,QString unNom,float uneLongueur,
                   float uneLargeur,float uneVitesse,QString uneImage,
                   QVector<Equipement> uneCollEquip);
    BateauVoyageur();
    QString versChaine();
    QString getImageBatVoy();
};

#endif // BATEAUVOYAGEUR_H
