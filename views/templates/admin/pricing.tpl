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
            <div class="panel">
                <div class="panel-heading"><i class="icon-money"></i> {l s='Prices and features by country' mod='labsmobile'}
                </div>

                <div class="table-responsive-row clearfix">
                    <table class="table table_messages">
                        <thead>
                            <tr class="nodrag nodrop">
                                <th class="left"></th>
                                <th class="left"><span class="title_box">{l s='Country' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Prefix' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Credits' mod='labsmobile'}/SMS</span></th>
                                <th class="left"><span class="title_box">{l s='Price to' mod='labsmobile'}/SMS</span></th>
                                <th class="left"><span class="title_box">{l s='Price from' mod='labsmobile'}/SMS</span></th>
                                <th class="left"><span class="title_box">{l s='Comments' mod='labsmobile'}</span></th>
                                <th></th>
                            </tr>
                        <thead>
                        <tbody>
                            {foreach from=$countries_name item=item_countries key=key_countries name=loop}
                                <tr class="{if $smarty.foreach.loop.index % 2 == 0}odd{/if}">
                                    <td class="">{$countries[$key_countries]['isocode']|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$countries[$key_countries]['name']|escape:'htmlall':'UTF-8'}</td>
                                    <td>+{$countries[$key_countries]['code']|escape:'htmlall':'UTF-8'}</td>
                                    <td class="item align_center">{$countries[$key_countries]['price_credits']|escape:'htmlall':'UTF-8'}</td>
                                    <td class="item align_right">{$countries[$key_countries]['price_currency_to']|escape:'htmlall':'UTF-8'}</td>
                                    <td class="item align_right">{$countries[$key_countries]['price_currency_from']|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$countries[$key_countries]['comments']|escape:'htmlall':'UTF-8'}</td>
                                    <td class=""><div class="action_column"></div></td>
                                </tr>
                            {/foreach}
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>