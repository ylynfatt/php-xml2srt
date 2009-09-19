<?php
/**
* 
*/
class Xml2srt
{
    
    private $_captions = array();
    
    private $_xmlFile = NULL;
    
    private $_xml = NULL;
    
    function __construct($xmlFile)
    {
        // Get the Contents of the XML File
        $this->_xmlFile = file_get_contents($xmlFile);
        
        // Load the string into an object
        $this->_xml = simplexml_load_string($this->_xmlFile);
    }
}

?>