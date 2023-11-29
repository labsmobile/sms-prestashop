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
 * class LabsApiCmd
 */
class LabsApiCmd
{
    public $api_username;
    public $api_password;
    public $lang_iso;
    public $lang_user_iso;
    public $connection;

    public function __construct()
    {
        $this->api_username = \Configuration::get('LABSMOBILE_API_USERNAME');
        $this->api_password = \Configuration::get('LABSMOBILE_API_PASSWORD');
        $this->connection = new LabsApi($this->api_username.":". $this->api_password);
        $this->lang_iso =  Language::getIsoById((int) Configuration::get('PS_LANG_DEFAULT'));
        $this->lang_user_iso = Context::getContext()->language->iso_code;
    }

    public function authenticate($username, $password)
    {
        $response = $this->connection->request(
            'authenticate',
            'POST',
            array(
                'lang' => $this->lang_user_iso,
                'api_username' => $username,
                'api_password' => md5($password)
            )
        );

        if ($response['code'] == 200 && $response['result'] == 'ok') {
            \Configuration::updateValue('LABSMOBILE_CONNECTION_STATUS', 1);
            \Configuration::updateValue('LABSMOBILE_API_USERNAME', $username);
            \Configuration::updateValue('LABSMOBILE_API_PASSWORD', md5($password));
            $this->api_username = $username;
            $this->api_password = md5($password);
            return true;
        } else {
            return $response['error'];
        }
    }

    public function forgot($username)
    {
        $response = $this->connection->request(
            'forgot',
            'POST',
            array(
                'username'  => $username,
                'lang'      => $this->lang_user_iso
            )
        );

        if ($response['code'] == 200 && $response['result'] == 'ok') {
            return true;
        } else {
            return $response['error'];
        }
    }

