<?php

    //Header
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB and Connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate category object
    $category = new category($db);

    //Category read query
    $result = $category->read_single_cat();

    //Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get category
    $category->read_single_cat();

    // Create Array
    $cat_arr = array(
        'id' => $category->id,
        'name' => $category->name
    );

    // Make JSON
    print_r(json_encode($cat_arr));