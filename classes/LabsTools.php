<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2020 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

class LabsTools
{
    public static function filterPhone($str_phone)
    {
        $res = preg_replace('/[^0-9]/', '', $str_phone);
        $res = trim($res);
        return $res;
    }

    public static function escapeStringCsv($string)
    {
        return str_replace('"', '\"', $string);
    }

    public static function getLabelFields($label)
    {

        if (!empty($label)) {
            $params = array();
            $tokens = explode("-", $label);
            foreach ($tokens as $item_token) {
                $token_unit = explode(":", $item_token);
                if (sizeof($token_unit) == 2 && Tools::strlen($token_unit[0]) == 1) {
                    $params[$token_unit[0]] = $token_unit[1];
                }
            }
            return $params;
        }
    }

    public static function getCartProducts($id_cart)
    {
        $dbQuery = (new \DbQuery)->select('cp.*')->from('cart_product', 'cp')->where('cp.id_cart = ' . (int) $id_cart);
        $result = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($dbQuery);

        return ($result) ? true : false;
    }

    public static function choosePhone($phone_mobile, $phone, $id_country = 0)
    {
        $only_mobile = \Configuration::get('LABSMOBILE_ONLY_MOBILE');

        $res_phone = $phone_mobile;
        if ($only_mobile == 0 && empty($res_phone)) {
            $res_phone = $phone;
        }
        if (empty($res_phone)) {
            return false;
        }
        $res_phone = preg_replace('/[^0-9]/', '', $res_phone);
        $res_phone = trim($res_phone);
        if (empty($res_phone)) {
            return false;
        }
        if ($id_country) {
            $country = new \Country((int) $id_country);
            if (strpos($res_phone, $country->call_prefix) !== 0) {
                $res_phone = $country->call_prefix . $res_phone;
            }
        }
        return $res_phone;
    }

    public static function getCountry($number, $country_list)
    {

        if (isset($country_list[Tools::substr($number, 0, 4)])) {
            return $country_list[Tools::substr($number, 0, 4)];
        }
        if (isset($country_list[Tools::substr($number, 0, 3)])) {
            return $country_list[Tools::substr($number, 0, 3)];
        }
        if (isset($country_list[Tools::substr($number, 0, 2)])) {
            return $country_list[Tools::substr($number, 0, 2)];
        }
        if (isset($country_list[Tools::substr($number, 0, 1)])) {
            return $country_list[Tools::substr($number, 0, 1)];
        }
    }

    public static function getUrlPurchase()
    {
        return "h"."t"."t"."p"."s".":"."/"."/".
                "projects.labsmobile.com".
                "/prestashop/1.0/purchase/";
    }

    public static function toUtc($datetime)
    {
        if (empty($datetime)) {
            return '';
        }
        $default_timezone = \Configuration::get('PS_TIMEZONE');
        $given = DateTime::createFromFormat('Y-m-d H:i:s', $datetime, new DateTimeZone($default_timezone));
        $given->setTimezone(new DateTimeZone("UTC"));
        return $given->format("Y-m-d H:i:s");
    }

    public static function toLocal($datetime)
    {
        if (empty($datetime)) {
            return '';
        }
        $default_timezone = \Configuration::get('PS_TIMEZONE');
        $given = DateTime::createFromFormat('Y-m-d H:i:s', $datetime, new DateTimeZone("UTC"));
        $given->setTimezone(new DateTimeZone($default_timezone));
        return $given->format("Y-m-d H:i:s");
    }

    public static function getFileExtension($filename)
    {
        $parts = explode('.', $filename);
        if (sizeof($parts) > 1) {
            $ext = $parts[sizeof($parts) - 1];
            return Tools::strtolower($ext);
        } else {
            return '';
        }
    }

    public static function checkUnicode($message)
    {
        $invalidCharacters = explode(' ', "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9  @ £ $ ¥ è é ù ì ò Ç Ø ø Å å Δ Φ Γ Λ Ω Π Ψ Σ Θ Ξ Ä Ö Ñ Ü § ä ö ñ ü à _ ^ | { } \\ [ ~ ] € Æ æ ß É ! \" # ¤ % & ' ( ) * + , - . / | \ : ; < = > ? ¡ ¿ \n \r");
        $invalidCharacters[] = ' ';
        if (Tools::strlen(str_replace($invalidCharacters, '', $message)) > 0) {
            return true;
        }
        return false;
    }
}
