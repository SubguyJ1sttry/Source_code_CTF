<?php
class Login {
    public function __construct($user, $pass) {
        $this->loginViaXml($user, $pass);
    }

    public function loginViaXml($user, $pass) {
        if (
            $user != false && $pass != false &&
            (!strpos($user, '<') || !strpos($user, '>')) &&
            (!strpos($pass, '<') || !strpos($pass, '>'))
        ) { 
            $format = '<?xml version="1.0"?><credentials><user v="%s"/><pass v="%s"/></credentials>';
            $xml = sprintf($format, $user, $pass);
            var_dump($xml);
            $xmlElement = new SimpleXMLElement($xml);
            // Perform the actual login.
            $this->login($xmlElement);
        }
    }
}

new Login($_POST['username'], $_POST['password']);
show_source(__FILE__);
