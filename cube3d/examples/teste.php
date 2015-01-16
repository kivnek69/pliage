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

                        print_r($tof[0]);
                       // echo "<img src='".$tof->enclosure["url"]."'/>";



                    }

?>