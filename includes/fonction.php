<?php

function getObjet(){
    $DBH = dbconnect();
    $STH = $DBH->prepare("SELECT * FROM objets");
    $STH->execute();

    while ($row = $STH->fetch(PDO::FETCH_ASSOC)) {
        $objets[] = [
            'id_objet' => $row['id_objet'],
            'id_user' => $row['id_user'],
            'image_objet' => $row['image_objet'],
            'descri_objet' => $row['descri_objet'],
            'prix_estime' => $row['prix_estime'],
            'id_categorie' => $row['id_categorie']
        ];
    }
    return $objets;
}

function getObjetById($id){
    $DBH = dbconnect();
    $STH = $DBH->prepare("SELECT * FROM objets WHERE id_objet = :id");
    $STH->bindParam(':id', $id, PDO::PARAM_INT);
    $STH->execute();

    while ($row = $STH->fetch(PDO::FETCH_ASSOC)) {
        $objets[] = [
            'id_objet' => $row['id_objet'],
            'id_user' => $row['id_user'],
            'image_objet' => $row['image_objet'],
            'descri_objet' => $row['descri_objet'],
            'prix_estime' => $row['prix_estime'],
            'id_categorie' => $row['id_categorie']
        ];
    }
    return $objets;
}

function getCategorie(){
    $DBH = dbconnect();
    $STH = $DBH->prepare("SELECT * FROM categories");
    $STH->execute();

    while ($row = $STH->fetch(PDO::FETCH_ASSOC)) {
        $categories[] = [
            'id' => $row['id'],
            'nom_categorie' => $row['nom_categorie']
        ];
    }
    return $categories;
}

function insertObjet($id_user, $image_objet, $descri_objet, $prix_estime, $id_categorie){
    $DBH = dbconnect();
    $STH = $DBH->prepare("INSERT INTO objets (id_user, image_objet, descri_objet, prix_estime, id_categorie) VALUES (:id_user, :image_objet, :descri_objet, :prix_estime, :id_categorie)");
    $STH->bindParam(':id_user', $id_user, PDO::PARAM_INT);
    $STH->bindParam(':image_objet', $image_objet, PDO::PARAM_STR);
    $STH->bindParam(':descri_objet', $descri_objet, PDO::PARAM_STR);
    $STH->bindParam(':prix_estime', $prix_estime);
    $STH->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
    return $STH->execute();
}

function deleteObjet($id){
    $DBH = dbconnect();
    $STH = $DBH->prepare("DELETE FROM objets WHERE id_objet = :id");
    $STH->bindParam(':id', $id, PDO::PARAM_INT);
    return $STH->execute();
}