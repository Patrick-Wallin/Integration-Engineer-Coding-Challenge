<?php
    header('Access-Control-Allow-Origin: *');

    include_once('../core/initialize.php');

    $process = true;
    $getData = 'XML';

    if(!isset($_GET['process'])) {
        $process = false;

        if(isset($_GET['xml'])) {
            $getData = 'XML';
        }else {
            if(isset($_GET['json'])) {
                $getData = 'JSON';
            }
        }
    }

    // If user chooses this to be process, it would get XML file from Senators' API and
    // save it to server's folder.  Then converted it to JSON and saved it into server's folder.
    // Otherwise, it will provide XML or JSON data to the user.
    if($process == true) {
        $all_xml_data = file_get_contents(URL_SENATORS);

        $myfile = fopen(FILES_XML_PATH . DS . "senators.xml", "w") or die("Unable to write file!");
        fwrite($myfile,$all_xml_data);
        fclose($myfile);

        convertXMLToJSON();
    }else {
        if($getData == 'XML') {
            if(file_exists(FILES_XML_PATH . DS . "senators.xml")) {
                echo file_get_contents(FILES_XML_PATH . DS . "senators.xml");
            }
        }else {
            if(file_exists(FILES_JSON_PATH . DS . "senators.json")) {
                echo file_get_contents(FILES_JSON_PATH . DS . "senators.json");
            }
        }
    }

    function convertXMLToJSON() {
        $success = false;

        $arrayFullMembers = array();

        if(file_exists(FILES_XML_PATH . DS . "senators.xml")) {
            $xmlReader = new XMLReader;
            if($xmlReader->open(FILES_XML_PATH . DS . "senators.xml")) {                
                while ($xmlReader->read()) {
                    if ($xmlReader->nodeType == XMLReader::ELEMENT && $xmlReader->name == 'member') {
                        array_push($arrayFullMembers,produceJSONMember($xmlReader->readOuterXml()));
                    }
                }

                $xmlReader->close();
            }

        }

        $myfile = fopen(FILES_JSON_PATH . DS . "senators.json", "w") or die("Unable to write file!");
        fwrite($myfile,json_encode($arrayFullMembers,JSON_PRETTY_PRINT));
        fclose($myfile);

        return $success;
    }

    function produceJSONMember($xmlValue) {
        $member = array(
            "firstName"=>"", 
            "lastName"=>"", 
            "fullName"=>"",
            "chartId"=>"",
            "mobile"=>"",
            "address"=>[]);

        $xml = simplexml_load_string($xmlValue);

        $address = array(parseAddress($xml->address));

        $member["firstName"] .= $xml->first_name;
        $member["lastName"] .= $xml->last_name;
        $member["fullName"] .= $xml->first_name . " " . $xml->last_name;
        $member["chartId"] .= $xml->bioguide_id;
        $member["mobile"] .= $xml->phone;
        $member["address"] = $address;

        return $member;
    }

    // Unable to use Google Map API (parse address) since it is no longer free.
    // It requires billing account.  
    // Therefore, I am doing this by myself. It may not be best result.
    function parseAddress($address) {
        $newAddress = array("street"=>"","city"=>"","state"=>"","postal"=>0);

        $arrayAddressFromText = preg_split('/[\s]+/', $address);

        // Check if last index of array has integer value. 
        // If it is, then it is zip code. 
        $zipCode = intval($arrayAddressFromText[count($arrayAddressFromText)-1]);        
        if(is_int($zipCode) && $zipCode > 0) {
            $newAddress["postal"] = $zipCode;
            unset($arrayAddressFromText[count($arrayAddressFromText)-1]);            
        }

        // Check if last index of array has two characters which may be state abbreviation
        if(strlen(trim($arrayAddressFromText[count($arrayAddressFromText)-1])) == 2) {
            $newAddress["state"] = $arrayAddressFromText[count($arrayAddressFromText)-1];
            unset($arrayAddressFromText[count($arrayAddressFromText)-1]);            
        }

        // Then the last index may be city name.
        // I know it may not be perfect since it could have two words in city name
        $newAddress["city"] = $arrayAddressFromText[count($arrayAddressFromText)-1];
        unset($arrayAddressFromText[count($arrayAddressFromText)-1]);            

        // The rest of it may be street name including numbers
        foreach ( $arrayAddressFromText as $address ) {
          $newAddress["street"] .= ' ' . $address;
        }
        $newAddress["street"] = trim($newAddress["street"]);

        return $newAddress;
    }


?>