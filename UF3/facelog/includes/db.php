<?php
require_once "imatge.php";

//Funció per retornar les imatges de la base de dades
function facelog_dbget(string $usuari): array
{

    try {
        $hostname = "localhost";
        $dbname = "wordpress";
        $username = "wordpress";
        $pw = "wordpress";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    //preparem i executem la consulta
    $query = $pdo->prepare("select * from wp_user_images where usuari = ? order by date ASC");
    $query->execute([$usuari]);

    $registres = [];

    foreach ($query as $row) {
        array_push($registres, new Imatge($row['image'], $row['date']));
    }


    //eliminem els objectes per alliberar memòria 
    unset($pdo);
    unset($query);

    return $registres;
}

//Funció per crear la taula de la base de dades
function crearTaula()
{
    try {
        $hostname = "localhost";
        $dbname = "wordpress";
        $username = "wordpress";
        $pw = "wordpress";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    //preparem i executem la consulta
    $query = $pdo->prepare("CREATE TABLE wp_user_images (
    usuari varchar(40) NOT NULL,
    ruta_imatge varchar(200) NOT NULL,
    image varchar(200) NOT NULL,
    date date NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    $query->execute();

    //eliminem els objectes per alliberar memòria 
    unset($pdo);
    unset($query);
}

//Funció per borrar la taula de la base de dades
function borrarTaula()
{
    try {
        $hostname = "localhost";
        $dbname = "wordpress";
        $username = "wordpress";
        $pw = "wordpress";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    //preparem i executem la consulta
    $query = $pdo->prepare("DROP TABLE wp_user_images");
    $query->execute();

    //eliminem els objectes per alliberar memòria 
    unset($pdo);
    unset($query);
}

//Funció per insertar una nova imatge a la base de dades
function insertarRegistreImatge($usuari, $ruta_imatge, $url_imatge, $data_imatge)
{
    try {
        $hostname = "localhost";
        $dbname = "wordpress";
        $username = "wordpress";
        $pw = "wordpress";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare("select * FROM wp_user_images where date = ? AND usuari = ?");
    $query->execute([$data_imatge, $usuari]);

    if ($query->rowCount() > 0) {
        $query = $pdo->prepare("UPDATE wp_user_images SET usuari = ?, ruta_imatge = ?, image = ? WHERE date = ?");
        $query->execute([$usuari, $ruta_imatge, $url_imatge, $data_imatge]);
    } else {
        //preparem i executem la consulta
        $query = $pdo->prepare("INSERT INTO wp_user_images VALUES(?, ?, ?, ?)");
        $query->execute([$usuari, $ruta_imatge, $url_imatge, $data_imatge]);
    }

    //eliminem els objectes per alliberar memòria 
    unset($pdo);
    unset($query);
}

//Funció per obtenir totes les rutes de les imatges de la base de dades i retornar-les en un array
function obtenirRutes()
{
    try {
        $hostname = "localhost";
        $dbname = "wordpress";
        $username = "wordpress";
        $pw = "wordpress";
        $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
    } catch (PDOException $e) {
        echo "Failed to get DB handle: " . $e->getMessage() . "\n";
        exit;
    }

    $query = $pdo->prepare("SELECT ruta_imatge FROM wp_user_images");
    $query->execute();
    
    $rutes = [];

    foreach ($query as $ruta) {
        array_push($rutes, $ruta[0]);
    }

    return $rutes;

    unset($pdo);
    unset($query);
}
