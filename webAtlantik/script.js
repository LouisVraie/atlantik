function verifSaisie(){
    nom = document.getElementById("nom").value;
    adresse = document.getElementById("adresse").value;
    cp = document.getElementById("cp").value;
    ville = document.getElementById("ville").value;
    console.log(nom.length);
    //si les valeurs correspondent on enable le bouton
    if(nom.length>2 && adresse.length>9 && cp.length==5 && ville.length>2){
        //on active le bouton réserver
        document.getElementById("reserver").disabled=false;
        console.log("activer bouton");
    }else{
        //on désactive le bouton réserver
        document.getElementById("reserver").disabled=true;
        console.log("désactiver bouton");
    }
}