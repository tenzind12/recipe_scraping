<?php 
    include_once __DIR__.'/../connection/Db.php';
    include_once __DIR__.'/../helpers/HelperClass.class.php';


    class Donation {
        private $db;
        private $class_helper;

        public function __construct() {
            $this->db = new ConnectionDb();
            $this->class_helper = new HelperClass();
        }

        // STORE DONATION DATA MYSQL
        public function storeDonation($paymentId, $first_name, $last_name, $email, $amount) {
            $query = "INSERT INTO `donations`
                (`paymentId`, `first_name`, `last_name`, `email`, `amount`) 
                    VALUES 
                ('$paymentId', '$first_name', '$last_name', '$email', '$amount')";
            
            $donation_saved = $this->db->insert($query);
            if($donation_saved) {
                $msg = $this->class_helper->alertMessage('Thank you', 'Success !', 'We received your donation of ' . $amount . ' euros');
                return $msg;
            }
        }
    }