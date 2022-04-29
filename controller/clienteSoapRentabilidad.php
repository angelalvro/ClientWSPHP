<?php

class ClienteSoapRentabilidad
{
    public $soapUrl = "http://156.35.98.130:8080/ws.soap.rentabilidad/soapws/rentabilidad?wsdl";

    public function obtenerRentabilidad($activo, $precioCompra)
    {
        try {
            $ch = curl_init();

            // Check if initialization had gone wrong*
            if ($ch === false) {
                throw new Exception('failed to initialize');
            }

            $xml_post_string='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservices.rentabilidad.ws.miw.uniovi.es/">
                            <soapenv:Header/>
                            <soapenv:Body>
                               <web:calcularRentabilidad>
                                  <arg0>'.$activo.'</arg0>
                                 <arg1>'.$precioCompra.'</arg1>
                              </web:calcularRentabilidad>
                           </soapenv:Body>
                        </soapenv:Envelope>';

            $headers = array(
                "Content-type: text/xml;charset=UTF-8",
                "Accept: text/xml",
                "Cache-Control: no-cache",
                "Pragma: no-cache",
                "SOAPAction: ",
                "Content-length: " . strlen($xml_post_string),
            );

            $url = $this->soapUrl;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            //curl_setopt ($ch, CURLOPT_SSLVERSION, 6);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);


            $content = curl_exec($ch);

            // Check the return value of curl_exec(), too
            if ($content === false) {
                throw new Exception(curl_error($ch), curl_errno($ch));
            }

            // Check HTTP return code, too; might be something else than 200
            $httpReturnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            /* Process $content here */

        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        } finally {
            // Close curl handle unless it failed to initialize
            if (is_resource($ch)) {
                $response = curl_exec($ch);
            }
        }

        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);

        try {
            $xml = new SimpleXMLElement($response);
            $body = $xml->xpath('//SBody')[0];
            $array = json_decode(json_encode((array)$body), TRUE);
            $arrayEdit = $array["ns2calcularRentabilidadResponse"];
        }catch (Exception $e){
            //$arrayEdit = new array("Return" => "0");
        }

        return $arrayEdit;

    }
}

?>
