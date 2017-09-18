<?php

/**
 * Class testEmail
 *
 * @package \\${NAMESPACE}
 */
class TestEmail extends CI_Controller {

    public function index(){
        $this->load->library("email");
        $config = [
            "from" => ["email" => "lhdiep95@gmail.com", "name" => "Le Hai Diep"],
            "to" => ["lebichngoc26@gmail.com"],
            "title" => "This is an Email",
            "content" => "this is a test email"
        ];

        $this->email->sendMail($config);
    }
}
