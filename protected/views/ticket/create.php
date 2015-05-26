<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	'Create',
);
Yii::app()->clientScript->registerScript('submenu_ajax2', "
	$('#returnlink').click(function(){	
			$('#dlg-detail').dialog('close');
		});
	",CClientScript::POS_READY);
?>

<h3>Create <medium>TICKET</medium>
<a id="returnlink" href="#"><i class="icon-th-list"></i></a>&nbsp; 
</h3>
<hr>
 
 
<?php $this->renderPartial('_form', array('model'=>$model)); ?>