<?php
class Vendor extends Model implements JsonSerializable {

    private $name;
    private $pass;
    private $products;
    
    // @ name
    function getName(){
        return $this->name;
    }
    function setName( $name ){
        $this->name = $name;
    }

    // @ pass
    function getPass(){
        return $this->pass;
    }
    function setPass( $pass ){
        $this->pass = $pass;
    }

    // @ products
    function getProducts(){
        return $this->products;
    }
    function setProducts( $products ){
        $this->products = $products;
    }

   

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "pass" => $this->pass,
            "products" => $this->products,
        ];
    }

}