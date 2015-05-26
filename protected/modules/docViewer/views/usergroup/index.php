<?php
/* @var $this UsergroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usergroups',
);

$this->menu=array(
	array('label'=>'Create Usergroup', 'url'=>array('create')),
	array('label'=>'Manage Usergroup', 'url'=>array('admin')),
);
?>

<h3>Usergroups</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
