<?php
/* @var $this DocumentController */
/* @var $model Document */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('submenu_ajax', "
	$('#addlink').click(function(){
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

<h3>Manage <medium>DOCUMENTS</medium>
<?php if(Yii::app()->session['role']==3){?>
 <a id="addlink" href='<?php echo Yii::app()->createUrl("docViewer/document/create",array("asDialog"=>1));?>'><i class="icon-plus"></i></a>
<?php }?>
 </h3>
<hr>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'document-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'subject',
		array('name'=>'issuedby_search','value'=>'$data->issuedby0->fullname','header'=>'Issued by'),
		array('name'=>'group_search','value'=>'$data->group->gname','header'=>'Group'),			
		'effectivitydt',
		'lstreviewdt',			
		array('name'=>'isapprove','value'=>'$data->isapprove==0? "No": "Yes"'),
		/*
		'attach1',
		*/
		array(
			'class'=>'CButtonColumn',
				'template'=>'{view}{update}{delete}',
				'buttons' => array(
						/*'view' => array(
						 'url'=>'Yii::app()->createUrl("request/view", array("id"=>$data->id,"asDialog"=>1))',
								'click'=>"function(){
								$.fn.yiiGridView.update('request-grid', {  //change my-grid to your grid's name
										type:'GET',
										url:$(this).attr('href'),
										beforeSend : function() {
										$('#content').addClass('ajaxloading');
										},
										complete : function() {
										$('#content').removeClass('ajaxloading');
										},
										success:function(data) {
										$('#detail-section').html(data);
										$.fn.yiiGridView.update('request-grid'); //change my-grid to your grid's name
										}
										})
								return false;
								}
								",
				
						),  */  // view button
						'update' => array(
								'url'=>'Yii::app()->createUrl("docViewer/document/update", array("id"=>$data->id,"asDialog"=>1))',
								'visible'=>'$data->issuedby==Yii::app()->session["userid"]',
								'click'=>"function(){
								    $.fn.yiiGridView.update('document-grid', {  //change my-grid to your grid's name
								        type:'GET',
								        url:$(this).attr('href'),
										beforeSend : function() {
											           $('#content').addClass('ajaxloading');
											        },
										complete : function() {
											          $('#content').removeClass('ajaxloading');
											        },
								        success:function(data) {
											  $('#detail-section').html(data);
								              $.fn.yiiGridView.update('document-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",
				
						),    // update button
				
				),				
		),
	),
)); ?>

<?php

 $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
        'id' => 'dlg-detail',
        'options' => array(
            //'title' => false,
            'closeOnEscape' => true,
            'autoOpen' => false,
            'modal' => true,
        	'width' => auto,
        	'height' => auto,
        		'show'=>array(
	                'effect'=>'fade',
	                'duration'=>1000,
	            ),
        	'open'=>'js:function(){$(".ui-dialog-titlebar").hide();
        		$("#dlg-detail input:first").focus();}',
        	'close'=>'js:function(){$("#ui-datepicker-div").remove();}',
        ),
)); ?>
<div id="detail-section" style="dispay:none;"></div>
<hr><br>
<?php $this->endWidget(); 
echo "<br/>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}
?>

