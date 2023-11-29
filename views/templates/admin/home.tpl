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
<div class="lm_presentation col-lg-8">
    <div class="panel cover">
        <div class="banner" style="background-image: url('/modules/labsmobile/views/img/banner{$rand_img|escape:'htmlall':'UTF-8'}.jpg')">
            <div class="banner_layer"></div>
            <div class="banner_text">
                <h1>{l s='Boost your ecommerce' mod='labsmobile'}</h1>
                <h2>{l s='with SMS and LabsMobile' mod='labsmobile'}</h2>

                <div class="tips row">
                    <div class="tip col-lg-3 col-md-6">
                        <i class="icon-globe"></i>
                        <p>{l s='Sent to any mobile in the world without apps.' mod='labsmobile'}</p>
                    </div>
                    <div class="tip col-lg-3 col-md-6">
                        <i class="icon-bolt"></i>
                        <p>{l s='Communicate directly and in a few seconds.' mod='labsmobile'}</p>
                    </div>
                    <div class="tip col-lg-3 col-md-6">
                        <i class="rate">95%</i>
                        <p>{l s='SMS messages has the best reading rate.' mod='labsmobile'}</p>
                    </div>
                    <div class="tip col-lg-3 col-md-6">
                        <i class="icon-money"></i>
                        <p>{l s='Low-cost communication, pay only for sent messages.' mod='labsmobile'}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel"> 

        <ul class="nav nav-tabs" id="tabOrder">	
            <li class="active" data-id="info">
                <a href="#info">
                    <i class="icon-info-circle"></i>
                    {l s='Features' mod='labsmobile'} 
                </a>
            </li>
            <li class="" data-id="pricing">
                <a href="#pricing">
                    <i class="icon-money"></i>
                    {l s='Pricing' mod='labsmobile'}
                </a>
            </li>
        </ul>

        <div class="tab-content panel">

            <div class="tab-pane active" id="info">
                <h1 class="lm_title">{l s='This is all you can do with the LabsMobile SMS module for Prestashop' mod='labsmobile'}</h1>
                <br /><br />
                <div class="row features">
                    <h3>{l s='SMS to customers' mod='labsmobile'}</h3>
                    <div class="row">
                        <div class="feature col-md-6">
                            <p>- {l s='Birthday greeting SMS.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='SMS in any change of order status.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Shipping notification message.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Reminder message for abandoned shopping carts.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Thank you message for a new order.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Confirmation message for customer returns.' mod='labsmobile'}</p>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <h3>{l s='SMS to ecommerce administrators' mod='labsmobile'}</h3>
                    <div class="row">
                        <div class="feature col-md-6">
                            <p>- {l s='New account message.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='New order message.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Order return message.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Test message.' mod='labsmobile'}</p>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <h3>{l s='Sending form' mod='labsmobile'}</h3>
                    <div class="row">
                        <div class="feature col-md-6">
                            <p>- {l s='Sent to your customer database.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Sent to a list of phone numbers.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Import a file (.csv/.xls) of phone numbers.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Schedule sendings.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='SMSUnicode, include any emoji or symbol.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Text message by customer language.' mod='labsmobile'}</p>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <h3>{l s='Module features' mod='labsmobile'}</h3>
                    <div class="row">
                        <div class="feature col-md-6">
                            <p>- {l s='Account balance and status.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Top up directly from the module.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Message history (status, delivery confirmation, credits, etc).' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Statistics and reports.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Check and cancel schedule sendings.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Download your invoices.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Updated price list and features by country.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='SMSUnicode, include any emoji or symbol.' mod='labsmobile'}</p>
                        </div>
                    </div>
                </div>

                <div class="row features">
                    <h3>{l s='LabsMobile platform' mod='labsmobile'}</h3>
                    <div class="row">
                        <div class="feature col-md-6">
                            <p>- {l s='Direct and quality routes.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Best and fair pricing.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='Consulting and support in your SMS campaigns and sendings.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='WebSMS application.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='API to integrate SMS communication with any software.' mod='labsmobile'}</p>
                        </div>
                        <div class="feature col-md-6">
                            <p>- {l s='More than 10 years of experience in the SMS sector.' mod='labsmobile'}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="pricing">
                <table class="table table_messages">
                        <thead>
                            <tr class="nodrag nodrop">
                                <th class="left"></th>
                                <th class="left"><span class="title_box">{l s='Country' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Prefix' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Price to' mod='labsmobile'}/SMS</span></th>
                                <th class="left"><span class="title_box">{l s='Price from' mod='labsmobile'}/SMS</span></th>
                                <th></th>
                            </tr>
                        <thead>
                        <tbody>
                            {foreach from=$countries_name item=item_countries key=key_countries name=loop}
                                <tr class="{if $smarty.foreach.loop.index % 2 == 0}odd{/if}">
                                    <td class="">{$countries[$key_countries]['isocode']|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$countries[$key_countries]['name']|escape:'htmlall':'UTF-8'}</td>
                                    <td>+{$countries[$key_countries]['code']|escape:'htmlall':'UTF-8'}</td>
                                    <td class="item align_right">{$countries[$key_countries]['price_currency_to']|escape:'htmlall':'UTF-8'}</td>
                                    <td class="item align_right">{$countries[$key_countries]['price_currency_from']|escape:'htmlall':'UTF-8'}</td>
                                    <td class=""><div class="action_column"></div></td>
                                </tr>
                            {/foreach}
                        </tbody>
                        </thead>
                    </table>
            </div>

        </div>

        <h2 class="lm_subtitle">{l s='More information at' mod='labsmobile'} <a target="_blank" href="https://addons.prestashop.com/contact-form.php?id_product=31022">{l s='Help center' mod='labsmobile'}</a></h2>
    </div>
</div>

<div class="lm_form col-lg-4">
    <div class="panel">
{if $action == 'account'}
    {include file="./forms/account.tpl"}
{elseif $action == 'forgot'}
    {include file="./forms/forgot.tpl"}
{else}
    {include file="./forms/login.tpl"}
{/if}
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $(".nav-tabs li").click(function() {
            $(".nav-tabs li").removeClass('active');
            $(this).addClass('active');
            $(".tab-pane").removeClass('active');
            $("#"+$(this).attr('data-id')).addClass('active');
        });
    });
</script>
{/literal}
