<?php
$data = DefaultController::actionSalestatRecords();
$amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
?>
<!--Load the AJAX API-->

<form class="form-inline span12">
    <label><?php echo Myclass::t('From');?> :</label>
	<input type="text" id="from_sales" value="<?php echo $data['so_min_date']; ?>" class="hasDatePicker input-medium" autocomplete="off" />
    <label><?php echo Myclass::t('To');?> :</label>
    <input type="text" id="to_sales" value="<?php echo date(FORMAT_DATE);?>" class="hasDatePicker input-medium" autocomplete="off" />
</form>
<table class="table">
    <thead>
        <tr>
            <td><?php echo Myclass::t('Sales Snapshot');?> :</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Myclass::t('Total SO Volume');?> : <?php echo '<span id ="total_qty">'.$data['total_qty'].'</span>';?></td>
            <td><?php echo Myclass::t('Total SO Value');?> : <?php echo $amount_format.'<span id ="total_value">'.$data['total_value'].'</span>';?></td>
        </tr>
        <tr>
            <td colspan="3">
                <label class="radio inline">
                        <input type="radio" name="chartmode_sales" id="chartmode_sales" checked="checked" value="product"> <?php echo Myclass::t('View By Product');?>
                </label>
                <label class="radio inline">
                    <input type="radio" name="chartmode_sales" id="chartmode_sales" value="category"> <?php echo Myclass::t('View By Category');?>
                </label>

                <label class="inline"><?php echo Myclass::t('Filter');?> : </label>
                <select name="range_filter_sale" id="range_filter_sale" class="input-small">
                    <option value="3"><?php echo Myclass::t('Top 3');?></option>
                    <option value="5" selected="selected"><?php echo Myclass::t('Top 5');?></option>
                    <option value="10"><?php echo Myclass::t('Top 10');?></option>
                </select>
            </td>
        </tr>
    </tbody>
</table>

<div class="chart_container" id="sales_statistics_chart">

</div>
<?php
echo CHtml::script("
$(document).ready(function(){
    $('#from_sales').datepicker({
            'autoSize':true,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'},
//            onSelect: function(selected) {
//              $('#to_sales').datepicker('option','minDate', selected)
//            }
    });
    $('#to_sales').datepicker({
	    'autoSize':true,
            'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'},
    });
});");
?>
<script type="text/javascript">
$(document).ready(function(){
    $('#from_sales,#to_sales').live('change',function(){
        UpdatesaleChart();
    });

    $("#chartmode_sales").live('click',function(){
        UpdatesaleChart();
    });

    $("#range_filter_sale").live('change',function(){
        UpdatesaleChart();
    });

//    function UpdatesaleChart()
//    {
//        var mode = $('input[name=chartmode_sales]:checked').val();
//        var filter = $('select[name=range_filter_sale]').val();
//        var from_date = $('#from_sales').val();
//        var to_date = $('#to_sales').val();
//
//        var url = '/home/default/salestatistics';
//        var data = {'from':from_date,'to':to_date,'viewby':mode,'filter':filter};
//
//       $.ajax({
//             url: url,
//              data:data,
//              success: function(data) {
//                  updateChartXML('chart_salestatistics',data);
//                }
//        });
//        $.ajax({
//              url: '/home/default/salestatRecords',
//              dataType: 'json',
//              data:data,
//              success: function(data){
//                  $.each(data, function(k, v) {
//                      $('#'+k).text(v);
//                    });
//              }
//            });
//    }
});
</script>
<?php
echo CHtml::script("
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(UpdatesaleChart);
      
    function UpdatesaleChart() {
    
    var mode = $('input[name=chartmode_sales]:checked').val();
        var filter = $('select[name=range_filter_sale]').val();
        var from_date = $('#from_sales').val();
        var to_date = $('#to_sales').val();
        
        var data = {'from':from_date,'to':to_date,'viewby':mode,'filter':filter};
        var data2 = {'from':from_date,'to':to_date,'viewby':mode,'filter':filter,'update':1};

      var jsonData = $.ajax({
          url: \"/home/default/salestatistics\",
          dataType:\"json\",
          data:data,
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('sales_statistics_chart'));
      chart.draw(data, {width: 700, height: 220,title: 'Sales Statistics'});
      
        $.ajax({
              url: '/home/default/salestatRecords',
              dataType: 'json',
             data:data2,
              success: function(data){
                  $.each(data, function(k, v) {
                      $('#'+k).text(v);
                    });
              }
            });

    }");
