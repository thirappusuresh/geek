<?php
$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Jobs','url'=>array('index')),
	array('label'=>'Manage Jobs','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>