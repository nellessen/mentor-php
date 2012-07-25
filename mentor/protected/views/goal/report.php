<?php
$this->breadcrumbs=array(
	'Goals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Goal','url'=>array('index')),
	array('label'=>'Manage Goal','url'=>array('admin')),
);
?>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="page-header">
        <h1>Report on your goal!</h1>
      </div>
      
      <?php if ($currentActivity) :?>
        <div id="report-form" class="row-fluid">
          <div class="span7">
            <h2>Accomplished your goal today?</h2>
            <blockquote>
              <p><?php print $currentActivity->description; ?></p>
            </blockquote>
        	</div>
        	<div class="span5">
          	<?php $this->widget('bootstrap.widgets.BootButton', array(
          		'buttonType'=>'link',
          	  'url' => array('goal/report', 'id'=>$model->id, 'status'=>'completed'),
              'icon'=>'thumbs-up white',
          		'type'=>'success',
          		'label'=>'Yes, I did!',
          	  'htmlOptions' => array('class'=> $currentActivity->status == 'completed' ? 'disabled' : '')
          	)); ?>
          	
          	<?php $this->widget('bootstrap.widgets.BootButton', array(
          		'buttonType'=>'link',
          	  'url' => array('goal/report', 'id'=>$model->id, 'status'=>'missed'),
              'icon'=>'thumbs-down white',
          		'type'=>'danger',
          		'label'=>'No, not today!',
          	  'htmlOptions' => array('class'=> $currentActivity->status == 'missed' ? 'disabled' : '')
          	)); ?>
        	</div>
        </div>
        <hr>
      <?php else: ?>
      <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
      <?php endif; ?>
      
      	
      <h2>Your performance so far:</h2>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Day</th>
            <th>Performance</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($model->activities as $activity): ?>
            <tr>
              <td><?php print $activity->getDayName("D - d.m.Y"); ?></td>
              <td>
                <?php 
                  switch ($activity->status) {
                    case "completed":
                      echo '<i class="icon-thumbs-up"></i> completed';
                      break;
                    case "missed":
                      echo '<i class="icon-thumbs-down"></i> missed';
                      break;
                    default:
                      echo '<i class="icon-fire"></i> on fire';
                      break;
                  }
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      
    </div>
    <div class="span3">
      <div class="page-header">
        <h1>Goal Details:</h1>
      </div>
      <?php $this->widget('bootstrap.widgets.BootDetailView',array(
      	'data'=>$model,
      	'attributes'=>array(
      		'description',
      	  'activityDescription',
      		'created',
      		//'active',
      		//'mentor1_email',
      		'mentor1_name',
      		//'mentor2_email',
      		'mentor2_name',
      		//'mentor3_email',
      		'mentor3_name',
      	),
      )); ?>
      <h2>Progress</h2>
      <?php $this->widget('bootstrap.widgets.BootProgress',array(
        'percent' => $model->progress,
        'type' => 'info'
      )); ?>
      <h2>Success</h2>
      <?php $this->widget('bootstrap.widgets.BootProgress',array(
        'percent' => $model->success,
        'type' => $model->success > 66 ? 'success' : ($model->success > 33 ? 'warning' : 'danger'),
      )); ?>
    </div>
  </div>
</div>
