<?php
/* @var $this DocumentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents',
);

$this->menu=array(
	array('label'=>'Create Document', 'url'=>array('create')),
	array('label'=>'Manage Document', 'url'=>array('admin')),
);
?>

<h3>Documents</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
