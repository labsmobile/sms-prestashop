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
        <div class="col-md-3">
            {include file="./parts/menu.tpl"}
        </div>
        <div class="col-md-9">
            {$formConfadmin|escape:'html':'UTF-8'|htmlspecialchars_decode:3}

            <div id="submitSendtest_wrapper" class="form-group">
                <button style="display:none;" type="submit" {if empty($phone_admin_value)}disabled{/if} id="submitSendtest" name="submitSendtest" class="btn btn-default pull-left">
                    <i class="icon-envelope-o"></i> {l s='Send test message' mod='labsmobile'}
                </button>
            </div>
            
            {$formSmsadmin|escape:'html':'UTF-8'|htmlspecialchars_decode:3}
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $("#submitSendtest_wrapper").appendTo("#configuration_form_1 .col-lg-9");
        $("#submitSendtest").show();
    });
</script>
{/literal}
