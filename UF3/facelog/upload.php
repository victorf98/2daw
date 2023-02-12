<?php

require_once __DIR__ . '/../../../wp-load.php';
require_once __DIR__ . "\includes\db.php";

/** Sets up the WordPress Environment. */
define('WP_USE_THEMES', false); /* Disable WP theme for this file (optional) */

//Establim la variable data per saber si la imatge és d'avui o no
if ($_POST["today"] == 1) {
    $data = date("Y-m-d");
} else {
    $data = $_POST["date"];
}

//Comprovem que la imatge sigui correcta (només admetem jpg i que no sigui més gran de 1MB)
if ($_FILES['imageupload']["type"] != "image/jpeg" || $_FILES['imageupload']["size"] > 10000000 || $_FILES['imageupload']['error'] != 0) {
    wp_redirect("http://localhost/wordpress/addlog/?err=Error%20en%20la%20imatge", 301);
    exit;
    //Establim la ruta i la url de la imatge i la pugem al servidor i a la base de dades
} else {
    $ruta_tmp = __DIR__ . "\uploads\\tmp\\" . $data . "_" . wp_get_current_user()->user_login . ".jpg";

    //Posem la imatge a la carpeta tmp de uploads
    move_uploaded_file($_FILES['imageupload']['tmp_name'], $ruta_tmp);

    //Cridem al servei i ho passem a un array
    $response = cridarServei($ruta_tmp);
    $response = json_decode($response, true);
    if (!isset($response["result"])) {
        unlink($ruta_tmp);
        wp_redirect("http://localhost/wordpress/addlog/?err=No%20hi%20ha%20persones", 301);
    } else {
        /**
         * Si es detecta més d'una persona a la imatge o no es detecta cap persona, 
         * esborrem la imatge i tornem a la pàgina d'afegir registre
         */
        if (count($response["result"]) > 1) {
            unlink($ruta_tmp);
            wp_redirect("http://localhost/wordpress/addlog/?err=Error%20en%20les%20persones", 301);
            /**
             * Si només hi ha una persona, guardem les coordenades de les parts de la cara (ulls i nas),
             * movem la imatge de tmp a la carpeta img  i la pugem a la base de dades
             */
        } else {
            $response = $response["result"][0]["landmarks"];
            $cara["ull_esquerre"] = $response[0];
            $cara["ull_dret"] = $response[1];
            $cara["nas"] = $response[2];
            print_r($cara);
            $ruta = __DIR__ . "\img\\" . $data . "_" . wp_get_current_user()->user_login . ".jpg";
            $ruta_url = plugins_url($data . "_" . wp_get_current_user()->user_login . ".jpg",  $ruta);
            rename($ruta_tmp, $ruta);
            insertarRegistreImatge(wp_get_current_user()->user_login, $ruta, $ruta_url, $data);
            wp_redirect("http://localhost/wordpress/addlog/", 301);
        }
    }
}

//Funció per cridar al servei i retornar la les coordenades de les parts de la cara
function cridarServei($ruta_tmp)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://bosc.boscdelacoma.cat:8000/api/v1/detection/detect?face_plugins=landmarks');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: multipart/form-data',
        'x-api-key: 3605527e-480c-4e59-a469-c246210d4cd9',
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'file' => new CURLFile($ruta_tmp),
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        wp_redirect("http://localhost/wordpress/addlog/?err=Error%20en%20la%20imatge", 301);
    }
    curl_close($ch);

    return $response;
}
