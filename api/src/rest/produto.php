<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
    header('Content-Type: application/json');
    date_default_timezone_set('America/Manaus');

    require_once __DIR__ . "/../invoke/invoke.php";
    invoke::call("produto", true);
    

    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents ( "php://input" ); // caso não esteja no request
    if (gettype($json) === 'string') $json = json_decode($json); // caso senha string
    if (gettype($json) !== 'object') $json = (object) $json; // caso não seja um objeto

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET': {
            get();
            break;
        }
        case 'POST': {
            post();
            break;
        }
        case 'UPDATE': {
            update();
            break;
        }
        case 'DELETE': {
            delete();
            break;
        }
    }

    function get () {
        global $json;
        $control = new produto_control($json);
        $response = $control->listar();
        echo json_encode($response);
    }

    function post () {
        global $json;
    }

?>