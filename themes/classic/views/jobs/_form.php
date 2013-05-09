<div class="row-fluid">
	<div class="span8 well offset2">
		
		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'jobs-form',
			'enableAjaxValidation'=>false,
			'type'=>'horizontal',
			'htmlOptions' => array('enctype' => 'multipart/form-data'),
		)); ?>
		
			<fieldset>
			<?php //echo $form->errorSummary($model); ?>
				<legend>
					<h3>List a job</h3>
					<p class="hint" style="font-size: 13px; line-height: 20px;">HasGeek reaches out to thousands of developers via events, blogs and discussion groups. Job listings made here will be shown across the network. Listings are valid for 30 days. Each job listing must be for one position only and must comply with the terms of service.</p>
				</legend>
				
				<h3>First, tell us about the position</h3>
				
				<?php if(isset($_GET['headline'])) { 
					$model->headline = 	$_GET['headline'];
				}?>
				
				<?php echo $form->textFieldRow($model,'headline',array('class'=>'span9','maxlength'=>222, 'hint'=>'A single-line summary. This goes to the front page and across the network')); ?>
			
				<?php echo $form->radioButtonListRow($model,'type',array(
									        'Full-time employment'=>'Full-time employment',
											'Short-term contract'=>'Short-term contract',
											'Freelance or consulting'=>'Freelance or consulting',
											'Volunteer contributor'=>'Volunteer contributor',
											'Partner for a venture'=>'Partner for a venture',
										)); ?>			
		
				<?php echo $form->radioButtonListRow($model,'category',array(
									        'Programming'=>'Programming',
											'Interaction Design'=>'Interaction Design',
											'Graphic Design'=>'Graphic Design',
											'Testing'=>'Testing',
											'Systems Administration'=>'Systems Administration',
											'Business/Management'=>'Business/Management',
											'Writer/Editor'=>'Writer/Editor',
											'Customer Support'=>'Customer Support',
											'Mobile (iPhone, Android, other)'=>'Mobile (iPhone, Android, other)',
											'Office Administration'=>'Office Administration',
										)); ?>

			
				<?php echo $form->textFieldRow($model,'location',array('class'=>'span5','maxlength'=>222, 'hint'=>'“Bangalore”, “Chennai”, “Pune”, etc or “Anywhere” (without quotes)')); ?>

				<?php echo $form->checkBoxRow($model,'relocation',array()); ?>
			
				<?php echo $form->textAreaRow($model,'job_description',array('rows'=>6, 'cols'=>50, 'class'=>'span11')); ?>
			
				<?php echo $form->textAreaRow($model,'job_perks_description',array('rows'=>6, 'cols'=>50, 'class'=>'span11')); ?>
			
				<?php echo $form->textAreaRow($model,'how_to_apply',array('rows'=>6, 'cols'=>50, 'class'=>'span11')); ?>
			
				<h3>Tell us about your company</h3>
				<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>222, 'hint'=>'The name of the organization where the position is. No intermediaries or unnamed stealth startups. Use your own real name if the company isn’t named yet. We do not accept listings from third parties such as recruitment consultants. Such listings may be removed without notice')); ?>
			

				<div class="control-group">
					<label class="control-label">Logo</label>
					<div class="controls">
						<?php if($model->logo) { ?>
							<img src="<?php echo Yii::app()->params['location'];?>upload/<?php echo $model->logo;?>" height="70" width="70" /> 
						<?php } ?>
						<?php echo $form->fileField($model, 'logo',array('class'=>'span5')); ?>
						<p class="help-block">Optional — Your company logo will appear at the top of your listing. 170px wide is optimal. We’ll resize automatically if it’s wider</p>
					</div>
				</div>
				<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>222,'hint'=>'Example: http://www.google.com')); ?>
			
				<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>222, 'hint'=>'This is where we’ll send your confirmation email. Use your company email id: listings are classified by your email domain. Your full email address will not be revealed to applicants.')); ?>
			
				<?php echo $form->radioButtonListRow($model,'privacy',array(
									        'No, it is NOT OK'=>'No, it is NOT OK',
											'Yes, it is OK'=>'Yes, recruiters may contact me',
										)); ?>		
			
				<div class="form-actions">
					<?php $this->widget('bootstrap.widgets.TbButton', array(
						'buttonType'=>'submit',
						'type'=>'primary',
						'label'=>$model->isNewRecord ? 'Create' : 'Save',
					)); ?>
				</div>
			</fieldset>
		<?php $this->endWidget(); ?>
	</div>
</div>