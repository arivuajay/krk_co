<?php
$data = DefaultController::actionSalestatRecords();
$amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
//var_dump($data['total_value']);
$min_date = Company::model()->mindate()->find();
$cmp_min_date = date(FORMAT_DATE,strtotime($min_date->CmpMinDate));
?>
<form class="form-inline span12">
    <label><?php echo Myclass::t('From');?> :</label>
    <input type="text" id="from_client" value="<?php echo $cmp_min_date; ?>" class="hasDatePicker input-medium" autocomplete="off" />
    <label><?php echo Myclass::t('To');?> :</label>
    <input type="text" id="to_client" value="<?php echo date(FORMAT_DATE);?>" class="hasDatePicker input-medium" autocomplete="off" />
</form>
<table class="table">
    <tbody>
        <tr>
            <td>
                <label class="radio inline">
                        <input type="radio" name="range_filter_client" id="range_filter_client" value="3"> <?php echo Myclass::t('Top 3');?>
                </label>
                <label class="radio inline">
                    <input type="radio" name="range_filter_client" id="range_filter_client" checked="checked" value="5"> <?php echo Myclass::t('Top 5');?>
                </label>
                <label class="radio inline">
                    <input type="radio" name="range_filter_client" id="range_filter_client" value="10"> <?php echo Myclass::t('Top 10');?>
                </label>

                <label class="inline"><?php echo Myclass::t('List By');?> : </label>
                <select name="list_by_client" id="list_by_client" class="input-medium">
                    <option value="earnval" selected="selected"><?php echo Myclass::t('Earning -Life Time Value');?></option>
                    <option value="avgorder"><?php echo Myclass::t('Average Order Value');?></option>
                    <option value="orderqty"><?php echo Myclass::t('No Of Orders');?></option>
                </select>
            </td>
        </tr>
    </tbody>
</table>

<div class="chart_container" id="client_statistics_div">

</div>
<?php
echo CHtml::script("
$(document).ready(function(){
    $('#from_client').datepicker({
            'autoSize':true,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'},
//            onSelect: function(selected) {
//              $('#to_client').datepicker('option','minDate', selected)
//            }
    });
    $('#to_client').datepicker({
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
    $('#from_client,#to_client').live('change',function(){
        UpdateChartClient();
    });

    $("#range_filter_client").live('click',function(){
        UpdateChartClient();
    });

    $("#list_by_client").live('change',function(){
        UpdateChartClient();
    });

//    function UpdateChartClient()
//    {
//        var mode = $("#list_by_client").val();
//        var range_filter = $('input[name=range_filter_client]:checked').val();
//        var from_date = $('#from_client').val();
//        var to_date = $('#to_client').val();
//
//        var url = '/home/default/clientstatistics';
//        var data = {'from':from_date,'to':to_date,'viewby':mode,'filter':range_filter};
//
//       $.ajax({
//             url: url,
//              data:data,
//              success: function(data) {
//                  updateChartXML('chart_clientstatistics',data);
//                }
//        });
//    }
});
</script>
<?php
echo CHtml::script("
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(UpdateChartClient);
       
    function UpdateChartClient() {
        
        var mode = $(\"#list_by_client\").val();
        var range_filter = $('input[name=range_filter_client]:checked').val();
        var from_date = $('#from_client').val();
        var to_date = $('#to_client').val();
        var data = {'from':from_date,'to':to_date,'viewby':mode,'filter':range_filter};        
    
      var jsonData = $.ajax({
          url: \"/home/default/clientstatistics\",          
          data:data,
          dataType:\"json\",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      var formatter = new google.visualization.NumberFormat(
      {prefix: '$', negativeColor: 'red', negativeParens: true});
       formatter.format(data, 1); // Apply formatter to second column

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('client_statistics_div'));
      chart.draw(data, {width: 700, height: 220,title: 'Client Statistics'});
    }");
