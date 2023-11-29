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
        <div class="col-md-9 col-lg-6">
            <div class="panel">
                <div class="panel-heading"><i class="icon-dashboard"></i> {l s='Dashboard' mod='labsmobile'}</div>
                
                {if $data->num_messages > 0}
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input name="options" onchange="selectDashChart('topups');" type="radio"><i class="icon-circle" style="color:#9E5BA1"></i> {l s='Top ups' mod='labsmobile'}
                        </label>
                        <label class="btn btn-default">
                            <input name="options" onchange="selectDashChart('credits');" type="radio"><i class="icon-circle" style="color:#3AC4ED"></i> {l s='Credits' mod='labsmobile'}
                        </label>
                        <label class="btn btn-default active">
                            <input name="options" onchange="selectDashChart('messages');" type="radio"><i class="icon-circle" style="color:#F99031"></i> {l s='Messages' mod='labsmobile'}
                        </label>
                    </div>
                    <section class="loading">
                        <div id="dash_chart" class="chart with-transitions">
                            <svg></svg>
                        </div>
                    </section>
                    <div class="row">
                        <section class="chart_stats col-md-12">
                            <div id="dash_confirmed" class="chart with-transitions col-md-6">
                                <h3>{l s='Delivery rate' mod='labsmobile'}</h3>
                                <div class="value" style="color:{$data->stat_confirmed->color|escape:'htmlall':'UTF-8'}">{$data->stat_confirmed->value|escape:'htmlall':'UTF-8'}</div>
                                <svg></svg>
                            </div>
                            <div id="dash_error" class="chart with-transitions col-md-6">
                                <h3>{l s='Error rate' mod='labsmobile'}</h3>
                                <div class="value" style="color:{$data->stat_error->color|escape:'htmlall':'UTF-8'}">{$data->stat_error->value|escape:'htmlall':'UTF-8'}</div>
                                <svg></svg>
                            </div>
                            <div id="dash_confirmedtime" class="chart with-transitions col-md-6">
                                <h3>{l s='Average confirmation time' mod='labsmobile'}</h3>
                                <div class="value" style="color:{$data->stat_confirmedtime->color|escape:'htmlall':'UTF-8'}">{$data->stat_confirmedtime->value|escape:'htmlall':'UTF-8'}</div>
                                <svg></svg>
                            </div>
                            <div id="dash_processedtime" class="chart with-transitions col-md-6">
                                <h3>{l s='Average processing time' mod='labsmobile'}</h3>
                                <div class="value" style="color:{$data->stat_processedtime->color|escape:'htmlall':'UTF-8'}">{$data->stat_processedtime->value|escape:'htmlall':'UTF-8'}</div>
                                <svg></svg>
                            </div>
                        </section>
                    </div>
                {else}
                <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-default">
                            <input name="options" type="radio"><i class="icon-circle" style="color:#9E5BA1"></i> {l s='Top ups' mod='labsmobile'}
                        </label>
                        <label class="btn btn-default">
                            <input name="options" type="radio"><i class="icon-circle" style="color:#3AC4ED"></i> {l s='Credits' mod='labsmobile'}
                        </label>
                        <label class="btn btn-default active">
                            <input name="options" type="radio"><i class="icon-circle" style="color:#F99031"></i> {l s='Messages' mod='labsmobile'}
                        </label>
                    </div>
                    <table class="table table_groups">
                        <tbody>
                            <tr>
                                <td class="list-empty" colspan="10">
                                    <div class="list-empty-msg">
                                        <i class="icon-warning-sign list-empty-icon"></i> {l s='No records found' mod='labsmobile'}
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        </thead>
                    </table>
                {/if}
            </div>
        </div>

        <div class="col-md-12 col-lg-3">
            {if count($data->notifications) > 0}
                <section class="dash_newsl panel">
                    <h3><i class="icon-bullhorn"></i> {l s='Notifications' mod='labsmobile'}</h3>
                    <div class="dash_news_content">
                        {foreach from=$data->notifications item=message_item}
                            <article>
                                <span class="dash-news-date text-muted"><small>{$message_item->created|escape:'htmlall':'UTF-8'}</small></span> {$message_item->text|escape:'htmlall':'UTF-8'}.
                            </article>
                        {/foreach}
                    </div>
                </section>
            {/if}

            <section class="dash_news panel">
                <h3><i class="icon-rss"></i> {l s='LabsMobile news' mod='labsmobile'}</h3>
                <div class="dash_news_content">
                    {foreach from=$data->news item=news_item}
                        <article>
                            <h4><a href="{$news_item->link|escape:'url':'UTF-8'}" class="_blank">{$news_item->title|escape:'quotes':'UTF-8'}</a></h4>
                            <span class="dash-news-date text-muted">{$news_item->created|escape:'htmlall':'UTF-8'}</span>
                            <p>{$news_item->content|strip_tags|truncate:150:"...":true|escape:'quotes':'UTF-8'}</p>
                        </article>
                        <hr>
                    {/foreach}
                    <div class="text-center"><h4><a href="http://www.labsmobile.com/{if $default_lang->iso_code == 'es'}es{else}en{/if}/blog/" target="_blank">{l s='See more news' mod='labsmobile'}</a></h4></div>
                </div>
            </section>
        </div>
    </div>
</div>

{if $data->num_messages > 0}
{literal}
<script type="text/javascript">

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
    
    var data = [
    {
        "title" : "{/literal}{l s='Top ups' mod='labsmobile'}{literal}",
        "unit_text": "topups",
        "key": "topups", 
        "disabled": true,
        "color": "#9E5BA1",
        "values" : {/literal}{$data->topups|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Used credits' mod='labsmobile'}{literal}",
        "unit_text": "credits",
        "key": "credits", 
        "disabled": true,
        "color": "#3AC4ED",
        "values" : {/literal}{$data->credits|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Error messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_error", 
        "disabled": false,
        "color": "#F66E1B",
        "values" : {/literal}{$data->error|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Delivered messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_delivered", 
        "disabled": false,
        "color": "#FBB244",
        "values" : {/literal}{$data->delivered|@json_encode|escape:'quotes':'UTF-8'}{literal}
    },
    {
        "title" : "{/literal}{l s='Sent messages' mod='labsmobile'}{literal}",
        "unit_text": "messages",
        "key": "messages_sent", 
        "disabled": false,
        "color": "#F99031",
        "values" : {/literal}{$data->sent|@json_encode|escape:'quotes':'UTF-8'}{literal}
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
		d3.select('#dash_chart svg')
			.datum(data)
			.transition()
			.call(chart);

		$('#dash_chart .nv-legendWrap').remove();
		nv.utils.windowResize(chart.update);

        return chart;
    });
    function selectDashChart(type)
    {
        if (type !== false)
        {
            $.each(data, function(index, value) {
                if (value.unit_text == type)
                    value.disabled = false;
                else
                    value.disabled = true;
            });
        }
        d3.select('#dash_chart svg')
            .datum(data)
            .transition()
            .call(dash_chart);
        nv.utils.windowResize(dash_chart.update);
    }
    
</script>
{/literal}
{/if}
