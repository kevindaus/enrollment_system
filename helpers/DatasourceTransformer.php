<?php

namespace app\helpers;

class DatasourceTransformer {
    public static function transformSchoolCollection($arr)
    {
        $tempContainer = [];
        if (count($arr) === 0) {
            $tempContainer[] ='';
        } else {
            foreach ($arr as $key => $value) {
                $tempContainer[$key] = $value['name_of_school'];
            }
        }
        return $tempContainer;
    }
    public static function transformEthnicityCollection($arr)
    {
        $tempContainer = [];
        if (count($arr) === 0) {
            $tempContainer[] ='';
        } else {
            foreach ($arr as $key => $value) {
                $tempContainer[$key] = $value['ethnic_origin'];
            }
        }
        return $tempContainer;
    }
}