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

class LabsFormRender extends \LabsMobile
{
    public function renderConfadmin()
    {
        $helper = new \HelperForm;
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->token = \Tools::getAdminTokenLite('AdminLabsmobile');
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;
        $helper->identifier = $this->identifier;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminLabsmobile', false).
            '&action='.Tools::getValue('action');
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
                        'title' => $this->l('Admin configuration', 'labsformrender'),
                        'icon'  => 'icon-mobile',
                    ),
                    'input'  => array(
                                    array(
                                        'type'     => 'text',
                                        'label'    => $this->l('Admin phone number', 'labsformrender'),
                                        'desc'     => $this->l('With country code and without any symbol or punctuation (Exp : 33655555555)', 'labsformrender'),
                                        'name'     => 'phone_admin',
                                        'required' => true,
                                    ),
                                ),
                    'submit' => array(
                        'title' => $this->l('Save', 'labsformrender'),
                        'name'  => 'submitConfadmin'
                    ),
                ),
            )
        ));

        return $helperHtml;
    }

    public function renderSmsadmin()
    {
        $helper = new \HelperForm;
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->token = \Tools::getAdminTokenLite('AdminLabsmobile');
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;
        $helper->identifier = 'labsmobile';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminLabsmobile', false).
            '&action='.Tools::getValue('action');
        $helper->submit_action = 'submitSmsadminForm';
        $helper->name_controller = 'col-lg-12';
        $fieldsValue = $this->getValuesSmsadmin();
        $helper->tpl_vars = array(
            'fields_value' => $fieldsValue,
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id,
        );

        $helperHtml = $helper->generateForm(array(
            array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('SMS to admin', 'labsformrender'),
                        'icon'  => 'icon-cog',
                    ),
                    'input'  => array(
                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('New account', 'labsformrender').":",
                                        'name'    => 'enable_newaccount',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_newaccount',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %EMAIL%.",
                                        'lang'      => true
                                    ),

                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('New Order', 'labsformrender').":",
                                        'name'    => 'enable_neworder',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_neworder',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%, %ORDERNUM%, %ORDERDATE%, %AMOUNT%.",
                                        'lang'      => true
                                    ),

                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('Order return', 'labsformrender').":",
                                        'name'    => 'enable_orderreturn',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_orderreturn',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ORDERNUM%, %ORDERDATE%, %PRODUCTCODES%.",
                                        'lang'      => true
                                    ),
                                ),
                    'submit' => array(
                        'title' => $this->l('Save', 'labsformrender'),
                        'name'  => 'submitSmsadmin',
                    ),
                ),
            )
        ));

        return $helperHtml;
    }

    public function renderSmscustomerEvents()
    {
        $helper = new \HelperForm;
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->token = \Tools::getAdminTokenLite('AdminLabsmobile');
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;
        $helper->identifier = 'labsmobile';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminLabsmobile', false).
            '&action='.Tools::getValue('action');
        $helper->submit_action = 'submitSmscustomerEventsForm';
        $helper->name_controller = 'col-lg-12';
        $fieldsValue = $this->getValuesSmscustomerEvents();
        $helper->tpl_vars = array(
            'fields_value' => $fieldsValue,
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id,
        );
        $helperHtml = $helper->generateForm(array(
            array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('SMS to customers by event', 'labsformrender'),
                        'icon'  => 'icon-cog',
                    ),
                    'input'  => array(
                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('Birthday', 'labsformrender').":",
                                        'name'    => 'enable_birthday',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_birthday',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%."." ".
                                                       $this->l('To send Birthday greeting messages you must add a "Cron Task" to load the following URL once a day at the time you would like:').
                                                       " <strong>".$this->context->link->getModuleLink($this->name, 'sendsmsbirthdays')."?secure_key=".md5(_COOKIE_KEY_.Configuration::get('PS_SHOP_NAME'))."</strong>",
                                        'lang'      => true
                                    ),

                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('New Order', 'labsformrender').":",
                                        'name'    => 'enable_neworder',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_neworder',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%, %ORDERNUM%, %ORDERDATE%, %AMOUNT%.",
                                        'lang'      => true
                                    ),

                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('Order return', 'labsformrender').":",
                                        'name'    => 'enable_orderreturn',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_orderreturn',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ORDERNUM%, %ORDERDATE%, %PRODUCTCODES%.",
                                        'lang'      => true
                                    ),

                                    array(
                                        'type'    => 'switch',
                                        'label'   => $this->l('Abandoned shopping cart', 'labsformrender').":",
                                        'name'    => 'enable_abandonedshoppingcart',
                                        'class'   => 'emo_sms tpl_sms',
                                        'is_bool' => true,
                                        'values'  => array(
                                            array(
                                                'id'    => 'active_on',
                                                'value' => 1,
                                                'label' => $this->l('Enabled', 'labsformrender'),
                                            ),
                                            array(
                                                'id'    => 'active_off',
                                                'value' => 0,
                                                'label' => $this->l('Disabled', 'labsformrender'),
                                            ),
                                        ),
                                    ),
                                    array(
                                        'type'   => 'text',
                                        'label'  => '',
                                        'name'   => 'limit_abandonedshoppingcart',
                                        'desc'   => $this->l('Delay after abandon shopping cart', 'labsformrender'),
                                        'suffix' => $this->l('hour(s)', 'labsformrender'),
                                        'col'    => '6',
                                    ),
                                    array(
                                        'type'      => 'textarea',
                                        'label'     => '',
                                        'col'       => '7',
                                        'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%.",
                                        'class'     => 'emo_sms tpl_sms',
                                        'name'      => 'template_abandonedshoppingcart',
                                        'lang'      => true
                                    ),
                                ),
                    'submit' => array(
                        'title' => $this->l('Save', 'labsformrender'),
                        'name'  => 'submitSmscustomerEvents',
                    ),
                ),
            )
        ));

        return $helperHtml;
    }

    public function getValuesSmscustomerEvents()
    {

        $languages = \Language::getLanguages(false);

        $events = LabsTemplate::getAllLm('events');
        if (sizeof($events) < 5) {
            $events_array = array('birthday', 'neworder', 'orderreturn', 'abandonedshoppingcart');
            $default_content = array(
                'birthday' => $this->l('Happy birthday! We would like to offer you a special discount.', 'labsformrender'),
                'neworder' => $this->l('We have received your order successfully and it has been validated!', 'labsformrender'),
                'orderreturn' => $this->l('We have initiated the process of returning your order and the refund of the associated amount.', 'labsformrender'),
                'abandonedshoppingcart' => $this->l('Hello, your basket is still available. You still have a few hours left to finalise your order.', 'labsformrender'),
            );
            $default_content_lang = array(
                'birthday' => array(
                    'ag' => '¡Feliz cumpleaños! Pensamos en ti y nos gustaria ofrecerte un descuento especial.',
                    'br' => 'Feliz Aniversário! Gostariamos de oferecer um disconto a voce neste dia especial.',
                    'ca' => 'Per molts anys! Ens agradaria oferir-te un descompte especial.',
                    'cs' => 'Všechno nejlepší! Chtěli bychom vám nabídnout slevu k vašemu výjimečnému dni.',
                    'de' => 'Herzlichen Glückwunsch zum Geburtstag! An diesem ganz besonderen Tag möchten wir Ihnen einen Rabatt anbieten.',
                    'en' => 'Happy Birthday! We would like to offer you a discount on your special day.',
                    'es' => '¡Feliz cumpleaños! Pensamos en ti y nos gustaria ofrecerte un descuento especial.',
                    'fr' => 'Bon anniversaire! Nous aimerions vous offrir un rabais dans votre journée spéciale.',
                    'gb' => 'Happy Birthday! We would like to offer you a discount on your special day.',
                    'it' => 'Buon compleanno! Vogliamo offrirti uno sconto per questo giorno speciale.',
                    'mx' => '¡Feliz cumpleaños! Pensamos en ti y nos gustaria ofrecerte un descuento especial.',
                    'pl' => 'Wszystkiego najlepszego z okazji urodzin! W tym wyjątkowym dniu chcielibyśmy zaoferować ci zniżkę.',
                    'pt' => 'Feliz Aniversario! Gostariamos de lhe oferecer um desconto no seu dia especial.',
                ),
                'neworder' => array(
                    'ag' => '¡Hemos recibido su pedido con exito y ha sido validado!',
                    'br' => 'Sua compra foi realizada com sucesso! Seu pedido esta sendo processado.',
                    'ca' => 'Hem rebut la teva comanda amb exit i ha estat validada!',
                    'cs' => 'Váš nákup byl úspěšně dokončen! Vaše objednávka se nyní zpracovává.',
                    'de' => 'Ihr Kauf wurde erfolgreich abgeschlossen und Ihre Bestellung wird jetzt bearbeitet.',
                    'en' => 'Your purchase was completed with success! Your order is now in process.',
                    'es' => '¡Hemos recibido su pedido con exito y ha sido validado!',
                    'fr' => 'Votre achat a ete complete avec succes ! Votre commande est en cours.',
                    'gb' => 'Your purchase was completed with success! Your order is now in process.',
                    'it' => 'Procedura di acquisto completata! L\\\'ordine e in fase di elaborazione.',
                    'mx' => '¡Hemos recibido su pedido con exito y ha sido validado!',
                    'pl' => 'Twoje zamówienie zostało z powodzeniem zakończone! Twoje zamówienie jest teraz realizowane.',
                    'pt' => 'A sua compra foi concluida com sucesso! A sua encomenda esta agora a ser processada.',
                ),
                'orderreturn' => array(
                    'ag' => 'Hemos iniciado el proceso de devolucion de tu pedido y la devolucion del importe asociado.',
                    'br' => 'Seu pedido para um reembolso foi recebido. A quantia retornara para sua conta bancaria em 05 dias uteis.',
                    'ca' => 'Hem iniciat el procés de devolucio de la teva comanda i el reemborsament de la quantitat associada.',
                    'cs' => 'Vaše žádost o vrácení peněz byla vystavena. Částka bude přičtena na váš bankovní účet během 5 pracovních dnů.',
                    'de' => 'Wir haben Ihre Anfrage bezüglich einer Rückerstattung erhalten. Der Betrag wird innerhalb von 5 Werktagen zurück auf Ihr Konto überwiesen.',
                    'en' => 'Your request for a refund has been issued. The sum will be returned to your bank account within 5 business days.',
                    'es' => 'Hemos iniciado el proceso de devolucion de tu pedido y la devolucion del importe asociado.',
                    'fr' => 'Votre demande de remboursement a ete emise. Le montant sera rembourse sur votre compte bancaire dans les cinq jours ouvrables.',
                    'gb' => 'Your request for a refund has been issued. The sum will be returned to your bank account within 5 business days.',
                    'it' => 'La richiesta di rimborso e stata inviata. La somma verra accreditata sul tuo conto bancario entro 5 giorni lavorativi.',
                    'mx' => 'Hemos iniciado el proceso de devolucion de tu pedido y la devolucion del importe asociado.',
                    'pl' => 'Twoje zgłoszenie o zwrot pieniędzy zostało przyjęte. Suma zostanie zwrócona na twoje konto bankowe w ciągu 5 dni roboczych.',
                    'pt' => 'O seu pedido de reembolso foi emitido. O valor sera devolvido para a sua conta bancaria dentro de 5 dias uteis.',
                ),
                'abandonedshoppingcart' => array(
                    'ag' => 'Hola, tu pedido todavia esta disponible. Aun te quedan unas pocas horas para finalizar tu pedido.',
                    'br' => 'Ola! Você tem item(ns) em sua cesta, e apenas algumas horas para completar o seu pedido.',
                    'ca' => 'Hola, la teva cistella encara esta disponible. Tot i et queden unes poques hores per finalitzar la teva comanda.',
                    'cs' => 'Dobrý den! Máte položku/y ve svém košíku a jen pár hodin k dokončení objednávky.',
                    'de' => 'Hallo! Sie haben einen oder mehrere Artikel im Warenkorb und nur wenige Stunden Zeit, um Ihre Bestellung abzuschließen.',
                    'en' => 'Hello! You\\\'ve got item(s) in your basket, and just a few hours to complete your order.',
                    'es' => 'Hola, tu pedido todavia esta disponible. Aun te quedan unas pocas horas para finalizar tu pedido.',
                    'fr' => 'Salut! Vous avez un article/des articles dans votre panier et quelques heures pour completer votre commande.',
                    'gb' => 'Hello! You\\\'ve got item(s) in your basket, and just a few hours to complete your order.',
                    'it' => 'Ciao! Hai degli articoli nel tuo cestino e solo poche ore per completare l\\\'ordine.',
                    'mx' => 'Hola, tu pedido todavia esta disponible. Aún te quedan unas pocas horas para finalizar tu pedido.',
                    'pl' => 'Witaj! Masz przedmiot(y) w swoim koszyku i tylko kilka godzin, aby dokończyć swoje zamówienie.',
                    'pt' => 'Ola! Tem um item no seu carrinh, e apenas algumas horas para concluir a sua encomenda.',
                ),
            );
            foreach ($events_array as $events_item) {
                if (!isset($events[$events_item])) {
                    \Db::getInstance()->insert('lm_templates', array(
                        'name' => pSQL($events_item),
                        'type' => pSQL('events'),
                        'limit' => (int)($events_item == 'abandonedshoppingcart'?3:0),
                        'active' => (int) 0,
                    ));
                    $id_new_event = \Db::getInstance()->Insert_ID();
         
                    foreach ($languages as $language_item) {
                        \Db::getInstance()->insert('lm_templates_lang', array(
                            'id_template' => (int) $id_new_event,
                            'id_lang' => (int) $language_item['id_lang'],
                            'template' => pSQL(isset($default_content_lang[$events_item][$language_item['iso_code']])?
                                $default_content_lang[$events_item][$language_item['iso_code']]:
                                $default_content[$events_item])
                        ));
                    }
                }
            }
            $events = LabsTemplate::getAllLm('events');
        }
        $valuesArray  = array();
        if (!empty($_POST)) {
            foreach ($_POST as $post_item_key => $post_item_value) {
                $token_item = explode("_", $post_item_key);
                if ($token_item[0] == "enable") {
                    $valuesArray['enable_' . $token_item[1]] = (int) $post_item_value;
                } elseif ($token_item[0] == "template") {
                    $valuesArray['template_' . $token_item[1]][(int) $token_item[2]] = $post_item_value;
                } elseif ($token_item[0] == "limit") {
                    $valuesArray['limit_' . $token_item[1]] = $post_item_value;
                }
            }
        } else {
            foreach ($events as $event_item) {
                $valuesArray['enable_' . $event_item->name] = (int) $event_item->active;
                $valuesArray['limit_' . $event_item->name] = (int) $event_item->limit;
                foreach ($languages as $lang) {
                    $valuesArray['template_' . $event_item->name][(int) $lang['id_lang']] = $event_item->template[(int) $lang['id_lang']];
                }
            }
        }
        return $valuesArray;
    }

    public function getValuesConfadmin()
    {

        $valuesArray  = array();

        if (!empty($_POST) && Tools::getIsset('submitConfadmin')) {
            $phone_admin_value = Tools::getValue('phone_admin');
        } else {
            $phone_admin_value = \Configuration::get('LABSMOBILE_ADMIN_PHONE');
        }

        $valuesArray['phone_admin'] = $phone_admin_value;

        return $valuesArray;
    }

    public function getValuesSmsadmin()
    {

        $languages = \Language::getLanguages(false);

        $events = LabsTemplate::getAllLm('admin');
        if (sizeof($events) < 3) {
            $events_array = array('newaccount', 'neworder', 'orderreturn');
            $default_content = array(
                'newaccount' => $this->l('A new account has sign up in your ecommerce: %EMAIL%.', 'labsformrender'),
                'neworder' => $this->l('You have a new order %ORDERNUM% of %AMOUNT% to %CITY% (%COUNTRY%), user %EMAIL%.', 'labsformrender'),
                'orderreturn' => $this->l('The customer %EMAIL% has demand an order return %ORDERNUM%.', 'labsformrender')
            );
            $default_content_lang = array(
                'newaccount' => array(
                    'ag' => 'Una cuenta nueva se ha registrado en su ecommerce: %EMAIL%.',
                    'br' => 'Uma nova conta registrou-se em sua loja online: %EMAIL%',
                    'ca' => 'Un nou compte s\\\'ha registrat a la botiga en línia: %EMAIL%.',
                    'cs' => 'Do vašeho e-shopu se zaregistroval nový uživatel: %EMAIL%',
                    'de' => 'In Ihrem Onlineshop wurde ein neues Konto registriert: %EMAIL%',
                    'en' => 'A new account has registered with your online shop: %EMAIL%',
                    'es' => 'Una cuenta nueva se ha registrado en su ecommerce: %EMAIL%.',
                    'fr' => 'Un nouveau compte a été enregistré avec votre boutique en ligne : %EMAIL%',
                    'gb' => 'A new account has registered with your online shop: %EMAIL%',
                    'it' => 'Sul tuo negozio online è stato registrato un nuovo account: %EMAIL%',
                    'mx' => 'Una cuenta nueva se ha registrado en su ecommerce: %EMAIL%.',
                    'pl' => 'Nowe konto zostało zarejestrowane za pomocą twojego sklepu internetowego: %EMAIL%',
                    'pt' => 'Uma conta nova registou-se na sua loja online: %EMAIL%',
                ),
                'neworder' => array(
                    'ag' => 'Has recibido un nuevo pedido %ORDERNUM% de %AMOUNT% en %CITY% (%COUNTRY%), usuario %EMAIL%.',
                    'br' => 'Você tem um novo pedido %ORDERNUM% de %AMOUNT% para %CITY% (%COUNTRY%), usuário %EMAIL%.',
                    'ca' => 'Tens una nova comanda %ORDERNUM% de %AMOUNT% de %CITY% (%COUNTRY%), de l\\\'usuari %EMAIL%.',
                    'cs' => 'Máte novou objednávku %ORDERNUM%, čítající %AMOUNT% položek do %CITY% (%COUNTRY%), uživatel %EMAIL%',
                    'de' => 'Sie haben eine neue Bestellung: Nr. %ORDERNUM% über %AMOUNT% nach %CITY% (%COUNTRY%), von Benutzer %EMAIL%.',
                    'en' => 'You have a new order %ORDERNUM% of %AMOUNT% to %CITY% (%COUNTRY%), user %EMAIL%.',
                    'es' => 'Has recibido un nuevo pedido %ORDERNUM% de %AMOUNT% en %CITY% (%COUNTRY%), usuario %EMAIL%.',
                    'fr' => 'Vous avez une nouvelle commande %ORDERNUM% de %AMOUNT% à %CITY% (%COUNTRY%), utilisateur %EMAIL%.',
                    'gb' => 'You have a new order %ORDERNUM% of %AMOUNT% to %CITY% (%COUNTRY%), user %EMAIL%.',
                    'it' => 'Hai un nuovo ordine %ORDERNUM% da %AMOUNT% per %CITY% (%COUNTRY%), utente %EMAIL%.',
                    'mx' => 'Has recibido un nuevo pedido %ORDERNUM% de %AMOUNT% en %CITY% (%COUNTRY%), usuario %EMAIL%.',
                    'pl' => 'Masz nowe zamówienie %ORDERNUM% na %AMOUNT% do %CITY% (%COUNTRY%), użytkownik %EMAIL%.',
                    'pt' => 'Tem uma nova encomenda %ORDERNUM% de %AMOUNT% para %CITY% (%COUNTRY%), utilizador %EMAIL%.',
                ),
                'orderreturn' => array(
                    'ag' => 'El cliente %EMAIL% ha pedido una devolución del pedido %ORDERNUM%.',
                    'br' => 'O cliente %EMAIL% pediu um reembolso.',
                    'ca' => 'El client %EMAIL% ha iniciat la devolució de la comanda %ORDERNUM%.',
                    'cs' => 'Zákazník %EMAIL% zažádal o vrácení peněz.',
                    'de' => 'Der Kunde %EMAIL% hat eine Rückerstattung beantragt.',
                    'en' => 'The customer %EMAIL% has requested a refund, order %ORDERNUM%.',
                    'es' => 'El cliente %EMAIL% ha pedido una devolución del pedido %ORDERNUM%.',
                    'fr' => 'Le client %EMAIL% a demandé un remboursement.',
                    'gb' => 'The customer %EMAIL% has requested a refund, order %ORDERNUM%.',
                    'it' => 'Il cliente %EMAIL% ha fatto richiesta di rimborso.',
                    'mx' => 'El cliente %EMAIL% ha pedido una devolución del pedido %ORDERNUM%.',
                    'pl' => 'Klient %EMAIL% zażądał zwrotu pieniędzy.',
                    'pt' => 'O cliente %EMAIL% solicitou um reembolso.',
                )
            );
            foreach ($events_array as $events_item) {
                if (!isset($events[$events_item])) {
                    \Db::getInstance()->insert('lm_templates', array(
                        'name' => pSQL($events_item),
                        'type' => pSQL('admin'),
                        'limit' => (int) 0,
                        'active' => (int) 0,
                    ));
                    $id_new_event = \Db::getInstance()->Insert_ID();
         
                    foreach ($languages as $language_item) {
                        \Db::getInstance()->insert('lm_templates_lang', array(
                            'id_template' => (int) $id_new_event,
                            'id_lang' => (int) $language_item['id_lang'],
                            'template' => pSQL(isset($default_content_lang[$events_item][$language_item['iso_code']])?
                                $default_content_lang[$events_item][$language_item['iso_code']]:
                                $default_content[$events_item])
                        ));
                    }
                }
            }
            $events = LabsTemplate::getAllLm('admin');
        }
        $valuesArray  = array();
        if (!empty($_POST)) {
            foreach ($_POST as $post_item_key => $post_item_value) {
                $token_item = explode("_", $post_item_key);
                if ($token_item[0] == "enable") {
                    $valuesArray['enable_' . $token_item[1]] = (int) $post_item_value;
                } elseif ($token_item[0] == "template") {
                    $valuesArray['template_' . $token_item[1]][(int) $token_item[2]] = $post_item_value;
                }
            }
        } else {
            foreach ($events as $event_item) {
                $valuesArray['enable_' . $event_item->name] = (int) $event_item->active;
                $valuesArray['limit_' . $event_item->name] = (int) $event_item->limit;
                foreach ($languages as $lang) {
                    $valuesArray['template_' . $event_item->name][(int) $lang['id_lang']] = $event_item->template[(int) $lang['id_lang']];
                }
            }
        }
        return $valuesArray;
    }

    public function renderSmscustomerStatus()
    {
        $helper = new \HelperForm;
        $helper->module = $this;
        $helper->show_toolbar = false;
        $helper->token = \Tools::getAdminTokenLite('AdminLabsmobile');
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = $this->context->language->id;
        $helper->identifier = 'labsmobile';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminLabsmobile', false).
            '&action='.Tools::getValue('action');
        $helper->submit_action = 'submitSmscustomerStatusForm';
        $helper->name_controller = 'col-lg-12';
        $fieldsValue = $this->getValuesSmscustomerStatus();
        $helper->tpl_vars = array(
            'fields_value' => $fieldsValue,
            'languages'    => $this->context->controller->getLanguages(),
            'id_language'  => $this->context->language->id,
        );

        $inputs = array();
        foreach (OrderState::getOrderStates($this->context->language->id) as $item_status) {
            $inputs = array_merge($inputs, array(
                array(
                'type'    => 'switch',
                'label'   => $item_status['name'],
                'name'    => 'enable_status'.$item_status['id_order_state'],
                'class'   => 'emo_sms tpl_sms',
                'is_bool' => true,
                'values'  => array(
                    array(
                        'id'    => 'active_on',
                        'value' => 1,
                        'label' => $this->l('Enabled', 'labsformrender'),
                    ),
                    array(
                        'id'    => 'active_off',
                        'value' => 0,
                        'label' => $this->l('Disabled', 'labsformrender'),
                    ),
                ),
            ),
            array(
                'type'      => 'textarea',
                'label'     => '',
                'class'     => 'emo_sms tpl_sms',
                'name'      => 'template_status'.$item_status['id_order_state'],
                'col'       => '7',
                'desc'      => $this->l('You can use these variables:', 'labsformrender')." %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%, %ORDERNUM%, %ORDERDATE%, %SHIPPINGNUMBER%, %AMOUNT%.",
                'lang'      => true
            )));
        }

        $helperHtml = $helper->generateForm(array(
            array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('SMS tu customers by order status', 'labsformrender'),
                        'icon'  => 'icon-cog',
                    ),
                    'input'  => $inputs,
                    'submit' => array(
                        'title' => $this->l('Save', 'labsformrender'),
                        'name'  => 'submitSmscustomerStatus',
                    ),
                ),
            )
        ));

        return $helperHtml;
    }

    public function getValuesSmscustomerStatus()
    {

        $languages = \Language::getLanguages(false);

        $status = OrderState::getOrderStates($this->context->language->id);
        $templates = LabsTemplate::getAllLm('status');
        $default_content = array(
            'payment' => $this->l('Hi %FIRSTNAME%, the payment (%AMOUNT%) of your order %ORDERNUM% has been completed and we begin the preparation.', 'labsformrender'),
            'shipped' => $this->l('Hi %FIRSTNAME%, your order %ORDERNUM% has been sent to the delivery address. Access your account to follow the shipment until delivery.', 'labsformrender'),
            'order_canceled' => $this->l('Hi %FIRSTNAME%, your order %ORDERNUM% has been canceled, please contact us for more information.', 'labsformrender'),
        );
        $other_status = $this->l('Hi %FIRSTNAME%, your order %ORDERNUM% has changed status. Access your account to know all the details.', 'labsformrender');
        $default_content_lang = array(
            'payment' => array(
                'es' => 'Hola %FIRSTNAME%, se ha completado el pago (%AMOUNT%) de tu pedido %ORDERNUM% e iniciamos su preparacion.',
            ),
            'shipped' => array(
                'es' => 'Hola %FIRSTNAME%, Tu pedido %ORDERNUM% ha sido enviado a la direccion de entrega. Accede a tu cuenta para seguir el envio hasta su entrega.',
            ),
            'order_canceled' => array(
                'es' => 'Hola %FIRSTNAME%, Tu pedido %ORDERNUM% ha sido cancelado, ponte en contacto connosotros para obtener más informacion.',
            ),
        );
        $other_status_lang = array(
            'es' => 'Hola %FIRSTNAME%, Tu pedido %ORDERNUM% ha cambiado de estado. Accede a tu cuenta para conocer todos los detalles.',
        );

        foreach ($status as $status_item) {
            if (!isset($templates['status'.$status_item['id_order_state']])) {
                \Db::getInstance()->insert('lm_templates', array(
                    'name' => pSQL('status'.$status_item['id_order_state']),
                    'limit' => (int) 0,
                    'type' => pSQL('status'),
                    'active' => (int) 0,
                ));

                $id_new_template = \Db::getInstance()->Insert_ID();
                foreach ($languages as $language_item) {
                    \Db::getInstance()->insert('lm_templates_lang', array(
                        'id_template' => (int) $id_new_template,
                        'id_lang' => (int) $language_item['id_lang'],
                        'template' => pSQL((isset($default_content[$status_item['template']]) && !empty($status_item['template']))?
                            (isset($default_content_lang[$status_item['template']][$language_item['iso_code']])?
                            $default_content_lang[$status_item['template']][$language_item['iso_code']]:
                            $default_content[$status_item['template']]):
                            (isset($other_status_lang[$language_item['iso_code']])?
                            $other_status_lang[$language_item['iso_code']]:
                            $other_status))
                    ));
                }
            }
        }

        $templates = LabsTemplate::getAllLm('status');

        $valuesArray  = array();
        foreach ($templates as $templates_item) {
            $valuesArray['enable_' . $templates_item->name] = (int) $templates_item->active;
            foreach ($languages as $lang) {
                $valuesArray['template_' . $templates_item->name][(int) $lang['id_lang']] = $templates_item->template[(int) $lang['id_lang']];
            }
        }
        return $valuesArray;
    }
}
