<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Enable support for setting from/name if specified in the settings
// Do it here rather than in the EmailService so it will be reflected in all implementations using the Email library.
// Also all configuration is kept in one place.

class EXT_Email extends CI_Email
{
    function __construct($config = array())
    {
        parent::__construct($config);

        // If defined in the config set from/name
        if (isset ($config['from']))
        {
            $from = $config['from'];
            $name = isset ($config['name']) ? $config['name'] : '';

            $this->from($from, $name);
        }
    }
}

?>