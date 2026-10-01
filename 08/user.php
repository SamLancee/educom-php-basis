<?php
interface start{
    public function setId (int $id);
    public function getId(): int;
    public function checkFileName(string $filename): bool;
    public function showImage();
    public function showPassport();

    }

class User implements start {
    private int $id;
    private string $filename ="";

    public function __construct(int $id = 0) {
        $this->id = $id;
    }

    public function setID(int $id){
        $this -> id = $id;
    }
    public function getId(): int{
        return $this -> id;
    }

    public function checkFileName(string $filename): bool{
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed= ["jpg", "png", "jpeg", "gif"];
        return in_array($extension, $allowed, true);
    }
    public function showImage(){

    }
    public function showPassport(){

    }


}