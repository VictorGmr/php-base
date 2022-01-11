<?php

namespace Modules\Core\Helpers\Application;

class ApplicationHelper
{
    public static function onlyNumber($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function getPhoneLabel($value)
    {
        if (strlen($value) == 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $value);
        } else {
            return self::getCellPhoneLabel($value);
        }
    }

    public static function getCellPhoneLabel($value)
    {
        return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
    }

    public static function getCellPhone($value)
    {
        if (strlen($value) > 10) {
            return preg_replace('/(\d{2})(\d{5})(\d{5})/', '($1) $2-$3', $value);
        } else {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $value);
        }
    }

    public static function getCepLabel($value)
    {
        return preg_replace('/(\d{2})(\d{3})(\d{3})/', '$1.$2-$3', $value);
    }

    public static function getCPFCNPJLabel($value)
    {
        if (strlen($value) == 11) {
            return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', '$1.$2.$3-$4', $value);
        } elseif (strlen($value) == 14) {
            return preg_replace('/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/', '$1.$2.$3/$4-$5', $value);
        }
        return $value;
    }

    public static function completeWithZeros($string, $quantidade, $direcao = 'STR_PAD_LEFT')
    {
        if ($direcao == 'STR_PAD_RIGHT') {
            return str_pad($string, $quantidade, "0", STR_PAD_RIGHT);
        }

        return str_pad($string, $quantidade, "0", STR_PAD_LEFT);
    }

    public static function removerAcentos($texto)
    {
        return preg_replace(
            array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/"),
            explode(" ", "a A e E i I o O u U n N c C"),
            $texto
        );
    }
}
