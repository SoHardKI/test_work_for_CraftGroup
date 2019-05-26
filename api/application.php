<?php
require_once 'UsersApi.php';

try {
    $api = new usersApi();
    //var_dump($api);
    $answer =$api->run();
    if (UsersApi::isJson($answer)==true)
    {
        $answer =  urldecode($answer);
        echo $answer;
    } else {
        if($answer)
        {
            $xml = new SimpleXMLElement($answer, LIBXML_NOCDATA);
            var_dump($xml);
        }
    }

} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>