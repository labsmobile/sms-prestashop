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
            <form id="lm_sendsms_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=sendsms" method="post" enctype="multipart/form-data">
                <div class="panel">
                    <div class="panel-heading"><i class="icon-edit"></i> {l s='Send SMS' mod='labsmobile'}</div>

                    <div class="form-group">
                        <div id="lm_sendsms_RECIPIENTS">
                            <label class="control-label col-lg-2">{l s='Recipients' mod='labsmobile'}</label>
                            <div class="col-lg-10">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {if !isset($params_form['send_type']) || $params_form['send_type']=='nav-link1'}active{/if}" id="nav-link1" href="javascript:void(0)">{l s='Customers' mod='labsmobile'}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {if $params_form['send_type']=='nav-link4'}active{/if}" id="nav-link4" href="javascript:void(0)">{l s='Groups' mod='labsmobile'}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {if $params_form['send_type']=='nav-link2'}active{/if}" id="nav-link2" href="javascript:void(0)">{l s='Edit list' mod='labsmobile'}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {if $params_form['send_type']=='nav-link3'}active{/if}" id="nav-link3" href="javascript:void(0)">{l s='Import file' mod='labsmobile'}</a>
                                    </li>
                                </ul>

                                <div class="nav-linktab nav-link1_tab {if isset($params_form['send_type']) && $params_form['send_type']!='nav-link1'}hide{/if}">
                                    <div class="table-responsive-row clearfix">
                                        <table class="table table_customers">
                                            <thead>
                                                <tr class="nodrag nodrop">
                                                    <th></th>
													<th class="left"><span class="title_box">{l s='Name' mod='labsmobile'}</span></th>
										            <th class="left"><span class="title_box">{l s='E-mail' mod='labsmobile'}</span></th>
                                                    <th class="left"><span class="title_box">{l s='Address' mod='labsmobile'}</span></th>
                                                    <th class="left"><span class="title_box">{l s='Phone number' mod='labsmobile'}</span></th>
													<th></th>
									            </tr>
                                                <tr class="nodrag nodrop filter row_hover">
                                                    <th></th>
										            <th class="left">
														<input class="filter" name="p_name" id="p_name" value="" type="text">
													</th>
											        <th class="left">
														<input class="filter" name="p_email" id="p_email" value="" type="text">
													</th>
                                                    <th class="left">
														<input class="filter" name="p_address" id="p_address" value="" type="text">
													</th>
                                                    <th class="left">
														<input class="filter" name="p_phone" id="p_phone" value="" type="text">
													</th>
                                                    <th class="actions">
														<span class="pull-right">
                                                            <button type="submit" id="submitFilterButton" name="submitFilter" class="btn btn-default" data-list-id="order_return_state">
                                                                <i class="icon-search"></i> {l s='Search' mod='labsmobile'}
                                                            </button>
													    </span>
													</th>
									            </tr>
                                            <thead>
                                            <tbody>
                                                {foreach from=$customer_list item=item_customer}
                                                    <tr>
                                                        <td class="row-selector text-center">
															<input name="customer_stateBox[]" data-number="{$item_customer['phone']|escape:'htmlall':'UTF-8'}" data-id="{$item_customer['id_address']|escape:'htmlall':'UTF-8'}" value="{$item_customer['id_address']|escape:'htmlall':'UTF-8'}" class="noborder customer_stateBox" type="checkbox">
												        </td>
                                                        <td>{$item_customer['name']|escape:'htmlall':'UTF-8'}</td>
                                                        <td>{$item_customer['email']|escape:'htmlall':'UTF-8'}</td>
                                                        <td>{$item_customer['address']|escape:'htmlall':'UTF-8'}</td>
                                                        <td>{$item_customer['phone']|escape:'htmlall':'UTF-8'}</td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                {/foreach}
                                            </tbody>
                                            </thead>
                                        </table>
                                        <div class="row">
	                                        <div class="col-lg-6">
				                                <div class="btn-group">
			                                        <button type="button" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'customer_stateBox[]', true);return false;" class="btn btn-default"><i class="icon-check-sign"></i>&nbsp;{l s='Select all' mod='labsmobile'}</button>
                                                    <button type="button" onclick="javascript:checkDelBoxes($(this).closest('form').get(0), 'customer_stateBox[]', false);return false;" class="btn btn-default"><i class="icon-check-empty"></i>&nbsp;{l s='Deselect all' mod='labsmobile'}</button>
		                                        </div>
			                                </div>
	                                    </div>
                                        <div class="col-lg-12">
                                            <div class="help-block">{l s='You can use these variables: %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%.' mod='labsmobile'}</div>
                                        </div>
                                        <div class="row">
                                            <div class="alert alert-danger nonumbersfound nav-link1" style="display:none">{l s='No recipients selected. Please select one or more customers that will receive the message.' mod='labsmobile'}</div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="nav-linktab nav-link2_tab {if $params_form['send_type']!='nav-link2'}hide{/if}">
                                    <br />
                                    <textarea id="textarea_contacts" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;" name="textarea_contacts" class="textarea-autosize"></textarea>
                                    <div class="help-block">{l s='Introduce the numbers one per line or separated by commas. The numbers should begin with the corresponding country code and they must contain only digits [0-9].' mod='labsmobile'}</div>
                                    <div class="row">
                                        <div class="alert alert-danger nonumbersfound nav-link2" style="display:none">{l s='No recipients found. Please introduce numbers in the above textarea.' mod='labsmobile'}</div>
                                    </div>
                                </div>

                                <div class="nav-linktab nav-link3_tab {if $params_form['send_type']!='nav-link3'}hide{/if}">
                                    <br />
                                    <input id="file" name="file" data-url="{urldecode($url_config|escape:'url')}&amp;action=ajaximportfile" style="width:0px;height:0px;" type="file">
                                    <div id="file-add-numbers" class="hide">
                                        <div class="numbers alert alert-success"></div>
                                        <button type="button" id="cancel_button" class="btn btn-default" name="cancel"><i class="icon-arrow-left"></i> {l s='Cancel' mod='labsmobile'}</button>
                                        <input id="importfile_contacts" name="importfile_contacts" type="hidden" value="">
                                        <input id="importfile_lines" name="importfile_lines" type="hidden" value="">
                                    </div>
                                    <button class="btn btn-default" data-style="expand-right" data-size="s" type="button" id="file-add-button"><i class="icon-folder-open"></i> {l s='Add file' mod='labsmobile'}</button>
                                    <div class="help-block file-add-button_help">{l s='You can import phone numbers from a text or Excel file. The allowed extensions are: .xls, .xlsx, .txt and .csv. You can use variables depending on column order: %FIELD_1%, %FIELD_2%,... %FIELD_N%' mod='labsmobile'}</div>
                                    <div class="alert alert-danger" id="file-errors" style="display:none"></div>
                                    <div class="row">
                                        <div class="alert alert-danger nonumbersfound nav-link3" style="display:none">{l s='No recipients found. Please import a file that cointain a list of phone numbers.' mod='labsmobile'}</div>
                                    </div>
                                </div>
                                <div class="nav-linktab nav-link4_tab {if $params_form['send_type']!='nav-link4'}hide{/if}">
                                    <br />
                                    {if count($groups) > 0}
                                        <select id="groups" class="chosen form-control" name="groups" placeholder="{l s='Select a group of customers' mod='labsmobile'}">
                                            <option value=""></option>
                                            {foreach from=$groups item=group_item key=group_key}
                                                <option value="{$group_key|escape:'htmlall':'UTF-8'}">{$group_item|escape:'htmlall':'UTF-8'}</option>
                                            {/foreach}
                                        </select>
                                        <div class="col-lg-12">
                                            <div class="help-block">{l s='You can use these variables: %FIRSTNAME%, %LASTNAME%, %EMAIL%, %ADDRESS%, %POSTCODE%, %CITY%, %STATE%, %COUNTRY%.' mod='labsmobile'}</div>
                                        </div>
                                        <div class="row">
                                            <div class="alert alert-danger nonumbersfound nav-link4" style="display:none">{l s='No recipients selected. Please select one group.' mod='labsmobile'}</div>
                                        </div>
                                        
                                        <input type="hidden" value="" name="group_contacts" id="group_contacts">
                                    {else}
                                        <div class="help-block">{l s='Create a group of customers with conditions and filters.' mod='labsmobile'}</div>
                                        <a href="{$url_config|escape:'htmlall':'UTF-8'}&action=groupsnew" class="delete btn btn-default">
                                            <i class="icon-plus-circle"></i> {l s='Create group' mod='labsmobile'}
                                        </a>
                                    {/if}
                                    
                                    <div class="row">
                                        <div class="alert alert-danger nonumbersfound nav-link2" style="display:none">{l s='No recipients found. Please introduce numbers in the above textarea.' mod='labsmobile'}</div>
                                    </div>
                                </div>
                                <input id="numbers" name="numbers" type="hidden" value="">
                                <input id="address" name="address" type="hidden" value="">
                                <input id="send_type" name="send_type" type="hidden" value="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_sendsms_SENDER">
                            <label class="control-label col-lg-2">{l s='Sender' mod='labsmobile'}</label>
                            <div class="col-lg-10">
                                <input type="text" value="{$params_form['sender']|escape:'htmlall':'UTF-8'}" id="sender" maxlength="11" class="form-control tpl_sender" size="5" name="sender">
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="help-block">{l s='Max. size: 11 characters. The sender can only contain letters and numbers [a-zA-z0-9]. Only available in some countries that allow to customize the sender field.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div id="lm_sendsms_MESSAGE">
                            <label class="control-label col-lg-2">{l s='Message' mod='labsmobile'}</label>
                            <div class="col-lg-10">
                                {if count($templates_name) > 0}
                                    <select id="templates" class="chosen form-control" name="templates" placeholder="{l s='Select a template' mod='labsmobile'}">
                                        <option value=""></option>
                                        {foreach from=$templates_name item=template_item key=template_key}
                                            <option value="{$template_key|escape:'htmlall':'UTF-8'}">{$template_item|escape:'htmlall':'UTF-8'}</option>
                                        {/foreach}
                                    </select>
                                {/if}
                                <div id="message_plain" class="{if !isset($params_form['send_type']) || $params_form['send_type']=='nav-link1'}hide{/if}">
                                    <textarea style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;" name="message" id="message" class="textarea-autosize emo_sms tpl_sms">{$params_form['message']|escape:'htmlall':'UTF-8'}</textarea>
                                    <div class="alert alert-danger nomessagefound nav-link1" style="display:none">{l s='No message found, please introduce a message.' mod='labsmobile'}</div>
                                </div>
                                <div id="message_lang" class="{if isset($params_form['send_type']) && $params_form['send_type']!='nav-link1'}hide{/if}">
                                    {foreach from=$languages item=item_language}
                                        <div class="form-group translatable-field lang-{$item_language['id_lang']|escape:'htmlall':'UTF-8'}">
                                            <div class="col-lg-9">
                                                <textarea name="message_lang_{$item_language['id_lang']|escape:'htmlall':'UTF-8'}" id="message_lang_{$item_language['id_lang']|escape:'htmlall':'UTF-8'}" class="textarea-autosize emo_sms tpl_sms" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;">{$params_form['message_lang'][$item_language['id_lang']]}</textarea>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-default dropdown-toggle" tabindex="-1" data-toggle="dropdown">{$item_language['iso_code']|escape:'htmlall':'UTF-8'} <span class="caret"></span></button>
                                                <ul class="dropdown-menu">
                                                    {foreach from=$languages item=item_language_aux}
                                                        <li><a href="javascript:hideOtherLanguage({$item_language_aux['id_lang']|escape:'htmlall':'UTF-8'});" tabindex="-1">{$item_language_aux['name']|escape:'htmlall':'UTF-8'}</a></li>
                                                    {/foreach}
                                                </ul>
                                            </div>
                                        </div>
                                    {/foreach}
                                    <div class="alert alert-danger nomessagefound nav-link1" style="display:none">{l s='No message found, please introduce a message.' mod='labsmobile'}</div>
                                </div>
                            </div>
                            <div class="col-lg-10 col-lg-offset-2">
                                <div class="help-block">{l s='These are the characters allowed in a standard SMS message:' mod='labsmobile'} ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz 0123456789 @£¥èéùìòÇØøÅåΔΦΓΛΩΠΨΣΘΞÄÖÑÜ§äöñüà _^|{}[~]€ÆæßÉ!/\"#¤%&\'()*+,-.|:;<=>?¿. {l s='If you want to send other characters, emojis or symbols you must activate the option SMSUnicode in the Settings of this module.' mod='labsmobile'}</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">
                            {l s='Scheduled' mod='labsmobile'}
                        </label>
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="input-group">
                                    <input class="datepicker input-medium" id="scheduled" name="scheduled" type="text">
                                    <span class="input-group-addon"><i class="icon-calendar-empty"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-10 col-lg-offset-2">
                            <div class="help-block">{l s='Format: YYYY-MM-DD HH:MM. Select the data and time when you want to send the messages. Leave this field empty if you want to send the message now.' mod='labsmobile'}</div>
                        </div>
                    </div>
                    
                    <div class="panel-footer">
                        <button type="button" value="1" id="submitSendsms" name="submitSendsms" class="btn btn-default pull-right">
                            <i class="process-icon-ok"></i> {l s='Send' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{literal}
<script type="text/javascript">
    hideOtherLanguage({/literal}{$lang|escape:'htmlall':'UTF-8'}{literal});
    var templates = {/literal}{$templates|json_encode|escape:'quotes':'UTF-8'}{literal};
    $(document).ready(function() {
        
        $("#templates").change(function() {
            var id_template = $(this).val();
            var new_text = '';
            if(id_template in templates){
                new_text_a = templates[id_template];
                $.each(new_text_a, function( key, value ) {
                    if(value.length) {
                        $('#message_lang_'+key).val(value);
                    }
                });
                if(new_text_a[{/literal}{$lang|escape:'htmlall':'UTF-8'}{literal}].length) {
                    $('#message').val(new_text_a[{/literal}{$lang|escape:'htmlall':'UTF-8'}{literal}]);
                }
            }
            setTimeout(function() {
               $("#templates").val('').change(); 
               $('#templates').trigger("chosen:updated");
            }, 500);
        });

        $("#scheduled").datetimepicker({
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
        }).datepicker('setDate', '{/literal}{$params_form['scheduled']|escape:'htmlall':'UTF-8'}{literal}');
        
        $(".nav-tabs .nav-link").click(function() {
            $(".nav-tabs .nav-link").removeClass('active');
            $(this).addClass('active');
            $(".nav-linktab").addClass('hide');
            $("."+$(this).attr('id')+"_tab").removeClass('hide');
            if($(this).attr('id') == 'nav-link1' || $(this).attr('id') == 'nav-link4'){
                $('#message_plain').addClass('hide');
                $('#message_lang').removeClass('hide');
            } else {
                $('#message_lang').addClass('hide');
                $('#message_plain').removeClass('hide');
            }
        });   
        $("#cancel_button").click(function() {
            $('#importfile_contacts').val('');
            $('#file-add-button').show();
            $('.file-add-button_help').show();
            $('#file-add-numbers').addClass('hide');
            $('#file-add-numbers .numbers').html('');
        });
        $("#groups").change(function() {
            var p_group = $(this).val();
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxgetcontactsgroup&p_group='+p_group
            }).done(function(res) {
                $("#group_contacts").val(res);
            });
        });
        $("#submitFilterButton").click(function() {
            $(".table_customers tbody tr input:checkbox").not(':checked').parent().parent().remove();
            var p_name = $('#p_name').val();
            var p_email = $('#p_email').val();
            var p_address = $('#p_address').val();
            var p_phone = $('#p_phone').val();
            var p_selected = '0';
            $(".table_customers tbody tr input:checkbox").each( function() {
                p_selected = p_selected + ',' + $(this).val();
            });
            $.ajax({
                type: 'GET',
                dataType: "html",
                url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxfiltersendsms&p_selected='+p_selected+'&p_name='+p_name+'&p_email='+p_email+'&p_address='+p_address+'&p_phone='+p_phone
            }).done(function(res) {
                $(".table_customers").append(res);
            });
        });

        var file_add_button = Ladda.create(document.querySelector('#file-add-button'));
		var file_total_files = 0;

		$('#file').fileupload({
			autoUpload: true,
			acceptFileTypes: /(\.|\/)(csv|txt|xls|xlsx)$/i,
			singleFileUploads: true,
			start: function (e) {
				file_add_button.start();
			},
			fail: function (e, data) {
				$('#file-errors').html(data.errorThrown.message).show();
			},
			done: function (e, data) {
                var data_raw = JSON.parse(data.result);
                if(data_raw.error) {
                    
                } else {
                    $('#importfile_contacts').val(data_raw.numbers);
                    $('#importfile_lines').val(JSON.stringify(data_raw.lines).replace(/(["])/g, "\\$1"));
                    $('#file-add-button').hide();
                    $('.file-add-button_help').hide();
                    $('#file-add-numbers').removeClass('hide');
                    $('#file-add-numbers .numbers').html('{/literal}{l s='Numbers:' mod='labsmobile'}{literal} <strong>'+data_raw.numbers_count+'</strong>');
                }
			},
		}).on('fileuploadalways', function (e, data) {
			file_add_button.stop();
		}).on('fileuploadprocessalways', function (e, data) {
			var index = data.index,	file = data.files[index];
			if (file.error) {
				$('#file-errors').append('<strong>'+file.name+'</strong> ('+humanizeSize(file.size)+') : '+file.error).show();
				$(data.context).find('button').trigger('click');
			}
		});
        $('#file-add-button').on('click', function(e) {
			e.preventDefault();
			$('#file-success').hide();
			$('#file-errors').html('').hide();
			$('#file').trigger('click');
		});
        $('#submitSendsms').on('click', function(e) {
            $('.nonumbersfound').hide();
            $('.nomessagefound').hide();
            var activetab = $('.nav-link.active').attr('id');
            var numbers_str = '';
            var address_str = '';
            var message_val = '';
            if(activetab == 'nav-link1') {
                var message_empty = true;
                $('#message_lang textarea').each(function() {
                    if($(this).val().length !== 0) {
                        message_empty = false;
                        message_val = $(this).val();
                    }
                });
                if(message_empty) {
                    $('.nomessagefound').show();
                    return;
                }

                var numbers = [];
                var address = [];
                $('input.customer_stateBox:checked').each(function() {
                    numbers.push($(this).attr('data-number'));
                    address.push($(this).attr('data-id'));
                });
                numbers_str = numbers.join(',');
                address_str = address.join(',');
            }
            if(activetab == 'nav-link2') {
                if($('#message').val().length === 0) {
                    $('.nomessagefound').show();
                    return;
                }
                address_str = '';
                var textarea_value = $('#textarea_contacts').val();
                var numbers = [];
                if (textarea_value.indexOf(',') == -1) {
                    numbers = textarea_value.split(/\r?\n/);
                } else {
                    numbers = textarea_value.split(',');
                }
                numbers_str = numbers.join(',');
                message_val = $('#message').val();
            }
            if(activetab == 'nav-link3') {
                if($('#message').val().length === 0) {
                    $('.nomessagefound').show();
                    return;
                }
                address_str = '';
                numbers_str = $('#importfile_contacts').val();
                message_val = $('#message').val();
            }
            if(activetab == 'nav-link4') {
                $('#message_lang textarea').each(function() {
                    if($(this).val().length !== 0) {
                        message_empty = false;
                        message_val = $(this).val();
                    }
                });
                if(message_empty) {
                    $('.nomessagefound').show();
                    return;
                }

                address_str = '';
                numbers_str = $('#group_contacts').val();
            }
            if(numbers_str.length === 0) {
                $('.nonumbersfound.'+activetab).show();
            } else {

                if($('#sender').val().length === 0) {
                    $('#sender').val('LABSMOBILE');
                } else {
                    if($('#sender').val().length > 11) {
                        $('#sender').val($('#sender').val().substring(0,11));
                    }
                }

                $('#numbers').val(numbers_str);
                $('#address').val(address_str);
                $('#send_type').val(activetab);

                var response = $.ajax({
                    type: 'POST',
                    data: {
                      numbers: numbers_str
                    },
                    async: false,
                    url: '{/literal}{urldecode($url_config|escape:'url')}{literal}&action=ajaxchecknumbers'
                }).responseText;
                response = JSON.parse(response);

                var country_prices = $.map(response.country_prices, function(el, key) { return [ el, key ]; });
                var country_names = $.map(response.country_names, function(el, key) { return [ el, key ]; });
                var countries_str = '';
                $.each(response.countries, function (index, value) {
                    countries_str = response.country_names[index] + ': ' + value + ' {/literal}{l s='numbers' mod='labsmobile'}{literal} x ' + response.country_prices[index] + ' {/literal}{l s='credits' mod='labsmobile'}{literal}<br />' + countries_str;
                });

                $('#recipient_numbers_dialog').text(maxSizeStr(response.numbers.replace(',',', '), 40));
                $('#recipient_countries_dialog').html(countries_str);
                $('#recipient_total_dialog').text(response.numbers_count);
                $('#credits_dialog').text(response.credits);
                $('#credits_available_dialog').text(response.available);
                $('#sender_dialog').val($('#sender').val());
                $('#message_dialog').val(message_val);
                if($('#scheduled').val().length === 0) {
                    $('#scheduled_dialog').val('{/literal}{l s='Now' mod='labsmobile'}{literal}');
                } else {
                    $('#scheduled_dialog').val($('#scheduled').val());
                }
                $('#confirm_dialog').modal('toggle');
            }
            
		});
        $('#cancelSendsms').on('click', function(e) {
			$('#confirm_dialog').modal('toggle');
		});
        $('#confirmSendsms').on('click', function(e) {
            $(this).prop("disabled",true);
            $('#cancelSendsms').prop("disabled",true);
			$('#lm_sendsms_form').submit();
		});
        {/literal}{if isset($get['recipient'])}{literal}
            $('#textarea_contacts').val('{/literal}{$get['recipient']|escape:'htmlall':'UTF-8'}{literal}');
            $('#nav-link2').click();
        {/literal}{/if}{literal}
    });
    $("#groups").chosen({
        disable_search: false,
        width: "100%"
    });
</script>
{/literal}

<div id="confirm_dialog" class="modal fade">
    <div class="modal-dialog">
        <form id="lm_sendsmsdialog_form" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="panel">
                <div class="panel-heading"><i class="icon-check-circle-o"></i> {l s='Sending confirmation' mod='labsmobile'}</div>
                
                <div class="form-group">
                    <label class="control-label col-lg-2">
                        {l s='Recipients' mod='labsmobile'}
                    </label>
                    <div class="col-lg-10 control-label align-left">
                        <i><span id="recipient_numbers_dialog"></span></i><br />
                        <span id="recipient_countries_dialog"></span>
                        <strong>{l s='Total' mod='labsmobile'}: <span id="recipient_total_dialog"></span></strong>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">
                        {l s='Sender' mod='labsmobile'}
                    </label>
                    <div class="col-lg-10">
                        <input disabled id="sender_dialog" name="sender_dialog" class="inputtext" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">
                        {l s='Message' mod='labsmobile'}
                    </label>
                    <div class="col-lg-10">
                        <textarea disabled id="message_dialog" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 100px;" name="message_dialog" class="inputtext"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">
                        {l s='When' mod='labsmobile'}
                    </label>
                    <div class="col-lg-10">
                        <input disabled id="scheduled_dialog" name="scheduled_dialog" class="inputtext" type="text">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-lg-2">
                        {l s='Credits' mod='labsmobile'}
                    </label>
                    <div class="control-label col-lg-10 align-left">
                        <span id="credits_dialog" class="badge"></span> ({l s='Available' mod='labsmobile'}: <span id="credits_available_dialog"></span>)
                    </div>
                </div>
                
                <div class="panel-footer">
                    <button type="button" value="1" id="cancelSendsms" name="cancelSendsms" class="btn btn-default pull-left">
                        <i class="process-icon-cancel"></i> {l s='Cancel' mod='labsmobile'}
                    </button>
                    <button type="button" value="1" id="confirmSendsms" name="confirmSendsms" class="btn btn-default pull-right">
                        <i class="process-icon-ok"></i> {l s='Confirm' mod='labsmobile'}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>