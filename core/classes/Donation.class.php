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
        public function storeDonation($paymentId, $first_name, $last_name, $email, $amount, $date) {
            $query = "INSERT INTO `donations`
                (`paymentId`, `first_name`, `last_name`, `email`, `amount`, `date`) 
                    VALUES 
                ('$paymentId', '$first_name', '$last_name', '$email', '$amount', '$date')";
            
            $donation_saved = $this->db->insert($query);
            if($donation_saved) {
                $msg = $this->class_helper->alertMessage('warning', 'Success !', 'We received your donation of ' . $amount . ' €');
                return $msg;
            } else {
                $msg = $this->class_helper->alertMessage('danger', 'Failed !', 'Donation failed. Please try again !');
                return $msg;
            }
        }

        // GET DONATION
        public function getDonation() {
            $query = "SELECT * FROM `donations`";
            $donation = $this->db->query($query);
            return $donation;
        }
    }