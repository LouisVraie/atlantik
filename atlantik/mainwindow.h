/**
  @author Louis Vraie
  @date 08/11/2021
  @version 1.0 beta 1
  @copyright GNU Public License
 */
#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include <QDebug>
#include <QVector>

namespace Ui {
class MainWindow;
}
/**
 * @brief La classe MainWindow
 * Elle hérite de la classe QMainWindow
 * Elle permet de créer la fenêtre de l'application
 */
class MainWindow : public QMainWindow
{
    Q_OBJECT

public:
    explicit MainWindow(QWidget *parent = nullptr);
    ~MainWindow();

private:
    Ui::MainWindow *ui;

    void brochurePDF();
};

#endif // MAINWINDOW_H