    public function getSettings()
    {
        $response = $this->connection->request(
            'settings',
            'POST',
            array()
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function checkNumbers($numbers, $currency)
    {
        $response = $this->connection->request(
            'numbers',
            'POST',
            array(
                'numbers' => $numbers,
                'currency' => $currency
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function getRenew()
    {
        $response = $this->connection->request(
            'renew',
            'POST',
            array()
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function getDashboard()
    {
        $response = $this->connection->request(
            'dashboard',
            'POST',
            array(
                'lang'      => $this->lang_user_iso
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result']->data;
        } else {
            return false;
        }
    }

    public function getInvoices($date)
    {
        $response = $this->connection->request(
            'invoices',
            'POST',
            array(
                'date' => $date
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result']->invoices;
        } else {
            return false;
        }
    }

    public function getCards()
    {
        $response = $this->connection->request(
            'cards',
            'POST',
            array()
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result']->cards;
        } else {
            return false;
        }
    }

    public function getStatistics($from, $to, $countries, $number, $sender, $message)
    {
        $response = $this->connection->request(
            'statistics',
            'POST',
            array(
                'from'  => $from,
                'to'  => $to,
                'countries'  => $countries,
                'number'  => $number,
                'sender'  => $sender,
                'message'  => $message
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function getCountries($currency)
    {
        $response = $this->connection->request(
            'countries',
            'POST',
            array(
                'currency' => $currency,
                'lang'     => $this->lang_user_iso
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function getMessages($id, $number, $sender, $message, $credits, $clicks, $sent_from, $sent_to, $status, $orderby = 'added DESC', $limit = '', $offset = '', $export = 0)
    {
        $response = $this->connection->request(
            'search',
            'POST',
            array(
                'id'  => $id,
                'number'  => $number,
                'sender' => $sender,
                'message' => $message,
                'credits' => $credits,
                'clicks' => $clicks,
                'sent_from' => $sent_from,
                'sent_to' => $sent_to,
                'status' => $status,
                'orderby' => $orderby,
                'limit' => $limit,
                'offset' => $offset,
                'export' => $export
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function getScheduled($id, $number, $sender, $message, $sent_from, $sent_to, $scheduled_from, $scheduled_to, $status, $orderby = 'scheduled DESC', $limit = '', $offset = '')
    {
        $response = $this->connection->request(
            'scheduled',
            'POST',
            array(
                'id'  => $id,
                'number'  => $number,
                'sender' => $sender,
                'message' => $message,
                'sent_from' => $sent_from,
                'sent_to' => $sent_to,
                'scheduled_from' => $scheduled_from,
                'scheduled_to' => $scheduled_to,
                'status' => $status,
                'orderby' => $orderby,
                'limit' => $limit,
                'offset' => $offset
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function sendMessage($numbers, $sender, $message, $label, $country_iso = '', $scheduled = '')
    {
        $response = $this->connection->request(
            'send',
            'POST',
            array(
                'numbers'  => $numbers,
                'sender'  => $sender,
                'message' => $message,
                'label' => $label,
                'country_iso' => $country_iso,
                'scheduled' => $scheduled,
                'unicode' => \Configuration::get('LABSMOBILE_SMSUNICODE')
            )
        );

        if ($response['code'] == 200 && isset($response['result']->error) && $response['result']->error == false) {
            return true;
        } else {
            if (isset($response['result']->error_code)) {
                return $response['result']->error_code;
            } else {
                return $response['error'];
            }
        }
    }

    public function deleteScheduledCart($id_cart)
    {
        $response = $this->connection->request(
            'cancel',
            'POST',
            array(
                'id_cart'  => $id_cart,
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return true;
        } else {
            return false;
        }
    }

    public function deleteScheduledSending($subid)
    {
        $response = $this->connection->request(
            'delete',
            'POST',
            array(
                'subid'  => $subid,
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return true;
        } else {
            return false;
        }
    }

    public function setRenew($renew_enable, $renew_limit, $renew_credits, $renew_maxrecharges, $renew_card)
    {
        $response = $this->connection->request(
            'renew',
            'POST',
            array(
                'renew_enable'  => $renew_enable,
                'renew_limit'  => ($renew_enable?$renew_limit:0),
                'renew_credits' => ($renew_enable?$renew_credits:0),
                'renew_maxrecharges' => ($renew_enable?$renew_maxrecharges:0),
                'renew_card' => ($renew_enable?$renew_card:0)
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return true;
        } else {
            return false;
        }
    }

    public function setSettings($warning_limit, $warning_email, $newsletter_active, $default_sender, $duplicated_filter, $max_daily, $max_batch, $unicode_active, $replace_links)
    {
        $response = $this->connection->request(
            'settings',
            'POST',
            array(
                'warning_limit'  => $warning_limit,
                'warning_email'  => $warning_email,
                'newsletter_active' => $newsletter_active,
                'default_sender' => $default_sender,
                'duplicated_filter' => $duplicated_filter,
                'max_daily' => $max_daily,
                'max_batch' => $max_batch,
                'unicode_active' => $unicode_active,
                'replace_links' => $replace_links
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return true;
        } else {
            return false;
        }
    }

    public function getInvoicing()
    {
        $response = $this->connection->request(
            'invoicing',
            'POST',
            array()
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }

    public function setInvoicing($company, $taxid, $address, $zipcode, $city, $region, $country, $invoicing_email)
    {
        $response = $this->connection->request(
            'invoicing',
            'POST',
            array(
                'company'  => $company,
                'taxid'  => $taxid,
                'address' => $address,
                'zipcode' => $zipcode,
                'city' => $city,
                'region' => $region,
                'country' => $country,
                'invoicing_email' => $invoicing_email
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return true;
        } else {
            return false;
        }
    }

    public function account($name, $company, $email, $website, $country, $timezone, $currency)
    {
        $response = $this->connection->request(
            'account',
            'POST',
            array(
                'name'      => $name,
                'company'   => $company,
                'email'     => $email,
                'website'   => $website,
                'country'   => $country,
                'timezone'  => $timezone,
                'currency'  => $currency,
                'lang'      => $this->lang_iso
            )
        );

        if ($response['code'] == 200 && $response['result'] == 'ok') {
            return true;
        } else {
            return $response['error'];
        }
    }

    public function checkConnection()
    {
        $response = $this->connection->request(
            'check',
            'POST',
            array()
        );

        return ($response['code'] == 200 && $response['result'] == 'ok') ? true : false;
    }

    public function balance($country_iso)
    {
        $response = $this->connection->request(
            'balance',
            'POST',
            array(
                'country' => $country_iso,
            )
        );

        if ($response['code'] == 200 && $response['result'] != 'ko') {
            return $response['result'];
        } else {
            return false;
        }
    }
}
