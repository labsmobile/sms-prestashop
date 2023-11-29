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
            <form target="_blank" class="form-horizontal" action="{$url_purchase|escape:'htmlall':'UTF-8'}?username={$username|escape:'url':'UTF-8'}&lang={$default_lang->iso_code|escape:'url'}&country_iso={$country_iso}&currency_iso={$currency_iso}" id="form_purchase" method="post">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-credit-card"></i> {l s='Credit card top ups' mod='labsmobile'}</div>
                    <div class="form-group">
                        <div>
                            <div class="col-lg-9 col-lg-offset-3"> 
                                <button type="submit" form="form_purchase" id="purchase" class="btn btn-default" name="purchase"><i class="icon-shopping-cart"></i> {l s='Purchase' mod='labsmobile'}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form id="lm_autom_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=purchase" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-magic"></i> {l s='Automatic top ups' mod='labsmobile'}</div>
                    
                    <div class="alert alert-info">
                        {l s='After your first purchase you can configure the automatic top ups to avoid get out of credits.' mod='labsmobile'}
                    </div>

                    <div class="form-group">
                        <div id="lm_settings_id_LM_AUTOM_ACTIVE">
                            <label class="control-label col-lg-3">{l s='Enable automatic top ups' mod='labsmobile'}</label>
                            <div class="col-lg-9">
                                <span class="switch prestashop-switch fixed-width-lg">
                                    <input {if $cards|@count eq 0}disabled{/if} name="renew_enable" id="LM_AUTOM_ACTIVE_on" value="1" {if $params_renew->renew_enable == 1}checked="checked"{/if} type="radio"><label for="LM_AUTOM_ACTIVE_on" class="radioCheck">{l s='Yes' mod='labsmobile'}</label>
                                    <input {if $cards|@count eq 0}disabled{/if} name="renew_enable" id="LM_AUTOM_ACTIVE_off" value="0" {if $params_renew->renew_enable == 0}checked="checked"{/if} type="radio"><label for="LM_AUTOM_ACTIVE_off" class="radioCheck">{l s='No' mod='labsmobile'}</label>
                                    <a class="slide-button btn"></a>
                                </span>
                            </div>
                            <div class="col-lg-9 col-lg-offset-3">
                                <div class="help-block">{l s='Enable and configure your automatic top ups.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_settings_id_LM_AUTOM_LIMIT">
                            <label class="control-label col-lg-3">{l s='Credit limit' mod='labsmobile'}</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input {if ($cards|@count eq 0) || ($params_renew->renew_enable == 0)}disabled{/if} type="text" value="{$params_renew->renew_limit|escape:'htmlall':'UTF-8'}" class="form-control" size="5" id="renew_limit" name="renew_limit">
                                    <span class="input-group-addon">{l s='credits' mod='labsmobile'}</span>
                                </div>
                            </div>
                            <div class="col-lg-9 col-lg-offset-3">
                                <div class="help-block">{l s='Each time your account reach this amount of credits a new top up will be created.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_settings_id_LM_AUTOM_CREDITS">
                            <label class="control-label col-lg-3">{l s='Credits to top up' mod='labsmobile'}</label>
                            <div class="col-lg-9">
                                <div class="input-group">
                                    <input {if ($cards|@count eq 0) || ($params_renew->renew_enable == 0)}disabled{/if} type="text" value="{$params_renew->renew_credits|escape:'htmlall':'UTF-8'}" class="form-control" size="5" id="renew_credits" name="renew_credits">
                                    <span class="input-group-addon">{l s='credits' mod='labsmobile'}</span>
                                </div>
                            </div>
                            <div class="col-lg-9 col-lg-offset-3">
                                <div class="help-block">{l s='Number f credits to add to your account for each automatic top up.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_settings_id_LM_AUTOM_MAX">
                            <label class="control-label col-lg-3">{l s='Max. purchases' mod='labsmobile'}</label>
                            <div class="col-lg-9">
                                <input {if ($cards|@count eq 0) || ($params_renew->renew_enable == 0)}disabled{/if} type="text" value="{$params_renew->renew_maxrecharges|escape:'htmlall':'UTF-8'}" class="form-control" id="renew_maxrecharges" name="renew_maxrecharges">
                            </div>
                            <div class="col-lg-9 col-lg-offset-3">
                                <div class="help-block">{l s='Maximum number of automatic purchases within 30 days.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_settings_id_LM_AUTOM_CARD">
                            <label class="control-label col-lg-3">{l s='Card' mod='labsmobile'}</label>
                            <div class="col-lg-9">
                                <select {if ($cards|@count eq 0) || ($params_renew->renew_enable == 0)}disabled{/if} class="chosen form-control" id="renew_card" name="renew_card">
                                {foreach from=$cards item=item_card}
                                    <option value="{$item_card->id|escape:'htmlall':'UTF-8'}">{$item_card->holder|escape:'htmlall':'UTF-8'} - **** **** **** {$item_card->lastnumbers|escape:'htmlall':'UTF-8'} - {$item_card->brand|escape:'htmlall':'UTF-8'} - {$item_card->exp_month|escape:'htmlall':'UTF-8'}/{$item_card->exp_year|escape:'htmlall':'UTF-8'}</option>
                                {/foreach}
                                </select>
                            </div>
                            <div class="col-lg-9 col-lg-offset-3">
                                <div class="help-block">{l s='Select the card to use in your automatic top ups.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" value="1" id="lm_autom_form_submit_btn_save" name="submitRenew" class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> {l s='Save' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>

            <form id="lm_transfer_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=purchase" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-bank"></i> {l s='Wire transfer top ups' mod='labsmobile'}</div>
                    
                    <div class="alert alert-info">
                        {l s='Here you have our bank details to top up with a wire transfer. You must include the reference as teh concept of the wire transfer to identify your account.' mod='labsmobile'}
                    </div>

                    <p>
                        <strong>{l s='Owner' mod='labsmobile'}</strong>
                        001TECH S.L.
                    </p>
                    <p>
                        <strong>{l s='Taxid' mod='labsmobile'}</strong>
                        ESB65213472
                    </p>
                    <p>
                        <strong>{l s='Address' mod='labsmobile'}</strong>
                        Calle Mateu Ferran 6, 08030 Barcelona (Spain)
                    </p>
                    <p>
                        <strong>{l s='Bank name' mod='labsmobile'}</strong>
                        Ing Direct Nv
                    </p>
                    <p>
                        <strong>{l s='Bank account number, IBAN' mod='labsmobile'}</strong>
                        ES48 1465 0150 5119 0026 2770
                    </p>
                    <p>
                        <strong>{l s='SWIFT / BIC Code' mod='labsmobile'}</strong>
                        INGDESMMXXX
                    </p>
                    <p>
                        <strong>{l s='Bank address' mod='labsmobile'}</strong>
                        Calle Severo Ochoa 2, 28230 Madrid (Spain)
                    </p>
                    <p>
                        <strong>{l s='Bank currency' mod='labsmobile'}</strong>
                        EUR
                    </p>
                    <p>
                        <strong>{l s='Reference' mod='labsmobile'}</strong>
                        <span class="badge">AC{$params_renew->reference|str_pad:5:"0":$smarty.const.STR_PAD_LEFT|escape:'htmlall':'UTF-8'}</span>
                        <span class="help-block">{l s='IMPORTANT: you must include this reference code in your wire transfer.' mod='labsmobile'}</span>
                    </p>
                    <p>
                        <strong>{l s='Notification email' mod='labsmobile'}</strong>
                        <a href="mailto:support@labsmobile.com?subject={l s='New bank transfer, ref:' mod='labsmobile'} AC{$params_renew->reference|str_pad:5:"0":$smarty.const.STR_PAD_LEFT|urlencode|escape:'htmlall':'UTF-8'}">support@labsmobile.com</a>
                        <span class="help-block">{l s='You can send us an email with a proof of the transfer to accelerate the process.' mod='labsmobile'}</span>
                    </p>
                    

                </div>
            </form>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    iFrameResize({log:false,checkOrigin:false,heightCalculationMethod:'bodyScroll'}, '#sizetracker');
    $(document).ready(function() {
        $('input[type=radio][name=renew_enable]').change(function() {
            if (this.value == '1') {
                $("#renew_limit").prop('disabled', false);
                $("#renew_credits").prop('disabled', false);
                $("#renew_maxrecharges").prop('disabled', false);
                $("#renew_card").prop('disabled', false).trigger("chosen:updated");;
            } else if (this.value == '0') {
                $("#renew_limit").prop('disabled', true);
                $("#renew_credits").prop('disabled', true);
                $("#renew_maxrecharges").prop('disabled', true);
                $("#renew_card").prop('disabled', 'disabled').trigger("chosen:updated");;
            }
        });
    });
</script>
{/literal}