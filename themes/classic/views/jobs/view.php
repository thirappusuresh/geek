<?php
$this->breadcrumbs=array(
	'Jobs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Jobs','url'=>array('index')),
	array('label'=>'Create Jobs','url'=>array('create')),
	array('label'=>'Update Jobs','url'=>array('update','id'=>$model->jid)),
	array('label'=>'Delete Jobs','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->jid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Jobs','url'=>array('admin')),
);
?>

<div class="row-fluid">
	<div class="span8 well offset2">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
		        'block'=>true, // display a larger alert block?
		        'fade'=>true, // use transitions?
		        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		        'alerts'=>array( // configurations per alert type
		            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		        ),
		    ));
		?>
		<div class="row-fluid">
			<div class="span9">
				<h3><?php echo $model->headline; ?></h3>
				<p class="help-block"><?php echo 'Posted '.date('F j, Y',strtotime($model->created_on));?></p>
				<h4><?php echo $model->name;?></h4>
				<h5><?php echo $model->location;
					if($model->relocation==1) echo " (relocation assistance available)";
				?></h5>
				<p><?php echo $model->type." / ".$model->category." / All jobs by ".$model->name;?></p>
			</div>
			<div class="span3">
				<?php if($model->logo) {?>
					<img src="<?php echo Yii::app()->params['location'].'upload/'.$model->logo; ?>" width="100" height="100" />
				<?php } ?>
			</div>
		</div>
		<hr>	
		<?php echo $model->job_description;?>
		<h3>Images</h3>
		<?php if(Yii::app()->user->name == $model->email) { ?>
			<form method="post" action="<?php echo Yii::app()->params['root'];?>/jobs/upload_image/id/<?php echo $_GET['id'];?>" enctype="multipart/form-data">
				<input type="file" name="images[]" onchange="this.form.submit()" multiple/>
				<p class="help-block">Only images with .gif, .jpeg, .png are allowed</p>
			</form>	
		<?php } ?>
		<div class="row-fluid">
			<ul class="thumbnails">
				<?php if($model->images) { 
					foreach($model->images as $image) { ?>
						<li class="span3">
							<img src="<?php echo Yii::app()->params['location'];?>/upload/<?php echo $image->image; ?>" width="200px"/>
						</li>
				<?php }
				} ?>
			</ul>
		</div>
		<hr>	
		<h3>Job Perks</h3>
		<?php echo $model->job_perks_description;?>
		<hr>
		<h3>Apply for this position</h3>
		<?php if(Yii::app()->user->isGuest) { ?>
			<a class="btn btn-small" href="/geek/site/login">Login</a> to see instructions on how to apply. Your identity will not be revealed to the employer.</a>
		<?php } else {?>
		<?php echo $model->how_to_apply;?>
		<?php } ?>
		<hr>
		<?php echo $model->privacy." for recruiters, HR consultants, and other intermediaries to contact this employer about this position.";?>
	</div>
</div>