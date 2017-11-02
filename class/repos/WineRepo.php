<?php 
class WineRepo extends Repository {

    function getWines(){

        $query = "SELECT * FROM wine";
        
        $exec = $this->connection->query( $query );
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);

        $wines = [];

        foreach( $result as $value ){

            $newWine = new Wine( $value );
            $wines[] = $newWine;
        }

        return $wines;
    }

    function getWineByVendorByCategory( $vendor , $category ){

        $query = "SELECT w.* from wine as w
                    inner join vendorWine as vw
                    on vw.wineId = w.id
                    where w.categoryId = :cat and vw.vendorId = :vend";
        $prep = $this->connection->prepare( $query );
        $prep->execute( [
            "vend" => $vendor,
            "cat" => $category
        ] );

        $result = $prep->fetchAll(PDO::FETCH_ASSOC);
       
        return $result;
    }


   



}