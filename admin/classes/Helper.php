<?php

class Helper{

    /**
     * @work Convert special characters to HTML entities
     * @param $string
     * @return mixed
     */
    public static function escape_string($string)
    {
        $new_string = htmlspecialchars($string);
        return $new_string;
    }



    /**
     * @work html special chars_decode
     * @param $string
     * @return string
     */
    public static function decode_string($string)
    {
        $new_string = htmlspecialchars_decode($string);
        return $new_string;
    }


    /**
     * @work If there is not data in the data array return message
     * @param $array
     * @return string
     */
    public static function check_data_array($array)
    {
        if(empty($array)){
            return "Sorry, Data Not Found!";
        }else{
            return $array;
        }
    }


    /**
     * @work redirect user to desired page
     * @param $page Location page
     */
    public static function redirect($page)
    {
        header("Location: ".$page);
    }


}