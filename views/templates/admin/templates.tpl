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
            {$templatesList|escape:'html':'UTF-8'|htmlspecialchars_decode:3}

            <div class="alert alert-info">
                <h4>{l s='Templates' mod='labsmobile'}</h4>
                {l s='You can use text templates to use in recurrent sendings. Create templates with different text for each language and use them in the sending forms.' mod='labsmobile'}
                <p><br /><center><a class="btn btn-default btn-primary" href="{$url_config|escape:'htmlall':'UTF-8'}&action=templatesnew"><i class="icon-plus-circle"></i> {l s='New template' mod='labsmobile'}</a></center></p>
            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $('.panel-heading-action').hide();
        $('#form-lm_texttemplates').attr('action',$('#form-lm_texttemplates').attr('action').replace('#lm_texttemplates','&action=templates#lm_texttemplates'));
        $('table.lm_texttemplates tr a.delete').each(function(index) {
            $(this).attr('href',$(this).attr('href').replace('&token','&action=templates&token'));
        });
        $(document).on('click', 'button[name=submitResetlm_texttemplates]', function(){
            $('tr.filter input').val('');
        });
    });
</script>
{/literal}

