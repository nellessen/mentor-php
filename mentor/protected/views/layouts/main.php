<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="language" content="en" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Mentor is a micro-social network that helps you to achieve your goals by enlisting your friends.">
	<?php // @todo: Add Icons. ?>
	<?php /* Removed for using twitter bootstrap 
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	 */ ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php // @todo: Remove when solved: https://bitbucket.org/Crisu83/yii-bootstrap/issue/122/ ?>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link rel="stylesheet" type="text/css" href="/mentor/assets/e33f9c19/css/bootstrap-responsive.min.css" />
  <?php // End: Remove when solved ... ?>
  
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/mentor.css" />
</head>

<body id="top">

  <?php 
    $this->widget('bootstrap.widgets.BootNavbar',array(
      'fixed' => 'top',
      'brand' => CHtml::encode(Yii::app()->name),
      'collapse' => TRUE,
      'items'=>array(
        // Left menu.
        array(
          'class'=>'bootstrap.widgets.BootMenu',
          'items'=>array(
    				array('label'=>'Home', 'url'=>array('/site/index'), 'icon'=>'home white',  'linkOptions'=>array('title' => 'Go to front page')),
    				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
    				array('label'=>'Register', 'url'=>array('/user/create'), 'visible'=>Yii::app()->user->isGuest),
    				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
    				array('label'=>'Profile', 'url'=>array('/user/update', 'id' => Yii::app()->user->id), 'icon'=>'user white',  'linkOptions'=>array('title' => 'Update your profile'), 'visible'=>!Yii::app()->user->isGuest),
    				array('label'=>'Logout', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
          ),
          'htmlOptions'=>array('class'=>'pull-left'),
        ),
        // Right menu.
        array(
          'class'=>'bootstrap.widgets.BootMenu',
          'items'=>array(
            array('label'=>'Blog', 'url'=>'http://mentor-app.tumblr.com/', 'linkOptions'=>array('target'=>'_blank', 'title' => 'Blog about Mentor')),
            array('label'=>'Facebook', 'url'=>'http://www.facebook.com/MentorApp', 'linkOptions'=>array('target'=>'_blank', 'title' => 'Mentor on Facebook')),
    				array('label'=>'Contact', 'url'=>array('/site/contact'), 'linkOptions'=>array('title' => 'Contact Mentor Team')),
          ),
          'htmlOptions'=>array('class'=>'pull-right'),
        ),
      ),
    )); 
  ?>

<div class="container" id="page">

	<?php 
	  // @todo: Do we want a breadcrumb?
	  if(FALSE && isset($this->breadcrumbs)):
	?>
		<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
  <hr>
	<footer id="footer">
	  <p class="powered">
	    Mentor is a micro-social network that helps you to achieve your goals by enlisting your friends.<br>
      Mentor is the product of four young founders from Berlin, Germany.
		</p>
	</footer><!-- footer -->

</div><!-- page -->

</body>
</html>
