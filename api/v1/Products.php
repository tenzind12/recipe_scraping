<?php

class Products {
    public function read($resource_id, $params = '') {
        try {

            $db_name     = 'recipe';
            $db_user     = 'root';
            $db_password = '';
            $db_host     = 'localhost';

            $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $data = [];

            $sql  = "select * from recipes ";

            if (!empty($resource_id)) {

                $sql .= " where id = :id";
                $data['id'] = $resource_id;

            } else {

                $filter = '';

                if (isset($params['name']) ) {
                    $filter .=" and name = :name";
                    $data['name'] = $params['name'];
                }

                $sql .= " where id > 0 $filter";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);

            $products = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $products[] = $row;
            }

            $response = [];

            $response['data'] =  $products;

            if (!empty($resource_id)) {
               $response['data'] = array_shift($response['data']);
            }

           return json_encode($response, JSON_PRETTY_PRINT);

        } catch (PDOException $ex) {
            $error = [];
            $error['message'] = $ex->getMessage();

            return $error;
        }
    }
}