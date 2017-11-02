<?php

header("Access-Control-Allow-Origin:*");

require 'flight/Flight.php';
require 'autoloader.php';

Flight::set( "BddManager", new BddManager() );

Flight::route('GET /all', function(){

    $all = [];

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getVendorRepo();
    $all["vendors"] = $repo->getVendors();

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getCategoryRepo();
    $all["categorys"] = $repo->getCategory();

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getWineRepo();
    $all["wines"] = $repo->getWines();
    
    echo json_encode( $all );
});

Flight::route('GET /vendors', function(){

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getVendorRepo();
    $vendors = $repo->getVendors();
    
    echo json_encode( $vendors );

});

Flight::route('GET /categorys', function(){

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getCategoryRepo();
    $categorys = $repo->getCategory();
    
    echo json_encode( $categorys );
});

Flight::route('GET /wines', function(){

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getWineRepo();
    $wines = $repo->getWines();

    echo json_encode( $wines );
});


Flight::route('POST /vendorWine', function(){

    $success = false;

    $vendorId = intval($_POST["vendorId"]);
    $wineId = intval( $_POST["wineId"] );

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getVendorRepo();
    $ret = $repo->setWineToVendor( $vendorId , $wineId );
    
    if( $ret == 1 ){
        $success = true;
    }

    echo json_encode( $success );
});

Flight::route('DELETE /deleteWineToVendor/@vendorId/@wineId', function( $vendorId , $wineId ){

    $success = false;

    $vendorId = intval( $vendorId );
    $wineId = intval( $wineId );
   
    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getVendorRepo();
    $ret = $repo->deleteWineToVendor( $vendorId , $wineId );
    
    if( $ret == 1 ){
        $success = true;
    }

    echo json_encode( $success );
});

// ############################## vendor's platform
Flight::route('GET /vendorLogin/@name/@pass', function( $name, $pass ){
    $status = [
        "success" => false,
        "errors" => false,
        "data" => false
    ];

    $newVendor = new Vendor();
    $newVendor->setName( $name );
    $newVendor->setPass( $pass );

    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getVendorRepo();
    $vendor = $repo->getVendor( $newVendor );

    if( $vendor != false ){
        $status["success"] = true;
        $status["data"] = $vendor;
    }
    else {
        $status["errors"] = "Identifiant ou mot de passe invalide";
    }

    // var_dump( $status );
    echo json_encode( $status );
});

Flight::route('GET /wines/@vid/@cid', function( $vid, $cid){
    
    $bddManager = Flight::get( "BddManager" );
    $repo = $bddManager->getWineRepo();
    $wines = $repo->getWineByVendorByCategory( $vid, $cid );

    echo json_encode( $wines );
});








Flight::start();