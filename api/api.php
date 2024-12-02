<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$users = [
    ['id' => 1, 'nombre' => "Pepe"],
    ['id' => 2, 'nombre' => "Manolo"],
    ['id' => 3, 'nombre' => "Juan"]
];

$metodo = $_SERVER["REQUEST_METHOD"];
switch ($metodo) {
    case 'GET':
        if(isset($_GET['id'])){
            $exists = false;
            foreach ($users as $user) {
                if($user['id'] == $_GET['id']){
                    echo json_encode(['estado' => 'Exito', 'data_count' => 1, 'data' => $user]);
                    $exists = true;
                    break;
                }
            }
            if(!$exists){
                http_response_code(404);
                echo json_encode(['estado' => 'Fallido', 'data' =>[]]);
            }
        }else{
            echo json_encode(['estado' => 'Exito', 'data_count' => count($users), 'data' => $users]);
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input",true));
        echo print_r($data);
        break;
    case 'PUT':

        break;
    case 'DELETE':

        break;
    default:
        # code...
        break;
}