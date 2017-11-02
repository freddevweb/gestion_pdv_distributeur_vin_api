<?php 
//BddManager va contenir les instances de nos repository
class BddManager {

    private $vendorRepo;
    private $categoryRepo;
    private $wineRepo;

    private $connection;

    function __construct(){

        $this->connection = Connection::getConnection();

        $this->vendorRepo = new VendorRepo( $this->connection );
        $this->categoryRepo = new CategoryRepo( $this->connection );
        $this->wineRepo = new WineRepo( $this->connection );
    }

    function getVendorRepo(){
        return $this->vendorRepo;
    }
    function getCategoryRepo(){
        return $this->categoryRepo;
    }
    function getWineRepo(){
        return $this->wineRepo;
    }

}