<?php 
class VendorRepo extends Repository {

    function getVendors( ){

        $query = "SELECT * FROM vendor";

        $exec = $this->connection->query( $query );
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);

        $vendors = [];

        foreach( $result as $value ){

            $query1 = "SELECT wineId FROM vendorWine where vendorId = :vendorId";
        
            $prep = $this->connection->prepare( $query1 );
            $prep->execute( [
                "vendorId" => $value["id"]
            ] );

            $result1 = $prep->fetchAll(PDO::FETCH_COLUMN);
            
            
            $newVendor = new Vendor();
            $newVendor->setId($value["id"]);
            $newVendor->setName($value["name"]);
            $newVendor->setProducts($result1);
            
            $vendors[] = $newVendor;
        }

        return $vendors;
    }


    function getVendor( Vendor $vendor){

        $query = "SELECT * from vendor where name = :name and pass = :pass";

        $values = array(
            "name" => $vendor->getName(),
            "pass" => $vendor->getPass()
        );

        $prep = $this->connection->prepare( $query );
        $prep->execute( $values );
        $result = $prep->fetchAll(PDO::FETCH_ASSOC);

        if( !empty( $result ) ){

            return new Vendor( $result[0] );
        }

        return false;
    }

    function setWineToVendor( $vendorId , $wineId ){

        $query = "INSERT INTO vendorWine SET vendorId = :vendorId, wineId = :wineId";
        

        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "vendorId" => $vendorId,
            "wineId" => $wineId
        ]);
        $lastInsertId = $this->connection->lastInsertId();

        return $prep->rowCount();
    }   

    function deleteWineToVendor( $vendorId , $wineId ){

        $query = "DELETE FROM vendorWine WHERE vendorId = :vendorId AND wineId = :wineId";
        
        $prep = $this->connection->prepare( $query );
        $prep->execute([
            "vendorId" => $vendorId,
            "wineId" => $wineId
        ]);
        $lastInsertId = $this->connection->lastInsertId();

        return $prep->rowCount();
    }








}