<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
  
    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    //Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate product object
    $product = new Product($db);

    //List query

    $result = $product->list();
    $numRow = $result->rowCount();

    if($numRow > 0){
        $product_arr = array();
        $product_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $product_item = array(
                'id' => $id,
                'name' => $name,
                'industry' => $industry,
                'price' => $price,
                'amount' => $amount
            );
            
            array_push($product_arr['data'], $product_item);
        }

        echo json_encode(array(
            'success' => true,
            'result' => $product_arr
        ));
    } else{
        echo json_encode(array(
            'success' => true,
            'result' => 'Nenhum produto encontrado'
        ));
    }

?>