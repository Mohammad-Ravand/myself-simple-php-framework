<?php

return [
    "mysql"=>[
        "username"=> $_ENV["username"],
        "password"=>$_ENV["password"],
        "database"=> $_ENV["database"],
        "host"=> $_ENV["host"],
        "port"=> $_ENV["port"]
    ]
];