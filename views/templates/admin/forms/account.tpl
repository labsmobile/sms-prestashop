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
<div class="lm_account">
    <form action="{$url_config|escape:'htmlall':'UTF-8'}&action=account" method="post" class="form-horizontal">
    <div class="form_wrapper">
    
            <div class="title_wrapper">
                <div class="lm_title">{l s='Create a new account' mod='labsmobile'}</div>
                <div class="lm_subtitle">{l s='Up to 100 SMS free trial!' mod='labsmobile'}</div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-3">{l s='Name' mod='labsmobile'}</label>
                <div class="col-lg-9">
                    <input name="name" class="form-control" class="control-form" id="name" value="{if isset($smarty.post.name)}{$smarty.post.name|escape:'htmlall':'UTF-8'}{else}{$ps_name|escape:'htmlall':'UTF-8'}{/if}" type="text" placeholder="{l s='Your name' mod='labsmobile'}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">{l s='Company' mod='labsmobile'}</label>
                <div class="col-lg-9">
                <input name="company" class="form-control" id="company" value="{if isset($smarty.post.company)}{$smarty.post.company|escape:'htmlall':'UTF-8'}{else}{$ps_company|escape:'htmlall':'UTF-8'}{/if}" type="text" placeholder="{l s='Company' mod='labsmobile'}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">{l s='Email' mod='labsmobile'}</label>
                <div class="col-lg-9">
                    <input name="email" class="form-control" id="email" value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'htmlall':'UTF-8'}{else}{$ps_email|escape:'htmlall':'UTF-8'}{/if}" type="text" placeholder="{l s='E-mail (username)' mod='labsmobile'}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">{l s='Website' mod='labsmobile'}</label>
                <div class="col-lg-9">
                    <input name="website" class="form-control" id="website" value="{if isset($smarty.post.website)}{$smarty.post.website|escape:'htmlall':'UTF-8'}{else}{$ps_website|escape:'htmlall':'UTF-8'}{/if}" type="text" placeholder="{l s='Website' mod='labsmobile'}">
                </div>
            </div>
            <div class="form-group">
                <div class="control-label col-sm-3">
                    <input name="terms" id="terms" value="1" type="checkbox"{if isset($smarty.post.terms)} checked="checked"{/if}>    
                </div>
                <div class="col-sm-9">
                    <label for="terms">{l s='I have read and agree with the' mod='labsmobile'}</label><br />&nbsp;<a href="http://www.labsmobile.com/en/privacy-terms" target="_blank">{l s='Privacy policy' mod='labsmobile'}</a>&nbsp;<label for="terms">{l s='and' mod='labsmobile'}</label>&nbsp;<a href="http://www.labsmobile.com/en/terms-of-service" target="_blank">{l s='Terms of service' mod='labsmobile'}</a>
                </div>
            </div>
            <br />
            <p>
                <input id="module_form_submit_btn" value="{l s='Sign up' mod='labsmobile'}" name="submitAccount" class="btn btn-red" type="submit">
            </p>
            
            <div class="clear"></div>
            <a href="{$url_config|escape:'htmlall':'UTF-8'}" class="btn btn-default btn-green">{l s='Cancel' mod='labsmobile'}</a>
    </div>
    </form>
</div>