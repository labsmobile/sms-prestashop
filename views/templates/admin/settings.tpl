{*
* 2007-2018 PrestaShop
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
*  @author     PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            {include file="./parts/menu.tpl"}
        </div>
        <div class="col-lg-9 col-md-9">
            <form id="lm_settings_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=settings" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-cogs"></i> {l s='Configuration parameters' mod='labsmobile'}</div>

                    <div class="form-wrapper">
                        <div class="form-group">
                            <div id="lm_settings_id_LM_WARNING_LIMIT">
                                <label class="control-label col-lg-3">{l s='Balance warning' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <div class="input-group">
                                        <input type="text" value="{$params_form->warning_limit|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="warning_limit">
                                        <span class="input-group-addon">{l s='credits' mod='labsmobile'}</span>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='You will receive and email notification when your account balance reaches this limit.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_WARNING_EMAIL">
                                <label class="control-label col-lg-3">{l s='Warning email' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->warning_email|escape:'htmlall':'UTF-8'}" class="form-control" name="warning_email">
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='Email address for notificacions and warnings.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_NEWSLETTER_ACTIVE">
                                <label class="control-label col-lg-3">{l s='Newsletters and promotions' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input name="newsletter_active" id="LM_NEWSLETTER_ACTIVE_on" value="1" {if $params_form->newsletter_active == 1}checked="checked"{/if} type="radio"><label for="LM_NEWSLETTER_ACTIVE_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                        <input name="newsletter_active" id="LM_NEWSLETTER_ACTIVE_off" value="0" {if $params_form->newsletter_active == 0}checked="checked"{/if} type="radio"><label for="LM_NEWSLETTER_ACTIVE_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='We can inform you about our special news and promotions.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_DEFAULT_SENDER">
                                <label class="control-label col-lg-3">{l s='Default sender' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->default_sender|escape:'htmlall':'UTF-8'}" class="form-control tpl_sender" maxlength="11" name="default_sender">
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='Max. size: 11 characters. The sender can only contain letters and numbers [a-zA-z0-9]. Only available in some countries that allow to customize the sender field.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div id="lm_settings_id_LM_DUPLICATED_FILTER">
                                <label class="control-label col-lg-3">{l s='Duplicated filter' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input name="duplicated_filter" id="LM_DUPLICATED_FILTER_on" value="1" {if $params_form->duplicated_filter == 1}checked="checked"{/if} type="radio"><label for="LM_DUPLICATED_FILTER_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                        <input name="duplicated_filter" id="LM_DUPLICATED_FILTER_off" value="0" {if $params_form->duplicated_filter == 0}checked="checked"{/if} type="radio"><label for="LM_DUPLICATED_FILTER_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='The sending platform can block duplicated messages: same text sent to the same mobile phones wihthin 60 minutes.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_MAX_DAILY">
                                <label class="control-label col-lg-3">{l s='Max. daily volume' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->max_daily|escape:'htmlall':'UTF-8'}" class="form-control" name="max_daily">
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='Your account can only spend this amount of credits per day.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_MAX_BATCH">
                                <label class="control-label col-lg-3">{l s='Max. batch length' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->max_batch|escape:'htmlall':'UTF-8'}" class="form-control" name="max_batch">
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='You can include this number of mobil phones in one sending operation.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_UNICODE_ACTIVE">
                                <label class="control-label col-lg-3">{l s='Send Unicode SMS' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input name="unicode_active" id="LM_UNICODE_ACTIVE_on" value="1" {if $params_form->unicode_active == 1}checked="checked"{/if} type="radio"><label for="LM_UNICODE_ACTIVE_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                        <input name="unicode_active" id="LM_UNICODE_ACTIVE_off" value="0" {if $params_form->unicode_active == 0}checked="checked"{/if} type="radio"><label for="LM_UNICODE_ACTIVE_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='Your messages can include any character, emoji or symbol. Unicode messages have a maximum capacity of 70 characters. Standard messages have a capacity of 160 characters but can contain only GSM characters:' mod='labsmobile'} ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789 @£¥èéùìòÇØøÅåΔΦΓΛΩΠΨΣΘΞÄÖÑÜ§äöñüà _^|{}[~]€ÆæßÉ!/\"#¤%&'()*+,-.|:;<=>?¿.</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_ONLY_MOBILE">
                                <label class="control-label col-lg-3">{l s='Use only mobile phone' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input name="onlymobile_active" id="LM_ONLY_MOBILE_on" value="1" {if $params_form->onlymobile_active == 1}checked="checked"{/if} type="radio"><label for="LM_ONLY_MOBILE_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                        <input name="onlymobile_active" id="LM_ONLY_MOBILE_off" value="0" {if $params_form->onlymobile_active == 0}checked="checked"{/if} type="radio"><label for="LM_ONLY_MOBILE_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='This module can use only the mobile phone field. Or otherwise use the phone field when the mobile phone field is empty.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_REPLACE_LINKS">
                                <label class="control-label col-lg-3">{l s='Replace links' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <span class="switch prestashop-switch fixed-width-lg">
                                        <input name="replace_links" id="LM_REPLACE_LINKS_on" value="1" {if $params_form->replace_links == 1}checked="checked"{/if} type="radio"><label for="LM_REPLACE_LINKS_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                        <input name="replace_links" id="LM_REPLACE_LINKS_off" value="0" {if $params_form->replace_links == 0}checked="checked"{/if} type="radio"><label for="LM_REPLACE_LINKS_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                        <a class="slide-button btn"></a>
                                    </span>
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='Any link included in your messages can be replaced by a lm0.eu/XXXXXXX link and then our platform can show click reports and statistics.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="panel-footer">
                        <button type="submit" value="1" id="lm_settings_form_submit_btn_save" name="submitSettings" class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> {l s='Save' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>