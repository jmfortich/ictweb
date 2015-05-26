<?php
/* @var $this StatusmsgController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Statusmsgs',
);

$this->menu=array(
	array('label'=>'Create Statusmsg', 'url'=>array('create')),
	array('label'=>'Manage Statusmsg', 'url'=>array('admin')),
);
?>

<h3>Statusmsgs</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
