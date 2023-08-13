<?php

namespace Serenatto\Web\Infrastructure\Persistence;

use PDO;

class ConnectionCreator {

    public static function createConnection() : PDO
    {
        $pdo = new PDO('mysql:dbname=serenatto;host=localhost','root','root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo; 

    }
    
}