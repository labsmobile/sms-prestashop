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

/**
 *
 */
class LabsApi
{

    private $baseUrl;
    private $authStr;

    public function __construct($authStr)
    {
        $this->baseUrl = "https://projects.labsmobile.com/prestashop/1.0/";
        $this->authStr = $authStr;
    }

    public function request($resource, $httpRequest, $data = array(), $params = array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        if ($this->authStr && !in_array($resource, array('authenticate', 'forgot', 'account'))) {
            curl_setopt($ch, CURLOPT_USERPWD, $this->authStr);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        }

        $this->setCurlOptions($ch, $httpRequest, $data);
        $url = $this->createUrl($resource, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
        $content = curl_exec($ch);
        $responseInfo = curl_getinfo($ch);
        curl_close($ch);
        $response = array();

        $response['code'] = $responseInfo['http_code'];
        if (!$response['code']) {
            $response['result'] = 'ko';
            $response['error'] = 'connectionerror';
        } else {
            if ($responseData = \Tools::jsonDecode($content)) {
                $response['result'] = $responseData->result;
                $response['error'] = $responseData->error;
            }
        }

        return $response;
    }

    private function setCurlOptions($ch, $httpRequest, $data)
    {
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'content-type: application/x-www-form-urlencoded; charset=utf-8',
            )
        );
        if ($httpRequest == 'POST') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        } elseif ($httpRequest == 'GET') {
            curl_setopt($ch, CURLOPT_POST, false);
        } elseif ($httpRequest == 'DELETE') {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
    }

    private function createUrl($resource, $params = array())
    {
        if ($resource == 'users') {
            $url = $this->urlRegister;
        } else {
            $url = $this->baseUrl;
        }
        $url = $url.$resource;
        if (!empty($params) && is_array($params)) {
            $url .= '?'.http_build_query($params);
        }

        return $url;
    }
}
