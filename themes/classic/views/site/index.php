<div class="row-fluid">
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
	        'block'=>true, // display a larger alert block?
	        'fade'=>true, // use transitions?
	        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
	        'alerts'=>array( // configurations per alert type
	            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
	        ),
	    ));
	?>
	<div class="span3 well" style="padding: 10px;">
		<?php /** @var BootActiveForm $form */
		$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
		    'id'=>'job-form',
		    'type'=>'vertical',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
					'validateOnSubmit'=>true),
			'htmlOptions'=>array('style'=>'margin: 0px;'),
		)); ?>
 
			<fieldset>
				<?php echo $form->textAreaRow($model, 'headline', array('rows'=>2, 'class'=>'span12', 'placeholder'=>'Awesome Coder wanted at Awesome Company', 'id'=>'headline')); ?></td>

				<?php $this->widget('bootstrap.widgets.TbButton', array(
					'buttonType'=>'submit',
					'type'=>'',
					'size'=>'small',
					'label'=>'Add details',
					'htmlOptions'=>array('style'=>'margin:0px 10px 0px 0px; float: right; display: none;'),
					'id'=>'add_details',
				)); ?>
			
		</fieldset>		
		<?php $this->endWidget(); ?>
	</div>
	<?php if($jobs) {
		foreach($jobs as $job) { ?>
			<div class="span3 well" style="padding: 10px; cursor: pointer;" onclick="location.href='/geek/jobs/view/id/<?php echo encrypt($job->jid);?>'">
				<span style="float: left;"><?php echo $job->location;?></span>
				<span style="float: right;"><?php echo date('F j',strtotime($job->created_on));?></span>
				<BR>
				<p style="padding: 10px; font-size: 18px;"><?php echo $job->headline;?></p>
				<p><span style="float: right;"><?php echo $job->name;?></span></p>
			</div>
		<?php }
	}?>
</div>

<script>
$(document).ready(function() {
    $("#headline").live('click', function (event) {
    	$("#add_details").slideDown();
    })
});
</script>