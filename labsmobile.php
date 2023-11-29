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
 * Class Labsmobile
 */
class Labsmobile extends Module
{
    /**
     * @var bool
     */
    public $new_user = true;

    /**
     * Labsmobile constructor.
     */
    public function __construct()
    {
        $this->name                   = 'labsmobile';
        $this->tab                    = 'emailing';
        $this->version                = '1.0.9';
        $this->author                 = 'LabsMobile';
        $this->module_key             = 'ca908d1dab4cccf8611fdabdd5d5a659';
        $this->need_instance          = 0;
        $this->bootstrap              = true;
        parent::__construct();
        $this->displayName            = $this->l('LabsMobile SMS');
        $this->description            = $this->l('Send SMS campaigns and personalized notifications. Easy to use and receive free 100 SMS when you sign up!');
        $this->confirmUninstall       = $this->l('Are you sure you want to uninstall this module?');
        $this->ps_versions_compliancy = array(
            'min' => '1.6',
            'max' => _PS_VERSION_,
        );
        $this->api_username = '';
        $this->api_password = '';

        $this->menu_controller = 'AdminLabsmobile';
        $this->menu_name = 'LabsMobile SMS';
        require_once(dirname(__FILE__) . '/autoload.php');
    }

    /**
     * @return bool
     * @throws PrestaShopException
     */
    public function install()
    {
        if (extension_loaded('curl') == false) {
            $this->_errors[] = $this->l('You have to enable the cURL extension on your server to install this module.');
            return false;
        }

        if (!parent::install() ||
            !$this->registerHook('displayBackOfficeHeader') ||
            !$this->registerHook('displayBackOfficeFooter') ||
            !$this->registerHook('postUpdateOrderStatus') ||
            !$this->registerHook('createAccount') ||
            !$this->registerHook('newOrder') ||
            !$this->registerHook('orderReturn') ||
            !$this->registerHook('actionCartSave')
        ) {
            return false;
        }

        if (!$this->installDB()) {
            return false;
        }

        if (_PS_VERSION_ >= 1.7) {
            if (!$this->installModuleTab17('AdminLabsmobile', 'AdminParentModulesSf')) {
                return false;
            }
        } elseif (_PS_VERSION_ >= 1.6) {
            if (!$this->installModuleTab16('AdminLabsmobile', 'LabsMobile SMS', 0)) {
                return false;
            }
        } else {
            if (!$this->installModuleTab15('AdminLabsmobile', array(1 => 'LabsMobile SMS'), $this->getIdTab('AdminParentCustomer'))) {
                return false;
            }
        }
       
        \Configuration::updateValue('LABSMOBILE_CONNECTION_STATUS', 0);
        \Configuration::updateValue('LABSMOBILE_API_USERNAME', '');
        \Configuration::updateValue('LABSMOBILE_API_PASSWORD', '');
        \Configuration::updateValue('LABSMOBILE_LAST_USERNAME', '');
        \Configuration::updateValue('LABSMOBILE_DEFAULT_SENDER', '');
        \Configuration::updateValue('LABSMOBILE_SMSUNICODE', 0);
        \Configuration::updateValue('LABSMOBILE_ADMIN_PHONE', '');
        \Configuration::updateValue('LABSMOBILE_ONLY_MOBILE', 0);

        return true;
    }

    public function getContent()
    {
        return \Tools::redirectAdmin('index.php?controller=AdminLabsmobile');
    }

    public function displayError($errors)
    {
        if (is_array($errors)) {
            $return = '';
            foreach ($errors as $err) {
                $return .= parent::displayError($err);
            }
        } else {
            $return = parent::displayError($errors);
        }

        return $return;
    }

    public function uninstall()
    {
        \Configuration::deleteByName('LABSMOBILE_CONNECTION_STATUS');
        \Configuration::deleteByName('LABSMOBILE_API_USERNAME');
        \Configuration::deleteByName('LABSMOBILE_API_PASSWORD');
        \Configuration::deleteByName('LABSMOBILE_LAST_USERNAME');
        \Configuration::deleteByName('LABSMOBILE_DEFAULT_SENDER');
        \Configuration::deleteByName('LABSMOBILE_SMSUNICODE');
        \Configuration::deleteByName('LABSMOBILE_ADMIN_PHONE');
        \Configuration::deleteByName('LABSMOBILE_ONLY_MOBILE');

        if (!$this->uninstallModuleTab('AdminLabsmobile')
        || !$this->uninstallDB()
        || !parent::uninstall()) {
            return false;
        }

        if (_PS_VERSION_ >= 1.7) {
            $this->uninstallModuleTab($this->menu_controller);
        } elseif (_PS_VERSION_ >= 1.6) {
            if (!$this->uninstallModuleTab16('AdminLabsmobile')) {
                return false;
            }
        } else {
            $this->uninstallModuleTab($this->menu_controller);
        }

        return true;
    }

