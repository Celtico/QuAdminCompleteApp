<?php
/**
 * @Author: Cel Ticó Petit
 * @Contact: cel@cenics.net
 * @Company: Cencis s.c.p.
 */

namespace QuAdmin\Model;

class QuUtilities
{
    /**
     * @param $string
     *
     * @return mixed|string
     */
    public function urlc($string){

        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = utf8_decode($string);
        $string = strtr($string, utf8_decode($a), $b);

        $NOT_acceptable_characters_regex = '#[^-a-zA-Z0-9_ ]#';
        $string = preg_replace($NOT_acceptable_characters_regex, '', $string);
        $string = trim($string);
        $string = preg_replace('#[-_ ]+#', '-', $string);
        $string =  strtolower($string);

        return $string;
    }


}
