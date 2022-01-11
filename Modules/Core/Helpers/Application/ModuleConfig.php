<?php

namespace Modules\Core\Helpers\Application;
use Illuminate\Support\Str;
use Route;

class ModuleConfig
{
    public static $module;
    public static $domain;

    public static function setModuleDomain($module, $domain)
    {
        self::$module = $module;
        self::$domain = $domain;
    }

    public static function getLabel($number = 'single')
    {
        return config(self::$module.'.domains')[self::$domain][$number] ?? null;
    }

    public static function getMessage($message)
    {
        return config(self::$module.'.domains')[self::$domain]['messages'][$message];
    }

    public static function getErrorMessage(string $type, string $prefix = "", string $sufix = "", $replace = [], $numberLabel = 'single'): string
    {
        $labelDomain = self::getLabel($numberLabel);
        $error = config(self::$module.'.domains')[self::$domain]['messages'][$type];
        $message = $error . " " . $labelDomain;
        $message = (empty($prefix)) ? ucfirst($message) : $prefix . $message;
        $message = (empty($sufix)) ? $message : ucfirst($message) . $sufix;
        collect($replace)->map(function ($value, $key) use(&$message){
            $message = str_replace($key,$value, $message);
        });
        return $message;
    }

    public static function getSuccessMessage(string $type, string $prefix = "", string $sufix = "", $replace = [], $numberLabel = 'single'): string
    {
        $labelDomain = self::getLabel($numberLabel);
        $success = config(self::$module.'.domains')[self::$domain]['messages'][$type];
        $message = $labelDomain . " " . $success;
        $message = (empty($prefix)) ? ucfirst($message) : $prefix . $message;
        $message = (empty($sufix)) ? $message : ucfirst($message) . $sufix;
        collect($replace)->map(function ($value, $key) use(&$message){
            $message = str_replace($key,$value, $message);
        });
        return $message;
    }

    public static function getPageTitle($action = null)
    {
        $currentRoute = $action;
        if(!$currentRoute){
            $currentRoute = Route::getFacadeRoot()->current()->action['as'];
        }
        $action = Str::afterLast($currentRoute,'-');
        switch ($action){

            case 'list':
                $title = "Listar";
                break;

            case 'create':
                $title = "Cadastrar";
                break;

            case 'edit':
                $title = "Editar";
                break;

            case 'config':
                $title = "Configurar";
                break;

            case 'profile':
                $title = "Perfil";
                break;

            default:
                $title = $currentRoute;
                break;
        }
        return $title;
    }
}
