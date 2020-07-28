<?php

// ======================================================================== //		
// Create attributes map so we can get the attributes of a wrapped shortcode
//
//      Used by:
//          bs_tabs()
//          bs_carousel()
//
// ======================================================================== // 

    function bs_attribute_map($str, $att = null) {
        $res = array();
        $return = array();
        $reg = get_shortcode_regex();
        preg_match_all('~'.$reg.'~',$str, $matches);
        foreach($matches[2] as $key => $name) {
            $parsed = shortcode_parse_atts($matches[3][$key]);
            $parsed = is_array($parsed) ? $parsed : array();

                $res[$name] = $parsed;
                $return[] = $res;
            }
        return $return;
    }

// ======================================================================== // 

?>
