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
<div class="panel">
    <div class="panel-heading"><span class="lm_status">{l s='Status' mod='labsmobile'}: <i class="icon-circle"></i></span><i class="icon-paper-plane-o"></i> {l s='Account' mod='labsmobile'}</div>
    
    {$username|escape:'htmlall':'UTF-8'}<br />
    <a href="index.php?controller=AdminLabsmobile&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;action={$action|escape:'htmlall':'UTF-8'}" class="delete btn btn-default pull-right"><i class="icon-refresh"></i></a>
    <b>{$balance->credits|number_format:0:$locale['thousands_sep']:$locale['decimal_point']|escape:'htmlall':'UTF-8'}</b> {l s='credits' mod='labsmobile'} <br />
    <b>{$balance->messages|number_format:0:$locale['thousands_sep']:$locale['decimal_point']|escape:'htmlall':'UTF-8'}</b> {l s='SMS to' mod='labsmobile'} {$balance->country|escape:'htmlall':'UTF-8'}<br />
    <b>{$balance->scheduled|number_format:0:$locale['thousands_sep']:$locale['decimal_point']|escape:'htmlall':'UTF-8'}</b> {l s='scheduled messages' mod='labsmobile'}
</div>
<div class="list-group lm_menu">
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=dashboard" class="list-group-item{if $action=='dashboard'} active{/if}"><i class="icon-dashboard"></i>&nbsp;&nbsp;{l s='Dashboard' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=smscustomer" class="list-group-item{if $action=='smscustomer'} active{/if}"><i class="icon-user"></i>&nbsp;&nbsp;{l s='SMS to Customers' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=smsadmin" class="list-group-item{if $action=='smsadmin'} active{/if}"><i class="icon-street-view"></i>&nbsp;&nbsp;{l s='SMS to Admin' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=sendsms" class="list-group-item{if $action=='sendsms'} active{/if}"><i class="icon-pencil-square-o"></i>&nbsp;&nbsp;{l s='Send SMS' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=templates" class="list-group-item{if $action=='templates'} active{/if}"><i class="icon-files-o"></i>&nbsp;&nbsp;{l s='Text templates' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=groups" class="list-group-item{if $action=='groups'} active{/if}"><i class="icon-users"></i>&nbsp;&nbsp;{l s='Customer groups' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=scheduled" class="list-group-item{if $action=='scheduled'} active{/if}"><i class="icon-clock-o"></i>&nbsp;&nbsp;{l s='Scheduled sendings' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=historic" class="list-group-item{if $action=='historic'} active{/if}"><i class="icon-search"></i>&nbsp;&nbsp;{l s='Message history' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=statistics" class="list-group-item{if $action=='statistics'} active{/if}"><i class="icon-bar-chart"></i>&nbsp;&nbsp;{l s='Statistics' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=settings" class="list-group-item{if $action=='settings'} active{/if}"><i class="icon-cogs"></i>&nbsp;&nbsp;{l s='Settings' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=invoicing" class="list-group-item{if $action=='invoicing'} active{/if}"><i class="icon-briefcase"></i>&nbsp;&nbsp;{l s='Invoicing' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=pricing" class="list-group-item{if $action=='pricing'} active{/if}"><i class="icon-money"></i>&nbsp;&nbsp;{l s='Prices and features by country' mod='labsmobile'}</a>
    <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=purchase" class="list-group-item{if $action=='purchase'} active{/if}"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;{l s='Top up' mod='labsmobile'}</a>
</div>