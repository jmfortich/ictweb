<?php
/* @var $this StatusController */
/* @var $model Status */

$this->breadcrumbs=array(
	'Statuses'=>array('index'),
	'Create',
);

Yii::app()->clientScript->registerScript('submenu_ajax', "
	$('#returnlink').click(function(){
			$('#dlg-detail').dialog('close');
		});
	");
?>

<h3>Create <medium>STATUS</medium>
<a id="returnlink" href="#"><i class="icon-th-list"></i></a>&nbsp;
</h3>
<hr>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>