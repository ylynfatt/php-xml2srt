<?php
/**
 * XML2SRT
 * 
 * This Script converts Caption files in XML format into SRT
 * format.
 *
 * @author Yannick Lyn Fatt (http://www.godsporch.net)
 * @author Deborah Edwards-Onoro (http://www.lireo.com)
 */

// Instantiate our captions array
$captions = array();

// Get the Contents of the XML File
$xmlFile = file_get_contents('xml/culinaryarts.xml');

// Load the string into an object
$xml = simplexml_load_string($xmlFile);


foreach ($xml->body->div as $items)
{
        // Instantiate our caption number and timer
        $i = 1;
        $start = "00:00:00,000"; 
        
        foreach ($items as $item) {
    		$caption = array();
    		$caption['text'] = $item;
    		$caption['begins'] = str_replace('.', ',', $item['begin']);
    		$caption['start'] = $start;
    		$caption['number'] = $i;
    
    		// add this article to the list
    		$captions[] = $caption;
      		$i++;
      		$start = $caption['begins'];
	    }
}

// Create/Open the SRT file we want to write to.
$myFile = "output/culinaryarts.srt";
$fh = fopen($myFile, 'w') or die("can't open file");

// Loop through our Captions Array and write the data to our SRT file
foreach ($captions as $captionData) {
    // Print it to the browser so we can see what our file will look like.
    echo "<p>" . $captionData['number'] . "<br />" . $captionData['start'] . " --> " . $captionData['begins'] . "<br />" . $captionData['text'] . "</p>";
    
    $stringData = $captionData['number'] . "\n" . $captionData['start'] . " --> " . $captionData['begins'] . "\n" . $captionData['text'] . "\n\n";
    fwrite($fh, $stringData);
}

fclose($fh);
?>
