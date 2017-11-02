<?php 
class CategoryRepo extends Repository {


    function getCategory(){

        $query = "SELECT * FROM category";

        $exec = $this->connection->query( $query );
        $result = $exec->fetchAll(PDO::FETCH_ASSOC);

        $categorys = [];

        foreach($result as $value ){
            $newCategory = new Category();
            $newCategory->setId( $value["id"] );
            $newCategory->setName( $value["name"] );
            $categorys[] =  $newCategory;
        }

        return $categorys ;
    }

}