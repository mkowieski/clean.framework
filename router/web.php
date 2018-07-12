<?php

return [
    "/" => ["method" => ["POST", "GET"], "action" => "HomeController@index"],
    "/users/{id}" => ["method" => ["GET"], "action" => "HomeController@getUser"]
];