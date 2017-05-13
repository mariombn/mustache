<?php

namespace Mustache;

class Language
{
    private static  $lang = DEFAUNT_LANG;

    public static function getLabel($labelPach) // index.title ou index.menu.home
    {
        $arrPachs = explode('.', $labelPach);
        if (count($arrPachs) < 2) {
            throw new \Exception('Invalid language path');
        }
        $pach = APPPATH . '/resource/lang/' . self::$lang . '/' . $arrPachs[0] . '.json';
        if (!file_exists($pach)) {
            throw new \Exception('Invalid language path');
        }
        $arrTemp = self::getArrLang($pach);

        $indexes = array();
        foreach ($arrPachs as $k => $v) {
            if ($k != 0) {
                $indexes[] = $v;
            }
        }
        return self::getArrayValues($arrTemp, $indexes);
    }

    /**
     * VERY TKS. Solution get in http://stackoverflow.com/questions/5458241/php-dynamic-array-index-name
     * @param array $array
     * @param array $indexes
     * @return bool|mixed
     */
    private static function getArrayValues(array $array, array $indexes)
    {
        if (count($array) == 0 || count($indexes) == 0) {
            throw new \Exception('Invalid language path in file');
        }
        $index = array_shift($indexes);
        if(!array_key_exists($index, $array)){
            throw new \Exception('Invalid language path in file');
        }
        $value = $array[$index];
        if (count($indexes) == 0) {
            return $value;
        }
        if(!is_array($value)) {
            throw new \Exception('Invalid language path in file');
        }
        return self::getArrayValues($value, $indexes);
    }

    private static function getArrLang($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}