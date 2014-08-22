<div class="page_section" id="dashboard-page">
    <div id="container">
        <div class="titlebox">
            <h2 class="fl"><span class="icon-dashboard">&nbsp;</span> Dashboard</h2>
        </div><!-- end .titlebox -->
        <div class="blackbox" id="dashreport">
        	<div class="row">
            	<div class="col4">
                	<div class="box">
                    	<h3 class="yellow">45</h3>
                        <h5><span class="ico icon-users">&nbsp;</span>Pegawai Tetap</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	<div class="col4">
                	<div class="box">
                    	<h3 class="green">36</h3>
                        <h5><span class="ico icon-user">&nbsp;</span>Pegawai Honorer</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	<div class="col4">
                	<div class="box">
                    	<h3 class="orange">17</h3>
                        <h5><span class="ico icon-user2">&nbsp;</span>Pensiun Bulan Depan</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            	<div class="col4">
                	<div class="box">
                    	<h3 class="purple">876</h3>
                        <h5><span class="ico icon-user4">&nbsp;</span>Data Jabatan</h5>
                    </div><!-- end .box -->
                </div><!-- end .col4 -->
            </div><!-- end .row -->
        </div><!-- end .blackbox -->
        <div class="content">
            <div class="titlebox">
                <h2 class="fl"><span class="icon-bars">&nbsp;</span> Data Pegawai</h2>
            </div><!-- end .titlebox -->
            <div id="charts" style="min-width: 310px; height: 300px; margin: 0 auto"></div>
        </div><!-- end .content -->
    </div><!-- end #container -->
</div><!-- end #home -->

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
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ]
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
                name: 'Data1',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]
    
            }, {
                name: 'Data2',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]
    
            }, {
                name: 'Data3',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]
    
            }, {
                name: 'Data5',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]
    
            }]
        });
    });

</script>
