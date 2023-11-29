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
            <form id="lm_groups_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=groupsnew" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-edit"></i> {l s='New group' mod='labsmobile'}</div>

                    <div class="form-wrapper">
                        <div class="form-group">
                            <div id="lm_newgroup_NAME">
                                <label class="control-label col-lg-3">{l s='Name' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{$params_form['name']|escape:'htmlall':'UTF-8'}" class="form-control" size="5" name="name">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div id="lm_newgroup_CONDITIONS">
                                <label class="control-label col-lg-3">{l s='Add conditions' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <fieldset class="form-fieldset">
                                    <br />
                                        <div class="col-lg-2">
                                            <label class="control-label col-lg-12">{l s='Criteria' mod='labsmobile'}</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <select id="selectcondition" placeholder="{l s='Choose one criteria...' mod='labsmobile'}" class="chosen col-lg-6" name="selectcondition">
                                                <option value="0" style="font-weight: bold"></option>
                                                <option value="gender">{l s='Gender' mod='labsmobile'}</option>
                                                <option value="age">{l s='Age' mod='labsmobile'}</option>
                                                <option value="countries">{l s='Country' mod='labsmobile'}</option>
                                                <option value="states">{l s='State' mod='labsmobile'}</option>
                                                <option value="languages">{l s='Language' mod='labsmobile'}</option>
                                                <option value="newsletter">{l s='Subscribed to the newsletter' mod='labsmobile'}</option>
                                                <option value="optin">{l s='Opt-in validated' mod='labsmobile'}</option>
                                                <option value="number">{l s='Number of orders' mod='labsmobile'}</option>
                                                <option value="spent">{l s='Total spent amount' mod='labsmobile'}</option>
                                                <option value="average">{l s='Average amount per order' mod='labsmobile'}</option>
                                                <option value="lastorder">{l s='Days since last order' mod='labsmobile'}</option>
                                                <option value="lastvisit">{l s='Days since last visit' mod='labsmobile'}</option>
                                                <option value="signup">{l s='Sign up date' mod='labsmobile'}</option>
                                                <option value="orders">{l s='Orders' mod='labsmobile'}</option>
                                                <option value="products">{l s='Purchased products' mod='labsmobile'}</option>
                                                <option value="categories">{l s='Categories of products purchased' mod='labsmobile'}</option>
                                            </select>
                                        </div>
                                        <br /><br /><hr>
                                        <div class="fields_criteria clearfix">
                                            <div class="hidden tab_criteria" id="gender">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Gender' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="gender_select" id="gender_select" class="">
                                                            <option value="female">{l s='Female' mod='labsmobile'}</option>
                                                            <option value="male">{l s='Male' mod='labsmobile'}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must have the selected gender.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="age">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="age_type_select" id="age_type_select" class="">
                                                            <option value="equal">{l s='Equal' mod='labsmobile'} (=)</option>
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Age' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div class="input-group">
                                                            <input type="text" value="" class="form-control" size="5" id="age_value" name="age_value">
                                                            <span class="input-group-addon">{l s='years' mod='labsmobile'}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must have the age greater, less or equal as the introduced value.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="countries">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Countries' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="country_select" multiple id="country_select" class="">
                                                            {foreach from=$countries item=item_country key=key_country}
                                                                <option value="{$key_country|escape:'htmlall':'UTF-8'}">{$item_country|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must have an address with the selected countries.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="states">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='States' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="state_select" multiple id="state_select" class="">
                                                            {foreach from=$states item=item_state key=key_state}
                                                                <option value="{$key_state|escape:'htmlall':'UTF-8'}">{$item_state|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must have an address with the selected states.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="languages">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Languages' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="language_select" multiple id="language_select" class="">
                                                            {foreach from=$languages item=item_language key=key_language}
                                                                <option value="{$key_language|escape:'htmlall':'UTF-8'}">{$item_language|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must have their account configured with one of the selected languages.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="newsletter">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <input id="newsletter_value" type="checkbox"> <label class="label_check" for="newsletter_value">{l s='The customer is subscribed to the newsletter.' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <div class="help-block">{l s='Customers must be subscribed to the newsletter.' mod='labsmobile'}</div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="optin">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <input id="optin_value" type="checkbox"> <label class="label_check" for="optin_value">{l s='The customer has the opt-in validated.' mod='labsmobile'}</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="number">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="number_type_select" id="number_type_select" class="">
                                                            <option value="equal">{l s='Equal' mod='labsmobile'} (=)</option>
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Number of orders' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" id="number_value" name="number_value">
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must have the number of orders greater, less or equal as the introduced value.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="spent">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="spent_type_select" id="spent_type_select" class="">
                                                            <option value="equal">{l s='Equal' mod='labsmobile'} (=)</option>
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Total spent amount' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" id="spent_value" name="spent_value">
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must have the total spent amount greater, less or equal as the introduced value.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="average">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="average_type_select" id="average_type_select" class="">
                                                            <option value="equal">{l s='Equal' mod='labsmobile'} (=)</option>
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Average amount per order' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" id="average_value" name="average_value">
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must have the average amount per order greater, less or equal as the introduced value.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="lastorder">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="lastorder_type_select" id="lastorder_type_select" class="">
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Days since last order' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div class="input-group">
                                                            <input type="text" value="" class="form-control" size="5" id="lastorder_value" name="lastorder_value">
                                                            <span class="input-group-addon">{l s='days' mod='labsmobile'}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must haven\'t made an order in greater of less days than the introduced value.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="lastvisit">
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <select name="lastvisit_type_select" id="lastvisit_type_select" class="">
                                                            <option value="greater">{l s='Greater than' mod='labsmobile'} (>)</option>
                                                            <option value="less">{l s='Less than' mod='labsmobile'} (<)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Days since last visit' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <div class="input-group">
                                                            <input type="text" value="" class="form-control" size="5" id="lastvisit_value" name="lastvisit_value">
                                                            <span class="input-group-addon">{l s='days' mod='labsmobile'}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must haven\'t visited the ecommerce in greater of less days than the introduced value.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="signup">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='From' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="signup_from_value" name="signup_from_value">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='To' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="signup_to_value" name="signup_to_value">
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must created their account from and/or to the introduced dates.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="orders">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Date from' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="orders_date_from_value" name="orders_date_from_value">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Date to' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="orders_date_to_value" name="orders_date_to_value">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Amount from' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="orders_amount_from_value" name="orders_amount_from_value">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Amount to' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <input type="text" value="" class="form-control" size="5" id="orders_amount_to_value" name="orders_amount_to_value">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Countries' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="orders_country_select" multiple id="orders_country_select" class="">
                                                            {foreach from=$countries item=item_country key=key_country}
                                                                <option value="{$key_country|escape:'htmlall':'UTF-8'}">{$item_country|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='States' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="orders_state_select" multiple id="orders_state_select" class="">
                                                            {foreach from=$states item=item_state key=key_state}
                                                                <option value="{$key_state|escape:'htmlall':'UTF-8'}">{$item_state|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Categories' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="orders_categories_select" multiple id="orders_categories_select" class="">
                                                            {foreach from=$categories item=item_category key=key_category}
                                                                <option value="{$key_category|escape:'htmlall':'UTF-8'}">{$item_category|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Products' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="orders_products_select" multiple id="orders_products_select" class="">
                                                            {foreach from=$products item=item_product key=key_product}
                                                                <option value="{$key_product|escape:'htmlall':'UTF-8'}">{$item_product|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must made and order with the introduced conditions (dates, countries, states, amount, products and categories).' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="products">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Products' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="products_select" multiple id="products_select" class="">
                                                            {foreach from=$products item=item_product key=key_product}
                                                                <option value="{$key_product|escape:'htmlall':'UTF-8'}">{$item_product|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must have purchased one of the selected products.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hidden tab_criteria" id="categories">
                                                <div class="form-group">
                                                    <div class="col-lg-2">
                                                        <label class="control-label col-lg-12">{l s='Categories' mod='labsmobile'}</label>
                                                    </div>
                                                    <div class="col-lg-10">
                                                        <select name="categories_select" multiple id="categories_select" class="">
                                                            {foreach from=$categories item=item_category key=key_category}
                                                                <option value="{$key_category|escape:'htmlall':'UTF-8'}">{$item_category|escape:'htmlall':'UTF-8'}</option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <div class="help-block">{l s='Customers must have purchased one product from of the selected categories.' mod='labsmobile'}</div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-10 col-lg-offset-2">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="icon-plus-circle"></i> {l s='Add condition' mod='labsmobile'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_newgroup_CONDITIONS">
                                <label class="control-label col-lg-3">{l s='Conditions' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <fieldset class="form-fieldset">
                                        <div id="conditions_show"></div>
                                    </fieldset>
                                    <input type="hidden" value="{}" id="conditions_json" class="form-control" size="5" name="conditions_json">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_newgroup_CUSTOMERS">
                                <label class="control-label col-lg-3">{l s='Number of customers' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" value="0" disabled id="numcustomers" class="form-control" size="5" name="numcustomers">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-footer">
                        <button type="submit" value="1" name="submitGroupsnew" class="btn btn-default pull-right">
                            <i class="process-icon-new"></i> {l s='Create group' mod='labsmobile'}
                        </button>
                        
                        <button type="button" onclick="window.location = '{$url_config|escape:'htmlall':'UTF-8'}&action=groups'" value="1" name="Cancel" class="btn btn-default pull-left">
                            <i class="process-icon-cancel"></i> {l s='Cancel' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $("#selectcondition").change(function() {
            $('.tab_criteria').addClass('hidden');
            $('#'+$(this).val()).removeClass('hidden');
            $('#gender_select').trigger("chosen:updated");
        });
        $("#signup_from_value,#signup_to_value,#orders_date_from_value,#orders_date_to_value").datetimepicker({
            prevText: '',
            nextText: '',
            dateFormat: 'yy-mm-dd',
            currentText: '{/literal}{l s='Now' js=1}{literal}',
            closeText: '{/literal}{l s='Done' js=1}{literal}',
            ampm: false,
            amNames: ['AM', 'A'],
            pmNames: ['PM', 'P'],
            timeFormat: 'hh:mm:ss tt',
            timeSuffix: '',
            timeOnlyTitle: '{/literal}{l s='Choose Time' js=1}{literal}',
            timeText: '{/literal}{l s='Time' js=1}{literal}',
            hourText: '{/literal}{l s='Hour' js=1}{literal}',
            minuteText: '{/literal}{l s='Minute' js=1}{literal}'
        });
        $(".tab_criteria button").click(function() {
            var type = $(this).parents('.tab_criteria').attr('id');

            if(type == 'gender') {
                var value = '';
                if($('#gender_select').val()=='female') {
                    value = '{/literal}{l s='Female' mod='labsmobile'}{literal}';
                } else {
                    value = '{/literal}{l s='Male' mod='labsmobile'}{literal}';
                }

                if($('#gender_select').val().length > 0) {
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Gender' mod='labsmobile'}{literal}: '+value+' <i data-type="gender" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='gender']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.gender = $('#gender_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#gender_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'age') {
                var opr_value = $('#age_type_select').val();
                var opr = '';
                if(opr_value == 'equal') {
                    opr = '=';
                } else if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#age_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Age' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="age" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='age']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.age = {
                        opr: $('#age_type_select').val(),
                        value: $('#age_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#age_type_select').val('').trigger("chosen:updated");
                    $('#age_value').val('');
                }
            }
            if(type == 'countries') {
                var value = new Array();
                $("#country_select option:selected").each(function() {
                    value.push($(this).text());
                });
                if(value.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Countries' mod='labsmobile'}{literal}: '+value.join(', ')+' <i data-type="countries" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='countries']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.countries = $('#country_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#country_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'states') {
                var value = new Array();
                $("#state_select option:selected").each(function() {
                    value.push($(this).text());
                });
                if(value.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='States' mod='labsmobile'}{literal}: '+value.join(', ')+' <i data-type="states" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='states']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.states = $('#state_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#state_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'languages') {
                var value = new Array();
                $("#language_select option:selected").each(function() {
                    value.push($(this).text());
                });
                if(value.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='States' mod='labsmobile'}{literal}: '+value.join(', ')+' <i data-type="languages" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='languages']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.languages = $('#language_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#language_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'newsletter') {
                if($('#newsletter_value').prop("checked")){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Subscribed to newsletter' mod='labsmobile'}{literal} <i data-type="newsletter" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='newsletter']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.newsletter = true;
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#newsletter_value').prop("checked", false);
                }
            }
            if(type == 'optin') {
                if($('#optin_value').prop("checked")){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Opt-in validated' mod='labsmobile'}{literal} <i data-type="optin" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='optin']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.optin = true;
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#optin_value').prop("checked", false);
                }
            }
            if(type == 'number') {
                var opr_value = $('#number_type_select').val();
                var opr = '';
                if(opr_value == 'equal') {
                    opr = '=';
                } else if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#number_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Number of orders' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="number" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='number']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.number = {
                        opr: $('#number_type_select').val(),
                        value: $('#number_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#number_type_select').val('').trigger("chosen:updated");
                    $('#number_value').val('');
                }
            }
            if(type == 'spent') {
                var opr_value = $('#spent_type_select').val();
                var opr = '';
                if(opr_value == 'equal') {
                    opr = '=';
                } else if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#spent_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Total spent amount' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="spent" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='spent']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.spent = {
                        opr: $('#spent_type_select').val(),
                        value: $('#spent_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#spent_type_select').val('').trigger("chosen:updated");
                    $('#spent_value').val('');
                }
            }
            if(type == 'average') {
                var opr_value = $('#average_type_select').val();
                var opr = '';
                if(opr_value == 'equal') {
                    opr = '=';
                } else if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#average_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Average amount per order' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="average" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='average']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.average = {
                        opr: $('#average_type_select').val(),
                        value: $('#average_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#average_type_select').val('').trigger("chosen:updated");
                    $('#average_value').val('');
                }
            }
            if(type == 'lastorder') {
                var opr_value = $('#lastorder_type_select').val();
                var opr = '';
                if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#lastorder_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Days since last order' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="lastorder" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='lastorder']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.lastorder = {
                        opr: $('#lastorder_type_select').val(),
                        value: $('#lastorder_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#lastorder_type_select').val('').trigger("chosen:updated");
                    $('#lastorder_value').val('');
                }
            }
            if(type == 'lastvisit') {
                var opr_value = $('#lastvisit_type_select').val();
                var opr = '';
                if (opr_value == 'greater') {
                    opr = '>';
                } else if (opr_value == 'less') {
                    opr = '<';
                }
                var value = $('#lastvisit_value').val();
                if(Math.floor(value) == value && $.isNumeric(value)){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Days since last visit' mod='labsmobile'}{literal} '+opr+' '+value+' <i data-type="lastvisit" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='lastvisit']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.lastvisit = {
                        opr: $('#lastvisit_type_select').val(),
                        value: $('#lastvisit_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#lastvisit_type_select').val('').trigger("chosen:updated");
                    $('#lastvisit_value').val('');
                }
            }
            if(type == 'signup') {
                var value_from = $('#signup_from_value').val();
                var value_str = '';
                if(value_from.length > 0) {
                    value_str = '{/literal}{l s='from' mod='labsmobile'}{literal} '+value_from+' ';
                }
                var value_to = $('#signup_to_value').val();
                if(value_to.length > 0) {
                    value_str = value_str+'{/literal}{l s='to' mod='labsmobile'}{literal} '+value_to+' ';
                }

                if(value_str.length > 0) {
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Sign up date' mod='labsmobile'}{literal} '+value_str+'<i data-type="signup" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='signup']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.signup = {
                        from: $('#signup_from_value').val(),
                        to: $('#signup_to_value').val()
                    };
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#signup_from_value').val('');
                    $('#signup_to_value').val('');
                }
            }
            if(type == 'orders') {
                var value_str = '';
                var value_date_from = $('#orders_date_from_value').val();
                var json_values = new Object();
                if(value_date_from.length > 0) {
                    value_str = value_str + '{/literal}{l s='date from' mod='labsmobile'}{literal} '+value_date_from+' ';
                    json_values.date_from = value_date_from;
                }
                var value_date_to = $('#orders_date_to_value').val();
                if(value_date_to.length > 0) {
                    value_str = value_str + '{/literal}{l s='date to' mod='labsmobile'}{literal} '+value_date_to+' ';
                    json_values.date_to = value_date_to;
                }
                var value_amount_from = $('#orders_amount_from_value').val();
                if(value_amount_from.length > 0 && Math.floor(value_amount_from) == value && $.isNumeric(value_amount_from)) {
                    value_str = value_str + '{/literal}{l s='amount from' mod='labsmobile'}{literal} '+value_amount_from+' ';
                    json_values.amount_from = value_amount_from;
                }
                var value_amount_to = $('#orders_amount_to_value').val();
                if(value_amount_to.length > 0 && Math.floor(value_amount_to) == value && $.isNumeric(value_amount_to)) {
                    value_str = value_str + '{/literal}{l s='amount to' mod='labsmobile'}{literal} '+value_amount_to+' ';
                    json_values.amount_to = value_amount_to;
                }
                var value_countries = new Array();
                $("#orders_country_select option:selected").each(function() {
                    value_countries.push($(this).text());
                });
                if(value_countries.length > 0){
                    value_str = value_str + '{/literal}{l s='Countries' mod='labsmobile'}{literal} ('+value_countries.join(', ')+') ';
                    json_values.countries = $("#orders_countries_select").val();
                }
                var value_states = new Array();
                $("#orders_state_select option:selected").each(function() {
                    value_states.push($(this).text());
                });
                if(value_states.length > 0){
                    value_str = value_str + '{/literal}{l s='States' mod='labsmobile'}{literal} ('+value_states.join(', ')+') ';
                    json_values.states = $("#orders_state_select").val();
                }
                var value_products = new Array();
                $("#orders_products_select option:selected").each(function() {
                    value_products.push($(this).text());
                });
                if(value_products.length > 0){
                    value_str = value_str + '{/literal}{l s='Products' mod='labsmobile'}{literal} ('+value_products.join(', ')+') ';
                    json_values.products = $("#orders_products_select").val();
                }
                var value_categories = new Array();
                $("#orders_categories_select option:selected").each(function() {
                    value_categories.push($(this).text());
                });
                if(value_categories.length > 0){
                    value_str = value_str + '{/literal}{l s='Categories' mod='labsmobile'}{literal} ('+value_categories.join(', ')+') ';
                    json_values.categories = $("#orders_categories_select").val();
                }

                if(value_str.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Orders' mod='labsmobile'}{literal}: '+value_str+' <i data-type="orders" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='orders']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_valuest = $('#conditions_json').val();
                    if(json_valuest.length > 0) {
                        json_valuest = JSON.parse(json_valuest);
                    }
                    json_valuest.orders = json_values;
                    $('#conditions_json').val(JSON.stringify(json_valuest));

                    $('#orders_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'products') {
                var value = new Array();
                $("#products_select option:selected").each(function() {
                    value.push($(this).text());
                });
                if(value.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Products' mod='labsmobile'}{literal}: '+value.join(', ')+' <i data-type="products" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='products']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.products = $('#products_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#products_select').val('').trigger("chosen:updated");
                }
            }
            if(type == 'categories') {
                var value = new Array();
                $("#categories_select option:selected").each(function() {
                    value.push($(this).text());
                });
                if(value.length > 0){
                    $('#conditions_show').html($('#conditions_show').html() + '<span class="badge">{/literal}{l s='Categories' mod='labsmobile'}{literal}: '+value.join(', ')+' <i data-type="categories" class="icon-times delete-badge"></i></span>');
                    $("#selectcondition").val('');
                    $("#selectcondition option[value='categories']").hide();
                    $("#selectcondition").trigger("chosen:updated");
                    $('.tab_criteria').addClass('hidden');

                    var json_values = $('#conditions_json').val();
                    if(json_values.length > 0) {
                        json_values = JSON.parse(json_values);
                    }
                    json_values.categories = $('#categories_select').val();
                    $('#conditions_json').val(JSON.stringify(json_values));

                    $('#categories_select').val('').trigger("chosen:updated");
                }
            }
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxcalcgroup&p_json='+$('#conditions_json').val()
            }).done(function(res) {
                $("#numcustomers").val(res);
            });
        });
        $(document).on('click', '.delete-badge', function(){
            $("#selectcondition option[value='"+$(this).attr('data-type')+"']").show();
            $("#selectcondition").trigger("chosen:updated");
            $(this).parents('span.badge').remove();

            var json_values = $('#conditions_json').val();
            if(json_values.length > 0) {
                json_values = JSON.parse(json_values);
            }
            var typethis = $(this).attr('data-type');
            delete json_values[typethis];
            $('#conditions_json').val(JSON.stringify(json_values));

            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxcalcgroup&p_json='+$('#conditions_json').val()
            }).done(function(res) {
                $("#numcustomers").val(res);
            });
        });
        $("#gender_select").chosen({
            disable_search: true,
            width: "100%"
        });
        $("#country_select, #orders_country_select").chosen({
            disable_search: false,
            width: "100%"
        });
        $("#state_select, #orders_state_select").chosen({
            disable_search: false,
            width: "100%"
        });
        $("#language_select").chosen({
            disable_search: false,
            width: "100%"
        });
        $("#number_type_select").chosen({
            disable_search: true,
            width: "100%"
        });
        $("#spent_type_select").chosen({
            disable_search: true,
            width: "100%"
        });
        $("#average_type_select").chosen({
            disable_search: true,
            width: "100%"
        });
        $("#age_type_select").chosen({
            disable_search: true,
            width: "100%"
        });
        $("#products_select, #orders_products_select").chosen({
            disable_search: false,
            width: "100%"
        });
        $("#categories_select, #orders_categories_select").chosen({
            disable_search: false,
            width: "100%"
        });
    });

</script>
{/literal}
