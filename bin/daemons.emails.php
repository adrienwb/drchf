<?php
$emails = $db->exec('select * from emails_queue where sent = 0 order by creation_date asc');

$mailer = new Mailer($app);
foreach($emails as $email){
    $mailer->send($email['name'],$email['email'],$email['replace'],$email['id']);
}