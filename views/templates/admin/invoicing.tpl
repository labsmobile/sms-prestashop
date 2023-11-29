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
            <form id="lm_invoicing_form" name="lm_invoicing_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=invoicing" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-building"></i> {l s='Invoicing details' mod='labsmobile'}</div>

                    <div class="form-wrapper">
                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_COMPANY">
                                <label class="control-label col-lg-3">{l s='Company name' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->company|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="company">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_TAXID">
                                <label class="control-label col-lg-3">{l s='Tax id' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->taxid|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="taxid">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_ADDRESS">
                                <label class="control-label col-lg-3">{l s='Address' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->address|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="address">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_ZIP">
                                <label class="control-label col-lg-3">{l s='Zip code' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->zipcode|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="zipcode">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_CITY">
                                <label class="control-label col-lg-3">{l s='City' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->city|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="city">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_REGION">
                                <label class="control-label col-lg-3">{l s='Region' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->region|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="region">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_COUNTRY">
                                <label class="control-label col-lg-3">{l s='Country' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <select id="country" class="chosen form-control" name="country">
									{foreach from=$list_countries item=item_country}
										<option value="{$item_country['iso_code']|escape:'htmlall':'UTF-8'}"{if isset($params_form->country) && $params_form->country == $item_country['iso_code']} selected="selected" {/if}>{$item_country['name']|escape:'htmlall':'UTF-8'}</option>
									{/foreach}
									</select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_settings_id_LM_INVOICING_EMAIL">
                                <label class="control-label col-lg-3">{l s='Administration email' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form->invoicing_email|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="invoicing_email">
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='You will receive a messate to this email address when a new invoice is created. LabsMobile issues the invoices the first working day of the following month of the purchase.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" value="1" id="lm_settings_form_submit_btn_save" name="submitInvoicing" class="btn btn-default pull-right">
                            <i class="process-icon-save"></i> {l s='Save' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>

            <a name="lm_invoices"></a>
            {$invoicesList|escape:'html':'UTF-8'|htmlspecialchars_decode:3}
            {foreach from=$invoices item=item_invoice}
                <form name="t{$item_invoice['invoice_ref']|escape:'htmlall':'UTF-8'}" action="https://ivc.labsmobile.com/api/api_invoice.php" target="_blank" method="post">
                    <input type="hidden" name="phpbmsusername" value="api_user">
                    <input type="hidden" name="phpbmspassword" value="api_password">
                    <input type="hidden" name="language" value="es">
                    <input type="hidden" name="company" value="sl">
                    <input type="hidden" name="invoice_id" value="{$item_invoice['invoice_ref']|escape:'htmlall':'UTF-8'}">
                </form>
            {/foreach}
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $('.panel-heading-action').hide();
        $('#form-lm_invoices').attr('action',$('#form-lm_invoices').attr('action').replace('#lm_invoices','&action=invoicing#lm_invoices'));
        $('table.lm_invoices tr.nodrop a').each(function(index) {
            $(this).attr('href',$(this).attr('href').replace('&token','&action=invoicing&token'));
            $(this).attr('href',$(this).attr('href')+'#lm_invoices');
        });
        $(document).on('click', 'button[name=submitResetlm_invoices]', function(){
            $('tr.filter input').val('');
        });
    });
</script>
{/literal}
