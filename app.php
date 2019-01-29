<?php

/**
 * Description of app
 * Main class to perform common activities
 */

final class App {

    /*
     * Get filter request data
     * @var string $data
     */
    public static function filterData($data){
        return trim(htmlspecialchars(strip_tags($data)));
    }

    /*
     * Show response in json format
     * @var boolean $status
     * @var int $code
     * @var string/array $message
     */
    public static function showResponse($status, $code, $message){
        return json_encode(array("status"=>$status, "code"=>$code, "response"=>$message));
    }

}
