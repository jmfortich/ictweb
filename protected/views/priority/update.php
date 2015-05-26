<?php
/* @var $this PriorityController */
/* @var $model Priority */

$this->breadcrumbs=array(
	'Priorities'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
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

<h3>Update <medium>PRIORITY <?php echo $model->id; ?></medium>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("priority/create")?>"><i class="icon-plus"></i></a>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("priority/view",array('id'=>$model->id))?>"><i class="icon-list-alt"></i></a>&nbsp;
<a id="returnlink" href="#"><i class="icon-th-list"></i></a>
</h3>
<hr>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>