<?php

class Mailer {

    function __construct($app){
        $this->app = $app;
        $this->db = $app->get('dbx');

        $this->logger = new Log('mailer.log');
    }

    function getTemplate($name){
        $template=$this->db->exec('SELECT subject,body FROM `emails_template` WHERE name=?',$name);
        if($template['0']){
            return $template['0'];
        }
    }


    function send($name,$to,$replace,$id=false){

        $smtp = new SMTP (
            $this->app->get('smtp_host'),
            $this->app->get('smtp_port'),
            $this->app->get('smtp_scheme'),
            $this->app->get('smtp_user'),
            $this->app->get('smtp_pw')
        );


        if($template = $this->getTemplate($name)){

            //var_dump($template['body']);exit;
            $smtp->set('To', sprintf('"Contact Name" <%s>',$to));
            $smtp->set('From', '"Romaric" <bonjour@derechef.fr>');
            $smtp->set('Subject', $template['subject']);

            $smtp->set('MIME-Version', '1.0');
            $smtp->set('Content-type', 'text/html; charset=iso-8859-1');


            if($smtp->send($template['body'])){
                $this->db->exec('UPDATE emails_queue SET sent=1,sent_date=NOW() WHERE id=?',$id);
                $this->logger->write( "mail sent to $to");
            }
        }
    }
}