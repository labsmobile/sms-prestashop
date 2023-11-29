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
        <div class="col-md-3 col-lg-3">
            {include file="./parts/menu.tpl"}
        </div>
        <div class="col-md-9">
            <form id="lm_statistics_form" class="form-horizontal" action="{$url_config|escape:'htmlall':'UTF-8'}&action=statistics" method="post" enctype="multipart/form-data">
                <div id="form_filter" class="panel">
                    <div class="panel-heading"><i class="icon-bar-chart"></i> {l s='Statistics' mod='labsmobile'}</div>
                    
                    <div class="form-wrapper">
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='From' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" id="from" class="datepicker input-medium fixed-width-lg" size="5" name="from">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='To' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" id="to" class="datepicker input-medium fixed-width-lg" size="5" name="to">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='Country' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <select id="country" data-placeholder="{l s='Choose a country...' mod='labsmobile'}" multiple class="chosen fixed-width-lg" name="country[]">
                                        <option></option>
                                        {foreach from=$countries item=item_country key=call_prefix}
                                            <option value="{$call_prefix|escape:'htmlall':'UTF-8'}"{if isset($params_form['country']) && in_array($call_prefix, $params_form['country'])} selected="selected" {/if}>{$item_country|escape:'htmlall':'UTF-8'} (+{$call_prefix|escape:'htmlall':'UTF-8'})</option>
                                        {/foreach}
									</select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='Phone number' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" id="number" value="{$params_form['number']|escape:'htmlall':'UTF-8'}" class=" fixed-width-lg" size="5" name="number">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='Sender' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" id="sender" value="{$params_form['sender']|escape:'htmlall':'UTF-8'}" class=" fixed-width-lg" size="5" name="sender">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="lm_statistics_dates">
                                <label class="control-label col-lg-3">{l s='Message' mod='labsmobile'}</label>
                                <div class="col-lg-9">
                                    <input type="text" id="message" value="{$params_form['message']|escape:'htmlall':'UTF-8'}" class=" fixed-width-lg" size="5" name="message">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button type="submit" value="1" id="submitStatistics" name="submitStatistics" class="btn btn-default pull-right">
                            <i class="process-icon-ok"></i> {l s='Apply' mod='labsmobile'}
                        </button>
                    </div>
                </div>
            </form>
            {if $stats}
            <div id="stats" class="panel">
                <section class="chart_stats col-md-12">
                    <h2>{l s='Success rates' mod='labsmobile'}</h2>
                    <br />
                    <div id="dash_confirmed" class="chart with-transitions col-md-6">
                        <h4>{l s='Delivery rate' mod='labsmobile'}</h4>
                        <div class="value" style="color:{$data->stat_confirmed->color|escape:'htmlall':'UTF-8'}">{$data->stat_confirmed->value|escape:'htmlall':'UTF-8'}</div>
                        <svg></svg>
                    </div>
                    <div id="dash_error" class="chart with-transitions col-md-6">
                        <h4>{l s='Error rate' mod='labsmobile'}</hh43>
                        <div class="value" style="color:{$data->stat_error->color|escape:'htmlall':'UTF-8'}">{$data->stat_error->value|escape:'htmlall':'UTF-8'}</div>
                        <svg></svg>
                    </div>
                </section>
                <section class="chart_stats col-md-12">
                    <h2>{l s='Average times' mod='labsmobile'}</h2>
                    <br />
                    <div id="dash_confirmedtime" class="chart with-transitions col-md-6">
                        <h4>{l s='Average confirmation time' mod='labsmobile'}</h4>
                        <div class="value" style="color:{$data->stat_confirmedtime->color|escape:'htmlall':'UTF-8'}">{$data->stat_confirmedtime->value|escape:'htmlall':'UTF-8'}</div>
                        <svg></svg>
                    </div>
                    <div id="dash_processedtime" class="chart with-transitions col-md-6">
                        <h4>{l s='Average processing time' mod='labsmobile'}</h4>
                        <div class="value" style="color:{$data->stat_processedtime->color|escape:'htmlall':'UTF-8'}">{$data->stat_processedtime->value|escape:'htmlall':'UTF-8'}</div>
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Messages sent by day' mod='labsmobile'}</h2>
                    <div id="dash_chart_byday" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Credits by day' mod='labsmobile'}</h2>
                    <div id="dash_chart_bycday" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Messages sent by week' mod='labsmobile'}</h2>
                    <div id="dash_chart_byweek" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Credits by week' mod='labsmobile'}</h2>
                    <div id="dash_chart_bycweek" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Messages sent by month' mod='labsmobile'}</h2>
                    <div id="dash_chart_bymonth" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
                <section class="loading">
                    <h2>{l s='Credits by month' mod='labsmobile'}</h2>
                    <div id="dash_chart_bycmonth" class="chart with-transitions">
                        <svg></svg>
                    </div>
                </section>
            </div>
            {else}
                <div class="alert alert-info">
                    <h4>{l s='Statistics' mod='labsmobile'}</h4>
                    {l s='Filter your messages by sending date, countries and numbers of destination, sender, messages. You will get the statistics and reports of those messages that fulfill the filter conditions.' mod='labsmobile'}
                </div>
            {/if}
        </div>

       
    </div>
