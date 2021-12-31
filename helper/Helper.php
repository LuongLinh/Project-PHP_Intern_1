<?php
if (!function_exists('config')) {
    function config($configName)
    {
        if ($configName === null || $configName === '') {
            return null;
        } else {
            $configsData = explode('.', $configName);
            $nameFileConfig = $configsData[0];
            $configs = scandir("../configs");
            $configFileNames = [];
            foreach ($configs as $config) {
                if (strpos($config, '.php')) {
                    $configFileNames[] = str_replace('.php', '', $config);
                }
            }
            if (in_array($nameFileConfig, $configFileNames)) {
                $configData = include('../configs/' . $nameFileConfig . '.php');
                return getAttributeInMultidimensionalArray(
                    $configData,
                    str_replace($nameFileConfig . '.', '', $configName)
                );
            }
        }
    }
}

if (!function_exists('getAttributeInMultidimensionalArray')) {
    function getAttributeInMultidimensionalArray($array, $string)
    {
        $configsData = explode('.', $string);
        if (count($configsData) > 1) {
            return getAttributeInMultidimensionalArray(
                $array[$configsData[0]],
                str_replace($configsData[0] . '.', '', $string)
            );
        } else {
            return $array[$configsData[0]];
        }
    }
}

if (!function_exists('redirect')) {
    function redirect($url = '')
    {
        $uri = _WEB_ROOT."/".$url;
        header("Location: ".$uri."");
        exit();
    }
}
