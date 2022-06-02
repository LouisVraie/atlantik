#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "pdf.h"
#include "bateauvoyageur.h"
#include "passerelle.h"

/**
 * @brief MainWindow::MainWindow
 * Constructeur de la classe MainWindow qui permet de créer l'application
 * @param parent: QWidget
 */
MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);

    brochurePDF();
}

/**
 * @brief MainWindow::~MainWindow
 * Destructeur de la classe MainWindow qui permet de détruire et donc fermer l'application
 */
MainWindow::~MainWindow()
{
    delete ui;
}

/**
 * @brief MainWindow::brochurePDF
 * Méthode privée qui permet de créer une brochure PDF des BateauxVoyageur dans l'application
 */
void MainWindow::brochurePDF()
{
    ui->monPDF->setName("BateauVoyageur.pdf");
    QVector <BateauVoyageur> collectionBV;
    collectionBV = Passerelle::chargerLesBateauxVoyageurs();
    //pour chaque batV de collectionBV
    for(int no=0;no<collectionBV.size();no++){
        BateauVoyageur batV = collectionBV.at(no);
        QString image = batV.getImageBatVoy();
        ui->monPDF->chargerImage(image);
        QString texte = batV.versChaine();
        ui->monPDF->ecrireTexte(texte);
    }
    ui->monPDF->fermer();
}
