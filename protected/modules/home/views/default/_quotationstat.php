<?php
$data = DefaultController::actionquotestatRecords();
$amount_format = Myclass::GetSiteSetting("AMOUNT_FORMAT");
//var_dump($data['total_value']);
?>
<form class="form-inline span12">
    <label class="inline"><?php echo Myclass::t('From');?> :</label>
    <input type="text" id="from_quotes" value="<?php echo $data['quotemin_date']; ?>" class="hasDatePicker input-medium" autocomplete="off" />
    <label class="inline"><?php echo Myclass::t('To');?> :</label>
    <input type="text" id="to_quotes" value="<?php echo date(FORMAT_DATE);?>" class="hasDatePicker input-medium" autocomplete="off" />

    <label class="inline"><?php echo Myclass::t('Filter By');?> : </label>
    <select name="list_by_quote" id="list_by_quote" class="input-medium">
        <option value="salesmen" selected="selected"><?php echo Myclass::t('Salesmen');?></option>
        <option value="client"><?php echo Myclass::t('Client');?></option>
    </select>
    <select name="userlist"  id="userlist" class="input-medium">
	<option value=""><?php echo Myclass::t('Choose Person');?></option>
    </select>
</form>

<table class="table">
    <thead>
        <tr>
            <td><?php echo Myclass::t('Quotation Snapshot');?>:</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Myclass::t('Total Quotation');?> : <?php echo '<span id ="quote_qty">'.$data['quote_qty'].'</span>';?></td>
            <td><?php echo Myclass::t('Quotation Value');?>: <?php echo $amount_format.'<span id ="quote_value">'.$data['quote_value'].'</span>';?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><?php echo Myclass::t('Total SO');?> : <?php echo '<span id ="so_qty">'.$data['so_qty'].'</span>';?></td>
            <td><?php echo Myclass::t('SO Value');?> : <?php echo $amount_format.'<span id ="so_value">'.$data['so_value'].'</span>';?></td>
        </tr>
    </tbody>
</table>

<div class="chart_container" id="quotation_stat_div">

</div>
<?php
echo CHtml::script("
$(document).ready(function(){
    $('#from_quotes').datepicker({
            'autoSize':true,
	    'dateFormat':'yy-mm-dd',
	    'mode':'date',
	    'showOn':'focus',
	    'changeMonth':true,
	    'changeYear':true,
	    'htmlOptions':{'readonly':'readonly'},
//            onSelect: function(selected) {
//              $('#to_quotes').datepicker('option','minDate', selected)
//            }
    });
    $('#to_quotes').datepicker({
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
    updatePerson();
    $('#list_by_quote').live('change',function(){
	updatePerson();
    });
    $('#userlist').live('change',function(){
        UpdateChart();
    });
    
    $('#from_quotes,#to_quotes').live('change',function(){
        UpdateChart();
    });

    $("#chartmode").live('click',function(){
        UpdateChart();
    });

    $("#range_filter").live('change',function(){
        UpdateChart();
    });

//    function UpdateChart()
//    {
//        var filter = $('select[name=list_by_quote]').val();
//        var from_date = $('#from_quotes').val();
//        var to_date = $('#to_quotes').val();
//	var user = $('select[name=userlist]').val();
//
//        var url = '/home/default/quotationstatistics';
//        var data = {'from':from_date,'to':to_date,'filter':filter,'user':user};
//
//       $.ajax({
//             url: url,
//              data:data,
//              success: function(data) {
//                  updateChartXML('chart_quotestatistics',data);
//                }
//        });
//        $.ajax({
//              url: '/home/default/quotestatRecords',
//              dataType: 'json',
//              data:data,
//              success: function(data){
//                  $.each(data, function(k, v) {
//                      $('#'+k).text(v);
//                    });
//              }
//            });
//    }
    
    function updatePerson()
    {
	var filterby = $('select[name=list_by_quote]').val();

        var url = '/home/default/getquotationfilterby';
        var data = {'filterby':filterby};

       $.ajax({
             url: url,
              data:data,
	      dataType: 'json',
              success: function(result) {
		    $('#userlist').empty();
		    $.each(result,function(key,val) {
			$('#userlist').append('<option value="'+ key + '">' + val + '</option>');
		    });
                }
        });
    }
});
</script>

<?php
echo CHtml::script("
    // Load the Visualization API and the piechart package.
    google.load('visualization', '1', {'packages':['corechart']});
      
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(UpdateChart);
      
    function UpdateChart() {
    
    var filter = $('select[name=list_by_quote]').val();
        var from_date = $('#from_quotes').val();
        var to_date = $('#to_quotes').val();
	var user = $('select[name=userlist]').val();
        
        var data = {'from':from_date,'to':to_date,'filter':filter,'user':user};
        var data2 = {'from':from_date,'to':to_date,'filter':filter,'user':user,'update':1};
      var jsonData = $.ajax({
          url: \"/home/default/quotationstatistics\",
          dataType:\"json\",
          data:data,
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);
      var formatter = new google.visualization.NumberFormat(
      {prefix: '$', negativeColor: 'red', negativeParens: true});
       formatter.format(data, 1); // Apply formatter to second column
       
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.ColumnChart(document.getElementById('quotation_stat_div'));
      chart.draw(data, {width: 750, height: 300,vAxis: {format:'$'},title: 'Quotation Statistics'});
      
      $.ajax({
              url: '/home/default/quotestatRecords',
              dataType: 'json',
              data:data2,
              success: function(data){
                  $.each(data, function(k, v) {
                      $('#'+k).text(v);
                    });
              }
            });
    }");

