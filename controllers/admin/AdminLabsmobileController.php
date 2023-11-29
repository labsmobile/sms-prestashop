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

class AdminLabsmobileController extends ModuleAdminController
{
    public $context;

    public static $currentIndex;
    public $connected;
    public $token;
    public $confirmations_index = array(
        'login' => 0,
    );

    public function __construct()
    {
        $this->lang      = true;
        $this->bootstrap = true;
        $this->context   = Context::getContext();
        $this->name      = 'labsmobile';
        $this->meta_title = 'LabsMobile SMS';

        parent::__construct();

        self::$currentIndex = 'index.php?controller=AdminLabsmobile&token='.\Tools::getValue('token');

        $this->addConf();

        $this->connected = (bool) (\Configuration::get('LABSMOBILE_CONNECTION_STATUS') == 1);
        $this->setTitle();
    }

    public function initPageHeaderToolbar()
    {
        parent::initPageHeaderToolbar();

        if ($this->getAction() == 'groups') {
            $this->page_header_toolbar_btn['new'] = array(
                'short' => 'Newgroup',
                'href' => self::$currentIndex."&action=groupsnew",
                'desc' => $this->l('New group')
            );
        }

        if ($this->getAction() == 'templates') {
            $this->page_header_toolbar_btn['new'] = array(
                'short' => 'Newtemplate',
                'href' => self::$currentIndex."&action=templatesnew",
                'desc' => $this->l('New template')
            );
        }

        $this->page_header_toolbar_btn['help'] = array(
            'short' => 'Help',
            'href' => "https://addons.prestashop.com/contact-form.php?id_product=31022",
            'target' => "_blank",
            'desc' => $this->l('Help')
        );

        if (!in_array($this->getAction(), array('account', 'login', 'forgot'))) {
            $this->page_header_toolbar_btn['cart'] = array(
                'short' => 'Topup',
                'href' => self::$currentIndex."&action=purchase",
                'desc' => $this->l('Top up')
            );
         
            $this->page_header_toolbar_btn['off'] = array(
                'short' => 'Signout',
                'href' => self::$currentIndex."&action=logout",
                'desc' => $this->l('Signout')
            );
        }
        

        unset($this->toolbar_btn['help']);
    }

    public function setTitle()
    {

        $action = \Tools::getValue('action');
        if ($this->connected == false) {
            $this->toolbar_title = $this->l('Send SMS and boost your ecommerce');
        } else {
            switch ($action) {
                case "settings":
                    $this->toolbar_title = $this->l('Settings');
                    break;

                case "invoicing":
                    $this->toolbar_title = $this->l('Invoicing');
                    break;

                case "errorconnection":
                    $this->toolbar_title = $this->l('Error');
                    break;
             
                case "smscustomer":
                    $this->toolbar_title = $this->l('SMS to customers');
                    break;
             
                case "smsadmin":
                    $this->toolbar_title = $this->l('SMS to admin');
                    break;
             
                case "sendsms":
                    $this->toolbar_title = $this->l('Send SMS');
                    break;
             
                case "historic":
                    $this->toolbar_title = $this->l('Message history');
                    break;
             
                case "scheduled":
                    $this->toolbar_title = $this->l('Scheduled sendings');
                    break;

                case "templates":
                case "templatesnew":
                    $this->toolbar_title = $this->l('Text templates');
                    break;

                case "statistics":
                    $this->toolbar_title = $this->l('Statistics');
                    break;
             
                case "pricing":
                    $this->toolbar_title = $this->l('Prices and features by country');
                    break;

                case "groups":
                case "groupsnew":
                    $this->toolbar_title = $this->l('Customer groups');
                    break;

                case "purchase":
                    $this->toolbar_title = $this->l('Top up credits');
                    break;

                default:
                    $this->toolbar_title = $this->l('Dashboard');
                    break;
            }
        }
    }

