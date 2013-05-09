<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="row-fluid">
	<div class="span6 offset3">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
		        'block'=>true, // display a larger alert block?
		        'fade'=>true, // use transitions?
		        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		        'alerts'=>array( // configurations per alert type
		            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		        ),
		    ));
		?>
		<?php /** @var BootActiveForm $form */
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'login-form',
		    'type'=>'horizontal',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
					'validateOnSubmit'=>true)
		)); ?>
		 
		<fieldset>
			<legend>Login</legend>
			<?php echo $form->textFieldRow($model, 'username', array('class'=>'span8')); ?>
			<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span8')); ?>
		</fieldset>		
		<div class="form-actions">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
				'buttonType'=>'submit',
				'type'=>'warning',
				'label'=>'Log In',
			)); ?>	
			<a class="btn btn-medium" href="/geek/user/create">Create a new account?</a>
		</div>
		
		<?php $this->endWidget(); ?>	
	</div>
</div>	