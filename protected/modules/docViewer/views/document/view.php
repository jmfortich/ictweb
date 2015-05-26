<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->id,
);


Yii::app()->clientScript->registerScript('submenu_ajax', "

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

Yii::app()->clientScript->registerScript(
'myHideEffect',
'$(".alert-info").animate({opacity: 0.9}, 1000).fadeOut("slow");');

?>

<h3>View <medium>DOCUMENT <?php echo $model->id; ?></medium>&nbsp;

<?php if(Yii::app()->session['role']==3){?>
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("docViewer/document/create",array("asDialog"=>1))?>"><i class="icon-plus"></i></a>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("docViewer/document/update",array("id"=>$model->id,"asDialog"=>1))?>"><i class="icon-pencil"></i></a>&nbsp;
<a href="<?php echo Yii::app()->createUrl("docViewer/document/admin")?>"><i class="icon-arrow-left"></i></a>&nbsp;
<?php }?>
</h3>
<hr>

<div style="height:800px;">

<?php 
$this->widget('ext.pdfJs.QPdfJs',array(
	'url'=>'/ictweb/docViewer/'.$model->attach1,
)
	
);


?>
</div>		
<?php /* $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'subject',
		'issuedby',
		'effectivitydt',
		'lstreviewdt',
		'dtadded',
		'isapprove',
		'attach1',
	),
)); */
?>