    public function addConf()
    {
        $index = count($this->_conf)+1;
        $this->_conf[$index] = $this->l('Login successfully, connected to your LabsMobile account.');
        $this->confirmations_index['login'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Email sent to reset your password.');
        $this->confirmations_index['forgot'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('New account created successfully. We have sent you an email with the password.');
        $this->confirmations_index['account'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Settings saved successfully.');
        $this->confirmations_index['settings'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Invoicing details saved successfully.');
        $this->confirmations_index['invoicing'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Automatic top up configuration saved successfully.');
        $this->confirmations_index['renew'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Your credits have been added to your account.');
        $this->confirmations_index['purchase'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Customer events configuration saved successfully.');
        $this->confirmations_index['smscustomerevents'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Customer status configuration saved successfully.');
        $this->confirmations_index['smscustomerstatus'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Admin events configuration saved successfully.');
        $this->confirmations_index['smsadmin'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Admin configuration saved successfully.');
        $this->confirmations_index['confadmin'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Messages processed successfully.');
        $this->confirmations_index['sendsms'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Test message sent successfully.');
        $this->confirmations_index['testsms'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('New template created successfully.');
        $this->confirmations_index['templatesnew'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('New group created successfully.');
        $this->confirmations_index['groupsnew'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Template deleted successfully.');
        $this->confirmations_index['templatedelete'] = $index;
        $index++;
        $this->_conf[$index] = $this->l('Group deleted successfully.');
        $this->confirmations_index['groupdelete'] = $index;
    }

    public function getAction()
    {

        $action = \Tools::getValue('action');

        if ($this->connected == false) {
            $action = (in_array($action, array('account', 'login', 'forgot', 'errorconnection'))) ? $action : 'login';
        } else {
            $action = (in_array($action, array('dashboard','settings','invoicing','purchase','errorconnection','smscustomer','smsadmin','sendsms','ajaxfiltersendsms','ajaximportfile','ajaxchecknumbers','historic','ajaxfilterhistoric','scheduled','ajaxfilterscheduled','templates','templatesnew','statistics','pricing','groups','groupsnew','ajaxcalcgroup','ajaxgetcontactsgroup'))) ? $action : 'dashboard';
        }
        return $action;
    }

    private function getCountries()
    {

        $currency_obj = Currency::getDefaultCurrency();
        $currency_iso = $currency_obj->iso_code;
        $prices = (new LabsApiCmd)->getCountries($currency_iso);
        
        $countries_in = json_decode(json_encode($prices->countries), true);

        $countries = $countries_name = array();
        $countries_ps= Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'country` ct,
                   `'._DB_PREFIX_.'country_lang` co
             WHERE ct.id_country = co.id_country
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($countries_ps as $country_item) {
            if (isset($countries_in[$country_item['iso_code']])) {
                $countries[$country_item['iso_code']] = array_merge($countries_in[$country_item['iso_code']], $country_item);
                $countries_name[$country_item['iso_code']] = $country_item['name'];
            }
        }
        asort($countries_name);

        return array(
            'countries'         => $countries,
            'countries_name'    => $countries_name
        );
    }

    public function renderListGroups()
    {

        if (Tools::getIsset('id_group')) {
            $id_group = Tools::getValue('id_group');
            Db::getInstance()->delete('lm_groups', 'id_group = ' . (int) $id_group);
            Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['groupdelete'].'&action=groups');
        }

        $group_num = Db::getInstance()->getRow('
            SELECT COUNT(*) as num
              FROM `'._DB_PREFIX_.'lm_groups`');

        $groups = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'lm_groups`
          ORDER BY created DESC');

        $countries = array();
        $countries_ps = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'country` ct,
                   `'._DB_PREFIX_.'country_lang` co
             WHERE ct.id_country = co.id_country
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($countries_ps as $country_item) {
            $countries[$country_item['id_country']] = $country_item['name'];
        }

        $states = array();
        $states_ps = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'state` ct,
                   `'._DB_PREFIX_.'country` co
        WHERE ct.id_country = co.id_country');
        foreach ($states_ps as $state_item) {
            $states[$state_item['id_state']] = $state_item['name'] . " (" . $state_item['iso_code'] . ")";
        }

        $languages = array();
        $languages_ps = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'lang` ct');
        foreach ($languages_ps as $language_item) {
            $languages[$language_item['id_lang']] = $language_item['name'];
        }

        $products = array();
        $products_ps = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'product` ct,
                   `'._DB_PREFIX_.'product_lang` co
             WHERE ct.id_product = co.id_product
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($products_ps as $product_item) {
            $products[$product_item['id_product']] = $product_item['name'];
        }

        $categories = array();
        $categories_ps = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'category` ct,
                   `'._DB_PREFIX_.'category_lang` co
             WHERE ct.id_category = co.id_category
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($categories_ps as $category_item) {
            $categories[$category_item['id_category']] = $category_item['name'];
        }

        foreach ($groups as $group_key => $group_item) {
            $conditions = json_decode($group_item['conditions'], true);
            $conditions_array = array();
            if (isset($conditions['gender'])) {
                $conditions_array[] = $this->l('Gender').': ' . ($conditions['gender']=='male'?$this->l('Male'):$this->l('Female'));
            }
            if (isset($conditions['age'])) {
                $opr = "";
                if ($conditions['age']['opr'] == 'equal') {
                    $opr = "=";
                } elseif ($conditions['age']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Age').' ' . $opr . ' ' . $conditions['age']['value'];
            }
            if (isset($conditions['countries'])) {
                $countries_this = array();
                foreach ($conditions['countries'] as $country_item) {
                    $countries_this[] = $countries[$country_item];
                }
                $conditions_array[] = $this->l('Countries').': ' . implode(', ', $countries_this);
            }
            if (isset($conditions['states'])) {
                $states_this = array();
                foreach ($conditions['states'] as $state_item) {
                    $states_this[] = $states[$state_item];
                }
                $conditions_array[] = $this->l('States').': ' . implode(', ', $states_this);
            }
            if (isset($conditions['languages'])) {
                $languages_this = array();
                foreach ($conditions['languages'] as $language_item) {
                    $languages_this[] = $languages[$language_item];
                }
                $conditions_array[] = $this->l('Languages').': ' . implode(', ', $languages_this);
            }
            if (isset($conditions['newsletter'])) {
                $conditions_array[] = $this->l('Subscribed to newsletter');
            }
            if (isset($conditions['optin'])) {
                $conditions_array[] = $this->l('Opt-in validated');
            }
            if (isset($conditions['number'])) {
                $opr = "";
                if ($conditions['number']['opr'] == 'equal') {
                    $opr = "=";
                } elseif ($conditions['number']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Number of orders').' ' . $opr . ' ' . $conditions['number']['value'];
            }
            if (isset($conditions['spent'])) {
                $opr = "";
                if ($conditions['spent']['opr'] == 'equal') {
                    $opr = "=";
                } elseif ($conditions['spent']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Total spent amount').' ' . $opr . ' ' . $conditions['spent']['value'];
            }
            if (isset($conditions['average'])) {
                $opr = "";
                if ($conditions['average']['opr'] == 'equal') {
                    $opr = "=";
                } elseif ($conditions['average']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Average amount per order').' ' . $opr . ' ' . $conditions['average']['value'];
            }
            if (isset($conditions['lastorder'])) {
                $opr = "";
                if ($conditions['lastorder']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Days since last order').' ' . $opr . ' ' . $conditions['lastorder']['value'];
            }
            if (isset($conditions['lastvisit'])) {
                $opr = "";
                if ($conditions['lastvisit']['opr'] == 'greater') {
                    $opr = ">";
                } else {
                    $opr = "<";
                }
                $conditions_array[] = $this->l('Days since last visit').' ' . $opr . ' ' . $conditions['lastvisit']['value'];
            }
            if (isset($conditions['signup'])) {
                $str = "";
                if (!empty($conditions['signup']['from'])) {
                    $str .= $this->l('from') . " " . $conditions['signup']['from'] . " ";
                }
                if (!empty($conditions['signup']['to'])) {
                    $str .= $this->l('to') . " " . $conditions['signup']['to'] . " ";
                }
                $conditions_array[] = $this->l('Sign up date').' ' . $str;
            }
            if (isset($conditions['orders'])) {
                $str = "";
                if (!empty($conditions['orders']['date_from'])) {
                    $str .= $this->l('date from') . " " . $conditions['orders']['date_from'] . " ";
                }
                if (!empty($conditions['orders']['date_to'])) {
                    $str .= $this->l('date to') . " " . $conditions['orders']['date_to'] . " ";
                }
                if (!empty($conditions['orders']['amount_from'])) {
                    $str .= $this->l('amount from') . " " . $conditions['orders']['amount_from'] . " ";
                }
                if (!empty($conditions['orders']['amount_to'])) {
                    $str .= $this->l('amount to') . " " . $conditions['orders']['amount_to'] . " ";
                }
                if (!empty($conditions['orders']['countries'])) {
                    $countries_this = array();
                    foreach ($conditions['orders']['countries'] as $country_item) {
                        $countries_this[] = $countries[$country_item];
                    }
                    $str .= $this->l('Countries') . " (" . implode(', ', $countries_this) . ") ";
                }
                if (!empty($conditions['orders']['states'])) {
                    $states_this = array();
                    foreach ($conditions['orders']['states'] as $state_item) {
                        $states_this[] = $states[$state_item];
                    }
                    $str .= $this->l('States') . " (" . implode(', ', $states_this) . ") ";
                }
                if (!empty($conditions['orders']['products'])) {
                    $products_this = array();
                    foreach ($conditions['orders']['products'] as $product_item) {
                        $products_this[] = $products[$product_item];
                    }
                    $str .= $this->l('Products') . " (" . implode(', ', $products_this) . ") ";
                }
                if (!empty($conditions['orders']['categories'])) {
                    $categories_this = array();
                    foreach ($conditions['orders']['categories'] as $category_item) {
                        $categories_this[] = $categories[$category_item];
                    }
                    $str .= $this->l('Categories') . " (" . implode(', ', $categories_this) . ") ";
                }
                $conditions_array[] = $this->l('Orders').': ' . $str;
            }
            if (isset($conditions['products'])) {
                $products_this = array();
                foreach ($conditions['products'] as $product_item) {
                    $products_this[] = $products[$product_item];
                }
                $conditions_array[] = $this->l('Products').': ' . implode(', ', $products_this);
            }
            if (isset($conditions['categories'])) {
                $categories_this = array();
                foreach ($conditions['categories'] as $category_item) {
                    $categories_this[] = $categories[$category_item];
                }
                $conditions_array[] = $this->l('Categories').': ' . implode(', ', $categories_this);
            }
            $groups[$group_key]['conditions_array'] = $conditions_array;

            $groups[$group_key]['num'] = $this->getCustomerGroup($group_item['conditions']);
        }

        $i = 2;
        $pag_size = ceil($group_num['num']/50);
        $pags_previous = $pags_next = array();
        while ($i <= $pag_size && $i < 11) {
            $pags_next[] = $i;
            $i++;
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => "./groups.tpl",
            'action'            => "groups",
            'groups'            => $groups,
            'groups_num'        => $group_num['num'],
            'pag_now'           => 1,
            'pag_previous'      => 1,
            'pag_next'          => 2,
            'pag_more_previous' => false,
            'pag_more_next'     => ($pag_size > 10),
            'pags_previous'     => $pags_previous,
            'pags_next'         => $pags_next,
            'pag_size'          => $pag_size
        ));
    }

    public function renderListLogin()
    {

        $params = $this->getCountries();

        $params = array_merge($params, array(
            'tpl_file'          => './home.tpl',
            'action'            => $this->getAction(),
            'rand_img'          => rand(1, 5)
        ));

        $this->context->smarty->assign($params);
    }

    public function renderListPricing()
    {

        $params = $this->getCountries();

        $params = array_merge($params, array(
            'tpl_file'          => './pricing.tpl',
            'action'            => 'pricing',
        ));

        $this->context->smarty->assign($params);
    }

    public function renderListTemplatesnew()
    {
        $params_form = array();
        if (!empty($_POST) && Tools::getIsset('submitTemplatesnew')) {
            $params_form['name'] = Tools::getValue('name');
            $params_form['text_lang'] = Tools::getValue('text_lang');
        } else {
            $params_form['name'] = "";
            $params_form['text_lang'] = array();
            $languages = $this->getLanguages();
            foreach ($languages as $language_item) {
                $params_form['text_lang'][$language_item['id_lang']] = '';
            }
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => './templatesnew.tpl',
            'action'            => 'templatesnew',
            'params_form'       => $params_form,
            'languages'         => $this->getLanguages()
        ));
    }

    public function renderListGroupsnew()
    {

        $params_form = array();
        if (!empty($_POST) && Tools::getIsset('submitGroupsnew')) {
            $params_form['name'] = Tools::getValue('name');
        } else {
            $params_form['name'] = $this->l('New group')." ".date("Y-m-d H:i:s");
        }

        $country_array = array();
        $countries = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'country` ct,
                   `'._DB_PREFIX_.'country_lang` co
             WHERE ct.id_country = co.id_country
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($countries as $country_item) {
            $country_array[$country_item['id_country']] = $country_item['name'];
        }

        $state_array = array();
        $states = Db::getInstance()->executeS('
            SELECT st.*, ct.iso_code
              FROM `'._DB_PREFIX_.'country` ct,
                   `'._DB_PREFIX_.'state` st
             WHERE st.id_country = ct.id_country');
        foreach ($states as $state_item) {
            $state_array[$state_item['id_state']] = $state_item['name'] . " (" . $state_item['iso_code'] . ")";
        }

        $language_array = array();
        $languages = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'lang` lg
          ORDER BY name');
        foreach ($languages as $language_item) {
            $language_array[$language_item['id_lang']] = $language_item['name'];
        }

        $product_array = array();
        $products = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'product` ct,
                   `'._DB_PREFIX_.'product_lang` co
             WHERE ct.id_product = co.id_product
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($products as $product_item) {
            $product_array[$product_item['id_product']] = $product_item['name'];
        }

        $category_array = array();
        $categories = Db::getInstance()->executeS('
          SELECT *
            FROM `'._DB_PREFIX_.'category` ct,
                 `'._DB_PREFIX_.'category_lang` co
           WHERE ct.id_category = co.id_category
             AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($categories as $category_item) {
            $category_array[$category_item['id_category']] = $category_item['name'];
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => './groupsnew.tpl',
            'action'            => 'groupsnew',
            'params_form'       => $params_form,
            'countries'         => $country_array,
            'states'            => $state_array,
            'languages'         => $language_array,
            'products'          => $product_array,
            'categories'        => $category_array
        ));
    }

    public function renderListAjaxcalcgroup()
    {

        echo $this->getCustomerGroup(Tools::getValue('p_json'));
        die();
    }
 
    public function renderListAjaxgetcontactsgroup()
    {
        $sql = "SELECT * FROM `"._DB_PREFIX_."lm_groups` gr WHERE id_group = " . (int) Tools::getValue('p_group');
        $row = Db::getInstance()->getRow($sql);

        echo implode(',', $this->getCustomerGroup($row['conditions'], true));
        die();
    }

    private function getCustomerGroup($json_values, $list = false, $address_list = false)
    {

        $filter_values = json_decode($json_values, true);
        $where_filter = array();
        $where_filter[] = "cu.`id_customer` = ad.`id_customer`";
        $where_filter[] = "co.`id_country` = ad.`id_country`";
        $only_mobile = \Configuration::get('LABSMOBILE_ONLY_MOBILE');
        if ($only_mobile) {
            $where_filter[] = "(ad.`phone_mobile` IS NOT NULL AND ad.`phone_mobile` <> '')";
        } else {
            $where_filter[] = "((ad.`phone_mobile` IS NOT NULL AND ad.`phone_mobile` <> '') OR (ad.`phone` IS NOT NULL AND ad.`phone` <> ''))";
        }
        $from_filter = array();
        $from_filter['customer'] = '`'._DB_PREFIX_.'customer` cu';
        $from_filter['address'] = '`'._DB_PREFIX_.'address` ad';
        $from_filter['country'] = '`'._DB_PREFIX_.'country` co';
        if (!empty($filter_values['gender'])) {
            $from_filter['gender'] = '`'._DB_PREFIX_.'gender` gr';
            $where_filter[] = "gr.`type` = " . (int) ($filter_values['gender']=='male'?0:1);
            $where_filter[] = "cu.`id_gender` = gr.`id_gender`";
        }
        if (!empty($filter_values['age'])) {
            $opr = "=";
            if ($filter_values['age']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['age']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "FLOOR(DATEDIFF(NOW(),cu.`birthday`)/365) $opr '" . pSQL($filter_values['age']['value']) . "'";
        }
        if (!empty($filter_values['countries'])) {
            $where_filter[] = "ad.`id_country` IN (" . implode(",", array_map("intval", $filter_values['countries'])) . ")";
        }
        if (!empty($filter_values['states'])) {
            $where_filter[] = "ad.`id_state` IN (" . implode(",", array_map("intval", $filter_values['states'])) . ")";
        }
        if (!empty($filter_values['languages'])) {
            $where_filter[] = "ad.`id_lang` IN (" . implode(",", array_map("intval", $filter_values['languages'])) . ")";
        }
        if (!empty($filter_values['newsletter'])) {
            $where_filter[] = "cu.`newsletter` = 1";
        }
        if (!empty($filter_values['optin'])) {
            $where_filter[] = "cu.`optin` = 1";
        }
        if (!empty($filter_values['number'])) {
            $opr = "=";
            if ($filter_values['number']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['number']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "(SELECT COUNT(*) FROM `"._DB_PREFIX_."orders` od WHERE od.`id_customer` = cu.`id_customer`) " . pSQL($opr) . " '" . pSQL($filter_values['number']['value']) . "'";
        }
        if (!empty($filter_values['spent'])) {
            $opr = "=";
            if ($filter_values['spent']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['spent']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "(SELECT SUM(od.`total_paid`) FROM `"._DB_PREFIX_."orders` od WHERE od.`id_customer` = cu.`id_customer`) " . pSQL($opr) . " '" . pSQL($filter_values['spent']['value']) . "'";
        }
        if (!empty($filter_values['average'])) {
            $opr = "=";
            if ($filter_values['average']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['average']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "(SELECT AVG(od.`total_paid`) FROM `"._DB_PREFIX_."orders` od WHERE od.`id_customer` = cu.`id_customer`) " . pSQL($opr) . " '" . pSQL($filter_values['average']['value']) . "'";
        }
        if (!empty($filter_values['lastorder'])) {
            $opr = "=";
            if ($filter_values['lastorder']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['lastorder']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "(SELECT DATEDIFF(NOW(),MAX(od.`date_add`)) FROM `"._DB_PREFIX_."orders` od WHERE od.`id_customer` = cu.`id_customer`) " . pSQL($opr) . " '". pSQL($filter_values['lastorder']['value']) . "'";
        }
        if (!empty($filter_values['lastvisit'])) {
            $opr = "=";
            if ($filter_values['lastvisit']['opr'] == 'greater') {
                $opr = ">";
            } elseif ($filter_values['lastvisit']['opr'] == 'less') {
                $opr = "<";
            }
            $where_filter[] = "(SELECT DATEDIFF(NOW(),MAX(cn.`date_add`)) FROM `"._DB_PREFIX_."connections` cn, `"._DB_PREFIX_."guest` gu  WHERE cn.`id_guest` = gu.`id_guest` AND cu.`id_customer` = gu.id_customer) " . pSQL($opr) . " '" . pSQL($filter_values['lastvisit']['value']) . "'";
        }
        if (!empty($filter_values['signup'])) {
            if (!empty($filter_values['signup']['from'])) {
                $where_filter[] = "cu.`date_add` > '" . pSQL($filter_values['signup']['from']) . "'";
            }
            if (!empty($filter_values['signup']['to'])) {
                $where_filter[] = "cu.`date_add` < '" . pSQL($filter_values['signup']['to']) . "'";
            }
        }
        if (!empty($filter_values['orders'])) {
            $from_filter['orders'] = '`'._DB_PREFIX_.'orders` od';
            $where_filter[] = "cu.`id_customer` = od.`id_customer`";
            if (!empty($filter_values['orders']['date_from'])) {
                $where_filter[] = "od.`date_add` > '" . pSQL($filter_values['orders']['date_from']) . "'";
            }
            if (!empty($filter_values['orders']['date_to'])) {
                $where_filter[] = "od.`date_add` < '" . pSQL($filter_values['orders']['date_to']) . "'";
            }
            if (!empty($filter_values['orders']['amount_from'])) {
                $where_filter[] = "od.`total_paid` > '" . pSQL($filter_values['orders']['amount_from']) . "'";
            }
            if (!empty($filter_values['orders']['amount_to'])) {
                $where_filter[] = "od.`total_paid` < '" . pSQL($filter_values['orders']['amount_to']) . "'";
            }
            if (!empty($filter_values['orders']['amount_to'])) {
                $where_filter[] = "od.`total_paid` < '" . pSQL($filter_values['orders']['amount_to']) . "'";
            }
            if (!empty($filter_values['orders']['countries'])) {
                $from_filter['addresso'] = '`'._DB_PREFIX_.'address` ado';
                $where_filter[] = "ado.`id_address` = od.`id_address_delivery`";
                $where_filter[] = "ado.`id_country` IN (" . implode(",", array_map("intval", $filter_values['orders']['countries'])) . ")";
            }
            if (!empty($filter_values['orders']['states'])) {
                $from_filter['addresso'] = '`'._DB_PREFIX_.'address` ado';
                $where_filter[] = "ado.`id_address` = od.`id_address_delivery`";
                $where_filter[] = "ado.`id_state` IN (" . implode(",", array_map("intval", $filter_values['orders']['states'])) . ")";
            }
            if (!empty($filter_values['orders']['products'])) {
                $from_filter['order_detail'] = '`'._DB_PREFIX_.'order_detail` ol';
                $where_filter[] = "od.`id_order` = ol.`id_order`";
                $where_filter[] = "ol.`product_id` IN (" . implode(",", array_map("intval", $filter_values['orders']['products'])) . ")";
            }
            if (!empty($filter_values['orders']['categories'])) {
                $from_filter['order_detail'] = '`'._DB_PREFIX_.'order_detail` ol';
                $from_filter['category_product'] = '`'._DB_PREFIX_.'category_product` cp';
                $where_filter[] = "od.`id_order` = ol.`id_order`";
                $where_filter[] = "ol.`product_id` = cp.`id_product`";
                $where_filter[] = "cp.`id_category` IN (" . implode(",", array_map("intval", $filter_values['orders']['categories'])) . ")";
            }
        }
        if (!empty($filter_values['products'])) {
            $from_filter['orders'] = '`'._DB_PREFIX_.'orders` od';
            $from_filter['order_detail'] = '`'._DB_PREFIX_.'order_detail` ol';
            $where_filter[] = "cu.`id_customer` = od.`id_customer`";
            $where_filter[] = "od.`id_order` = ol.`id_order`";
            $where_filter[] = "ol.`product_id` IN (" . implode(",", array_map("intval", $filter_values['products'])) .")";
        }
        if (!empty($filter_values['categories'])) {
            $from_filter['orders'] = '`'._DB_PREFIX_.'orders` od';
            $from_filter['order_detail'] = '`'._DB_PREFIX_.'order_detail` ol';
            $from_filter['category_product'] = '`'._DB_PREFIX_.'category_product` cp';
            $where_filter[] = "cu.`id_customer` = od.`id_customer`";
            $where_filter[] = "od.`id_order` = ol.`id_order`";
            $where_filter[] = "ol.`product_id` = cp.`id_product`";
            $where_filter[] = "cp.`id_category` IN (" . implode(",", array_map("intval", $filter_values['categories'])) .")";
        }
        if (sizeof($where_filter) == 2) {
            return 0;
        }

        if ($list) {
            $sql = 'SELECT ad.*, co.call_prefix
                      FROM ' . implode(', ', $from_filter) . '
                     WHERE ' . implode(' AND ', $where_filter) . '
                  GROUP BY cu.`id_customer`';
            $rows = Db::getInstance()->executeS($sql);
            $numbers = array();
            foreach ($rows as $customer) {
                if ($address_list) {
                    $numbers[] = $customer['id_address'];
                } else {
                    $phone = LabsTools::choosePhone($customer['phone_mobile'], $customer['phone'], $customer['id_country']);
                    if ($phone !== false) {
                        $numbers[] = $phone;
                    }
                }
            }
            return $numbers;
        } else {
            $sql = 'SELECT COUNT(*) as num FROM (SELECT cu.`id_customer`
                      FROM ' . implode(', ', $from_filter) . '
                     WHERE ' . implode(' AND ', $where_filter) . '
                  GROUP BY cu.`id_customer`) d';
            $row = Db::getInstance()->getRow($sql);

            return $row['num'];
        }
    }

    public function renderListAjaxchecknumbers()
    {

        $currency_obj = Currency::getDefaultCurrency();
        $currency_iso = $currency_obj->iso_code;

        $res = (new LabsApiCmd)->checkNumbers(
            Tools::getValue('numbers'),
            $currency_iso
        );

        $country_array = array();
        $countries = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'country` ct,
                   `'._DB_PREFIX_.'country_lang` co
             WHERE ct.id_country = co.id_country
               AND co.id_lang = ' . (int) $this->context->language->id);
        foreach ($countries as $country_item) {
            $country_array[$country_item['call_prefix']] = $country_item['name'];
        }
        $res->country_names = $country_array;

        if ($res != false) {
            echo json_encode($res);
        } else {
            echo json_encode(0);
        }
        die();
    }

    public function renderListAjaximportfile()
    {

        $res = array(
            'error' => 0
        );
        if (isset($_FILES) &&
          isset($_FILES['file']) &&
          isset($_FILES['file']['name']) &&
          isset($_FILES['file']['tmp_name']) &&
          isset($_FILES['file']['error']) &&
          $_FILES['file']['error'] == 0) {
            $extension = LabsTools::getFileExtension($_FILES['file']['name']);
            $data_content = Tools::file_get_contents($_FILES['file']['tmp_name']);
            $final_lines = array();
            if ($extension == 'txt' || $extension == 'csv') {
                $delimitador = ',';
                if (strstr($data_content, "\r")) {
                    $lines = explode("\r", $data_content);
                } else {
                    $lines = explode(PHP_EOL, $data_content);
                }
                $num_lines = sizeof($lines);
                if ($num_lines == 0) {
                    $res['error'] = 1;
                    $res['desc'] = "nonumbersinfile";
                } elseif ($num_lines == 1) {
                    $cells = explode($delimitador, $lines[0]);
                    $num_cells = sizeof($cells);
                    if ($num_cells == 0) {
                        $res['error'] = 1;
                        $res['desc'] = "nodatafound";
                    } elseif ($num_cells == 1) {
                        $index_number = 0;
                    } else {
                        $index = 0;
                        $index_number = 0;
                        foreach ($cells as $cell_item) {
                            if (preg_match('/^[0-9()+-.\s]+$/', $cell_item)) {
                                $index_number =  $index;
                                break;
                            }
                            $index++;
                        }
                    }
                } else {
                    $cells = explode($delimitador, $lines[1]);
                    $num_cells = sizeof($cells);
                    if ($num_cells == 0) {
                        $res['error'] = 1;
                        $res['desc'] = "nodatafound";
                    } elseif ($num_cells == 1) {
                        $index_number = 0;
                    } else {
                        $index = 0;
                        $index_number = 0;
                        foreach ($cells as $cell_item) {
                            if (preg_match('/^[0-9()+-.\s]+$/', $cell_item)) {
                                $index_number =  $index;
                                break;
                            }
                            $index++;
                        }
                    }
                }
                $numbers = array();
                if ($res['error'] == 0) {
                    foreach ($lines as $line_item) {
                        $cells = explode($delimitador, $line_item);
                        $final_lines[] = $cells;
                        if (preg_match('/^[0-9()+-.\s]+$/', $cells[$index_number])) {
                            $numbers[] = LabsTools::filterPhone($cells[$index_number]);
                        } else {
                            $numbers[] = "";
                        }
                    }
                }

                $res['numbers'] = $numbers;
                $res['lines'] = $final_lines;
                $res['numbers_count'] = sizeof($numbers);
            } elseif (($extension == 'xls' || $extension == 'xlsx')) {
                require_once(dirname(__FILE__) . '/../../vendor/PHPExcel/PHPExcel.php');
                ini_set('memory_limit', '1G');
                if ($extension == 'xlsx') {
                    $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                    $objReader->setReadDataOnly(true);
                    $objPHPExcel = $objReader->load($_FILES['file']['tmp_name']);
                } elseif ($extension == 'xls') {
                    $objReader = PHPExcel_IOFactory::createReader('Excel5');
                    $objReader->setReadDataOnly(true);
                    $objPHPExcel = $objReader->load($_FILES['file']['tmp_name']);
                }
                $objPHPExcel->setActiveSheetIndex(0);
                $objSheet = $objPHPExcel->getActiveSheet();
                $final_lines = array();
                $rowIterator = $objSheet->getRowIterator(1);
                $num_lines = 0;
                foreach ($rowIterator as $rowIterator_item) {
                    $num_lines++;
                }
                if ($num_lines == 0) {
                    $res['error'] = 1;
                    $res['desc'] = "nonumbersinfile";
                } elseif ($num_lines == 1) {
                    foreach ($rowIterator as $rowIterator_item) {
                        $cellIterator = $rowIterator_item->getCellIterator();
                        break;
                    };
                    $cellIterator->setIterateOnlyExistingCells(true);
                    $num_cells = 0;
                    foreach ($cellIterator as $cellIterator_item) {
                        $num_cells++;
                        $cellIterator_item = $cellIterator_item;
                    }
                    if ($num_cells == 0) {
                        $res['error'] = 1;
                        $res['desc'] = "nodatafound";
                    } elseif ($num_cells == 1) {
                        $index_number = 0;
                    } else {
                        $index = 0;
                        $index_number = 0;
                        foreach ($cellIterator as $cell_item) {
                            $cellValue = trim($cell_item->getValue());
                            if (preg_match('/^[0-9()+-.\s]+$/', $cellValue)) {
                                $index_number =  $index;
                                break;
                            }
                            $index++;
                        }
                    }
                } else {
                    $num = 0;
                    foreach ($rowIterator as $rowIterator_item) {
                        $cellIterator = $rowIterator_item->getCellIterator();
                        if ($num == 1) {
                            break;
                        }
                        $num++;
                    };
                    $cellIterator->setIterateOnlyExistingCells(true);
                    $num_cells = 0;
                    foreach ($cellIterator as $cellIterator_item) {
                        $num_cells++;
                    }
                    if ($num_cells == 0) {
                        $res['error'] = 1;
                        $res['desc'] = "nodatafound";
                    } elseif ($num_cells == 1) {
                        $index_number = 0;
                    } else {
                        $index = 0;
                        $index_number = 0;
                        foreach ($cellIterator as $cell_item) {
                            $cellValue = trim($cell_item->getValue());
                            if (preg_match('/^[0-9()+-.\s]+$/', $cellValue)) {
                                $index_number =  $index;
                                break;
                            }
                            $index++;
                        }
                    }
                }

                $numbers = array();
                if ($res['error'] == 0) {
                    foreach ($rowIterator as $row) {
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(true);
                        $num = 0;
                        $cells = array();
                        $found = false;
                        foreach ($cellIterator as $cell) {
                            $cellValue = trim($cell->getValue());
                            $cells[$num] = $cellValue;
                            if ($num == $index_number) {
                                if (preg_match('/^[0-9()+-.\s]+$/', $cellValue)) {
                                    $numbers[] = LabsTools::filterPhone($cellValue);
                                } else {
                                    $numbers[] = "";
                                }
                                $found = true;
                            }
                            $num++;
                        }
                        $final_lines[] = $cells;
                        if (!$found) {
                            $numbers[] = "";
                        }
                    }
                }

                $res['numbers'] = $numbers;
                $res['lines'] = $final_lines;
                $res['numbers_count'] = sizeof($numbers);
            } else {
                $res['error'] = 1;
                $res['desc'] = "filenotsupported";
            }
        } else {
            $res['error'] = 1;
            $res['desc'] = "uploaderror";
        }
     
        echo json_encode($res);
        die();
    }

    public function renderListScheduled()
    {

        $messages_result = (new LabsApiCmd)->getScheduled(
            '', // id
            '', // number
            '', // sender
            '', // message
            '', // sent_from
            '', // sent_to
            '', // scheduled_from
            '', // scheduled_to
            '', // status
            'sc.scheduled DESC', // orderby
            50,
            0
        );

        foreach ($messages_result->messages as $key => $message_item) {
            switch ($message_item->status) {
                case 'scheduled':
                    $status_item = $this->l('Scheduled');
                    break;
                case 'processed':
                    $status_item = $this->l('Processed');
                    break;
                case 'cancelled':
                    $status_item = $this->l('Cancelled');
                    break;
                case 'error':
                    $status_item = $this->l('Error');
                    break;
                default:
                    break;
            }
            $messages_result->messages[$key]->status_str = $status_item;
            $messages_result->messages[$key]->created = LabsTools::toLocal($message_item->created);
            $messages_result->messages[$key]->scheduled = LabsTools::toLocal($message_item->scheduled);
        }

        $i = 2;
        $pag_size = ceil($messages_result->number/50);
        $pags_previous = $pags_next = array();
        while ($i <= $pag_size && $i < 11) {
            $pags_next[] = $i;
            $i++;
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => "./scheduled.tpl",
            'action'            => "scheduled",
            'messages'          => $messages_result->messages,
            'messages_num'      => $messages_result->number,
            'pag_now'           => 1,
            'pag_previous'      => 1,
            'pag_next'          => 2,
            'pag_more_previous' => false,
            'pag_more_next'     => ($pag_size > 10),
            'pags_previous'     => $pags_previous,
            'pags_next'         => $pags_next,
            'pag_size'          => $pag_size
        ));
    }

    public function renderListStatistics()
    {

        $stats = false;
        $params_form = array();

        $countries_list = Country::getCountries($this->context->language->id);
        $countries_array = array();
        foreach ($countries_list as $countries_item) {
            $countries_array[$countries_item['call_prefix']] = $countries_item['name'];
        }

        $params = array(
            'tpl_file'          => "./statistics.tpl",
            'action'            => "statistics",
            'countries'         => $countries_array
        );

        if (!empty($_POST) && Tools::getIsset('submitStatistics')) {
            $p_from = LabsTools::toUtc(Tools::getValue('from'));
            $p_to = LabsTools::toUtc(Tools::getValue('to'));
            $p_countries = Tools::getValue('country');
            if (is_array($p_countries)) {
                $p_countries = implode(',', $p_countries);
            } else {
                $p_countries = '';
            }
            $p_number = Tools::getValue('number');
            $p_sender = Tools::getValue('sender');
            $p_message = Tools::getValue('message');
            $data = (new LabsApiCmd)->getStatistics(
                $p_from,
                $p_to,
                $p_countries,
                $p_number,
                $p_sender,
                $p_message
            );

            $params_form['from'] = $p_from;
            $params_form['to'] = $p_to;
            $params_form['country'] = explode(',', $p_countries);
            $params_form['number'] = $p_number;
            $params_form['sender'] = $p_sender;
            $params_form['message'] = $p_message;

            $stats = true;
            $params['data'] = $data->data;
        } else {
            $params_form['from'] = date('Y-m-d H:i:s', strtotime("-3 days"));
            $params_form['to'] = "";
            $params_form['number'] = "";
            $params_form['sender'] = "";
            $params_form['message'] = "";
            $stats = false;
        }
     
        $params['stats'] = $stats;
        $params['params_form'] = $params_form;

        $this->context->smarty->assign($params);
    }

    public function renderListHistoric()
    {

        $messages_result = (new LabsApiCmd)->getMessages(
            '', // id
            '', // number
            '', // sender
            '', // message
            '', // credits
            '', // clicks
            '', // sent_from
            '', // sent_to
            '', // status
            'lo.id DESC', // orderby
            50,
            0
        );

        $countries_list = Country::getCountries($this->context->language->id);
        $countries_array = array();
        foreach ($countries_list as $countries_item) {
            $countries_array[$countries_item['call_prefix']] = $countries_item['name'];
        }

        foreach ($messages_result->messages as $key => $message_item) {
            switch ($message_item->status) {
                case 'processed':
                    $status_item = $this->l('Processed');
                    break;
                case 'duplicated':
                    $status_item = $this->l('Duplicated');
                    break;
                case 'noformat':
                    $status_item = $this->l('Format error');
                    break;
                case 'test':
                    $status_item = $this->l('Test');
                    break;
                case 'error':
                    $status_item = $this->l('Error');
                    break;
                case 'undeliverable':
                    $status_item = $this->l('Undeliverable');
                    break;
                case 'rejected':
                    $status_item = $this->l('Rejected');
                    break;
                case 'expired':
                    $status_item = $this->l('Expired');
                    break;
                case 'delivered':
                    $status_item = $this->l('Delivered');
                    break;
                case 'sent':
                    $status_item = $this->l('Sent');
                    break;
                default:
                    break;
            }
            $messages_result->messages[$key]->status = $status_item;
            $messages_result->messages[$key]->sent = LabsTools::toLocal($message_item->sent);
            $messages_result->messages[$key]->updated = LabsTools::toLocal($message_item->updated);
            $messages_result->messages[$key]->country = LabsTools::getCountry($messages_result->messages[$key]->number, $countries_array);
     
            $label_tokens = LabsTools::getLabelFields($message_item->label);
            if (isset($label_tokens["k"])) {
                $customer = new \Customer((int) $label_tokens["k"]);
                if ($customer) {
                    $messages_result->messages[$key]->customer = $customer;
                }
            }
        }

        $i = 2;
        $pag_size = ceil($messages_result->number/50);
        $pags_previous = $pags_next = array();
        while ($i <= $pag_size && $i < 11) {
            $pags_next[] = $i;
            $i++;
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => "./historic.tpl",
            'action'            => "historic",
            'messages'          => $messages_result->messages,
            'messages_num'      => $messages_result->number,
            'pag_now'           => 1,
            'pag_previous'      => 1,
            'pag_next'          => 2,
            'url_customer'      => 'index.php?controller=AdminCustomers&viewcustomer',
            'pag_more_previous' => false,
            'pag_more_next'     => ($pag_size > 10),
            'pags_previous'     => $pags_previous,
            'pags_next'         => $pags_next,
            'pag_size'          => $pag_size
        ));
    }

    public function renderListAjaxfilterhistoric()
    {

        $page_now = Tools::getValue('p_page');
        $export = Tools::getValue('p_export');
        $messages_result = (new LabsApiCmd)->getMessages(
            Tools::getValue('p_id'), // id
            Tools::getValue('p_number'), // number
            Tools::getValue('p_sender'), // sender
            Tools::getValue('p_message'), // message
            Tools::getValue('p_credits'), // credits
            Tools::getValue('p_clicks'), // clicks
            LabsTools::toUtc(Tools::getValue('p_sent_from')), // sent_from
            LabsTools::toUtc(Tools::getValue('p_sent_to')), // sent_to
            Tools::getValue('p_status'), // status
            'lo.id DESC', // orderby
            50,
            ($page_now > 1?($page_now-1)*50:0),
            $export
        );

        $countries_list = Country::getCountries($this->context->language->id);
        $countries_array = array();
        foreach ($countries_list as $countries_item) {
            $countries_array[$countries_item['call_prefix']] = $countries_item['name'];
        }

        if ($export) {
            $num = 0;
            $res = "";
            foreach ($messages_result->messages as $key => $messages_item) {
                switch ($messages_item->status) {
                    case 'processed':
                        $status_item = $this->l('Processed');
                        break;
                    case 'duplicated':
                        $status_item = $this->l('Duplicated');
                        break;
                    case 'noformat':
                        $status_item = $this->l('Format error');
                        break;
                    case 'test':
                        $status_item = $this->l('Test');
                        break;
                    case 'error':
                        $status_item = $this->l('Error');
                        break;
                    case 'undeliverable':
                        $status_item = $this->l('Undeliverable');
                        break;
                    case 'rejected':
                        $status_item = $this->l('Rejected');
                        break;
                    case 'expired':
                        $status_item = $this->l('Expired');
                        break;
                    case 'delivered':
                        $status_item = $this->l('Delivered');
                        break;
                    case 'sent':
                        $status_item = $this->l('Sent');
                        break;
                    default:
                        break;
                }
                $country = LabsTools::getCountry($messages_result->messages[$key]->number, $countries_array);
                $res .=
                '"' . $messages_item->id . '"' . "," .
                '"' . $messages_item->number . '"' . "," .
                '"' . LabsTools::escapeStringCsv($messages_item->sender) . '"' . "," .
                '"' . LabsTools::escapeStringCsv($messages_item->message) . '"' . "," .
                '"' . $messages_item->credits . '"' . "," .
                '"' . $messages_item->clicks . '"' . "," .
                '"' . LabsTools::toLocal($messages_item->sent) . '"' . "," .
                '"' . $status_item . '"' . "," .
                '"' . LabsTools::toLocal($messages_item->updated) . '"'.PHP_EOL;
                $num++;
            }
            echo $res;
            die();
        } else {
            foreach ($messages_result->messages as $key => $messages_item) {
                switch ($messages_item->status) {
                    case 'processed':
                        $status_item = $this->l('Processed');
                        break;
                    case 'duplicated':
                        $status_item = $this->l('Duplicated');
                        break;
                    case 'noformat':
                        $status_item = $this->l('Format error');
                        break;
                    case 'test':
                        $status_item = $this->l('Test');
                        break;
                    case 'error':
                        $status_item = $this->l('Error');
                        break;
                    case 'undeliverable':
                        $status_item = $this->l('Undeliverable');
                        break;
                    case 'rejected':
                        $status_item = $this->l('Rejected');
                        break;
                    case 'expired':
                        $status_item = $this->l('Expired');
                        break;
                    case 'delivered':
                        $status_item = $this->l('Delivered');
                        break;
                    case 'sent':
                        $status_item = $this->l('Sent');
                        break;
                    default:
                        break;
                }
                $country = LabsTools::getCountry($messages_result->messages[$key]->number, $countries_array);
                $messages_result->messages[$key]->country = $country;
                $messages_result->messages[$key]->sent_local = LabsTools::toLocal($messages_item->sent);
                $messages_result->messages[$key]->updated_local = LabsTools::toLocal($messages_item->updated);
                $messages_result->messages[$key]->status_item = $status_item;
                $num++;
            }
            $pag_size = ceil($messages_result->number/50);
            if ($page_now > 1) {
                $page_previous = $page_now - 1;
            } else {
                $page_previous = 1;
            }
            if ($page_now == $pag_size) {
                $pag_next = $pag_size;
            } else {
                $pag_next = $page_now + 1;
            }
            $pags_previous = $pags_next = array();
            if ($page_now > 1) {
                $i = $page_now - 1;
                while (($page_now - $i) < 11 && $i > 0) {
                    $pags_previous[] = $i;
                    $i--;
                }
                $pags_previous = array_reverse($pags_previous);
            }
            if ($page_now < $pag_size) {
                $i = $page_now + 1;
                while ($i <= $pag_size && ($i - $page_now) < 11) {
                    $pags_next[] = $i;
                    $i++;
                }
            }
            $this->context->smarty->assign(array(
                'messages_result'   => $messages_result,
                'countries_array'   => $countries_array,
                'pag_size'          => $pag_size,
                'pag_now'           => $page_now,
                'pags_previous'     => $pags_previous,
                'pags_next'         => $pags_next,
                'page_previous'     => $page_previous,
                'pag_next'         => $pag_next
            ));
            $table = $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/ajax/filterhistoric.tpl');
            $pagination = $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/ajax/pagination.tpl');

            echo json_encode(array(
                'table'             => $table,
                'message_num'       => $messages_result->number,
                'pagination'        => $pagination
            ));
            die();
        }
    }

    public function renderListAjaxfilterscheduled()
    {

        $page_now = Tools::getValue('p_page');
        $messages_result = (new LabsApiCmd)->getScheduled(
            (Tools::getIsset('p_id')?Tools::getValue('p_id'):''), // id
            Tools::getValue('p_number'), // number
            Tools::getValue('p_sender'), // sender
            Tools::getValue('p_message'), // message
            Tools::getValue('p_sent_from'), // sent_from
            Tools::getValue('p_sent_to'), // sent_to
            Tools::getValue('p_scheduled_from'), // sent_from
            Tools::getValue('p_scheduled_to'), // sent_to
            Tools::getValue('p_status'), // status
            'sc.scheduled DESC', // orderby
            50,
            ($page_now > 1?($page_now-1)*50:0)
        );

        foreach ($messages_result->messages as $key => $messages_item) {
            switch ($messages_item->status) {
                case 'scheduled':
                    $status_item = $this->l('Scheduled');
                    break;
                case 'processed':
                    $status_item = $this->l('Processed');
                    break;
                case 'cancelled':
                    $status_item = $this->l('Cancelled');
                    break;
                case 'error':
                    $status_item = $this->l('Error');
                    break;
                default:
                    break;
            }
            $messages_result->messages[$key]->status_item = $status_item;
            $messages_result->messages[$key]->created_local = LabsTools::toLocal($messages_item->created);
            $messages_result->messages[$key]->scheduled_local = LabsTools::toLocal($messages_item->scheduled);
        }
        $pag_size = ceil($messages_result->number/50);
        if ($page_now > 1) {
            $page_previous = $page_now - 1;
        } else {
            $page_previous = 1;
        }
        if ($page_now == $pag_size) {
            $pag_next = $pag_size;
        } else {
            $pag_next = $page_now + 1;
        }
        $pags_previous = $pags_next = array();
        if ($page_now > 1) {
            $i = $page_now - 1;
            while (($page_now - $i) < 11 && $i > 0) {
                $pags_previous[] = $i;
                $i--;
            }
            $pags_previous = array_reverse($pags_previous);
        }
        if ($page_now < $pag_size) {
            $i = $page_now + 1;
            while ($i <= $pag_size && ($i - $page_now) < 11) {
                $pags_next[] = $i;
                $i++;
            }
        }
        $this->context->smarty->assign(array(
            'messages_result'   => $messages_result,
            'pag_size'          => $pag_size,
            'pag_now'           => $page_now,
            'pags_previous'     => $pags_previous,
            'pags_next'         => $pags_next,
            'page_previous'     => $page_previous,
            'pag_next'          => $pag_next
        ));
        $table = $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/ajax/filterscheduled.tpl');
        $pagination = $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/ajax/pagination.tpl');

        echo json_encode(array(
            'table'             => $table,
            'message_num'       => $messages_result->number,
            'pagination'        => $pagination
        ));
        die();
    }

    public function renderListAjaxfiltersendsms()
    {

        $p_name = "";
        if (Tools::getIsset('p_name')) {
            $v_name = Tools::getValue('p_name');
            $p_name = 'AND (cu.firstname LIKE \'%' . pSQL($v_name) . '%\'';
            $p_name .= 'OR cu.lastname LIKE \'%' . pSQL($v_name) . '%\'';
            $p_name .= 'OR ad.firstname LIKE \'%' . pSQL($v_name) . '%\'';
            $p_name .= 'OR ad.lastname LIKE \'%' . pSQL($v_name) . '%\')';
        }

        $p_email = "";
        if (Tools::getIsset('p_email')) {
            $v_email = Tools::getValue('p_email');
            $p_email = 'AND cu.email LIKE \'%' . pSQL($v_email) . '%\'';
        }

        $p_address = "";
        if (Tools::getIsset('p_address')) {
            $v_address = Tools::getValue('p_address');
            $p_address = 'AND (co.name LIKE \'%' . pSQL($v_address) . '%\'';
            $p_address .= 'OR ad.city LIKE \'%' . pSQL($v_address) . '%\'';
            $p_address .= 'OR ad.postcode LIKE \'%' . pSQL($v_address) . '%\'';
            $p_address .= 'OR ad.address1 LIKE \'%' . pSQL($v_address) . '%\'';
            $p_address .= 'OR ad.address2 LIKE \'%' . pSQL($v_address) . '%\')';
        }

        $p_phone = "";
        if (Tools::getIsset('p_phone')) {
            $v_phone = Tools::getValue('p_phone');
            $only_mobile = \Configuration::get('LABSMOBILE_ONLY_MOBILE');
            if ($only_mobile) {
                $p_phone .= 'AND (ad.phone_mobile LIKE \'%' . pSQL($v_phone) . '%\')';
            } else {
                $p_phone .= 'AND (ad.phone_mobile LIKE \'%' . pSQL($v_phone) . '%\' OR ad.phone LIKE \'%' . pSQL($v_phone) . '%\')';
            }
        }

        $p_selected = "";
        if (Tools::getIsset('p_selected')) {
            $v_selected = Tools::getValue('p_selected');
            $p_selected .= 'AND (ad.id_address NOT IN (' . pSQL($v_selected) . '))';
        }

        $only_mobile = \Configuration::get('LABSMOBILE_ONLY_MOBILE');
        if ($only_mobile) {
            $phone_filter = 'AND (ad.phone_mobile IS NOT NULL AND ad.phone_mobile <> \'\')';
        } else {
            $phone_filter = 'AND ((ad.phone_mobile IS NOT NULL AND ad.phone_mobile <> \'\') OR (ad.phone IS NOT NULL AND ad.phone <> \'\'))';
        }

        $customers_list = Db::getInstance()->executeS('
            SELECT ad.id_address,
                   CONCAT(ad.firstname,\' \',ad.lastname) as name,
                   cu.email,
                   CONCAT(ad.city,\' (\',co.name,\')\') as address,
                   ad.phone_mobile,
                   ad.phone,
                   ad.id_country,
                   cn.call_prefix
              FROM `'._DB_PREFIX_.'customer` cu,
                   `'._DB_PREFIX_.'address` ad,
                   `'._DB_PREFIX_.'country` cn,
                   `'._DB_PREFIX_.'country_lang` co
             WHERE cu.id_customer = ad.id_customer
               AND co.id_country = cn.id_country
               AND co.id_country = ad.id_country ' .
               $phone_filter . $p_name . $p_email . $p_address . $p_phone . $p_selected . '
               AND co.id_lang = ' . (int) $this->context->language->id . '
          GROUP BY cu.id_customer, ad.phone_mobile
          ORDER BY cu.id_customer DESC
             LIMIT 25');
 
        foreach ($customers_list as $customers_key => $customers_item) {
            $phone = LabsTools::choosePhone($customers_item['phone_mobile'], $customers_item['phone'], $customers_item['id_country']);
            if ($phone === false) {
                continue;
            }
            $customers_list[$customers_key]['phone'] = $phone;
        }

        $this->context->smarty->assign(array(
            'customers_list'    => $customers_list
        ));

        echo $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/ajax/filtersendsms.tpl');
        die();
    }

    public function renderListForgot()
    {

        $params = $this->getCountries();
        $this->context->smarty->assign($params);

        $this->context->smarty->assign(array(
            'tpl_file'          => './home.tpl',
            'action'            => $this->getAction(),
            'rand_img'          => rand(1, 5)
        ));
    }

    public function renderListSendsms()
    {

        $bo_theme = ((Validate::isLoadedObject($this->context->employee)
            && $this->context->employee->bo_theme) ? $this->context->employee->bo_theme : 'default');

        if (!file_exists(_PS_BO_ALL_THEMES_DIR_.$bo_theme.DIRECTORY_SEPARATOR
            .'template')) {
            $bo_theme = 'default';
        }

        $this->addJs(__PS_BASE_URI__.$this->admin_webpath.'/themes/'.$bo_theme.'/js/jquery.iframe-transport.js');
        $this->addJs(__PS_BASE_URI__.$this->admin_webpath.'/themes/'.$bo_theme.'/js/jquery.fileupload.js');
        $this->addJs(__PS_BASE_URI__.$this->admin_webpath.'/themes/'.$bo_theme.'/js/jquery.fileupload-process.js');
        $this->addJs(__PS_BASE_URI__.$this->admin_webpath.'/themes/'.$bo_theme.'/js/jquery.fileupload-validate.js');
        $this->addJS(_PS_JS_DIR_.'vendor/spin.js');
        $this->addJS(_PS_JS_DIR_.'vendor/ladda.js');

        $params_form = array();
        if (Tools::getIsset('redirect')) {
            $params_form['sender'] = Tools::getValue('sender');
            $params_form['message'] = Tools::getValue('message');
            $params_form['message_lang'] = array();
 
            foreach ($this->getLanguages() as $language_item) {
                $params_form['message_lang'][$language_item['id_lang']] = Tools::getValue('message_lang_'.$language_item['id_lang']);
            }
            $params_form['scheduled'] = Tools::getValue('scheduled');
            $params_form['send_type'] = Tools::getValue('send_type');
        } else {
            $params_form['sender'] = \Configuration::get('LABSMOBILE_DEFAULT_SENDER');
            $params_form['send_type'] = "nav-link1";
            $params_form['message_lang'] = array();
            foreach ($this->getLanguages() as $language_item) {
                $params_form['message_lang'][$language_item['id_lang']] = Tools::getValue('message_lang_'.$language_item['id_lang']);
            }
            $params_form['message'] = "";
            $params_form['scheduled'] = "";
        }

        $only_mobile = \Configuration::get('LABSMOBILE_ONLY_MOBILE');
        if ($only_mobile) {
            $phone_filter = "AND (ad.phone_mobile IS NOT NULL AND ad.phone_mobile <> '')";
        } else {
            $phone_filter = "AND ((ad.phone_mobile IS NOT NULL AND ad.phone_mobile <> '') OR (ad.phone IS NOT NULL AND ad.phone <> ''))";
        }

        $customers_list = Db::getInstance()->executeS('
                  SELECT ad.id_address,
                         CONCAT(ad.firstname,\' \',ad.lastname) as name,
                         cu.email,
                         CONCAT(ad.city,\' (\',co.name,\')\') as address,
                         ad.phone_mobile,
                         ad.phone,
                         ad.id_country,
                         cn.call_prefix
                    FROM `'._DB_PREFIX_.'customer` cu,
                         `'._DB_PREFIX_.'address` ad,
                         `'._DB_PREFIX_.'country` cn,
                         `'._DB_PREFIX_.'country_lang` co
                   WHERE cu.id_customer = ad.id_customer
                     AND co.id_country = ad.id_country
                     AND co.id_country = cn.id_country
                     AND co.id_lang = ' . (int) $this->context->language->id . '
                     ' . $phone_filter . '
                GROUP BY cu.id_customer, ad.phone_mobile
                ORDER BY cu.id_customer DESC
                   LIMIT 25');

        foreach ($customers_list as $key => $customers_item) {
            $phone = LabsTools::choosePhone($customers_item['phone_mobile'], $customers_item['phone'], $customers_item['id_country']);
            if ($phone === false) {
                continue;
            }
            $customers_list[$key]['phone'] = $phone;
        }

        $templates_list_aux = Db::getInstance()->executeS('
                  SELECT *
                    FROM `'._DB_PREFIX_.'lm_texttemplates` te,
                         `'._DB_PREFIX_.'lm_texttemplates_lang` tl
                   WHERE te.id_texttemplate = tl.id_texttemplate
                ORDER BY te.id_texttemplate DESC');
        $templates = array();
        $templates_name = array();
        foreach ($templates_list_aux as $templates_item) {
            if (!isset($templates[$templates_item['id_texttemplate']])) {
                $templates[$templates_item['id_texttemplate']] = array();
            }
            $templates[$templates_item['id_texttemplate']][$templates_item['id_lang']] = utf8_decode($templates_item['text']);
            $templates_name[$templates_item['id_texttemplate']] = $templates_item['name'];
        }

        $groups_list_aux = Db::getInstance()->executeS('
                  SELECT *
                    FROM `'._DB_PREFIX_.'lm_groups` gr
                ORDER BY gr.created DESC');
        $groups = array();
        foreach ($groups_list_aux as $group_item) {
            $numcustomers = $this->getCustomerGroup($group_item['conditions']);
            if ($numcustomers > 0) {
                $groups[$group_item['id_group']] = $group_item['name'] . " (" . $numcustomers . ")";
            }
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => './sendsms.tpl',
            'action'            => $this->getAction(),
            'customer_list'     => $customers_list,
            'params_form'       => $params_form,
            'templates'         => $templates,
            'groups'            => $groups,
            'get'               => $_GET,
            'templates_name'    => $templates_name,
            'languages'         => $this->getLanguages()
        ));
    }

    public function renderListAccount()
    {
     
        $params = $this->getCountries();
        $this->context->smarty->assign($params);

        $ps_email = \Configuration::get('PS_SHOP_EMAIL');
        $ps_company = \Configuration::get('PS_SHOP_NAME');
        $ps_website = "http://".\Configuration::get('PS_SHOP_DOMAIN');
        $empl = new Employee($this->context->cookie->id_employee);
        $ps_name = $empl->firstname . " " . $empl->lastname;
        $this->context->smarty->assign(array(
            'ps_email'          => $ps_email,
            'ps_company'        => $ps_company,
            'ps_website'        => $ps_website,
            'ps_name'           => $ps_name,
            'rand_img'          => rand(1, 5)
        ));

        $this->context->smarty->assign(array(
            'tpl_file'          => './home.tpl',
            'action'            => $this->getAction(),
        ));
    }

    public function renderListDashboard()
    {
        $data = (new LabsApiCmd)->getDashboard();

        $this->context->smarty->assign(array(
            'tpl_file'          => "./dashboard.tpl",
            'action'            => "dashboard",
            'data'              => $data
        ));
    }

    public function renderListErrorconnection()
    {
        $this->context->smarty->assign(array(
            'href'              => 'index.php?controller=AdminLabsmobile&action=dashboard&token='.\Tools::getValue('token'),
            'tpl_file'          => "./errorconnection.tpl",
            'action'            => "errorconnection",
        ));
    }

    public function renderListInvoicing()
    {

        $params_form = (new LabsApiCmd)->getInvoicing();
        if (!empty($_POST) && Tools::getIsset('submitInvoicing')) {
            $params_form->company = Tools::getValue('company');
            $params_form->taxid = Tools::getValue('taxid');
            $params_form->address = Tools::getValue('address');
            $params_form->zipcode = Tools::getValue('zipcode');
            $params_form->city = Tools::getValue('city');
            $params_form->region = Tools::getValue('region');
            $params_form->country = Tools::getValue('country');
            $params_form->invoicing_email = Tools::getValue('invoicing_email');
        }

        $max_invoice_date = Db::getInstance()->getRow('
            SELECT MAX(date) as date
              FROM `'._DB_PREFIX_.'lm_invoices`');
        $invoices = (new LabsApiCmd)->getInvoices($max_invoice_date['date']);

        if ($invoices !== false && !empty($invoices)) {
            foreach ($invoices as $invoice_item) {
                $sql_arr = array(
                    'reference' => pSQL($invoice_item->reference),
                    'credits' => (float) $invoice_item->credits,
                    'amount' => (float) $invoice_item->amount,
                    'date' => pSQL($invoice_item->date),
                    'invoice_ref' => (int) $invoice_item->invoice_ref
                );
                Db::getInstance()->insert('lm_invoices', $sql_arr);
            }
        }

        $invoices = Db::getInstance()->executeS('
            SELECT *
              FROM `'._DB_PREFIX_.'lm_invoices`');

        $this->context->smarty->assign(array(
            'tpl_file'          => "./invoicing.tpl",
            'action'            => "invoicing",
            'params_form'       => $params_form,
            'invoices'          => $invoices,
            'invoicesList'      => $this->renderListInvoices(),
            'list_countries'    => Country::getCountries($this->context->language->id)
        ));
    }

    protected function renderListInvoices()
    {
        self::$currentIndex = 'index.php?controller=AdminLabsmobile&action=invoicing&token='.\Tools::getValue('token');

        $this->table = 'lm_invoices';
        $this->lang = false;
        $this->list_id = 'lm_invoices';
        $this->actions = array();
        $this->addRowAction('download');
        $this->identifier = 'id_invoice';
        $this->bulk_actions = false;
        $this->list_no_link = true;
        $this->explicitSelect = false;
        $this->toolbar_title = '<i class="icon-file"></i> '.$this->l('Invoices');

        $this->fields_list = (array(
            'reference' => array('title' => $this->l('Number'), 'filter_key' => 'a!reference', 'align' => 'center', 'orderby' => true),
            'credits' => array('title' => $this->l('Credits'), 'type' => 'int', 'align' => 'text-right', 'filter_key' => 'a!credits', 'orderby' => true),
            'amount' => array('title' => $this->l('Amount'), 'filter_key' => 'a!amount', 'align' => 'text-right', 'suffix' => ' €', 'orderby' => true),
            'date' => array('title' => $this->l('Date'), 'type' => 'date', 'filter_key' => 'a!date', 'align' => 'center', 'class' => 'fixed-width-md', 'orderby' => true)
        ));
        $this->_orderBy = 'date';
        $this->_orderWay = 'DESC';

        $this->processFilter();
        return parent::renderList();
    }

    public function renderListTemplates()
    {

        if (Tools::getIsset('id_texttemplate')) {
            $id_template = Tools::getValue('id_texttemplate');
            Db::getInstance()->delete('lm_texttemplates_lang', 'id_texttemplate = ' . (int) $id_template);
            Db::getInstance()->delete('lm_texttemplates', 'id_texttemplate = ' . (int) $id_template);
            Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['templatedelete'].'&action=templates');
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => "./templates.tpl",
            'action'            => "templates",
            'templatesList'      => $this->renderListTexttemplates()
        ));
    }

    protected function renderListTexttemplates()
    {
        self::$currentIndex = 'index.php?controller=AdminLabsmobile&action=templates&token='.\Tools::getValue('token');

        $this->table = 'lm_texttemplates';
        $this->lang = true;
        $this->list_id = 'lm_texttemplates';
        $this->actions = array();
        $this->addRowAction('delete');
        $this->identifier = 'id_texttemplate';
        $this->bulk_actions = false;
        $this->list_no_link = true;
        $this->explicitSelect = false;
        $this->toolbar_title = '<i class="icon-edit"></i> '.$this->l('Templates');

        $this->fields_list = (array(
            'name' => array('title' => $this->l('Name'), 'filter_key' => 'a!name', 'align' => 'left', 'orderby' => true),
            'text' => array('title' => $this->l('Text'), 'filter_key' => 'b!text', 'orderby' => false, 'class' => 'sms_format', 'callback' => 'printTexttemplate'),
        ));
        $this->_orderBy = 'id_texttemplate';
        $this->_orderWay = 'DESC';

        $this->processFilter();
        return parent::renderList();
    }

    public function printTexttemplate($value, $customer)
    {
        $customer = $customer;
        return utf8_decode($value);
    }

    public function displayDownloadLink($token, $id, $value)
    {
        $token = $token;
        $value = $value;
        $tpl = $this->createTemplate('../../../..'._MODULE_DIR_.'labsmobile/views/templates/admin/linkdownload.tpl');

        $invoices = Db::getInstance()->getRow('
            SELECT *
              FROM `'._DB_PREFIX_.'lm_invoices`
             WHERE id_invoice = ' . (int) $id);

        $tpl->assign(array(
            'invoice_ref'   => $invoices['invoice_ref']
        ));

        return $tpl->fetch();
    }

    public function renderListSmscustomer()
    {
     
        $this->context->smarty->assign(array(
            'formSmscustomerEvents' => (new LabsFormRender)->renderSmscustomerEvents(),
            'formSmscustomerStatus' => (new LabsFormRender)->renderSmscustomerStatus(),
            'tpl_file'              => "./smscustomer.tpl",
            'action'                => "smscustomer",
        ));
    }

    public function renderListSmsadmin()
    {
        if (!empty($_POST) && Tools::getIsset('submitConfadmin')) {
            $phone_admin_value = Tools::getValue('phone_admin');
        } else {
            $phone_admin_value = \Configuration::get('LABSMOBILE_ADMIN_PHONE');
        }
        $this->context->smarty->assign(array(
            'formSmsadmin'      => (new LabsFormRender)->renderSmsadmin(),
            'formConfadmin'     => (new LabsFormRender)->renderConfadmin(),
            'phone_admin_value' => $phone_admin_value,
            'tpl_file'          => "./smsadmin.tpl",
            'action'            => "smsadmin",
        ));
    }

    public function renderConfadmin()
    {
        $helper = new \HelperForm;
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->token = \Tools::getAdminTokenLite('AdminLabsmobile');
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;
        $helper->identifier = 'labsmobile';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminLabsmobile', false).'&action='.Tools::getValue('action');
        $helper->submit_action = 'submitConfadminForm';
        $helper->name_controller = 'col-lg-12';
        $fieldsValue = $this->getValuesConfadmin();
        $helper->tpl_vars = array(
            'fields_value' => $fieldsValue,
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id,
        );

        $helperHtml = $helper->generateForm(array(
            array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Admin configuration', 'labsmobile'),
                        'icon'  => 'icon-mobile',
                    ),
                    'input'  => array(
                                    array(
                                        'type'     => 'text',
                                        'label'    => $this->l('Admin phone number', 'labsmobile'),
                                        'desc'     => $this->l('With country code and without any symbol or punctuation (Exp : 33655555555)', 'labsmobile'),
                                        'name'     => 'phone_admin',
                                        'required' => true,
                                    ),
                                ),
                    'submit' => array(
                        'title' => $this->l('Save', 'labsmobile'),
                        'name'  => 'submitConfadmin'
                    ),
                ),
            )
        ));

        return $helperHtml;
    }

    public function renderListSettings()
    {

        $params_form = (new LabsApiCmd)->getSettings();
        if (!empty($_POST) && Tools::getIsset('submitSettings')) {
            $params_form->warning_limit = Tools::getValue('warning_limit');
            $params_form->warning_email = Tools::getValue('warning_email');
            $params_form->newsletter_active = Tools::getValue('newsletter_active');
            $params_form->default_sender = Tools::getValue('default_sender');
            $params_form->duplicated_filter = Tools::getValue('duplicated_filter');
            $params_form->max_daily = Tools::getValue('max_daily');
            $params_form->max_batch = Tools::getValue('max_batch');
            $params_form->onlymobile_active = Tools::getValue('onlymobile_active');
            $params_form->unicode_active = Tools::getValue('unicode_active');
            $params_form->replace_links = Tools::getValue('replace_links');
        } else {
            $params_form->onlymobile_active = \Configuration::get('LABSMOBILE_ONLY_MOBILE');
        }

        $this->context->smarty->assign(array(
            'tpl_file'          => "./settings.tpl",
            'action'            => "settings",
            'params_form'       => $params_form
        ));
    }

    public function renderListPurchase()
    {
     
        $this->addJS(_MODULE_DIR_ . 'labsmobile/views/js/iframeResizer/iframeResizer.min.js');

        $params_renew = (new LabsApiCmd)->getRenew();
        if (!empty($_POST) && Tools::getIsset('submitRenew')) {
            $params_renew->renew_enable = Tools::getValue('renew_enable');
            $params_renew->renew_limit = Tools::getValue('renew_limit');
            $params_renew->renew_credits = Tools::getValue('renew_credits');
            $params_renew->renew_maxrecharges = Tools::getValue('renew_maxrecharges');
            $params_renew->renew_card = Tools::getValue('renew_card');
        }

        $currency_obj = Currency::getDefaultCurrency();

        $this->context->smarty->assign(array(
            'tpl_file'          => "./purchase.tpl",
            'action'            => "purchase",
            'redirect_url'      => (isset($_SERVER['HTTPS']) ? "https" : "http").'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
            'username'          => \Configuration::get('LABSMOBILE_API_USERNAME'),
            'country_iso'       => Country::getIsoById(\Configuration::get('PS_COUNTRY_DEFAULT')),
            'currency_iso'      => $currency_obj->iso_code,
            'cards'             => (new LabsApiCmd)->getCards(),
            'params_renew'      => $params_renew,
            'url_purchase'      => LabsTools::getUrlPurchase(),
            'confmsg'           => $this->confirmations_index['purchase']
        ));
    }

    public function renderList()
    {
        $action = Tools::toCamelCase($this->getAction(), true);
        if ($action != 'Errorconnection' && $this->connected) {
            $balance = (new LabsApiCmd)->balance(Country::getIsoById(\Configuration::get('PS_COUNTRY_DEFAULT')));
            if ($balance === false) {
                Tools::redirectAdmin(self::$currentIndex.'&action=errorconnection');
            }
            $this->context->smarty->assign(array(
                'balance'   => $balance,
            ));
        } elseif ($action != 'Errorconnection') {
            if (!(new LabsApiCmd)->checkConnection()) {
                Tools::redirectAdmin(self::$currentIndex.'&action=errorconnection');
            }
        }

        $functionRenderList = 'renderList'.$action;
        if (!empty($action) && method_exists($this, $functionRenderList)) {
            $this->$functionRenderList();
        }

        $error_mobile_required = false;

        if ($this->connected) {
            $required_enabled = Db::getInstance()->getRow("
            SELECT COUNT(*) as num
              FROM `"._DB_PREFIX_."required_field`
             WHERE (object_name = 'Address' OR object_name = 'CustomerAddress')
               AND field_name = 'phone_mobile'");
            if ($required_enabled['num'] == 0) {
                $error_mobile_required = true;
            }
        }

        $this->context->smarty->assign(array(
            // 'debug'    => (_PS_MODE_DEV_ && !empty($this->api->debug)) ? $this->api->debug : array(),
            'img_path'          => _MODULE_DIR_ . 'labsmobile/views/img/',
            'username'          => \Configuration::get('LABSMOBILE_API_USERNAME'),
            'unicode_active'    => \Configuration::get('LABSMOBILE_SMSUNICODE'),
            'connected'         => $this->connected,
            'url_config'        => self::$currentIndex,
            'lang'              => $this->context->language->id,
            'module'            => $this->module,
            'default_lang'      => $this->context->language,
            'locale'            => localeconv(),
            'error_mobile_required' => $error_mobile_required
        ));

        $this->addCSS(_MODULE_DIR_ . 'labsmobile/views/css/labsmobile.css');
        $this->addJS(_MODULE_DIR_ . 'labsmobile/views/js/labsmobile.js');

        return $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/labsmobile.tpl');
    }

    public function postProcessGroupsnew()
    {
        $errors_found = false;

        $field_name = $this->l('Name');
        if (!Tools::getIsset('name')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_name = Tools::getValue('name');
            if (empty($p_name)) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        $field_name = $this->l('Conditions');
        if (!Tools::getIsset('conditions_json')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_conditions = Tools::getValue('conditions_json');
            if (empty($p_conditions) || $p_conditions == '{}') {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        if (!$errors_found) {
            $sql_arr = array(
                'name' => pSQL($p_name),
                'conditions' => pSQL($p_conditions),
                'created' => pSQL(date('Y-m-d H:i:s'))
            );
            Db::getInstance()->insert('lm_groups', $sql_arr);
            Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['groupsnew'].'&action=groups');
            return;
        }
    }

    public function postProcessTemplatesnew()
    {
        $errors_found = false;

        $field_name = $this->l('Name');
        if (!Tools::getIsset('name')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_name = Tools::getValue('name');
            if (empty($p_name)) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        $p_text_lang = array();
        $languages = $this->getLanguages();
        foreach ($languages as $language_item) {
            $p_text_aux = Tools::getValue('text_lang_'.$language_item['id_lang']);
            if (!empty($p_text_aux)) {
                $p_text_lang[$language_item['id_lang']] = $p_text_aux;
            } else {
                $p_text_lang[$language_item['id_lang']] = '';
            }
        }

        $field_name = $this->l('Text');
        if (sizeof($p_text_lang) == 0) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
        }

        if (!$errors_found) {
            $sql_arr = array(
                'name' => pSQL($p_name),
            );
            Db::getInstance()->insert('lm_texttemplates', $sql_arr);
            $id_template = Db::getInstance()->Insert_ID();
            foreach ($p_text_lang as $p_text_lang_id => $p_text_lang_item) {
                $sql_arr_item = array(
                    'id_texttemplate' => (int) $id_template,
                    'id_lang' => (int) $p_text_lang_id,
                    'text' => pSQL(utf8_encode($p_text_lang_item)),
                );
                Db::getInstance()->insert('lm_texttemplates_lang', $sql_arr_item);
            }
            Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['templatesnew'].'&action=templates');
            return;
        }
    }

    public function postProcessSendsms()
    {
        $errors_found = false;

        $field_name = $this->l('Recipients');
        if (!Tools::getIsset('numbers')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_numbers_aux = explode(',', Tools::getValue('numbers'));
            $p_numbers_array = array();
            foreach ($p_numbers_aux as $p_numbers_item) {
                $p_numbers_array[] = LabsTools::filterPhone($p_numbers_item);
            }
            $p_numbers = implode(',', $p_numbers_array);
        }

        $field_name = $this->l('Message');
        if (!Tools::getIsset('message')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_sendtype = Tools::getValue('send_type');
            $p_mult_sending = false;
            if ($p_sendtype == 'nav-link1') {
                $p_address_str = Tools::getValue('address');
                $p_address_list = explode(',', $p_address_str);
                $p_address_array = array();
                $p_customer_array = array();
                $p_message_array = array();
                $num = 0;
                $first_lang = $default_lang = $this->context->language->id;
             
                $languages = $this->getLanguages();
                foreach ($languages as $language_item) {
                    $p_message_aux = Tools::getValue('message_lang_'.$language_item['id_lang']);
                    if (!empty($p_message_aux)) {
                        $first_lang = $language_item['id_lang'];
                        break;
                    }
                }

                foreach ($p_address_list as $p_address_item) {
                    $p_address_array[$num] = new \Address((int) $p_address_item);
                    $p_country_aux = null;
                    if ($p_address_array[$num]->id_country > 0) {
                        $p_country_aux = new \Country((int) $p_address_array[$num]->id_country);
                    }
                    $p_state_aux = null;
                    if ($p_address_array[$num]->id_state > 0) {
                        $p_state_aux = new \State((int) $p_address_array[$num]->id_state);
                    }
                    $p_customer_array[$num] = new \Customer((int) $p_address_array[$num]->id_customer);
                    $p_message_array[$num] = Tools::getValue('message_lang_'.$p_customer_array[$num]->id_lang);
                    if (empty($p_message_array[$num])) {
                        $p_message_array[$num] = Tools::getValue('message_lang_'.$default_lang);
                        if (empty($p_message_array[$num])) {
                            $p_message_array[$num] = Tools::getValue('message_lang_'.$first_lang);
                        }
                    }
                 
                    if (stripos($p_message_array[$num], "%FIRSTNAME%") !== false) {
                        $p_message_array[$num] = str_replace("%FIRSTNAME%", $p_customer_array[$num]->firstname, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%LASTNAME%") !== false) {
                        $p_message_array[$num] = str_replace("%LASTNAME%", $p_customer_array[$num]->lastname, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%EMAIL%") !== false) {
                        $p_message_array[$num] = str_replace("%EMAIL%", $p_customer_array[$num]->email, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%ADDRESS%") !== false) {
                        $p_message_array[$num] = str_replace("%ADDRESS%", $p_address_array[$num]->address1, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%POSTCODE%") !== false) {
                        $p_message_array[$num] = str_replace("%POSTCODE%", $p_address_array[$num]->postcode, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%CITY%") !== false) {
                        $p_message_array[$num] = str_replace("%CITY%", $p_address_array[$num]->city, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%STATE%") !== false) {
                        if ($p_state_aux) {
                            $p_message_array[$num] = str_replace("%STATE%", $p_state_aux->name, $p_message_array[$num]);
                        } else {
                            $p_message_array[$num] = str_replace("%STATE%", "", $p_message_array[$num]);
                        }
                    }
                    if (stripos($p_message_array[$num], "%COUNTRY%") !== false) {
                        if ($p_country_aux) {
                            $p_message_array[$num] = str_replace("%COUNTRY%", $p_country_aux->name[(int) $p_customer_array[$num]->id_lang], $p_message_array[$num]);
                        } else {
                            $p_message_array[$num] = str_replace("%COUNTRY%", "", $p_message_array[$num]);
                        }
                    }
                    $num++;
                }

                $last_message = $p_message_array[0];
                foreach ($p_message_array as $p_message_item) {
                    if ($last_message != $p_message_item) {
                        $p_mult_sending = true;
                        break;
                    }
                }
                if (!$p_mult_sending) {
                    $p_message = $last_message;
                }
            } elseif ($p_sendtype == 'nav-link4') {
                $p_group_id = Tools::getValue('groups');
                $sql = 'SELECT * FROM `'._DB_PREFIX_.'lm_groups` gr WHERE id_group = ' . (int) $p_group_id;
                $row_group = Db::getInstance()->getRow($sql);

                $p_address_list = $this->getCustomerGroup($row_group['conditions'], true, true);
                $p_address_array = array();
                $p_customer_array = array();
                $p_message_array = array();
                $num = 0;

                $first_lang = $default_lang = $this->context->language->id;
             
                $languages = $this->getLanguages();
                foreach ($languages as $language_item) {
                    $p_message_aux = Tools::getValue('message_lang_'.$language_item['id_lang']);
                    if (!empty($p_message_aux)) {
                        $first_lang = $language_item['id_lang'];
                        break;
                    }
                }

                foreach ($p_address_list as $p_address_item) {
                    $p_address_array[$num] = new \Address((int) $p_address_item);
                    $p_country_aux = null;
                    if ($p_address_array[$num]->id_country > 0) {
                        $p_country_aux = new \Country((int) $p_address_array[$num]->id_country);
                    }
                    $p_state_aux = null;
                    if ($p_address_array[$num]->id_state > 0) {
                        $p_state_aux = new \State((int) $p_address_array[$num]->id_state);
                    }
                    $p_customer_array[$num] = new \Customer((int) $p_address_array[$num]->id_customer);
                    $p_message_array[$num] = Tools::getValue('message_lang_'.$p_customer_array[$num]->id_lang);
                    if (empty($p_message_array[$num])) {
                        $p_message_array[$num] = Tools::getValue('message_lang_'.$default_lang);
                        if (empty($p_message_array[$num])) {
                            $p_message_array[$num] = Tools::getValue('message_lang_'.$first_lang);
                        }
                    }
                 
                    if (stripos($p_message_array[$num], "%FIRSTNAME%") !== false) {
                        $p_message_array[$num] = str_replace("%FIRSTNAME%", $p_customer_array[$num]->firstname, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%LASTNAME%") !== false) {
                        $p_message_array[$num] = str_replace("%LASTNAME%", $p_customer_array[$num]->lastname, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%EMAIL%") !== false) {
                        $p_message_array[$num] = str_replace("%EMAIL%", $p_customer_array[$num]->email, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%ADDRESS%") !== false) {
                        $p_message_array[$num] = str_replace("%ADDRESS%", $p_address_array[$num]->address1, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%POSTCODE%") !== false) {
                        $p_message_array[$num] = str_replace("%POSTCODE%", $p_address_array[$num]->postcode, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%CITY%") !== false) {
                        $p_message_array[$num] = str_replace("%CITY%", $p_address_array[$num]->city, $p_message_array[$num]);
                    }
                    if (stripos($p_message_array[$num], "%STATE%") !== false) {
                        if ($p_state_aux) {
                            $p_message_array[$num] = str_replace("%STATE%", $p_state_aux->name, $p_message_array[$num]);
                        } else {
                            $p_message_array[$num] = str_replace("%STATE%", "", $p_message_array[$num]);
                        }
                    }
                    if (stripos($p_message_array[$num], "%COUNTRY%") !== false) {
                        if ($p_country_aux) {
                            $p_message_array[$num] = str_replace("%COUNTRY%", $p_country_aux->name[(int) $p_customer_array[$num]->id_lang], $p_message_array[$num]);
                        } else {
                            $p_message_array[$num] = str_replace("%COUNTRY%", "", $p_message_array[$num]);
                        }
                    }
                    $num++;
                }

                $last_message = $p_message_array[0];
                foreach ($p_message_array as $p_message_item) {
                    if ($last_message != $p_message_item) {
                        $p_mult_sending = true;
                        break;
                    }
                }
                if (!$p_mult_sending) {
                    $p_message = $last_message;
                }
            } elseif ($p_sendtype == 'nav-link2') {
                $p_message = Tools::getValue('message');
            } else {
                $p_message = Tools::getValue('message');
                if (stripos($p_message, "%FIELD_") !== false) {
                    $p_lines = json_decode(Tools::getValue('importfile_lines'), true);
                    $num = 0;
                    $p_message_array = array();
                    foreach ($p_numbers_array as $p_numbers_item) {
                        $offset = 0;
                        $p_message_aux = $p_message_orig = $p_message;

                        while ($offset < Tools::strlen($p_message_orig) && ($start_field = stripos($p_message_orig, "%FIELD_", $offset)) !== false) {
                            $end_field = stripos($p_message_orig, "%", $start_field+1);
                            $number_field = -1;
                            if ($end_field !== false) {
                                $offset = $end_field + 1;
                                $name_field = Tools::substr($p_message_orig, $start_field+1, $end_field-$start_field-1);
                                $number_field = explode("_", $name_field);
                                if (sizeof($number_field) == 2) {
                                    $number_field = (int) $number_field[1];
                                }
                            } else {
                                break;
                            }
                         
                            if (is_int($number_field) && $number_field > 0 && isset($p_lines[$num][$number_field-1])) {
                                $p_message_aux = str_replace("%$name_field%", $p_lines[$num][$number_field-1], $p_message_aux);
                            } else {
                                $p_message_aux = str_replace("%$name_field%", "", $p_message_aux);
                            }
                        }

                        $p_message_array[$num] = $p_message_aux;
                        $num++;
                    }
                    $last_message = $p_message_array[0];
                    foreach ($p_message_array as $p_message_item) {
                        if ($last_message != $p_message_item) {
                            $p_mult_sending = true;
                            break;
                        }
                    }
                }
            }
        }

        $field_name = $this->l('Sender');
        if (!Tools::getIsset('sender')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_sender = Tools::getValue('sender');
            if (!$p_sender) {
                $p_sender = 'LABSMOBILE';
            }
        }

        $field_name = $this->l('Scheduled');
        if (!Tools::getIsset('scheduled')) {
            $p_scheduled = false;
        } else {
            $p_scheduled = Tools::getValue('scheduled');
            if (!$p_scheduled) {
                $p_scheduled = false;
            } else {
                if (!Validate::isDateFormat($p_scheduled)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be a datetime value.'), $field_name);
                } else {
                    $p_scheduled = LabsTools::toUtc($p_scheduled);
                }
            }
        }

        if (!$errors_found) {
            $username = \Configuration::get('LABSMOBILE_API_USERNAME');
            if ($p_mult_sending) {
                $num = 0;
                $res_error = null;
             
                foreach ($p_numbers_array as $p_numbers_item) {
                    $res = (new LabsApiCmd)->sendMessage($p_numbers_item, $p_sender, $p_message_array[$num], 'p:prestashop-u:'.$username.'-h:sendsms', '', ($p_scheduled === false?'':$p_scheduled));
                    if ($res !== true) {
                        $res_error = $res;
                    }
                    $num++;
                }
                if ($res_error) {
                    $res = $res_error;
                }
            } else {
                $res = (new LabsApiCmd)->sendMessage($p_numbers, $p_sender, $p_message, 'p:prestashop-u:'.$username.'-h:sendsms', '', ($p_scheduled === false?'':$p_scheduled));
            }
         
            if ($res === true) {
                $params_redirect = array();
                foreach ($_POST as $key_post => $value_post) {
                    if (($key_post == 'sender' || $key_post == 'message' || $key_post == 'send_type' || $key_post == 'scheduled' || stripos($key_post, "message_lang") === 0) && !empty($value_post)) {
                        $params_redirect[$key_post] = $value_post;
                    }
                }
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['sendsms'].'&action=sendsms&redirect=1&'.http_build_query($params_redirect));
                return;
            } else {
                switch ($res) {
                    case "35":
                        $this->errors[] = $this->l('The account has no credits for this sending.');
                        break;
                    case 'requiredfields':
                        $this->errors[] = $this->l('Required fields not found.');
                        break;
                    case 'internalerror':
                        $this->errors[] = $this->l('Internal error.');
                        break;
                    default:
                        $this->errors[] = $this->l('Error processing the operation.');
                        break;
                }
            }
        }
    }

    public function postProcessSmsadmin()
    {
        $errors_found = false;
        $languages = $this->getLanguages();
        $eval_active = $eval_templates = array();

        if (Tools::getIsset('submitSmsadmin')) {
            $field_name = $this->l('New account active');
            if (!Tools::getIsset('enable_newaccount')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['newaccount'] = Tools::getValue('enable_newaccount');
                if (!Validate::isBool($eval_active['newaccount'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $eval_templates['newaccount'] = array();
            $found_template = false;
            $field_name = $this->l('New account template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_newaccount_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['newaccount'][$language_item['id_lang']] = Tools::getValue('template_newaccount_'.$language_item['id_lang']);
                    if ($eval_templates['newaccount'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            $field_name = $this->l('New order active');
            if (!Tools::getIsset('enable_neworder')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['neworder'] = Tools::getValue('enable_neworder');
                if (!Validate::isBool($eval_active['neworder'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $eval_templates['neworder'] = array();
            $found_template = false;
            $field_name = $this->l('New order template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_neworder_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['neworder'][$language_item['id_lang']] = Tools::getValue('template_neworder_'.$language_item['id_lang']);
                    if ($eval_templates['neworder'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            $field_name = $this->l('Order return active');
            if (!Tools::getIsset('enable_orderreturn')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['orderreturn'] = Tools::getValue('enable_orderreturn');
                if (!Validate::isBool($eval_active['orderreturn'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }
         
            $eval_templates['orderreturn'] = array();
            $found_template = false;
            $field_name = $this->l('Order return template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_orderreturn_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['orderreturn'][$language_item['id_lang']] = Tools::getValue('template_orderreturn_'.$language_item['id_lang']);
                    if ($eval_templates['orderreturn'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            if (!$errors_found) {
                $events_array = array('newaccount', 'neworder', 'orderreturn');
                foreach ($events_array as $event_item) {
                    $event = LabsTemplate::getByNameLm('admin', $event_item);
                    $event->active = $eval_active[$event_item];
                    foreach ($eval_templates[$event_item] as $key_templates => $item_templates) {
                        $eval_templates[$event_item][$key_templates] = utf8_encode($item_templates);
                    }
                    $event->template = $eval_templates[$event_item];
                    $event->save();
                }

                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['smsadmin'].'&action=smsadmin');
                return;
            }
        } elseif (Tools::getIsset('submitSendtest')) {
            $username = \Configuration::get('LABSMOBILE_API_USERNAME');
            $default_sender = \Configuration::get('LABSMOBILE_DEFAULT_SENDER');
            $phone_admin = \Configuration::get('LABSMOBILE_ADMIN_PHONE');
            $res = (new LabsApiCmd)->sendMessage($phone_admin, $default_sender, $this->l('This is a test message from your LabsMobile SMS Prestashop module.'), 'p:prestashop-u:'.$username.'-h:testsms');
            if ($res === true) {
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['testsms'].'&action=smsadmin');
                return;
            } else {
                switch ($res) {
                    case "35":
                        $this->errors[] = $this->l('The account has no credits for this sending.');
                        break;
                    default:
                        $this->errors[] = $this->l('Error processing the sending operation.');
                        break;
                }
            }
        } else {
            $field_name = $this->l('Admin phone number');
            if (!Tools::getIsset('phone_admin')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_phone_admin = Tools::getValue('phone_admin');
                if (empty($p_phone_admin)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                } else {
                    if (!preg_match('/^[0-9()+-.\s]+$/', $p_phone_admin)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must have a phone number format.'), $field_name);
                    } else {
                        $p_phone_admin = LabsTools::filterPhone($p_phone_admin);
                        \Configuration::updateValue('LABSMOBILE_ADMIN_PHONE', $p_phone_admin);
                    }
                }
            }

            if (!$errors_found) {
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['confadmin'].'&action=smsadmin');
                return;
            }
        }
    }

    public function postProcessSmscustomer()
    {

        $errors_found = false;
        $languages = $this->getLanguages();
        $eval_active = $eval_templates = $eval_limit = array();

        if (Tools::getIsset('submitSmscustomerEvents')) {
            $field_name = $this->l('Birthday active');
            if (!Tools::getIsset('enable_birthday')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['birthday'] = Tools::getValue('enable_birthday');
                if (!Validate::isBool($eval_active['birthday'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $eval_templates['birthday'] = array();
            $found_template = false;
            $field_name = $this->l('Birthday template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_birthday_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['birthday'][$language_item['id_lang']] = Tools::getValue('template_birthday_'.$language_item['id_lang']);
                    if ($eval_templates['birthday'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            $field_name = $this->l('New order active');
            if (!Tools::getIsset('enable_neworder')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['neworder'] = Tools::getValue('enable_neworder');
                if (!Validate::isBool($eval_active['neworder'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $eval_templates['neworder'] = array();
            $found_template = false;
            $field_name = $this->l('New order template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_neworder_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['neworder'][$language_item['id_lang']] = Tools::getValue('template_neworder_'.$language_item['id_lang']);
                    if ($eval_templates['neworder'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            $field_name = $this->l('Order return active');
            if (!Tools::getIsset('enable_orderreturn')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['orderreturn'] = Tools::getValue('enable_orderreturn');
                if (!Validate::isBool($eval_active['orderreturn'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }
        
            $eval_templates['orderreturn'] = array();
            $found_template = false;
            $field_name = $this->l('Order return template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_orderreturn_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['orderreturn'][$language_item['id_lang']] = Tools::getValue('template_orderreturn_'.$language_item['id_lang']);
                    if ($eval_templates['orderreturn'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            $field_name = $this->l('Abandoned shopping cart active');
            if (!Tools::getIsset('enable_abandonedshoppingcart')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_active['abandonedshoppingcart'] = Tools::getValue('enable_abandonedshoppingcart');
                if (!Validate::isBool($eval_active['abandonedshoppingcart'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Abandoned shopping cart limit');
            if (!Tools::getIsset('limit_abandonedshoppingcart')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $eval_limit['abandonedshoppingcart'] = Tools::getValue('limit_abandonedshoppingcart');
                if (!Validate::isInt($eval_limit['abandonedshoppingcart'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                }
            }

            $eval_templates['abandonedshoppingcart'] = array();
            $found_template = false;
            $field_name = $this->l('Abandoned shopping cart template');
            foreach ($languages as $language_item) {
                if (!Tools::getIsset('template_abandonedshoppingcart_'.$language_item['id_lang'])) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_templates['abandonedshoppingcart'][$language_item['id_lang']] = Tools::getValue('template_abandonedshoppingcart_'.$language_item['id_lang']);
                    if ($eval_templates['abandonedshoppingcart'][$language_item['id_lang']]) {
                        $found_template = true;
                    }
                }
            }
            if (!$found_template) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }

            if (!$errors_found) {
                $events_array = array('birthday', 'neworder', 'orderreturn', 'abandonedshoppingcart');
                foreach ($events_array as $event_item) {
                    $event = LabsTemplate::getByNameLm('events', $event_item);
                    $event->active = $eval_active[$event_item];
                    if ($event_item == 'abandonedshoppingcart') {
                        $event->limit = $eval_limit[$event_item];
                    }
                    foreach ($eval_templates[$event_item] as $key_templates => $item_templates) {
                        $eval_templates[$event_item][$key_templates] = utf8_encode($item_templates);
                    }
                    $event->template = $eval_templates[$event_item];
                    $event->save();
                }

                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['smscustomerevents'].'&action=smscustomer');
                return;
            }
        } else {
            foreach (OrderState::getOrderStates($this->context->language->id) as $item_status) {
                $name_status = 'status'.$item_status['id_order_state'];

                $field_name = $item_status['name'].' '.$this->l('active');
                if (!Tools::getIsset('enable_'.$name_status)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $eval_active[$name_status] = Tools::getValue('enable_'.$name_status);
                    if (!Validate::isBool($eval_active[$name_status])) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                    }
                }

                $eval_templates[$name_status] = array();
                foreach ($languages as $language_item) {
                    $field_name = $item_status['name'].' '.$this->l('template') ." ".$language_item['iso_code'];
                    if (!Tools::getIsset('template_'.$name_status.'_'.$language_item['id_lang'])) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                    } else {
                        $eval_templates[$name_status][$language_item['id_lang']] = Tools::getValue('template_'.$name_status.'_'.$language_item['id_lang']);
                        if ($eval_active[$name_status] && !$eval_templates[$name_status][$language_item['id_lang']]) {
                            $errors_found = true;
                            $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                        }
                    }
                }
            }

            if (!$errors_found) {
                foreach ($eval_active as $eval_active_key => $eval_active_item) {
                    $event = LabsTemplate::getByNameLm('status', $eval_active_key);
                    $event->active = $eval_active_item;
                    foreach ($eval_templates[$eval_active_key] as $key_templates => $item_templates) {
                        $eval_templates[$eval_active_key][$key_templates] = utf8_encode($item_templates);
                    }
                    $event->template = $eval_templates[$eval_active_key];
                    $event->save();
                }

                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['smscustomerstatus'].'&action=smscustomer');
                return;
            }
        }
    }

    public function postProcessForgot()
    {
        $errors_found = false;

        $field_name = $this->l('E-mail');
        if (!Tools::getIsset('username')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_username = Tools::getValue('username');
            if (!$p_username) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            } else {
                if (!Validate::isEmail($p_username)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field has an invalid format.'), $field_name);
                }
            }
        }

        if (!$errors_found) {
            $res = (new LabsApiCmd)->forgot($p_username);
            if ($res === true) {
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['forgot'].'&action=login');
                return;
            } else {
                switch ($res) {
                    case 'requiredfields':
                        $this->errors[] = $this->l('Required fields not found.');
                        break;
                    case 'internalerror':
                        $this->errors[] = $this->l('Internal error.');
                        break;
                    case 'nousername':
                        $this->errors[] = $this->l('No account associated with this E-mail.');
                        break;
                }
            }
        }
    }

    public function postProcessAccount()
    {
        $errors_found = false;

        $field_name = $this->l('Name');
        if (!Tools::getIsset('name')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_name = Tools::getValue('name');
            if (!$p_name) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        $field_name = $this->l('Company');
        if (!Tools::getIsset('company')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_company = Tools::getValue('company');
            if (!$p_company) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        $field_name = $this->l('E-mail');
        if (!Tools::getIsset('email')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_email = Tools::getValue('email');
            $p_email = Tools::strtolower($p_email);
            if (!$p_email) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            } else {
                if (!Validate::isEmail($p_email)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field has an invalid format.'), $field_name);
                }
            }
        }

        $field_name = $this->l('Website');
        if (!Tools::getIsset('website')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_website = Tools::getValue('website');
            if (!$p_website) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            } else {
                if (!Validate::isAbsoluteUrl($p_website)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field has an invalid format.'), $field_name);
                }
            }
        }

        if (!Tools::getIsset('terms')) {
            $errors_found = true;
            $this->errors[] = $this->l('Please, accept the privacy and service terms.');
        }

        if (!$errors_found) {
            $country_iso = Country::getIsoById(\Configuration::get('PS_COUNTRY_DEFAULT'));
            $timezone = \Configuration::get('PS_TIMEZONE');
            $currency_obj = Currency::getDefaultCurrency();
            $currency_iso = $currency_obj->iso_code;
            $res = (new LabsApiCmd)->account($p_name, $p_company, $p_email, $p_website, $country_iso, $timezone, $currency_iso);
            if ($res === true) {
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['account'].'&action=login');
                return;
            } else {
                switch ($res) {
                    case 'requiredfields':
                        $this->errors[] = $this->l('Required fields not found.');
                        break;
                    case 'internalerror':
                        $this->errors[] = $this->l('Internal error.');
                        break;
                    case 'emailduplicated':
                        $this->errors[] = $this->l('This E-mail is already associated with an account. Please change the E-mail or reset your password and sign in.');
                        break;
                }
            }
        }
    }

    public function postProcessPurchase()
    {
        $errors_found = false;

        if (Tools::getIsset('submitRenew')) {
            $field_name = $this->l('Enable automatic top ups');
            if (!Tools::getIsset('renew_enable')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_enable = Tools::getValue('renew_enable');
                if (!Validate::isBool($p_enable)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            if ($p_enable) {
                $field_name = $this->l('Credit limit');
                if (!Tools::getIsset('renew_limit')) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $p_limit = Tools::getValue('renew_limit');
                    if (empty($p_limit)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                    } else {
                        if (!Validate::isInt($p_limit)) {
                            $errors_found = true;
                            $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                        }
                    }
                }

                $field_name = $this->l('Balance Warning');
                if (!Tools::getIsset('renew_credits')) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $p_credits = Tools::getValue('renew_credits');
                    if (empty($p_credits)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                    } else {
                        if (!Validate::isInt($p_credits)) {
                            $errors_found = true;
                            $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                        }
                    }
                }

                $field_name = $this->l('Max. purchases');
                if (!Tools::getIsset('renew_maxrecharges')) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $p_maxrecharges = Tools::getValue('renew_maxrecharges');
                    if (empty($p_maxrecharges)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                    } else {
                        if (!Validate::isInt($p_maxrecharges)) {
                            $errors_found = true;
                            $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                        }
                    }
                }

                $field_name = $this->l('Card');
                if (!Tools::getIsset('renew_card')) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
                } else {
                    $p_card = Tools::getValue('renew_card');
                }
            }

            if (!$errors_found) {
                $res = (new LabsApiCmd)->setRenew($p_enable, $p_limit, $p_credits, $p_maxrecharges, $p_card);
                if ($res === true) {
                    Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['renew'].'&action=purchase');
                    return;
                } else {
                    switch ($res) {
                        case 'requiredfields':
                            $this->errors[] = $this->l('Required fields not found.');
                            break;
                        case 'internalerror':
                            $this->errors[] = $this->l('Internal error.');
                            break;
                        case 'invalidauth':
                            $this->errors[] = $this->l('Invalid username and/or password.');
                            break;
                    }
                }
            }
        }
    }

    public function postProcessInvoicing()
    {
        $errors_found = false;

        if (Tools::getIsset('submitInvoicing')) {
            $field_name = $this->l('Company');
            if (!Tools::getIsset('company')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_company = Tools::getValue('company');
                if (empty($p_company)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Tax Id');
            if (!Tools::getIsset('taxid')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_taxid = Tools::getValue('taxid');
                if (empty($p_taxid)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Address');
            if (!Tools::getIsset('address')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_address = Tools::getValue('address');
                if (empty($p_address)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Zip Code');
            if (!Tools::getIsset('zipcode')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_zipcode = Tools::getValue('zipcode');
                if (empty($p_zipcode)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('City');
            if (!Tools::getIsset('city')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_city = Tools::getValue('city');
                if (empty($p_city)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Region');
            if (!Tools::getIsset('region')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_region = Tools::getValue('region');
                if (empty($p_region)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Country');
            if (!Tools::getIsset('country')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_country = Tools::getValue('country');
                if (empty($p_country)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s cannot be empty.'), $field_name);
                }
            }

            $field_name = $this->l('Administration Email');
            if (!Tools::getIsset('invoicing_email')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_invoicing_email = Tools::getValue('invoicing_email');
                if (empty($p_invoicing_email)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s cannot be empty.'), $field_name);
                } else {
                    if (!Validate::isEmail($p_invoicing_email)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be an email address value.'), $field_name);
                    }
                }
            }

            if (!$errors_found) {
                $res = (new LabsApiCmd)->setInvoicing($p_company, $p_taxid, $p_address, $p_zipcode, $p_city, $p_region, $p_country, $p_invoicing_email);
                if ($res === true) {
                    Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['invoicing'].'&action=invoicing');
                    return;
                } else {
                    switch ($res) {
                        case 'requiredfields':
                            $this->errors[] = $this->l('Required fields not found.');
                            break;
                        case 'internalerror':
                            $this->errors[] = $this->l('Internal error.');
                            break;
                        case 'invalidauth':
                            $this->errors[] = $this->l('Invalid username and/or password.');
                            break;
                    }
                }
            }
        }
    }

    public function postProcessSettings()
    {
        $errors_found = false;

        if (Tools::getIsset('submitSettings')) {
            $field_name = $this->l('Balance Warning');
            if (!Tools::getIsset('warning_limit')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_warning_limit = Tools::getValue('warning_limit');
                if (empty($p_warning_limit)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                } else {
                    if (!Validate::isInt($p_warning_limit)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                    }
                }
            }

            $field_name = $this->l('Balance Email');
            if (!Tools::getIsset('warning_email')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_warning_email = Tools::getValue('warning_email');
                if (empty($p_warning_email)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                } else {
                    if (!Validate::isEmail($p_warning_email)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be an email address value.'), $field_name);
                    }
                }
            }

            $field_name = $this->l('Newsletters and Promotions');
            if (!Tools::getIsset('newsletter_active')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_newsletter_active = Tools::getValue('newsletter_active');
                if (!Validate::isBool($p_newsletter_active)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Duplicated Filter');
            if (!Tools::getIsset('duplicated_filter')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_duplicated_filter = Tools::getValue('duplicated_filter');
                if (!Validate::isBool($p_duplicated_filter)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Max Daily Volume');
            if (!Tools::getIsset('max_daily')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_max_daily = Tools::getValue('max_daily');
                if (empty($p_max_daily)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                } else {
                    if (!Validate::isInt($p_max_daily)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                    }
                }
            }

            $field_name = $this->l('Max Batch Length');
            if (!Tools::getIsset('max_batch')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_max_batch = Tools::getValue('max_batch');
                if (empty($p_max_batch)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
                } else {
                    if (!Validate::isInt($p_max_batch)) {
                        $errors_found = true;
                        $this->errors[] = sprintf($this->l('The %s field must be a numeric value.'), $field_name);
                    }
                }
            }

            $field_name = $this->l('Send Unicode SMS');
            if (!Tools::getIsset('unicode_active')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_unicode_active = Tools::getValue('unicode_active');
                if (!Validate::isBool($p_unicode_active)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Use only mobile phone');
            if (!Tools::getIsset('onlymobile_active')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_onlymobile_active = Tools::getValue('onlymobile_active');
                if (!Validate::isBool($p_onlymobile_active)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Replace Links');
            if (!Tools::getIsset('replace_links')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_replace_links = Tools::getValue('replace_links');
                if (!Validate::isBool($p_replace_links)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field must be yes/no value.'), $field_name);
                }
            }

            $field_name = $this->l('Default Sender');
            if (!Tools::getIsset('default_sender')) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
            } else {
                $p_default_sender = Tools::getValue('default_sender');
                if (Tools::strlen($p_default_sender) > 11) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field value exceeds the maximum length.'), $field_name);
                }
                if (!preg_match('/^[a-zA-Z0-9_-]+$/', $p_default_sender)) {
                    $errors_found = true;
                    $this->errors[] = sprintf($this->l('The %s field value includes invalid characters.'), $field_name);
                }
            }

            if (!$errors_found) {
                $res = (new LabsApiCmd)->setSettings($p_warning_limit, $p_warning_email, $p_newsletter_active, $p_default_sender, $p_duplicated_filter, $p_max_daily, $p_max_batch, $p_unicode_active, $p_replace_links);
                if ($res === true) {
                    \Configuration::updateValue('LABSMOBILE_DEFAULT_SENDER', $p_default_sender);
                    \Configuration::updateValue('LABSMOBILE_SMSUNICODE', $p_unicode_active);
                    \Configuration::updateValue('LABSMOBILE_ONLY_MOBILE', $p_onlymobile_active);
                    Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['settings'].'&action=settings');
                    return;
                } else {
                    switch ($res) {
                        case 'requiredfields':
                            $this->errors[] = $this->l('Required fields not found.');
                            break;
                        case 'internalerror':
                            $this->errors[] = $this->l('Internal error.');
                            break;
                        case 'invalidauth':
                            $this->errors[] = $this->l('Invalid username and/or password.');
                            break;
                    }
                }
            }
        }
    }

    public function postProcessLogin()
    {
        $errors_found = false;
     
        $field_name = $this->l('Username');
        if (!Tools::getIsset('username')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_username = Tools::getValue('username');
            if (!$p_username) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        $field_name = $this->l('Password');
        if (!Tools::getIsset('password')) {
            $errors_found = true;
            $this->errors[] = sprintf($this->l('The %s field is required.'), $field_name);
        } else {
            $p_password = Tools::getValue('password');
            if (!$p_password) {
                $errors_found = true;
                $this->errors[] = sprintf($this->l('The %s field cannot be empty.'), $field_name);
            }
        }

        if (!$errors_found) {
            $res = (new LabsApiCmd)->authenticate($p_username, $p_password);
            if ($res === true) {
                $params_account = (new LabsApiCmd)->getSettings();
                \Configuration::updateValue('LABSMOBILE_DEFAULT_SENDER', $params_account->default_sender);
                \Configuration::updateValue('LABSMOBILE_SMSUNICODE', $params_account->unicode_active);
                if ($p_username != \Configuration::get('LABSMOBILE_CONNECTION_STATUS')) {
                    Db::getInstance()->execute('TRUNCATE TABLE `'._DB_PREFIX_.'lm_invoices`');
                }
                \Configuration::updateValue('LABSMOBILE_LAST_USERNAME', $p_username);
                Tools::redirectAdmin(self::$currentIndex.'&conf='.$this->confirmations_index['login'].'&action=dashboard');
                return;
            } else {
                switch ($res) {
                    case 'requiredfields':
                        $this->errors[] = $this->l('Required fields not found.');
                        break;
                    case 'internalerror':
                        $this->errors[] = $this->l('Internal error.');
                        break;
                    case 'invalidauth':
                        $this->errors[] = $this->l('Invalid username and/or password.');
                        break;
                }
            }
        }
    }

    public function postProcess()
    {
        $action = Tools::toCamelCase(Tools::getValue('action'), true);
        if (!empty($_POST)) {
            $functionPostProcess = 'postProcess'.$action;
            if (!empty($action) && method_exists($this, $functionPostProcess)) {
                $this->$functionPostProcess();
            }
        }
    }

    public function init()
    {

        parent::init();

        $action = Tools::toCamelCase(Tools::getValue('action'), true);
        $functionInit = 'init'.$action;
        if (!empty($action) && method_exists($this, $functionInit)) {
            $this->$functionInit();
        }
    }

    public function initLogout()
    {
        $this->module->new_user = true;
        \Configuration::updateValue('LABSMOBILE_CONNECTION_STATUS', 0);
        \Configuration::updateValue('LABSMOBILE_API_USERNAME', '');
        \Configuration::updateValue('LABSMOBILE_API_PASSWORD', '');
        Tools::redirectAdmin(self::$currentIndex.'&action=login');
    }
}
