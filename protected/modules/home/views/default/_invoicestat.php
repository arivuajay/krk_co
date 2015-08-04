<?php
$data = DefaultController::actionInvoicestatRecords();
$amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
//var_dump($data);
?>
<form class="form-inline span12">
    <label><?php echo Myclass::t('From');?> :</label>
    <input type="text" id="from_inv" value="<?php echo $data['min_date']; ?>" class="hasDatePicker input-medium" autocomplete="off" />
    <label><?php echo Myclass::t('To');?> :</label>
    <input type="text" id="to_inv" value="<?php echo date(FORMAT_DATE);?>" class="hasDatePicker input-medium" autocomplete="off" />
</form>
<table class="table">
    <thead>
        <tr>
            <td><?php echo Myclass::t('Invoices Snapshot');?>:</td>
            <td><?php echo Myclass::t('Total of Invoices');?> : <?php echo '<span id ="total_count">'.$data['total_count'].'</span>';?></td>
            <td><?php echo Myclass::t('Invoice Value');?>: <?php echo $amount_format.' <span id ="total_inv_val">'.$data['total_inv_val'].'</span>';?></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Myclass::t('Paid Invoices');?> : <?php echo '<span id ="paid_count">'.$data['paid_count'].'</span>';?></td>
            <td><?php echo Myclass::t('Paid Value');?> : <?php echo $amount_format.' <span id ="paid_inv_val">'.$data['paid_inv_val'].'</span>';?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Myclass::t('Unpaid Invoices');?> : <?php echo '<span id ="unpaid_count">'.$data['unpaid_count'].'</span>';?></td>
            <td><?php echo Myclass::t('Unpaid Value');?> : <?php echo $amount_format.' <span id ="unpaid_inv_val">'.$data['unpaid_inv_val'].'</span>';?></td>
        </tr>
    </tbody>
</table>
Chart Type :
<label class="radio inline">
    <input type="radio" name="charttype" id="charttype" checked="checked" value="pie_chart"> <?php echo Myclass::t('Pie');?>
</label>
<label class="radio inline">
    <input type="radio" name="charttype" id="charttype" value="histogram"> <?php echo Myclass::t('Histogram');?>
</label>
<br />
<div class="chart_container">
    <div id ="pie_chart" data-type="chart">

    </div>
    <div id="histogram" class="hide" data-type="chart">
    
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#from_inv,#to_inv').live('change',function(){
        UpdateInv();
    });
    


    $("#charttype").live('click',function(){
        var val = $(this).val();
       $('div[data-type="chart"]').hide();
       $('#'+val).show();
//        alert(data);
//         updateChartType('chart_invoicestatistics','Column2D');
//        $("#chart_invoicestatistics").updateFusionCharts({"swfUrl": "FusionCharts/Column2D.swf"});
    });
});
</script>
<?php
$minDate = $data['min_date'];
echo CHtml::script("
$(document).ready(function(){
    $('#from_inv').datepicker({
            'autoSize':true,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'minDate':'{$minDate}',
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'},
//            onSelect: function(selected) {
//              $('#to_inv').datepicker('option','minDate', selected);
//		UpdateInv();
//            }
    });
    $('#to_inv').datepicker({
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

<?php
echo CHtml::script("
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(UpdateInv);
      
    function UpdateInv() {
    var from_date = $('#from_inv').val();
        var to_date = $('#to_inv').val();      
    var data = {'from':from_date,'to':to_date};   

      var jsonData = $.ajax({
          url: \"/home/default/invoicestatistics\",
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
      var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
      chart.draw(data, {width: 700, height: 220,title: 'Invoice Statistics'});
      
$.getJSON('/home/default/invoicestatRecords/from/'+from_date+'/to/'+to_date+'/update/1',function(data){
                  $.each(data, function(k, v) {
                      $('#'+k).text(v);
                    });
            });
    }");

echo CHtml::script("
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(UpdateInvBar);
      
    function UpdateInvBar() {
    var from_date = $('#from_inv').val();
        var to_date = $('#to_inv').val();      
    var data = {'from':from_date,'to':to_date};   

      var jsonData = $.ajax({
          url: \"/home/default/invoicestatistics\",
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
      var chart = new google.visualization.ColumnChart(document.getElementById('histogram'));
      chart.draw(data, {width: 700, height: 220,title: 'Invoice Statistics',vAxis: {format:'$'}});
      $.getJSON('/home/default/invoicestatRecords/from/'+from_date+'/to/'+to_date+'/update/1',function(data){
                  $.each(data, function(k, v) {
                      $('#'+k).text(v);
                    });
            });
    }");


