<?php
    //Connect to database
    database::connect();

    //Query the database for results
    $query_result = database::Query("SELECT name, user_score FROM users_score ORDER BY user_score DESC LIMIT 10");

    //If no result was found, end with error.
    if (!database::Result($query_result))
        request::EndWithError("No scores were found.");

    $query_data = array();

    //Fetch every result and store inside an array.
    while ($data = mysqli_fetch_assoc($query_result)) {
        $query_data[] = $data;
    }

    //End request with obtained data.
    request::EndWithData($query_data);