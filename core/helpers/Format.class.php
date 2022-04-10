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

    // rating star filled
    public function generateStars($rating) {
        $rating = round($rating);
        for($i=0; $i<$rating; $i++) {
            echo '<i class="fas fa-star text-warning"></i>';
        }
    }
    // empty stars
    public function emptyStars($rating) {
        $count = 5 -  round($rating);
        for($i=0; $i< $count; $i++) {
            echo '<i class="far fa-star text-warning"></i>';
        }
    }

    // text shortener
    public function shortenText($string, $length = 400) {
        $string = substr($string, 0, $length);
        if(strlen($string) >= $length) $string = $string."...";
        return $string;   
    }

    
}