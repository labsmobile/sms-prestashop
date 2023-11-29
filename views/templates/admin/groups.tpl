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
                <div class="panel-heading"><i class="icon-users"></i> {l s='Customer groups' mod='labsmobile'} 
                    <span class="badge">{$groups_num|escape:'htmlall':'UTF-8'}</span>
                </div>

                <div class="table-responsive-row clearfix">
                    <table class="table table_groups">
                        <thead>
                            <tr class="nodrag nodrop">
                                <th class="left"><span class="title_box">{l s='Name' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Conditions' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Customers' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Created' mod='labsmobile'}</span></th>
                                <th></th>
                                <th></th>
                            </tr>
                        <thead>
                        <tbody>
                            {foreach from=$groups item=item_group name=loop}
                                <tr class="{if $smarty.foreach.loop.index % 2 == 0}odd{/if}">
                                    <td>{$item_group['name']|escape:'htmlall':'UTF-8'}</td>
                                    <td width="50%"><span class="badge">{if count($item_group['conditions_array'])}{'</span> <span class="badge">'|implode:$item_group['conditions_array']|escape:'htmlall':'UTF-8'}</span>{/if}</td>
                                    <td>{$item_group['num']|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_group['created']|escape:'htmlall':'UTF-8'}</td>
                                    <td>
                                        <a href="{$url_config|escape:'htmlall':'UTF-8'}&id_group={$item_group['id_group']|escape:'htmlall':'UTF-8'}&deletelm_groups&action=groups" onclick="{literal}if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};{/literal}" title="Delete" class="delete btn btn-default">
                                            <i class="icon-trash"></i> {l s='Delete' mod='labsmobile'}
                                        </a>
                                    </td>
                                    <td><div class="action_column"></div></td>
                                </tr>
                            {/foreach}
                            {if count($groups) == 0}
                                <tr>
                                    <td class="list-empty" colspan="10">
                                        <div class="list-empty-msg">
                                            <i class="icon-warning-sign list-empty-icon"></i> {l s='No records found' mod='labsmobile'}
                                        </div>
                                    </td>
                                </tr>
                            {/if}
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="alert alert-info">
                <h4>{l s='Customer groups' mod='labsmobile'}</h4>
                {l s='Use Customer groups to segment your customer database. A group consists of a series of conditions that must be met by the its customers. You can select a group in the sending form and create bulk sendings.' mod='labsmobile'}
                <p><br /><center><a class="btn btn-default btn-primary" href="{$url_config|escape:'htmlall':'UTF-8'}&action=groupsnew"><i class="icon-plus-circle"></i> {l s='New group' mod='labsmobile'}</a></center></p>
            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.cancelButton', function(){
            
        });
    });
</script>
{/literal}