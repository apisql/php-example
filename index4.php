<?php
# curl https://php.loadfunc.com/apifunc.php --output apifunc.php
# curl https://loadfunc.github.io/php/apifunc.php --output apifunc.php
include 'apifunc.php';
header('Content-Type: application/json');

# Webs service with JSON
try {

    # Load functions from remote/local
    apifunc([
        'https://php.letjson.com/let_json.php',
        'https://php.defjson.com/def_json.php',
        'https://php.apisql.com/api_sql.php'], function ($func_url_array) {

        // Load config file from remote/local json file
        let_json('db.json', function ($db) {

            // load data from sqlite based on json configuration: config.json
            api_sql($db->db, $db->read, function ($fetch) {

                // encode data to json
                echo def_json('', $fetch);
            });
        });
    });

} catch (exception $e) {
    echo def_json('', ['error' => $e->getMessage()]);
}

?>

