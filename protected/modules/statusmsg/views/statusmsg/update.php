<?php
/* @var $this StatusmsgController */
/* @var $model Statusmsg */

$this->breadcrumbs=array(
	'Statusmsgs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Statusmsg', 'url'=>array('index')),
	array('label'=>'Create Statusmsg', 'url'=>array('create')),
	array('label'=>'View Statusmsg', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Statusmsg', 'url'=>array('admin')),
);
?>

<h1>Update Statusmsg <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>