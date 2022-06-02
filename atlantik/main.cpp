#include "mainwindow.h"
#include <QApplication>
#include <QSqlDatabase>

/**
 * @brief main
 * Fonction principale qui permet de lancer l'application
 * @param argc: int
 * @param argv: char
 * @return La fenêtre de l'application
 */
int main(int argc, char *argv[])
{
    QSqlDatabase db = QSqlDatabase::addDatabase("QMYSQL");
          db.setHostName("localhost");
          db.setDatabaseName("dbAtlantik");
          db.setUserName("userAtlantik");
          db.setPassword("XyW+s129!");
          bool ok = db.open();
          //si la connexion est réussite
          if(ok){
              qDebug()<<"Connecter à la base de données !";
          }else {
              qDebug()<<"Erreur lors de la connexion à la base de données !";
          }

    QApplication a(argc, argv);
    MainWindow w;
    w.show();

    return a.exec();
}
