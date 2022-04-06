<?php

use Phalcon\Mvc\Controller;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    /**
     * Function to Display Book List
     *
     * @return void
     */
    public function indexAction()
    {

        $this->view->details = array();
        $postdata = $this->request->getPost();
        if (count($postdata) > 0) {
       
            $name = urlencode($postdata['book']);

            
            $url = "http://api.weatherapi.com/";

            $client = new Client(
                [
               
                'base_uri' => $url,
  
                ]
            );
            $query = ["key" => '0bab7dd1bacc418689b143833220304', 'q'=>$name];
  
            $response = $client->request('GET', '/v1/search.json', ['query'=>$query]);

    
        
            $response = json_decode($response->getBody(), true); 
            
            
            $this->view->details = $response;
             
        }
        
        
    }
    /**
     * Function to display single book
     *
     * @param [type] $olid
     * @return void
     */
    public function currentLocationAction($name)
    {

        $this->view->name = $name;
        


    }
    
    public function informationAction($name,$action, $disp = "", $date = "")
    {
        $this->view->disp = $disp;
        $url = "http://api.weatherapi.com/";

            $client = new Client(
                [
               
                'base_uri' => $url,
  
                ]
            );
            // $date =date('y-m-d', strtotime("-1 days"));
                // echo $date;
                // die;
            $query = ["key" => '0bab7dd1bacc418689b143833220304', 'q'=>$name, 'dt'=>$date, 'aqi'=>'yes', 'alerts'=>'yes'];
            $response = $client->request('GET', '/v1/'.$action.'.json', ['query'=>$query]);
            $response = json_decode($response->getBody(), true); 
            $this->view->details = $response;
            echo "<pre>";
            print_r($response);
  
    }            
}