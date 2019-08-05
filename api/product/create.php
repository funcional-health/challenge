<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
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

    $product->name = $data->name;
    $product->industry = $data->industry;
    $product->price = $data->price;
    $product->amount = $data->amount;

    //Create Product
    if($product->create()){
        echo json_encode(array(
            'success' => true,
            'result' => 'Produto cadastrado'
        ));
    } else{
        echo json_encode(array(
            'success' => false,
            'result' => 'Produto não cadastrado'
        ));
    }