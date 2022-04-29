<?php

class ClienteRestCrud
{
    public $service_url     = 'http://156.35.98.162:8080/ws.portfolio.crud/api/portfolios?wsdl';

    public function listar()
    {
        try {
            $curl = curl_init();

            if ($curl === false) {
                throw new Exception('failed to initialize');
            }

            $curl = curl_init($this->service_url);

            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $curl_response = curl_exec($curl);
            // Check the return value of curl_exec(), too
            if ($curl_response === false) {
                throw new Exception(curl_error($curl), curl_errno($curl));
            }
            curl_close($curl);
            return json_decode($curl_response);
        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        } finally {
            // Close curl handle unless it failed to initialize
            if (is_resource($curl)) {
                $response = curl_exec($curl);
            }
        }
    }

    public function add($cartera)
    {
        $data = array(
            "nombre" => $cartera[0],
            "activo" => $cartera[1],
            "bolsa" => $cartera[2],
            "cantidad" => $cartera[3],
            "precio" => $cartera[4]
        );
        $postdata = json_encode($data);
        $ch            = curl_init($this->service_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    public function delete($id)
    {
        $service_url = "http://156.35.98.162:8080/ws.portfolio.crud/api/portfolios/" . $id . "?wsdl" ;
        $ch = curl_init($service_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

    public function update($cartera)
    {
        $data = array(
            "nombre" => $cartera[0],
            "activo" => $cartera[1],
            "bolsa" => $cartera[2],
            "cantidad" => $cartera[3],
            "precio" => $cartera[4]
        );
        $postdata = json_encode($data);
        $service_url = "http://156.35.98.162:8080/ws.portfolio.crud/api/portfolios/" . $cartera[5] . "?wsdl" ;
        $ch = curl_init($service_url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
}

?>