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

    $item = new Compte($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
    $item->getCompteFromId();
    
    if($item->mdp != null){
        if (isset($_GET['nom']))
        {
            
            $item->x = $_GET['nom'];
        }

        if (isset($_GET['mdp']))
        {
            
            $item->y = $_GET['mdp'];
        }

        if (isset($_GET['niveau']))
        {
            
            $item->y = $_GET['niveau'];
        }
      
        $result = $item->updateCompte(); 

        $emp_arr = array(
            "id" => $item->id,
            "nom" => $item->nom,
            "mdp" => $item->mdp,
            "niveau" => $item->niveau,
            "result" => $result
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Recipe not found.");
    }
?>