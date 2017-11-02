<?php
class Wine extends Model implements JsonSerializable {

    private $name;
    private $color;
    private $year;
    private $designation;
    private $categoryId;


    // @ name
    function getName(){
        return $this->name;
    }
    function setName( $name ){
        $this->name = $name;
    }

    // @ color
    function getColor(){
        return $this->color;
    }
    function setColor( $color ){
        $this->color = $color;
    }

    // @ year
    function getYear(){
        return $this->year;
    }
    function setYear( $year ){
        $this->year = $year;
    }

    // @ designation
    function getDesignation(){
        return $this->designation;
    }
    function setDesignation( $designation ){
        $this->designation = $designation;
    }

    // @ categoryId
    function getCategoryId(){
        return $this->categoryId;
    }
    function setCategoryId( $categoryId ){
        $this->categoryId = $categoryId;
    }

    function jsonSerialize(){
        return [
            "id" => $this->id,
            "name" => $this->name,
            "color" => $this->color,
            "year" => $this->year,
            "designation" => $this->designation,
            "categoryId" => $this->categoryId
        ];
	}
}