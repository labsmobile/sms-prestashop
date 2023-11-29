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
<li class="{if $pag_now < 2}disabled{/if}">
    <a href="javascript:void(0);" id="pag_previoustop" class="pagination-link" data-page="1">
        <i class="icon-double-angle-left"></i>
    </a>
</li>
<li class="{if $pag_now < 2}disabled{/if}">
    <a href="javascript:void(0);" class="pagination-link" data-page="{$page_previous|escape:'htmlall':'UTF-8'}">
        <i class="icon-angle-left"></i>
    </a>
</li>
{if $pag_now > 10}
    <li class="disabled">
        <a href="javascript:void(0);">…</a>
    </li>
{/if}
{foreach from=$pags_previous item=pag_item}
    <li>
        <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_item|escape:'htmlall':'UTF-8'}">{$pag_item|escape:'htmlall':'UTF-8'}</a>
    </li>
{/foreach}
<li class="active">
    <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_now|escape:'htmlall':'UTF-8'}">{$pag_now|escape:'htmlall':'UTF-8'}</a>
</li>
{foreach from=$pags_next item=pag_item}
    <li>
        <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_item|escape:'htmlall':'UTF-8'}">{$pag_item|escape:'htmlall':'UTF-8'}</a>
    </li>
{/foreach}
{if $pag_now + 10 < $pag_size}
    <li class="disabled">
        <a href="javascript:void(0);">…</a>
    </li>
{/if}
<li class="{if $pag_now >= $pag_size}disabled{/if}">
    <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_next|escape:'htmlall':'UTF-8'}">
        <i class="icon-angle-right"></i>
    </a>
</li>
<li class="{if $pag_now >= $pag_size}disabled{/if}">
    <a href="javascript:void(0);" id="pag_nexttop" class="pagination-link" data-page="{$pag_size|escape:'htmlall':'UTF-8'}">
        <i class="icon-double-angle-right"></i>
    </a>
</li>

