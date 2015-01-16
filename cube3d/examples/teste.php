<?php
/**
 * Created by PhpStorm.
 * User: Saad1
 * Date: 16/01/15
 * Time: 10:00
 */
                    $xml = simplexml_load_file('http://t-u-n-i-s-i-e.tumblr.com/rss');
                    //var_dump($xml->channel);

                    foreach ($xml->channel->item as $tof) {
                      
                        $string = $tof->description->asXML();
                        echo $string."<br>";
                        
                        $lien_image = "";
                        
                        $balise = '/<img src="(.*)"/>/i';
                        preg_match($balise, $string, $lien_image);
                        print_r($lien_image);
                       // echo "<img src='".$tof->enclosure["url"]."'/>";



                    }

?>