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
                <div class="panel-heading"><i class="icon-search"></i> {l s='Message history' mod='labsmobile'} 
                    <span class="badge">{$messages_num|escape:'htmlall':'UTF-8'}</span>
                </div>

                <div class="table-responsive-row clearfix">
                    <table class="table table_messages">
                        <thead>
                            <tr class="nodrag nodrop">
                                <th class="left"><span class="title_box">{l s='Id' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Phone number' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Sender' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Message' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Credits' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Clicks' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Sent' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Status' mod='labsmobile'}</span></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="nodrag nodrop filter row_hover">
                                <th>
                                    <input class="filter" name="p_page" id="p_page" value="1" type="hidden">
                                    <input class="filter" name="p_id" id="p_id" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_number" id="p_number" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_sender" id="p_sender" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_message" id="p_message" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_credits" id="p_credits" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_clicks" id="p_clicks" value="" type="text">
                                </th>
                                <th class="left">
                                    <div class="date_range row">
 										<div class="input-group fixed-width-md center">
											<input class="filter" id="p_sent_from" name="p_sent_from" placeholder="{l s='From' mod='labsmobile'}" type="text">
											<span class="input-group-addon">
												<i class="icon-calendar"></i>
											</span>
										</div>
 										<div class="input-group fixed-width-md center">
											<input class="filter" id="p_sent_to" name="p_sent_to" placeholder="{l s='To' mod='labsmobile'}" type="text">
											<span class="input-group-addon">
												<i class="icon-calendar"></i>
											</span>
										</div>
									</div>
                                </th>
                                <th class="left">
                                    <select class="filter" onchange="$('#submitFilterButtonorder').focus();$('#submitFilterButtonorder').click();" id="p_status" name="p_status">
											<option value="" selected="selected">-</option>
											<option value="processed">{l s='Processed' mod='labsmobile'}</option>
                                            <option value="duplicated">{l s='Duplicated' mod='labsmobile'}</option>
                                            <option value="noformat">{l s='Format error' mod='labsmobile'}</option>
                                            <option value="test">{l s='Test' mod='labsmobile'}</option>
                                            <option value="error">{l s='Error' mod='labsmobile'}</option>
                                            <option value="undeliverable">{l s='Undeliverable' mod='labsmobile'}</option>
                                            <option value="rejected">{l s='Rejected' mod='labsmobile'}</option>
                                            <option value="expired">{l s='Expired' mod='labsmobile'}</option>
                                            <option value="delivered">{l s='Delivered' mod='labsmobile'}</option>
                                            <option value="sent">{l s='Sent' mod='labsmobile'}</option>
									</select>
                                </th>
                                <th class="actions">
                                    <span class="pull-right">
                                        <button type="submit" id="submitFilterButton" name="submitFilter" class="btn btn-default">
                                            <i class="icon-search"></i> {l s='Search' mod='labsmobile'}
                                        </button>
                                        <button type="button" id="clearFilterButton" name="clearFilter" class="btn btn-default">
                                            <i class="icon-times"></i> {l s='Clear' mod='labsmobile'}
                                        </button>
                                    </span>
                                </th>
                                <th></th>
                            </tr>
                        <thead>
                        <tbody>
                            {foreach from=$messages item=item_message name=loop}
                                <tr class="{if $smarty.foreach.loop.index % 2 == 0}odd{/if}">
                                    <td>{$item_message->id|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->number|escape:'htmlall':'UTF-8'} 
                                        {if isset($item_message->customer)}
                                            <small>(<a href="{urldecode($url_customer|escape:'url')}&id_customer={$item_message->customer->id|escape:'htmlall':'UTF-8'}&token={getAdminToken tab='AdminCustomers'}">{$item_message->customer->firstname|escape:'htmlall':'UTF-8'} {$item_message->customer->lastname|escape:'htmlall':'UTF-8'}</a>)</small>
                                        {else}
                                            {if !empty({$item_message->country})}
                                                <small>({$item_message->country|escape:'htmlall':'UTF-8'})</small>
                                            {/if}
                                        {/if}
                                    </td>
                                    <td>{$item_message->sender|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->message|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->credits|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->clicks|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->sent|escape:'htmlall':'UTF-8'}</td>
                                    <td><span class="badge">{$item_message->status|escape:'htmlall':'UTF-8'}</span></td>
                                    <td>{$item_message->updated|escape:'htmlall':'UTF-8'}</td>
                                    <td><div class="action_column"></div></td>
                                </tr>
                            {/foreach}
                        </tbody>
                        </thead>
                    </table>
                    <div class="col-lg-12">
                        <ul class="pagination">
                            <li class="disabled">
                                <a href="javascript:void(0);" id="pag_previoustop" class="pagination-link" data-page="1">
                                    <i class="icon-double-angle-left"></i>
                                </a>
                            </li>
                            <li class="disabled">
                                <a href="javascript:void(0);" id="pag_previous" class="pagination-link" data-page="{$pag_previous|escape:'htmlall':'UTF-8'}">
                                    <i class="icon-angle-left"></i>
                                </a>
                            </li>
                            {if $pag_more_previous}
                                <li class="disabled">
                                    <a href="javascript:void(0);">…</a>
                                </li>
                            {/if}
                            {foreach from=$pags_previous item=item_pags}
                                <li>
                                    <a href="javascript:void(0);" class="pagination-link" data-page="{$item_pags|escape:'htmlall':'UTF-8'}">{$item_pags|escape:'htmlall':'UTF-8'}</a>
                                </li>
                            {/foreach}
                            <li class="active">
                                <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_now|escape:'htmlall':'UTF-8'}">{$pag_now|escape:'htmlall':'UTF-8'}</a>
                            </li>
                            {foreach from=$pags_next item=item_pags}
                                <li>
                                    <a href="javascript:void(0);" class="pagination-link" data-page="{$item_pags|escape:'htmlall':'UTF-8'}">{$item_pags|escape:'htmlall':'UTF-8'}</a>
                                </li>
                            {/foreach}
                            {if $pag_more_next}
                                <li class="disabled">
                                    <a href="javascript:void(0);">…</a>
                                </li>
                            {/if}
                            <li>
                                <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_next|escape:'htmlall':'UTF-8'}">
                                    <i class="icon-angle-right"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_size|escape:'htmlall':'UTF-8'}">
                                    <i class="icon-double-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <button type="button" id="exportHistoric" name="exportHistoric" class="btn btn-default pull-right">
                        <i class="process-icon-download"></i> {l s='Export' mod='labsmobile'}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $("#p_sent_from,#p_sent_to").datetimepicker({
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
        $(document).on('click', 'ul.pagination li a', function(){
			$('#p_page').val($(this).attr('data-page'));
            $("#submitFilterButton").click();
        });
        $("#clearFilterButton").click(function() {
            $('#p_id').val('');
            $('#p_number').val('');
            $('#p_sender').val('');
            $('#p_message').val('');
            $('#p_credits').val('');
            $('#p_clicks').val('');
            $('#p_sent_from').val('');
            $('#p_sent_to').val('');
            $('#p_status').val('');
            $("#submitFilterButton").click();
        });
        $("#exportHistoric").click(function() {
            var p_id = $('#p_id').val();
            var p_number = $('#p_number').val();
            var p_sender = $('#p_sender').val();
            var p_message = $('#p_message').val();
            var p_credits = $('#p_credits').val();
            var p_clicks = $('#p_clicks').val();
            var p_sent_from = $('#p_sent_from').val();
            var p_sent_to = $('#p_sent_to').val();
            var p_status = $('#p_status').val();
            var p_page = $('#p_page').val();
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfilterhistoric&p_id='+p_id+'&p_number='+p_number+'&p_sender='+p_sender+'&p_message='+p_message+'&p_credits='+p_credits+'&p_clicks='+p_clicks+'&p_sent_from='+p_sent_from+'&p_sent_to='+p_sent_to+'&p_status='+p_status+'&p_page='+p_page+'&p_export=1'
            }).done(function(res) {
                const a = document.createElement("a");
                document.body.appendChild(a);
                a.style = "display: none";
                const blob = new Blob([res], {type: "octet/stream"}),
                url = window.URL.createObjectURL(blob);
                a.href = url;
                var datename = new Date();
                a.download = "export_" + formatDate(datename) + ".csv";
                a.click();
                window.URL.revokeObjectURL(url);
            });
        });
        
        $("#submitFilterButton").click(function() {
            $(".table_messages tbody").remove();
            $(".table_messages .list-empty").remove();
            $(".pagination li").remove();
            var p_id = $('#p_id').val();
            var p_number = $('#p_number').val();
            var p_sender = $('#p_sender').val();
            var p_message = $('#p_message').val();
            var p_credits = $('#p_credits').val();
            var p_clicks = $('#p_clicks').val();
            var p_sent_from = $('#p_sent_from').val();
            var p_sent_to = $('#p_sent_to').val();
            var p_status = $('#p_status').val();
            var p_page = $('#p_page').val();
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfilterhistoric&p_id='+p_id+'&p_number='+p_number+'&p_sender='+p_sender+'&p_message='+p_message+'&p_credits='+p_credits+'&p_clicks='+p_clicks+'&p_sent_from='+p_sent_from+'&p_sent_to='+p_sent_to+'&p_status='+p_status+'&p_page='+p_page+'&p_export=0'
            }).done(function(res) {
                var res_raw = JSON.parse(res);
                $(".table_messages").append(res_raw.table);
                $(".pagination").append(res_raw.pagination);
                $(".panel-heading .badge").html(res_raw.message_num);
                $('#p_page').val(1);
            });
        });
    });
</script>
{/literal}