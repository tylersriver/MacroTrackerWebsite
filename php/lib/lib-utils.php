<?php
/**
 * Created by VSCode.
 * User: tyler
 * Date: 8/7/2017
 * Time: 10:47 AM
 *
 * lib-utils
 *
 * This is a general file for functions
 * that can be used anywhere
 */

/**
 * Make array pass by reference
 * 
 * @param $arr array
 * @return array
 */
function makeValuesReferenced(&$arr)
{
    $refs = array();
    foreach($arr as $key => $value){
        $refs[$key] = &$arr[$key];
    }
    return $refs;
}