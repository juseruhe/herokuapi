<?php
class Database{
    public function getconectar(){
    $localhost = 'bile850769ms7y36d0gt-mysql.services.clever-cloud.com';
    $database = 'bile850769ms7y36d0gt';
    $user = 'u7qyhwwkxjvyhcbj'; 
    $password = 'vVfrQrSRySpfPdcYQhpS';
    $link = new PDO("mysql:host=$localhost; dbname=$database", $user, $password);
    return $link;
    }
}
?>