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
            <form id="lm_templates_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=templatesnew" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-edit"></i> {l s='New template' mod='labsmobile'}</div>

                    <div class="form-wrapper">
                        <div class="form-group">
                            <div id="lm_newtemplate_NAME">
                                <label class="control-label col-lg-3">{l s='Name' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form['name']|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_newtemplate_TEXT">
                                <label class="control-label col-lg-3">{l s='Text' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    {foreach from=$languages item=item_language}
                                        <div class="form-group translatable-field lang-{$item_language['id_lang']|escape:'htmlall':'UTF-8'}">
                                            <div class="col-lg-9">
                                                <textarea name="text_lang_{$item_language['id_lang']|escape:'htmlall':'UTF-8'}" id="text_lang_{$item_language['id_lang']|escape:'htmlall':'UTF-8'}" class="textarea-autosize emo_sms tpl_sms" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;">{$params_form['text_lang'][$item_language['id_lang']]|escape:'htmlall':'UTF-8'}</textarea>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">{$item_language['iso_code']|escape:'htmlall':'UTF-8'} <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    {foreach from=$languages item=item_language_aux}
                                                        <li><a href="javascript:hideOtherLanguage({$item_language_aux['id_lang']|escape:'htmlall':'UTF-8'});" tabindex="-1">{$item_language_aux['name']|escape:'htmlall':'UTF-8'}</a></li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        </div>
                                    {/foreach}
                                </div>
                                <div class="col-lg-9 col-lg-offset-3">
                                    <div class="help-block">{l s='These are the characters allowed in a standard SMS message:' mod='labsmobile'} ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789 @£¥èéùìòÇØøÅåΔΦΓΛΩΠΨΣΘΞÄÖÑÜ§äöñüà _^|{}[~]€ÆæßÉ!/\"#¤%&\'()*+,-.|:;<=>?¿. {l s='If you want to send other characters, emojis or symbols you must activate the option SMSUnicode in the Settings of this module.' mod='labsmobile'}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" value="1" name="submitTemplatesnew" class="btn btn-default pull-right">
                            <i class="process-icon-new"></i> {l s='Create template' mod='labsmobile'}
                        </button>
                        <button type="button" onclick="window.location = '{$url_config|escape:'htmlall':'UTF-8'}&action=templates'" value="1" name="Cancel" class="btn btn-default pull-left">
                            <i class="process-icon-cancel"></i> {l s='Cancel' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    hideOtherLanguage({/literal}{$lang|escape:'htmlall':'UTF-8'}{literal});
    $(document).ready(function() {

    });
</script>
{/literal}
