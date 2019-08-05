<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  
    include_once '../../config/Database.php';
    include_once '../../models/Product.php';

    //Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate product object
    $product = new Product($db);

    //Get data from Post request
    $data = json_decode(file_get_contents("php://input"));

    $product->id = $data->id;
    $product->name = $data->name;
    $product->industry = $data->industry;
    $product->price = $data->price;
    $product->amount = $data->amount;

    //Update product
    if($product->update()){
        echo json_encode(array(
            'success' => true,
            'result' => 'Produto Atualizado'
        ));
    } else{
        echo json_encode(array(
            'success' => false,
            'result' => 'Produto não Atualizado'
        ));
    }