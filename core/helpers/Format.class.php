<?php
class Format {

    // extracting image from json stringified object
    public function extractImage($str) {
        $image = '';
        $isObject = strpos($str, "@type");
        if($isObject) {
            $imageObj = json_decode($str);
            $image = $imageObj->url;
        }else {
            $image = $str;
        }
        return $image;
    }

    // filter the user input 
    public function validation($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // min to hour converter
    public function minToHour($minutes) {
        if($minutes <= 60) {
            return $minutes.' mins';
        }
        $min = $minutes % 60;
        $hour = $minutes / 60;
        return (int)$hour.':'.strlen((string)$min) < 1 ? '0'.$min. ' mins': $min . ' mins';
    }
}