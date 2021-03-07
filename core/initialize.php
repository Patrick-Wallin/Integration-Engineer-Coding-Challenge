<?php
    defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
    defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'webserver'. DS . 'mend' . DS . 'integration-coding-challenge');
    defined('INC_PATH') ? null : define('INC_PATH', SITE_ROOT .DS. 'includes');
    defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT .DS. 'core');
    defined('FILES_XML_PATH') ? null : define('FILES_XML_PATH', SITE_ROOT .DS. 'files-xml');
    defined('FILES_JSON_PATH') ? null : define('FILES_JSON_PATH', SITE_ROOT .DS. 'files-json');
    defined('URL_SENATORS') ? null : define('URL_SENATORS', "https://www.senate.gov/general/contact_information/senators_cfm.xml");

    require_once(INC_PATH . DS. "config.php");
?>