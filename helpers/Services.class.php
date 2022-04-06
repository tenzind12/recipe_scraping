<?php

class Service {

    // extracting integer from string
    public function extractInt($string) {
        return preg_replace('/[^0-9]/', '', $string);
    }
}