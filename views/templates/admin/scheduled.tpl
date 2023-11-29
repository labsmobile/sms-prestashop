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
                <div class="panel-heading"><i class="icon-clock-o"></i> {l s='Scheduled messages' mod='labsmobile'} 
                    <span class="badge">{$messages_num|escape:'htmlall':'UTF-8'}</span>
                </div>

                <div class="table-responsive-row clearfix">
                    <table class="table table_messages">
                        <thead>
                            <tr class="nodrag nodrop">
                                <th class="left"><span class="title_box">{l s='Numbers' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Sender' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Message' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Sent' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Scheduled' mod='labsmobile'}</span></th>
                                <th class="left"><span class="title_box">{l s='Status' mod='labsmobile'}</span></th>
                                <th></th>
                                <th></th>
                            </tr>
                            <tr class="nodrag nodrop filter row_hover">
                                <th class="left">
                                    <input class="filter" name="p_page" id="p_page" value="1" type="hidden">
                                    <input class="filter" name="p_number" id="p_number" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_sender" id="p_sender" value="" type="text">
                                </th>
                                <th class="left">
                                    <input class="filter" name="p_message" id="p_message" value="" type="text">
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
                                    <div class="date_range row">
 										<div class="input-group fixed-width-md center">
											<input class="filter" id="p_scheduled_from" name="p_sent_from" placeholder="{l s='From' mod='labsmobile'}" type="text">
											<span class="input-group-addon">
												<i class="icon-calendar"></i>
											</span>
										</div>
 										<div class="input-group fixed-width-md center">
											<input class="filter" id="p_scheduled_to" name="p_sent_to" placeholder="{l s='To' mod='labsmobile'}" type="text">
											<span class="input-group-addon">
												<i class="icon-calendar"></i>
											</span>
										</div>
									</div>
                                </th>
                                <th class="left">
                                    <select class="filter" onchange="$('#submitFilterButtonorder').focus();$('#submitFilterButtonorder').click();" id="p_status" name="p_status">
											<option value="" selected="selected">-</option>
                                            <option value="scheduled">{l s='Scheduled' mod='labsmobile'}</option>
											<option value="processed">{l s='Processed' mod='labsmobile'}</option>
                                            <option value="error">{l s='Error' mod='labsmobile'}</option>
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
                                    <td>
                                        <small style="color: #959595;"><i>{$item_message->msisdns|truncate:30:"...":true|escape:'htmlall':'UTF-8'}</i></small><br />
                                        {l s='Total' mod='labsmobile'}: {$item_message->size|escape:'htmlall':'UTF-8'}
                                    </td>
                                    <td>{$item_message->tpoa|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->message|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->created|escape:'htmlall':'UTF-8'}</td>
                                    <td>{$item_message->scheduled|escape:'htmlall':'UTF-8'}</td>
                                    <td><span class="badge">{$item_message->status_str|escape:'htmlall':'UTF-8'}</span></td>
                                    <td>
                                        {if $item_message->status == 'scheduled'}
                                            <button type="button" data-id="{$item_message->id|escape:'htmlall':'UTF-8'}" id="cancelButton_{$item_message->id|escape:'htmlall':'UTF-8'}" name="cancelButton_{$item_message->id|escape:'htmlall':'UTF-8'}" class="cancelButton btn btn-default">
                                                <i class="icon-times"></i> {l s='Cancel' mod='labsmobile'}
                                            </button>
                                        {/if}
                                    </td>
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
                                    <a href="javascript:void(0);" class="pagination-link" data-page="{$item_pags|escape:'htmlall':'UTF-8'}">{$item_pags}</a>
                                </li>
                            {/foreach}
                            <li class="active">
                                <a href="javascript:void(0);" class="pagination-link" data-page="{$pag_now|escape:'htmlall':'UTF-8'}">{$pag_now}</a>
                            </li>
                            {foreach from=$pags_next item=item_pags}
                                <li>
                                    <a href="javascript:void(0);" class="pagination-link" data-page="{$item_pags|escape:'htmlall':'UTF-8'}">{$item_pags}</a>
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
                    <button type="button" id="cancelAll" name="cancelAll" class="btn btn-default pull-right">
                        <i class="process-icon-cancel"></i> {l s='Cancel All' mod='labsmobile'}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $("#p_sent_from,#p_sent_to,#p_scheduled_from,#p_scheduled_to").datepicker({
            prevText: '',
            nextText: '',
            dateFormat: 'yy-mm-dd',
            currentText: '{/literal}{l s='Now' js=1}{literal}',
            closeText: '{/literal}{l s='Done' js=1}{literal}',
        });
        $(document).on('click', 'ul.pagination li a', function(){
			$('#p_page').val($(this).attr('data-page'));
            $("#submitFilterButton").click();
        });
        $("#clearFilterButton").click(function() {
            $('#p_number').val('');
            $('#p_sender').val('');
            $('#p_message').val('');
            $('#p_sent_from').val('');
            $('#p_sent_to').val('');
            $('#p_scheduled_from').val('');
            $('#p_scheduled_to').val('');
            $('#p_status').val('');
            $("#submitFilterButton").click();
        });
        $(document).on('click', '.cancelButton', function(){
            $(".table_messages tbody").remove();
            $(".pagination li").remove();
            var p_number = $('#p_number').val();
            var p_sender = $('#p_sender').val();
            var p_message = $('#p_message').val();
            var p_sent_from = $('#p_sent_from').val();
            var p_sent_to = $('#p_sent_to').val();
            var p_scheduled_from = $('#p_scheduled_from').val();
            var p_scheduled_to = $('#p_scheduled_to').val();
            var p_status = $('#p_status').val();
            var p_page = $('#p_page').val();
            var p_id = $(this).attr('data-id');
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfilterscheduled&p_id='+p_id+'&p_number='+p_number+'&p_sender='+p_sender+'&p_message='+p_message+'&p_sent_from='+p_sent_from+'&p_sent_to='+p_sent_to+'&p_scheduled_from='+p_scheduled_from+'&p_scheduled_to='+p_scheduled_to+'&p_status='+p_status+'&p_page='+p_page
            }).done(function(res) {
                var res_raw = JSON.parse(res);
                $(".table_messages").append(res_raw.table);
                $(".pagination").append(res_raw.pagination);
                $(".panel-heading .badge").html(res_raw.message_num);
                $('#p_page').val(1);
            });
        });
        $("#cancelAll").click(function() {
            $(".table_messages tbody").remove();
            $(".pagination li").remove();
            var p_number = $('#p_number').val();
            var p_sender = $('#p_sender').val();
            var p_message = $('#p_message').val();
            var p_sent_from = $('#p_sent_from').val();
            var p_sent_to = $('#p_sent_to').val();
            var p_scheduled_from = $('#p_scheduled_from').val();
            var p_scheduled_to = $('#p_scheduled_to').val();
            var p_status = $('#p_status').val();
            var p_page = $('#p_page').val();
            var p_id = 'all';
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfilterscheduled&p_id='+p_id+'&p_number='+p_number+'&p_sender='+p_sender+'&p_message='+p_message+'&p_sent_from='+p_sent_from+'&p_sent_to='+p_sent_to+'&p_scheduled_from='+p_scheduled_from+'&p_scheduled_to='+p_scheduled_to+'&p_status='+p_status+'&p_page='+p_page
            }).done(function(res) {
                var res_raw = JSON.parse(res);
                $(".table_messages").append(res_raw.table);
                $(".pagination").append(res_raw.pagination);
                $(".panel-heading .badge").html(res_raw.message_num);
                $('#p_page').val(1);
            });
        });
        $("#submitFilterButton").click(function() {
            $(".table_messages tbody").remove();
            $(".pagination li").remove();
            var p_number = $('#p_number').val();
            var p_sender = $('#p_sender').val();
            var p_message = $('#p_message').val();
            var p_sent_from = $('#p_sent_from').val();
            var p_sent_to = $('#p_sent_to').val();
            var p_scheduled_from = $('#p_scheduled_from').val();
            var p_scheduled_to = $('#p_scheduled_to').val();
            var p_status = $('#p_status').val();
            var p_page = $('#p_page').val();
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfilterscheduled&p_number='+p_number+'&p_sender='+p_sender+'&p_message='+p_message+'&p_sent_from='+p_sent_from+'&p_sent_to='+p_sent_to+'&p_scheduled_from='+p_scheduled_from+'&p_scheduled_to='+p_scheduled_to+'&p_status='+p_status+'&p_page='+p_page
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