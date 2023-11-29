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
<div class="lm_login">
    {if !empty($errors)}
        <span class="error">{$errors|escape:'htmlall':'UTF-8'}</span>
    {/if}
    <form action="{$url_config|escape:'htmlall':'UTF-8'}&action=forgot" method="post">
            <div class="title_wrapper">
                <div class="lm_subtitle">{l s='Introduce your username' mod='labsmobile'}</div>
            </div>
            <p>
                <input name="username" id="username" value="{if isset($smarty.post.username)}{$smarty.post.username|escape:'htmlall':'UTF-8'}{/if}" type="text" placeholder="{l s='E-mail (username)' mod='labsmobile'}">
            </p>
            <p>
                <input id="module_form_submit_btn" value="{l s='Reset password' mod='labsmobile'}" name="submitForgot" class="btn btn-red" type="submit">
            </p>
            <p>
                <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=login" class="btn btn-default btn-green">{l s='Cancel' mod='labsmobile'}</a>
            </p>
    </form>
</div>
