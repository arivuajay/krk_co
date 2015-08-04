<?php $this->widget('application.extensions.alphapager.ApGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{alphapager}\n{items}",

	'columns'=>array(
		'name',
	),
)); 

?>
