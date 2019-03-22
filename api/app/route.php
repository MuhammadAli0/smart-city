<?php
require __DIR__ .  '/app.php';





// ------------- Register-------------------
$app->post('/register', function($request, $response){

    $data = $request->getParsedBody();

    if ( isset( $data) ) { 
            try{
                // foreach ($data as $data){
                //     echo $data;
                // }
                $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
                $gender = $data['gender'];
                $email = $data['email'];
                $phone = $data['phone'];
                $target = $data['target'];
                $org = $data['org'];
                $note = $data['note'];
                $type = $data['type_of_participation'];
                $rb = "";
                foreach ($type as $tb){
                    $rb = $rb . ", " . $tb;
                }
                if (Register($name, $gender, $email, $phone, $target, $org, $rb, $note) == TRUE ){
                    echo(json_encode(array(
                        "status" => 200
                    )));
                    exit();
                }else{
                    echo(json_encode(array(
                        "status" => 300
                    )));
                    exit();
                }
    
            } catch (ERROR $e){
                echo $e;
                exit();
            }

    }
   
    


     
});





?>
