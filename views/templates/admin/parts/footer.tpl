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
&nbsp;&nbsp;&nbsp;<small class="text-muted">v{$module->version|escape:'htmlall':'UTF-8'} by {$module->author|escape:'htmlall':'UTF-8'}. {l s='Contact us' mod='labsmobile'} <a class="footer_link" target="_blank" href="https://addons.prestashop.com/contact-form.php?id_product=31022">{l s='here' mod='labsmobile'}</a>. </small>

{literal}
<script type="text/javascript">
    var L_MESSAGES = '{/literal}{l s='messages' mod='labsmobile'}{literal}';
    var L_CHARACTERS = '{/literal}{l s='characters' mod='labsmobile'}{literal}';
    var L_UNICODE = '{/literal}{l s='(emojis or symbols not allowed)' mod='labsmobile'}{literal}';
    var UNICODE_ACTIVE = {/literal}{$unicode_active|escape:'htmlall':'UTF-8'}{literal};
    $('#toolbar-nav .btn-help').hide();
</script>
{/literal}