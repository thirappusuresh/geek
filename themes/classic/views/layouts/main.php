<!DOCTYPE html>
<html lang="en">
<head>

	<?php include_once("header.php") ?>
    
</head>

<body>
	<!-- Part 1: Wrap all page content here -->
	<div id="wrap">
		<div class="navbar navbar-fixed-top" id="top-menu">
			<div class="navbar-inner">
				<div class="container">
					  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					    <span class="icon-bar"></span>
					  </button>
					  <div class="nav-collapse collapse">
					    <ul class="nav">
					      <li><a title="My Profile" href="/geek/site/index">Jobs</a></li>  				          
					      <li>
					      	<?php if(Yii::app()->user->isGuest) { ?>
								<a title="Logout" href="/geek/site/login">Login or sign up</a>					      		
					      	<?php } 
					      	else { ?>
					      		<a title="Logout" href="/geek/site/logout"><?php echo "<b>".Yii::app()->user->name."</b> ";?>Logout</a>
							<?php } ?>					      
					      </li>
					    </ul>
					    
					    <div class="navbar-search pull-right">
				          	<?php $search = new Searchengine; ?>
					    	<?php $form=$this->beginWidget('CActiveForm', array(
								'id'=>'search-engine',
								'action' => Yii::app()->createUrl('site/searchengine'),
								'enableAjaxValidation'=>false,
					    		'htmlOptions'=>array('style'=>'margin: 0px;'),
							)); ?>
							<div class="row">
								<?php echo $form->textField($search,'searchtext',array('class'=>'search-query span2','placeholder'=>'Find a job...')); ?>							
								<?php echo $form->error($search,'searchtext'); ?>
								<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Search', 'htmlOptions'=>array('style'=>'margin-top: 0px;'))); ?>
							</div>
							<?php $this->endWidget(); ?>
				        </div>
					  </div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
	
		<div id="hide"></div>
			<div class="container-fluid">
				<?php echo $content; ?>
			</div>
		<div id="push"></div>
	
	</div>
	
	<?php include_once("footer.php") ?>
		
</body>
</html>