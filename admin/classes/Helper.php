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
     * @work Encode Html entities
     * @param $string
     * @return string
     */
    public static function html_entity($string)
    {
        $new_string = htmlentities($string);
        return $new_string;
    }


    /**
     * @work decode Html entities
     * @param $string
     * @return string
     */
    public static function html_entity_decode($string)
    {
        $new_string = html_entity_decode($string);
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


    /**
     * @work To check if an array is associative or not
     * @param $arr
     * @return bool
     */
    public static function isAssoc($arr)
    {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }


}