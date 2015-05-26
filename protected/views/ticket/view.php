<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
	$model->id,
);

Yii::app()->clientScript->registerScript('submenu_ajax', "
	$('#returnlink').click(function(){	
			$('#dlg-detail').dialog('close');
		});
	$('.ajaxlink').click(function(){
		$.ajax({
			type:'GET',
			url: $(this).attr('href'),
			beforeSend: function() {
						           $('#content').addClass('ajaxloading');
						        },
			complete: function() {
						          $('#content').removeClass('ajaxloading');
						        },
			success: function(data) {
				  $('#detail-section').html(data);
	        }
		});
		return false;
	});

	");
?>

<h3>View <medium>TICKET <?php echo $model->id; ?></medium>&nbsp;
<!-- 
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("branch/create",array("asDialog"=>1))?>"><i class="icon-plus"></i></a>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("branch/update",array("id"=>$model->id,"asDialog"=>1))?>"><i class="icon-pencil"></i></a>&nbsp;
 -->
<a id="returnlink" href="#"><i class="icon-th-list"></i></a>&nbsp;
</h3>
<hr>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'itemTemplate'=> "<tr class=\"{class}\"><td style='width:30%'><b>{label}</b></td><td>{value}</td></tr>\n",	
	'attributes'=>array(
		'id',
		'requestid',
		array('name'=>'resourceid','value'=>$model->resource->fullname),
		array('name'=>'priorityid','value'=>$model->priority->pname),
		'startdt',
		'finishdt',
		'actualstart',
		'actualfinish',
		array('label'=>'Attachment','type'=>'html','value'=>CHtml::link(CHtml::encode($model->attach1),'downloadfile?file='.$model->attach1), 'visible'=>empty($model->attach1) ? false: true),	
		array('name'=>'assignedby','value'=>$model->assignedby0->fullname),
		'progress',
		'remark',
	),
)); ?>
