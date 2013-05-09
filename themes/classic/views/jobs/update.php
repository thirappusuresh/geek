<?php
$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->name=>array('view','id'=>$model->jid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Jobs','url'=>array('index')),
	array('label'=>'Create Jobs','url'=>array('create')),
	array('label'=>'View Jobs','url'=>array('view','id'=>$model->jid)),
	array('label'=>'Manage Jobs','url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>