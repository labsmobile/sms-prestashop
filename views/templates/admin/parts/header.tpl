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
{if !empty($balance->lastversion) && $module->version != $balance->lastversion}
    <div class="alert alert-warning">
        {l s='An upgrade is available for this module. New features and improvements are waiting for you! Please, go to the Modules and Services section to upgrade your LabsMobile SMS module.' mod='labsmobile'}
    </div>
{/if}
{if $error_mobile_required}
    <div class="alert alert-warning">
        {l s='In order to communicate via SMS and to use this module you need the mobile phone of your customers. You can make the mobile phone a required field in any order. Go to Customers->Adresses and set the field phone_mobile as required.' mod='labsmobile'}
    </div>
{/if}