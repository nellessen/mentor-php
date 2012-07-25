<?php $this->beginContent('//layouts/main'); ?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <?php echo $content; ?>
    </div>
    <div class="span3">
    	<div id="sidebar">
    	<?php
    		$this->beginWidget('zii.widgets.CPortlet', array(
    			'title'=>'Operations',
    		));
    		$this->widget('zii.widgets.CMenu', array(
    			'items'=>$this->menu,
    			'htmlOptions'=>array('class'=>'operations'),
    		));
    		$this->endWidget();
    	?>
    	</div><!-- sidebar -->
    </div>
  </div>
</div>

<?php $this->endContent(); ?>