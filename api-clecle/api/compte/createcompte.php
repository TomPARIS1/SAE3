<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../class/compte.php';

    $database = new Database();
    $db = $database->getConnection();
    $_SERVER['REQUEST_METHOD'] = 'POST';

    $item = new Compte($db);
    
    $data = json_decode(file_get_contents("php://input"));

    $hashed = hash("sha512", $data->mdp);
    $item->nom = $data->nom;
    $item->mdp = $hashed;
    $item->niveau = $data->niveau;

    if ($item->findCompteByName()!=null)
    {
        echo "1";
    }
    else if($item->createCompte()){
        echo '0';
    } else{
        echo "2";
    }
?>