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



}