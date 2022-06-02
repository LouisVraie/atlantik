#include "passerelle.h"
#include <QDebug>
/**
 * @brief Passerelle::Passerelle
 * Constructeur vide de la classe Passerelle
 */
Passerelle::Passerelle()
{

}

/**
 * @brief Passerelle::chargerLesEquipements
 * Méthode statique publique qui permet de charger les différents équipements d'un bateau avec son identifiant passé en paramètre
 * @param unIdBateau: int Identifiant d'un bateau
 * @return QVector<Equipement> Vecteur qui contient tous les identifiants et les libellés des équipements d'un bateau
 */
QVector<Equipement> Passerelle::chargerLesEquipements(int unIdBateau)
{
    QVector<Equipement> resultat;
    QString requete = "SELECT equ.numeroEquipement,equ.libelleEquipement FROM Equipement equ "
                      "INNER JOIN Bateau bat ON bat.numeroBateau = "+QString::number(unIdBateau)+" "
                      "INNER JOIN Posseder pos ON pos.numeroBateau = bat.numeroBateau "
                      "AND pos.numeroEquipement = equ.numeroEquipement";
    qDebug()<<requete;
    JeuEnregistrement monJeu = JeuEnregistrement(requete);
    //on rempli et retourne notre vecteur
    while(!monJeu.fin()){
        QString sonId= monJeu.getValeur("numeroEquipement").toString();
        QString sonLibelle = monJeu.getValeur("libelleEquipement").toString();
        qDebug()<<sonId<<" "<<sonLibelle;
        resultat.push_back(Equipement(sonId,sonLibelle));
        //on passe à l'enregistrement suivant
        monJeu.suivant();
    }
    return resultat;
}

/**
 * @brief Passerelle::chargerLesBateauxVoyageurs
 * Méthode statique publique qui permet de charger les différentes informations de tous les bateaux voyageurs
 * @return QVector<BateauVoyageur> Vecteur qui contient toutes les informations associées aux bateaux voyageurs
 * (le numéro, le libellé, les détails techniques, l'image et les équipements)
 */
QVector<BateauVoyageur> Passerelle::chargerLesBateauxVoyageurs()
{
    QVector<BateauVoyageur> resultat;
    JeuEnregistrement monJeu = JeuEnregistrement("SELECT numeroBateau,libelleBateau,longueurBateau,largeurBateau,vitesseBateau,imageBateau FROM Bateau "
                                                 "WHERE type = 'v' ORDER BY longueurBateau DESC, largeurBateau DESC");
    //on rempli et retourne notre vecteur
    while(!monJeu.fin()){
        int sonId = monJeu.getValeur("numeroBateau").toInt();
        QString sonNom = monJeu.getValeur("libelleBateau").toString();
        float saLongueur = monJeu.getValeur("longueurBateau").toFloat();
        float saLargeur = monJeu.getValeur("largeurBateau").toFloat();
        float saVitesse = monJeu.getValeur("vitesseBateau").toFloat();
        QString sonImage = monJeu.getValeur("imageBateau").toString();
        //j'obtiens ses équipements
        QVector<Equipement> sesEquipements;
        qDebug()<<sonId;
        sesEquipements = chargerLesEquipements(sonId);
        BateauVoyageur unBateau = BateauVoyageur(QString::number(sonId),sonNom,saLongueur,saLargeur,saVitesse,sonImage,sesEquipements);
        resultat.push_back(unBateau);
        //on passe à l'enregistrement suivant
        monJeu.suivant();
    }
    return resultat;
}
