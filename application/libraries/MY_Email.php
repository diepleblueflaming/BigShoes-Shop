<?php

/**
 * Class Mail_library
 *
 * @package \\${NAMESPACE}
 */
class MY_Email extends CI_Email{

    private $config = [
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'charset'  => 'utf-8',
        'smtp_user' => 'lhdiep95@gmail.com',
        'smtp_pass' => 'elanlkshcctscfrw',
        'mailtype' => 'html'
    ];

    public function sendMail($config){
        $this->initialize($this->config);

        $this->from($config["from"]["email"], $config["from"]["name"]);
        $this->to($config["to"]);
        // tieu de email
        $this->subject($config["title"]);
        // noi dung email
        $this->message($config["content"]);

        // neu co file dinh kem
        if(isset($config["attach"])){
            $this->attach($config["attach"]);
        }

        if(!$this->send()){
            echo "failed";
        }
        $this->print_debugger();
    }
}
