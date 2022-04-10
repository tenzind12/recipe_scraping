<?php
class HelperClass {

    // error message generator
    public function alertMessage($messageType, $head, $body) {
        return '
        <div class="alert alert-'. $messageType .' alert-dismissible fade show" role="alert">
            <strong>'.$head.'</strong> '.$body.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
}