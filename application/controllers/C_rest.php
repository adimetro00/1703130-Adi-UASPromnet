<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_rest extends CI_Controller {
	
	public function __construct()
    {
    // created the construct so that the helpers, libraries, models can be loaded all through this controller
    parent::__construct();
    $this->load->helper('url');
	$this->load->library('curl');
    $this->load->library('xmlrpc');
    $this->load->library('xmlrpcs');
        $this->refcode = $this->session->userdata('refcode');
    }

  public function index()
    {
      $secretKey = "sk_test_1234567";

      $url = "https://api.akhmad.id/uaspromnet/" . $this->refcode;

      // append the header putting the secret key and hash

      $request_headers = array();
      $request_headers[] = 'Authorization: Bearer ' . $secretKey;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $data = curl_exec($ch);

      if (curl_errno($ch))
        {
        print "Error: " . curl_error($ch);
        }
        else
        {
        // Show me the result

        $transaction = json_decode($data, TRUE);

        curl_close($ch);

        var_dump($transaction['data']);

      }
    }
}
