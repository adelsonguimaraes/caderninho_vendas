<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json');
    date_default_timezone_set('America/Manaus');

    require_once __DIR__ . "/../invoke/invoke.php";
    invoke::call('usuario');

    $json = $_REQUEST;
    if (empty($json)) $json = file_get_contents ( "php://input" );
    if (gettype($json) === 'string') $json = json_decode($json);

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
        var_dump($json);
    }

    function post () {
        global $json;
        $control = new usuario_control($json);
        $response = $control->acessar();
        echo json_encode($response);
    }

?>