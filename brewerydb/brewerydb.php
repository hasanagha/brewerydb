<?php
/**
 * BrewerDB library to communicate between brewerdb api's endpoints 
 *
 * usage:   $bdo = new BrewerDB(array('api_key' => 'brewerydbs_api_key'));
 *          $bdo->sendRequest('beer/random');
 **/

class BrewerDB {
	/*
	 * The urls contain conversion specifications that will be replaced by sprintf in the functions
     *
	 * @var string
	 */
    protected $api_url = 'http://api.brewerydb.com/v2/%s?%s'; // endpoint?params
	
    /**
     * API key
     *
     * @var string
     */
    protected $api_key = '';

    /**
     * Constructor
     *
     * @param string $api_key Brewerydb API key
     */
    public function __construct($params)
    {
        if(isset($params['api_key'])) {
            $this->api_key = $params['api_key'];
        }
    }

    /**
     * Accepts params and send request to brewerydb
     *
     * @param endpoint string
     * @param query_params array
     * @param method string (GET)
     * @return response from the server
     */
    public function sendRequest($endpoint='', $query_params = array(), $method='GET')
    {
        $params = $this->addKeyInParams($query_params);

        $url = sprintf($this->api_url, $endpoint, http_build_query($params));
        
        $response = $this->getCurl($url);

        return $response;
    }

    /**
     * Add api key in params array
     *
     * @param params array
     * @return array
     */
    private function addKeyInParams($params) {

        if(is_array($params)) {
            $params['key'] = $this->api_key;
        }

        return $params;
    }

    /**
     * Trigger curl request
     *
     * @param url string
     * @return response returned form curl call
     */
    private function getCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        return $response;
    }

}
