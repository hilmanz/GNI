
<div class="page_section" id="dashboard-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-dashboard">&nbsp;</span> Dashboard</h2>
        </div><!-- end .titlebox -->
        <div class="blackbox" id="dashreport">
        	<div class="row">
            	<div class="col4">
                	<div class="box">
                    	<h3 class="yellow"><?=get('total_collections')?></h3>
                        <h5><span class="ico icon-users">&nbsp;</span>Total Collections</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	<div class="col4">
                	<div class="box">
                    	<h3 class="green"><?=get('total_artists')?></h3>
                        <h5><span class="ico icon-user">&nbsp;</span>Total Artists</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	<div class="col4">
                	<div class="box">
                    	<h3 class="orange"><?=get('total_damaged')?></h3>
                        <h5><span class="ico icon-user2">&nbsp;</span>Butuh Perbaikan</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	
            </div><!-- end .row -->
        </div><!-- end .blackbox -->
        <div class="content">
            <div class="titlebox">
                <h2 class="fl"><span class="icon-bars">&nbsp;</span> Jumlah Submisi Terakhir</h2>
            </div><!-- end .titlebox -->
            <div id="charts" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->

<script>
var data = <?=json_encode(get('overall'))?>;
var categories = [];
var vals = [];
for(var i in data){
	categories.push(data[i].dt);
	vals.push(parseInt(data[i].total));
}
</script>
<script type="text/javascript">
	$(function () {
        $('#charts').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
			credits: {
                enabled: false
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Art Submission',
                data: vals
    
            }]
        });
    });

</script>
