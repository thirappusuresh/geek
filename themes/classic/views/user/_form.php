<div class="row-fluid">
	<div class="span10 offset1">
		<?php $this->widget('bootstrap.widgets.TbAlert', array(
		        'block'=>true, // display a larger alert block?
		        'fade'=>true, // use transitions?
		        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
		        'alerts'=>array( // configurations per alert type
		            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		        ),
		    ));
		?>
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'user-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>false,
		)); ?>
			<fieldset>
				<legend>Create an account</legend>
			
				<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>222)); ?>
			
				<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>222, 'hint'=>'Please provide an email address so that we can connect your account to your event tickets and unlock site features that are for ticket holders only')); ?>
			
				<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>222, 'hint'=>'You need a username to have a public profile at http://hasgeek.com/username (coming soon), where we’ll list the proposals you’ve made and the sessions you’ve taken up at HasGeek events, and jobs you’ve listed on the HasGeek Job Board')); ?>
					
				<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>222)); ?>
				
				<?php echo $form->passwordFieldRow($model,'confirmpassword',array('class'=>'span5','maxlength'=>222)); ?>
				
			</fieldset>
			<div class="form-actions">
				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'primary',
					'label'=>'Register',
				)); ?>
			</div>
		
		<?php $this->endWidget(); ?>
	</div>
</div>