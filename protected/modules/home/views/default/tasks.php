<h1>My Tasks</h1>
<?php

echo CHtml::link('+ Create Task',"javascript:void(0);",array("onclick"=>"$('#create_task').slideToggle();"));
if($task->hasErrors()):
    echo CHtml::script("$(document).ready(function(){ $('#create_task').show(); });");
endif;
echo CHtml::script('$(document).ready(function() {  
	    var oTable = $("#list-table").dataTable({
			    "aoColumns": [{ "asSorting": [ "desc", "asc" ] },null,null],
			    "sDom": "<\'row-fluid\'<\'span6 date-range\'l><\'span6\'f>r>t<\'row-fluid\'<\'span6\'i><\'span6\'p>>",
   			    "sPaginationType": "bootstrap",			    
			    "oLanguage": {"sLengthMenu": "_MENU_ records per page","sInfo": "Showing _START_ to _END_ of _TOTAL_ records","sInfoEmpty":"","sEmptyTable":"Today You have notask"},
			    "fnDrawCallback": function ( oSettings ){
					if ( oSettings.bSorted || oSettings.bFiltered )
					{
					    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
					    {
						$("td:eq(0)", oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
					    }
					}
				    }
			}); 
			$.datepicker.regional[""].dateFormat = "'.JS_FORMAT_DATE.'";
			$.datepicker.setDefaults($.datepicker.regional[""]);
			oTable.columnFilter({
			    sPlaceHolder: "head:before",
			    aoColumns: [ 
				null,
				{ sSelector: ".date-range", type:"date-range" },
				null
			    ]

			});
			$(".date_range_filter").addClass("input-medium");
		    });');
?>
<div id="create_task" style="display: none;">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'items-form',
	'enableAjaxValidation'=>false,
)); 
echo $form->errorSummary(array($task),''); 
?>
<div class="modal-body">
    <div class="control-group">
	<?php echo $form->labelEx($task,'task_date',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo $this->getDatePicker('task_date',$task,''); ?>
	</div>
    </div>
    <div class="control-group">
	<?php echo $form->labelEx($task,'task_description',array('class'=>'control-label')); ?>
	<div class="controls">
	    <?php echo $form->textArea($task,'task_description'); ?>
	</div>
    </div>
    <div class="span4" style="margin-left: 180px;">
	<?php $this->widget('bootstrap.widgets.BootButton', array(
	    'buttonType'=>'submit', 
	    'type'=>'primary', 
	    'icon'=>'ok white', 
	    'label'=>'Save'
	)); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array(
	    'buttonType'=>'reset',	    
	    'label'=>'Close',
	    'icon'=>'remove', 
	    'htmlOptions'=>array('data-dismiss'=>'modal'),
	)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
</div>
<div class="pull-right clearfix"><?php echo CHtml::link('View All >>',"javascript:void(0);",array('onclick'=>'set_memebers();')) ?></div>
<table  border="0" cellspacing="0" class="table table-bordered table-striped" id="list-table" cellpadding="0">
<thead>
    <tr>
	    <th><?php echo Myclass::t('S.No');?></th>
	    <th><?php echo Myclass::t('Date');?></th>
	    <th><?php echo Myclass::t('Description');?></th>
    </tr>
</thead>
<tbody>
<?php foreach($records as $record): ?>
<tr class="updates">
	<td></td>
	<td><?php echo $record->task_date;?></td>
	<td><?php echo $record->task_description;?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<script type="text/javascript">
function set_memebers()
{
    var tableId = '#list-table';
    var urlData = '/home/default/tasks';
    //Retrieve the new data with $.getJSON. You could use it ajax too
    $.getJSON(urlData, null, function( json )
    {
    table = $(tableId).dataTable();
    oSettings = table.fnSettings();

    table.fnClearTable(this);

    for (var i=0; i<json.aaData.length; i++)
    {
	table.oApi._fnAddData(oSettings, json.aaData[i]);
    }

    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
    table.fnDraw();
    });
}
</script>	