    public function installDB()
    {
        $sql = array();

        $sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'lm_invoices` (
            `id_invoice` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `reference` VARCHAR(64),
            `credits` INT(11),
            `amount` FLOAT(8,2),
            `date` DATETIME,
            `invoice_ref` INT(11),
            PRIMARY KEY (`id_invoice`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_templates` (
                `id_template` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `type` VARCHAR(20) NULL DEFAULT NULL,
                `name` VARCHAR(80) NULL DEFAULT NULL,
                `limit` INT(11) NULL DEFAULT NULL,
                `active` INT(11) UNSIGNED NOT NULL,
                PRIMARY KEY (`id_template`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_templates_lang` (
                `id_template` INT(11) UNSIGNED NOT NULL,
                `id_lang` INT(11) UNSIGNED NOT NULL,
                `template` VARCHAR(1000) NULL DEFAULT NULL,
                PRIMARY KEY (`id_template`, `id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_cart` (
                `id_lm_cart` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `id_cart` INT(11) UNSIGNED NOT NULL,
                `subid` VARCHAR(100) NULL DEFAULT NULL,
                PRIMARY KEY (`id_lm_cart`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_texttemplates` (
                `id_texttemplate` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(80) NULL DEFAULT NULL,
                PRIMARY KEY (`id_texttemplate`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';
       
        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_texttemplates_lang` (
                `id_texttemplate` INT(11) UNSIGNED NOT NULL,
                `id_lang` INT(11) UNSIGNED NOT NULL,
                `text` TEXT NULL DEFAULT NULL,
                PRIMARY KEY (`id_texttemplate`, `id_lang`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'lm_groups` (
                `id_group` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(500),
                `conditions` TEXT,
                `created` DATETIME,
                PRIMARY KEY (`id_group`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

        $return_sql = true;
        foreach ($sql as $query) {
            if (!Db::getInstance()->execute($query)) {
                $this->_errors[] = Db::getInstance()->getMsgError();

                $return_sql = false;
                break;
            }
        }
       
        return $return_sql;
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path . '/css/labsmobile_admin.css', 'all');
        $ctrl = $this->context->controller;
        if ($ctrl instanceof AdminController && method_exists($ctrl, 'addCss')) {
            $ctrl->addCss($this->_path.'views/css/labsmobile_admin.css');
        }
    }

    public function hookPostUpdateOrderStatus($params)
    {
        $template = LabsTemplate::getByNameLm('status', 'status'.$params['newOrderStatus']->id);
        if ($template->active == 1) {
            $username = \Configuration::get('LABSMOBILE_API_USERNAME');
            $id_order = (int) $params['id_order'];
            $order = new \Order((int) $id_order);
            $id_customer = (int) $order->id_customer;
            $id_currency = (int) $order->id_currency;
            $customer = new \Customer((int) $id_customer);
            $currency = new \Currency((int) $id_currency);
            $amount = ($currency->format==1?$currency->sign:"") . $order->total_paid . ($currency->format==2?" ".$currency->sign:"");
            $address = new \Address((int) $order->id_address_delivery);
            
            $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
            if ($phone === false) {
                $address = new \Address((int) $order->id_address_invoice);
                $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
            }

            if ($phone === false) {
                return;
            }
            if ($address->id_state > 0) {
                $state = new \State((int) $address->id_state);
            }
            if ($address->id_country > 0) {
                $country = new \Country((int) $address->id_country);
            }
           
            $template_sms = $template->template[(int) $order->id_lang];
            $template_sms = str_replace('%FIRSTNAME%', $customer->firstname, $template_sms);
            $template_sms = str_replace('%LASTNAME%', $customer->lastname, $template_sms);
            $template_sms = str_replace('%EMAIL%', $customer->email, $template_sms);
            $template_sms = str_replace('%ADDRESS%', trim($address->address1 . " " . $address->address2), $template_sms);
            $template_sms = str_replace('%POSTCODE%', $address->postcode, $template_sms);
            $template_sms = str_replace('%CITY%', $address->city, $template_sms);
            if ($address->id_state > 0) {
                $template_sms = str_replace('%STATE%', $state->name, $template_sms);
            }
            if ($address->id_country > 0) {
                $template_sms = str_replace('%COUNTRY%', $country->name[(int) $order->id_lang], $template_sms);
            }
            $template_sms = str_replace('%ORDERNUM%', $order->reference, $template_sms);
            $template_sms = str_replace('%ORDERID%', $id_order, $template_sms);
            $template_sms = str_replace('%ORDERDATE%', $order->date_add, $template_sms);
            $template_sms = str_replace('%SHIPPINGNUMBER%', $order->shipping_number, $template_sms);
            $template_sms = str_replace('%AMOUNT%', $amount, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-'.$params['newOrderStatus']->name.'-k:'.$id_customer,
                ($address->id_country > 0?$country->iso_code:'')
            );
        }
    }

    public function hookCreateAccount($params)
    {
        $email = $params['newCustomer']->email;
        $username = \Configuration::get('LABSMOBILE_API_USERNAME');

        $template = LabsTemplate::getByNameLm('admin', 'newaccount');
        $admin_phone = \Configuration::get('LABSMOBILE_ADMIN_PHONE');

        if ($template->active == 1 && !empty($admin_phone)) {
            $template_sms = $template->template[(int) \Configuration::get('PS_LANG_DEFAULT')];
            $template_sms = str_replace('%EMAIL%', $email, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $admin_phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-newaccount_admin'
            );
        }
    }

    public function hookNewOrder($params)
    {
        (new LabsApiCmd)->deleteScheduledCart($params['order']->id_cart);
        $id_order = (int) $params['id_order'];
        $amount = ($params['currency']->format==1?$params['currency']->sign:"") . $params['order']->total_paid . ($params['currency']->format==2?" ".$params['currency']->sign:"");
        $address = new \Address((int) $params['order']->id_address_delivery);
        if ($address->id_state > 0) {
            $state = new \State((int) $address->id_state);
        }
        if ($address->id_country > 0) {
            $country = new \Country((int) $address->id_country);
        }

        $username = \Configuration::get('LABSMOBILE_API_USERNAME');
        $template = LabsTemplate::getByNameLm('admin', 'neworder');
        $admin_phone = \Configuration::get('LABSMOBILE_ADMIN_PHONE');
        if ($template->active == 1 && !empty($admin_phone)) {
            $template_sms = $template->template[(int) $this->context->language->id];
            $template_sms = str_replace('%FIRSTNAME%', $params['customer']->firstname, $template_sms);
            $template_sms = str_replace('%LASTNAME%', $params['customer']->lastname, $template_sms);
            $template_sms = str_replace('%EMAIL%', $params['customer']->email, $template_sms);
            $template_sms = str_replace('%ADDRESS%', trim($address->address1 . " " . $address->address2), $template_sms);
            $template_sms = str_replace('%POSTCODE%', $address->postcode, $template_sms);
            $template_sms = str_replace('%CITY%', $address->city, $template_sms);
            if ($address->id_state > 0) {
                $template_sms = str_replace('%STATE%', $state->name[(int) $this->context->language->id], $template_sms);
            }
            if ($address->id_country > 0) {
                $template_sms = str_replace('%COUNTRY%', $country->name[(int) $this->context->language->id], $template_sms);
            }
            $template_sms = str_replace('%ORDERNUM%', $params['order']->reference, $template_sms);
            $template_sms = str_replace('%ORDERID%', $id_order, $template_sms);
            $template_sms = str_replace('%ORDERDATE%', $params['order']->date_add, $template_sms);
            $template_sms = str_replace('%AMOUNT%', $amount, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $admin_phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-neworder_admin',
                Country::getIsoById(\Configuration::get('PS_COUNTRY_DEFAULT'))
            );
        }

        $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
        if ($phone === false) {
            $address = new \Address((int) $params['order']->id_address_invoice);
            $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
        }
        if ($phone === false) {
            return;
        }

        $template = LabsTemplate::getByNameLm('events', 'neworder');
        if ($template->active == 1) {
            $template_sms = $template->template[(int) $params['order']->id_lang];
            $template_sms = str_replace('%FIRSTNAME%', $params['customer']->firstname, $template_sms);
            $template_sms = str_replace('%LASTNAME%', $params['customer']->lastname, $template_sms);
            $template_sms = str_replace('%EMAIL%', $params['customer']->email, $template_sms);
            $template_sms = str_replace('%ADDRESS%', trim($address->address1 . " " . $address->address2), $template_sms);
            $template_sms = str_replace('%POSTCODE%', $address->postcode, $template_sms);
            $template_sms = str_replace('%CITY%', $address->city, $template_sms);
            if ($address->id_state > 0) {
                $template_sms = str_replace('%STATE%', $state->name[(int) $params['order']->id_lang], $template_sms);
            }
            if ($address->id_country > 0) {
                $template_sms = str_replace('%COUNTRY%', $country->name[(int) $params['order']->id_lang], $template_sms);
            }
            $template_sms = str_replace('%ORDERNUM%', $params['order']->reference, $template_sms);
            $template_sms = str_replace('%ORDERID%', $id_order, $template_sms);
            $template_sms = str_replace('%ORDERDATE%', $params['order']->date_add, $template_sms);
            $template_sms = str_replace('%AMOUNT%', $amount, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-neworder'.'-k:'.$params['customer']->id_customer,
                ($address->id_country > 0?$country->iso_code:'')
            );
        }
    }

    public function hookDisplayBackOfficeFooter()
    {
        if ((float) Tools::substr(_PS_VERSION_, 0, 3) >= 1.6) {
            if (Tools::getValue("controller") == "AdminOrders" && Tools::getValue("id_order") != null && Tools::getIsset("vieworder")) {
                $result = Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "orders where id_order = '" . (int) Tools::getValue("id_order") . "'");
                if (isset($result[0])) {
                    if (isset($result[0]["id_address_delivery"])) {
                        $address_id = $result[0]["id_address_delivery"];
                    } elseif (isset($result[0]["id_address_invoice"])) {
                        $address_id = $result[0]["id_address_invoice"];
                    } else {
                        $address_id = 0;
                    }
                    if ($address_id != 0) {
                        $result = Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "address WHERE id_address = '" . (int) $address_id . "'");
                        if (isset($result[0])) {
                            $phone = LabsTools::choosePhone($result[0]["phone_mobile"], $result[0]["phone"], $result[0]["id_country"]);
                        }
                    }
                }
                if ($phone !== false) {
                    $this->context->smarty->assign(array(
                        'token'     => Tools::getAdminTokenLite("AdminLabsmobile"),
                        'phone'     => $phone,
                    ));
                    echo $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/admin/parts/insertbuttonorders.tpl');
                }
            }

            if (Tools::getValue("controller") == "AdminCustomers" && Tools::getValue("id_customer") != null && Tools::getIsset("viewcustomer")) {
                $phone = false;
                $result = Db::getInstance()->executeS("SELECT * FROM " . _DB_PREFIX_ . "address WHERE id_customer = '" . (int) Tools::getValue("id_customer") . "'");
                if ($result != null) {
                    foreach ($result as $row) {
                        $phone = LabsTools::choosePhone($row["phone_mobile"], $row["phone"], $row["id_country"]);
                        if ($phone !== false) {
                            break;
                        }
                    }
                }

                if ($phone !== false) {
                    $this->context->smarty->assign(array(
                        'token'     => Tools::getAdminTokenLite("AdminLabsmobile"),
                        'phone'     => $phone,
                    ));
                    echo $this->context->smarty->fetch(dirname(__FILE__).'/views/templates/admin/parts/insertbuttoncustomers.tpl');
                }
            }
        }
    }

    public function hookOrderReturn($params)
    {
        $id_customer     = (int) $params['orderReturn']->id_customer;
        $id_order        = (int) $params['orderReturn']->id_order;
        $customer        = new \Customer((int) $id_customer);
        $order           = new \Order($id_order);

        $address = new \Address((int) $order->id_address_delivery);
        $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
        if ($phone === false) {
            $address = new \Address((int) $order->id_address_invoice);
            $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
        }
        if ($phone === false) {
            return;
        }
       
        if ($address->id_country > 0) {
            $country = new \Country((int) $address->id_country);
        }
        $order_return    = new \OrderReturn($params['orderReturn']->id);
        $return_products = $order_return->getOrdersReturnProducts((int) $params['orderReturn']->id, $order);
        $codes           = array();
        foreach ($return_products as $product) {
            $codes[] = $product['reference'];
        }
        $codes_list = implode(', ', $codes);
    
        $username = \Configuration::get('LABSMOBILE_API_USERNAME');
        $template = LabsTemplate::getByNameLm('admin', 'orderreturn');
        $admin_phone = \Configuration::get('LABSMOBILE_ADMIN_PHONE');
        if ($template->active == 1 && !empty($admin_phone)) {
            $template_sms = $template->template[(int) $this->context->language->id];
           
            $template_sms = str_replace('%FIRSTNAME%', $customer->firstname, $template_sms);
            $template_sms = str_replace('%LASTNAME%', $customer->lastname, $template_sms);
            $template_sms = str_replace('%EMAIL%', $customer->email, $template_sms);
            $template_sms = str_replace('%ORDERNUM%', $order->reference, $template_sms);
            $template_sms = str_replace('%ORDERID%', $id_order, $template_sms);
            $template_sms = str_replace('%ORDERDATE%', $order->date_add, $template_sms);
            $template_sms = str_replace('%PRODUCTCODES%', $codes_list, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $admin_phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-orderreturn_admin',
                Country::getIsoById(\Configuration::get('PS_COUNTRY_DEFAULT'))
            );
        }

        $template = LabsTemplate::getByNameLm('events', 'orderreturn');
        if ($template->active == 1) {
            $template_sms = $template->template[(int) $order_return->id_lang];
           
            $template_sms = str_replace('%FIRSTNAME%', $customer->firstname, $template_sms);
            $template_sms = str_replace('%LASTNAME%', $customer->lastname, $template_sms);
            $template_sms = str_replace('%EMAIL%', $customer->email, $template_sms);
            $template_sms = str_replace('%ORDERNUM%', $order->reference, $template_sms);
            $template_sms = str_replace('%ORDERID%', $id_order, $template_sms);
            $template_sms = str_replace('%ORDERDATE%', $order->date_add, $template_sms);
            $template_sms = str_replace('%PRODUCTCODES%', $codes_list, $template_sms);

            (new LabsApiCmd)->sendMessage(
                $phone,
                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                $template_sms,
                'p:prestashop-u:'.$username.'-h:status-orderreturn'.'-k:'.$id_customer,
                ($address->id_country > 0?$country->iso_code:'')
            );
        }
    }

    public function hookActionCartSave($params)
    {
        $template = LabsTemplate::getByNameLm('events', 'abandonedshoppingcart');
        if ($template->active == 1) {
            if (isset($params['cart']) && $params['cart']) {
                $customer = new \Customer((int) $params['cart']->id_customer);
                $id_cart  = (int) $params['cart']->id;

                if ($params['cart']->id_address_delivery) {
                    $address = new \Address((int) $params['cart']->id_address_delivery);
                    $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
                    if ($phone === false) {
                        $address = new \Address((int) $params['cart']->id_address_invoice);
                        $phone = LabsTools::choosePhone($address->phone_mobile, $address->phone, $address->id_country);
                    }
                    if ($phone === false) {
                        return;
                    }

                    if ($address->id_state > 0) {
                        $state = new \State((int) $address->id_state);
                    }
                    if ($address->id_country > 0) {
                        $country = new \Country((int) $address->id_country);
                    }
                    $username = \Configuration::get('LABSMOBILE_API_USERNAME');

                    $dbQuery = new \DbQuery();
                    $dbQuery->select('lmc.id_cart');
                    $dbQuery->from('lm_cart', 'lmc');
                    $dbQuery->where('lmc.id_cart = ' . (int) $id_cart);
                    $existing_cart = \Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue($dbQuery);

                    $cartProducts = LabsTools::getCartProducts((int) $id_cart);
                    if (!$existing_cart) {
                        if ($cartProducts == true) {
                            $template_sms = $template->template[(int) $params['cart']->id_lang];
                            $template_sms = str_replace('%FIRSTNAME%', $customer->firstname, $template_sms);
                            $template_sms = str_replace('%LASTNAME%', $customer->lastname, $template_sms);
                            $template_sms = str_replace('%EMAIL%', $customer->email, $template_sms);
                            $template_sms = str_replace('%ADDRESS%', trim($address->address1 . " " . $address->address2), $template_sms);
                            $template_sms = str_replace('%POSTCODE%', $address->postcode, $template_sms);
                            $template_sms = str_replace('%CITY%', $address->city, $template_sms);
                            if ($address->id_state > 0) {
                                $template_sms = str_replace('%STATE%', $state->name[(int) $params['cart']->id_lang], $template_sms);
                            }
                            if ($address->id_country > 0) {
                                $template_sms = str_replace('%COUNTRY%', $country->name[(int) $params['cart']->id_lang], $template_sms);
                            }

                            $dateTime = new \DateTime(null, new \DateTimeZone("UTC"));
                            $dateInterval = new \DateInterval('PT' . (int) $template->limit . 'H');
                            $dateTime->add($dateInterval);
                            $send_date = $dateTime->format('Y-m-d H:i:s');

                            $res = (new LabsApiCmd)->sendMessage(
                                $phone,
                                \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                                $template_sms,
                                'p:prestashop-u:'.$username.'-h:status-abandonedshoppingcart'.'-k:'.$params['cart']->id_customer.'-{cart:'.$id_cart.'}',
                                ($address->id_country > 0?$country->iso_code:''),
                                $send_date
                            );

                            if ($res !== false) {
                                \Db::getInstance()->insert('lm_cart', array(
                                    'id_cart' => (int) $id_cart,
                                    'subid' => pSQL($res['subid'])));
                            }
                        }
                    } else {
                        if ($cartProducts == false) {
                            $res = (new LabsApiCmd)->deleteScheduledSending($existing_cart['subid']);
                        }
                    }
                }
            }
        }
    }

    protected function installModuleTab15($tabClass, $tabName, $idTabParent)
    {
        $tab = new Tab();

        $id_lang = Language::getIdByIso('en');
        if (!$id_lang) {
            $id_lang = $this->context->language->id;
        }
        $langues = Language::getLanguages(false);
        foreach ($langues as $langue) {
            if (!isset($tabName[$langue['id_lang']])) {
                $tabName[$langue['id_lang']] = $tabName[$id_lang];
            }
        }

        $tab->name = $tabName;
        $tab->class_name = $tabClass;
        $tab->module = $this->name;
        $tab->id_parent = $idTabParent;
        $id_tab = $tab->save();
        if (!$id_tab) {
            return false;
        }

        $this->installcleanPositions($tab->id, $idTabParent);

        return true;
    }

    public function installcleanPositions($id, $id_parent)
    {
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT `id_tab`,`position`
            FROM `' ._DB_PREFIX_.'tab`
            WHERE `id_parent` = ' . (int) $id_parent . '
            AND `id_tab` != ' . (int) $id . '
            ORDER BY `position`');
        $sizeof = count($result);
        for ($i = 0; $i < $sizeof; ++$i) {
            Db::getInstance()->execute('
			UPDATE `' ._DB_PREFIX_.'tab`
			SET `position` = ' . (int) ($result[$i]['position'] + 1) . '
			WHERE `id_tab` = ' . (int) $result[$i]['id_tab']);
        }

        Db::getInstance()->execute('
			UPDATE `' ._DB_PREFIX_.'tab`
			SET `position` = 2
			WHERE `id_tab` = ' . (int) $id);

        return true;
    }
   
    private function installModuleTab16($tabClass, $tabName, $idTabParent)
    {
        @copy(_PS_MODULE_DIR_ . $this->name . '/logotab.png', _PS_IMG_DIR_ . 't/' . $tabClass . '.png');
       
        $tabNameA = array();
        $langues = \Language::getLanguages(false);
        foreach ($langues as $langue) {
            $tabNameA[$langue['id_lang']] = $tabName;
        }
       
        if (_PS_VERSION_ >= 1.7 || (_PS_VERSION_ < 1.6 && _PS_VERSION_ >= 1.5)) {
            $partab             = new Tab();
            $partab->name       = $tabName;
            $partab->class_name = $tabClass;
            $partab->module     = $this->name;
            $partab->id_parent  = $idTabParent;
            if ($partab->save()) {
                $tab             = new Tab();
                $tab->name       = $tabName;
                $tab->class_name = $tabClass;
                $tab->id_parent  = $partab->id;
                $tab->module     = $this->name;
                $tab->add();
                return true;
            }
            return false;
        } elseif (_PS_VERSION_ >= 1.6 && _PS_VERSION_ < 1.7) {
            $partab             = new Tab();
            $partab->name       = $tabNameA;
            $partab->class_name = $tabClass;
            $partab->module     = $this->name;
            $partab->id_parent  = $idTabParent;
            if ($partab->save()) {
                return true;
            }
            return false;
        }
    }

    protected static function getIdTab($tabClassName)
    {
        return (int) \Db::getInstance()->getValue(
            "SELECT id_tab FROM "._DB_PREFIX_."tab WHERE class_name = '" . pSQL($tabClassName) . "'"
        );
    }

    public function installModuleTab17($tabClassName, $TabParentName)
    {
        $tab = new \Tab();
        $tabName = array();

        $langues = \Language::getLanguages(false);
        foreach ($langues as $langue) {
            $tabName[$langue['id_lang']] = $this->menu_name;
        }

        $tab_parent_id = self::getIdTab($TabParentName);

        $tab->name       = $tabName;
        $tab->class_name = $tabClassName;
        $tab->module     = $this->name;
        $tab->id_parent  = $tab_parent_id;
        $id_tab          = $tab->save();
        if (!$id_tab) {
            return false;
        }

        return true;
    }

    private function uninstallModuleTab16($tabClass)
    {
        $sql = "SELECT id_tab FROM " . _DB_PREFIX_ . "tab WHERE class_name = '" . pSQL($tabClass) . "'";
        if ($results = Db::getInstance()->ExecuteS($sql)) {
            foreach ($results as $row) {
                $idTab = $row['id_tab'];
                if ($idTab != 0) {
                    $tab = new Tab((int)$idTab);
                    $tab->delete();
                    @unlink(_PS_IMG_DIR . "t/" . $tabClass . ".png");
                }
            }
        }
        return true;
    }

    protected function uninstallModuleTab($tabClass)
    {
        $idTab = self::getIdTab($tabClass);
        if ($idTab != 0) {
            $tab = new \Tab($idTab);
            $tab->delete();

            return true;
        }

        return false;
    }

    public function uninstallDB()
    {
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_invoices');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_templates');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_templates_lang');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_cart');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_texttemplates');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_texttemplates_lang');
        Db::getInstance()->execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'lm_groups');

        return true;
    }

    public function sendSMSBirthdays()
    {
        $template = LabsTemplate::getByNameLm('events', 'birthday');
        $username = \Configuration::get('LABSMOBILE_API_USERNAME');
        if ($template->active == 1) {
            $sql = "SELECT c.id_customer
                      FROM "._DB_PREFIX_."customer c
                    WHERE STR_TO_DATE(CONCAT(YEAR(CURDATE()), '-', MONTH(c.birthday), '-', DAY(c.birthday)), '%Y-%m-%d') = CURDATE()";
            $customers = Db::getInstance()->ExecuteS($sql);
            $customersList = array_map(function ($c) {
                return new \Customer((int) $c['id_customer']);
            }, $customers);

            if (!empty($customersList)) {
                foreach ($customersList as $customer) {
                    $addresses = $customer->getAddresses($customer->id_lang);
                    $address_selected = null;
                    $phone = false;
                    foreach ($addresses as $address) {
                        $phone = LabsTools::choosePhone($address['phone_mobile'], $address['phone'], $address['id_country']);
                        if ($phone !== false) {
                            $address_selected = $address;
                            break;
                        }
                    }
                    if ($phone === false) {
                        break;
                    }
                    if ($address_selected['id_country'] > 0) {
                        $country = new \Country((int) $address_selected['id_country']);
                    }
                    $template_sms = $template->template[(int) $customer->id_lang];
                    $template_sms = str_replace('%FIRSTNAME%', $customer->firstname, $template_sms);
                    $template_sms = str_replace('%LASTNAME%', $customer->lastname, $template_sms);

                    (new LabsApiCmd)->sendMessage(
                        $phone,
                        \Configuration::get('LABSMOBILE_DEFAULT_SENDER'),
                        $template_sms,
                        'p:prestashop-u:'.$username.'-h:birthday'.'-k:'.$customer->id,
                        ($addresses[0]['id_country'] > 0?$country->iso_code:'')
                    );
                }
            }
        }
        return $this->adminDisplayWarning($this->l('Please activate the SMS birthday event.'));
    }
}
