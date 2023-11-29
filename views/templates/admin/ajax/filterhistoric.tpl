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
{if count($messages_result) > 0}
<tbody>
    {foreach from=$messages_result->messages name=messages_loop item=messages_item}
    <tr class="{if $smarty.foreach.messages_loop.index%2}odd{/if}">
        <td>{$messages_item->id|escape:'htmlall':'UTF-8'}</td>
        <td>{$messages_item->number|escape:'htmlall':'UTF-8'}{if !$messages_item->country}<br /><small>{$messages_item->country|escape:'htmlall':'UTF-8'}</small>{/if}</td>
        <td>{$messages_item->sender|escape:'htmlall':'UTF-8'}</td>
        <td>{$messages_item->message|escape:'htmlall':'UTF-8'}</td>
        <td>{$messages_item->credits|escape:'htmlall':'UTF-8'}</td>
        <td>{$messages_item->clicks|escape:'htmlall':'UTF-8'}</td>
        <td>{$messages_item->sent_local|escape:'htmlall':'UTF-8'}</td>
        <td><span class="badge">{$messages_item->status_item|escape:'htmlall':'UTF-8'}</span></td>
        <td>{$messages_item->updated_local|escape:'htmlall':'UTF-8'}</td>
        <td><div class="action_column"></div></td>
    </tr>
    {/foreach}
</tbody>
{else}
    <tr>
        <td class="list-empty" colspan="10">
            <div class="list-empty-msg">
                <i class="icon-warning-sign list-empty-icon"></i>
                {l s='No records found' mod='labsmobile'}
            </div>
        </td>
    </tr>
{/if}