/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef PDF_H
#define PDF_H
#include <QTextBrowser>
#include <QString>
#include <QPdfWriter>
#include <QPagedPaintDevice>

/**
 * @brief La classe PDF
 * Elle hérite de la classe QTextBrowser
 * Elle permet de générer un document PDF
 * Chaque pdf d'une propriété
 */
class PDF : public QTextBrowser
{
private:
    QString nomDoc;
public:
    PDF(QWidget *parent);
    void setName(QString nomDocument);
    void ecrireTexte(QString leTexte);
    void chargerImage(QString chemin);
    void fermer();
};

#endif // PDF_H
