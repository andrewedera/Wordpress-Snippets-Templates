<?php
class MagentoIntegration {

    /**
     * Constructor
     * @param array $keys   Contains Access and Consumers keys
     * @param array $config Contains URL, Wordpress options
     */
    function __construct()
    {
        $this->user             = '';
        $this->password         = '';
        $this->url              = '';
        $this->items            = 5;

        $this->credentials      = array("username" => $this->user, "password" => $this->password);
        $this->signature        = array();
    }

    /**
     * Get Magento v2 Access Token
     * @return string Returns the requested Access Token
     */
    public function getToken() {
        $this->token = $this->cUrlRequest($this->url . '/rest/V1/integration/admin/token', null, 'POST');

        return json_decode($this->token);
    }

    /**
     * Gets and returns all products
     * @param  string $token Access Token
     * @return array         Returns all products
     */
    public function getAllProducts() {

        $this->products = $this->cUrlRequest($this->url . '/rest/V1/products?fields=items[name,price,custom_attributes]&searchCriteria[pageSize]=' . $this->items, $this->getToken());

        return $this->products;
    }

    /**
     * Handles the request using cUrl
     * @param  string $url    Magento v2 API url
     * @param  string $token  Access Token
     * @param  string $method Method (GET, POST) default: GET
     * @return array          Result
     */
    private function cUrlRequest($url, $token = null, $method = 'GET') {

        $this->url          = $url;
        $this->method       = $method;
        $this->token        = $token;

        $this->signature  = json_encode($this->credentials);

        $curlConfig   = array(
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_CUSTOMREQUEST => $this->method,
                            CURLOPT_URL => $this->url,          
                        );

         if(!$this->token) { // Only if $token is requested do this
             $curlConfig[CURLOPT_POSTFIELDS] = $this->signature;
             $curlConfig[CURLOPT_HTTPHEADER] = array('Content-Type: application/json','Content-Length: ' . strlen($this->signature));
        } else {
            $curlConfig[CURLOPT_HTTPHEADER] = array('Authorization: Bearer ' . $this->token);

        }

        $ch = curl_init();

        curl_setopt_array($ch, $curlConfig);

        $result = curl_exec($ch);

        curl_close($ch);

        return $result;
    }

}
