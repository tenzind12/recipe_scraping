<?php
class Format {
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
}