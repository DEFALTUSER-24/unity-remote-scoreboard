<?php

    header("Access-Control-Allow-Origin: *");
    
    //Require specified files.
    require "settings/database.php";
    require "settings/request.php";

    //Checks if request is valid (if "action" was used as a $_GET parameter).
    if (!request::IsValid())
        request::EndWithError("Invalid request.");

    $action = $_GET["action"];

    //Do different actions based on $_GET "action" value.
    switch ($action)
    {
        case "add-score":
        {
            if (!request::IsPost())
                request::EndWithError("This should be a POST request.");

            require "requests/store-data.php";
            break;
        }
        case "get-scores":
        {
            if (!request::IsGet())
                request::EndWithError("This should be a GET request.");

            require "requests/get-data.php";
            break;
        }
        default:
        {
            request::EndWithError("Invalid action.");
        }
    }
