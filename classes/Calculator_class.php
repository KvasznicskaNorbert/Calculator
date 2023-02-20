<?php
class Calculator{

    public function add($value1, $value2){
        return $value1 + $value2;
    }

    public function subtraction($value1, $value2){
        return $value1 - $value2;
    }

    public function multiplication($value1, $value2){
        return $value1 * $value2;
    }

    public function division($value1, $value2){
        return $value1 / $value2;
    }

    public function GetHistory(){
        return $this->history;
    }
}