</div>

{literal}
<script type="text/javascript">
    $(document).ready(function() {
        $(".datepicker").datetimepicker({
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
        $("#from").datepicker('setDate', '{/literal}{$params_form['from']|escape:'quotes':'UTF-8'}{literal}');
        $("#to").datepicker('setDate', '{/literal}{$params_form['to']|escape:'quotes':'UTF-8'}{literal}');
        
        $("#country").chosen({
            disable_search: false
        });
    });
    var dataday = [
    {
        "title" : "{/literal}{l s='Error messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_error", 
        "disabled": false,
        "color": "#F66E1B",
        "values" : {/literal}{$data->stat_sentbyday->error|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Delivered messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_delivered", 
        "disabled": false,
        "color": "#FBB244",
        "values" : {/literal}{$data->stat_sentbyday->delivered|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Sent messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_sent", 
        "disabled": false,
        "color": "#F99031",
        "values" : {/literal}{$data->stat_sentbyday->sent|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_byday svg')
			.datum(dataday)
			.transition()
			.call(chart);

		$('#dash_chart_byday .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });
    var datacday = [
    {
        "title" : "{/literal}{l s='Credits' mod='labsmobile'}{literal}",
        "unit_text": "credits",
        "key": "credits", 
        "disabled": false,
        "color": "#3AC4ED",
        "values" : {/literal}{$data->stat_sentbyday->credits|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_bycday svg')
			.datum(datacday)
			.transition()
			.call(chart);

		$('#dash_chart_bycday .nv-legendWrap').remove();

        return chart;
    });

    var dataweek = [
    {
        "title" : "{/literal}{l s='Error messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_error", 
        "disabled": false,
        "color": "#F66E1B",
        "values" : {/literal}{$data->stat_sentbyweek->error|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Delivered messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_delivered", 
        "disabled": false,
        "color": "#FBB244",
        "values" : {/literal}{$data->stat_sentbyweek->delivered|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Sent messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_sent", 
        "disabled": false,
        "color": "#F99031",
        "values" : {/literal}{$data->stat_sentbyweek->sent|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_byweek svg')
			.datum(dataweek)
			.transition()
			.call(chart);

		$('#dash_chart_byweek .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });
    var datacweek = [
    {
        "title" : "{/literal}{l s='Credits' mod='labsmobile'}{literal}",
        "unit_text": "credits",
        "key": "credits", 
        "disabled": false,
        "color": "#3AC4ED",
        "values" : {/literal}{$data->stat_sentbyweek->credits|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_bycweek svg')
			.datum(datacweek)
			.transition()
			.call(chart);

		$('#dash_chart_bycweek .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });

    var datamonth = [
    {
        "title" : "{/literal}{l s='Error messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_error", 
        "disabled": false,
        "color": "#F66E1B",
        "values" : {/literal}{$data->stat_sentbymonth->error|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Delivered messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_delivered", 
        "disabled": false,
        "color": "#FBB244",
        "values" : {/literal}{$data->stat_sentbymonth->delivered|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Sent messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_sent", 
        "disabled": false,
        "color": "#F99031",
        "values" : {/literal}{$data->stat_sentbymonth->sent|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_bymonth svg')
			.datum(datamonth)
			.transition()
			.call(chart);

		$('#dash_chart_bymonth .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });
    var datacmonth = [
    {
        "title" : "{/literal}{l s='Credits' mod='labsmobile'}{literal}",
        "unit_text": "credits",
        "key": "credits", 
        "disabled": false,
        "color": "#3AC4ED",
        "values" : {/literal}{$data->stat_sentbymonth->credits|@json_encode|escape:'quotes':'UTF-8'}{literal}
    }
    ];
    var dash_chart;
    nv.addGraph(function() {
        var chart = nv.models.multiBarChart()
        .stacked(true)
		.showControls(false)
        .tooltipContent(function(key, y, e, graph) {
            if (graph.disabled == false)
				return '';
            if (key == 'messages_delivered' || key == 'messages_sent' || key == 'messages_error') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' SMS</span></div>';
                return result;
            }
            if (key == 'credits' || key == 'topups') {
                var result = '<div class="tooltip-panel"><div class="tooltip-panel-heading">' + graph.series.title + '</div><strong>';
                result += graph.point.y + ' {/literal}{l s='credits' mod='labsmobile'}{literal}</span></div>';
                return result;
            }
        });

        chart.yAxis.tickFormat(d3.format('.1f'));
		dash_chart = chart;
		d3.select('#dash_chart_bycmonth svg')
			.datum(datacmonth)
			.transition()
			.call(chart);

		$('#dash_chart_bycmonth .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });

    var data_stat_processedtime = {/literal}{$data->stat_processedtime->data|@json_encode|escape:'quotes':'UTF-8'}{literal};

    nv.addGraph(function() {
		var charts = nv.models.pieChart()
			.x(function(d) { return d.key })
            .y(function(d) { return d.y })
			.donut(true)
            .tooltips(false)
            .labelThreshold(.5)
			.showLabels(false)
			.showLegend(false)
            .donutRatio(0.45);
        
        charts.color(function(d){
            return d.data.color
        });

		d3.select("#dash_processedtime svg")
			.datum(data_stat_processedtime)
			.transition().duration(1200)
			.call(charts);
		
		nv.utils.windowResize(charts.update);

		return charts;
	});

    var data_stat_confirmedtime = {/literal}{$data->stat_confirmedtime->data|@json_encode|escape:'quotes':'UTF-8'}{literal};

    nv.addGraph(function() {
		var charts = nv.models.pieChart()
			.x(function(d) { return d.key })
            .y(function(d) { return d.y })
			.donut(true)
            .tooltips(false)
            .labelThreshold(.05)
			.showLabels(false)
			.showLegend(false)
            .donutRatio(0.45);
        
        charts.color(function(d){
            return d.data.color
        });

		d3.select("#dash_confirmedtime svg")
			.datum(data_stat_confirmedtime)
			.transition().duration(1200)
			.call(charts);
		
		nv.utils.windowResize(charts.update);

		return charts;
	});

    var data_stat_error = {/literal}{$data->stat_error->data|@json_encode|escape:'quotes':'UTF-8'}{literal};

    nv.addGraph(function() {
		var charts = nv.models.pieChart()
			.x(function(d) { return d.key })
            .y(function(d) { return d.y })
			.donut(true)
            .tooltips(false)
            .labelThreshold(.05)
            .labelType("percent")
			.showLabels(false)
			.showLegend(false)
            .donutRatio(0.45);
        
        charts.color(function(d){
            return d.data.color
        });

		d3.select("#dash_error svg")
			.datum(data_stat_error)
			.transition().duration(1200)
			.call(charts);
		
		nv.utils.windowResize(charts.update);

		return charts;
	});

    var data_stat_confirmed = {/literal}{$data->stat_confirmed->data|@json_encode|escape:'quotes':'UTF-8'}{literal};

    nv.addGraph(function() {
		var charts = nv.models.pieChart()
			.x(function(d) { return d.key })
            .y(function(d) { return d.y })
			.donut(true)
            .tooltips(false)
            .labelThreshold(.05)
            .labelType("percent")
			.showLabels(false)
			.showLegend(false)
            .donutRatio(0.45);

        charts.color(function(d){
            return d.data.color
        });

		d3.select("#dash_confirmed svg")
			.datum(data_stat_confirmed)
			.transition().duration(1200)
			.call(charts);
		
		nv.utils.windowResize(charts.update);

		return charts;
	});
</script>
{/literal}
