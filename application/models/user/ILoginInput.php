<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once (APPPATH . 'models/IValidatable.php');

    //public function verify_credentials();

    // Create ICredentials - email / password
    // let Membership / CommunityService / UserService use it - which checks against the db using the UserModel

    // iCredentials ? get_email / get_password ? eller bare verify_credentials ?  skal internt bruge get_email og get_password
    // Men der er bare slet ingen brug for get_email og get_password når der er verify_credentials på ? iCredentials bør istedet være et interface i en service der tager iUserLogin f.eks ?
    //
    //men skal ikke bruges til noget lige nu ?
    // skal den ikke også bruge usermodel direkte så ? jo !?

    // Meningen er vel at noget af logikken der ryger i de her models så igen kan deles ud i services .... så det kan deles !!! og bruge interfacesne ?!??!?!



// IValidatable ? Lige meget så længe tjek foregår i controller og man bruger typen ?

interface ILoginInput extends IValidatable       // ICredentials istedet ?
{
    public function get_email();
    public function get_password();
}

?>