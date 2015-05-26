<?php
/* @var $this TicketController */
/* @var $model Ticket */

$this->breadcrumbs=array(
	'Tickets'=>array('index'),
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

<h3>Manage <medium> TICKETS</medium>
 <!-- <a id="addlink" href='<?php echo Yii::app()->createUrl("ticket/create",array("asDialog"=>1));?>'><i class="icon-plus"></i></a> -->
</h3>
 <hr>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->search(),
	'rowCssClassExpression'=>'(strtotime($data->actualfinish)>strtotime($data->finishdt) || ($data->actualfinish=="0000-00-00 00:00:00" and time()>strtotime($data->finishdt)))? "red":"even"',		
	'filter'=>$model,
	'columns'=>array(
		'id',
		//'requestid',
		array('name'=>'resource_search', 'value'=>'$data->resource->fullname','header'=>'Resource'), 
		'startdt',
		'finishdt',			
		'actualfinish',
		array('name'=>'priority_search', 'value'=>'$data->priority->pname','header'=>'Priority'),
		//array('name'=>'assignedby', 'value'=>'$data->assignedby0->fullname'),
		//array('name'=>'wdeliverable','value'=>'$data->wdeliverable==0 ? "No": "Yes"'),	
		array('name'=>'wdeliverable',
				'value'=>'CHtml::checkBox("wdeliverable",$data->wdeliverable,array("value"=>$data->wdeliverable,"id"=>"cid_".$data->id))', 
				'type'=>'raw',
				'header'=>'w/DI',
        		'htmlOptions'=>array('width'=>5),
				
		),
		'progress',
		//array('name'=>'statusid', 'value'=>'$data->status->sname'),
		array('name'=>'score', 'value'=>'($data->resourceid==Yii::app()->session["userid"] or Yii::app()->session["role"]==3) ? $data->computeScore($data->id): "****"','header'=>'Score'),
		'remark',
		/*
		'resolution',
		'actualstart',
		'actualfinish',

		*/
		array(
			'class'=>'CButtonColumn',
				'template'=>'{view}{update}{delete}',
				'buttons' => array(
						'view' => array(
								'url'=>'Yii::app()->createUrl("request/view", array("id"=>$data->requestid))',	
								/*'click'=>"function(){
								    $.fn.yiiGridView.update('ticket-grid', {  //change my-grid to your grid's name
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
								              $.fn.yiiGridView.update('ticket-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",*/
				
						),    // view button
						'update' => array(
								'url'=>'Yii::app()->createUrl("ticket/update", array("id"=>$data->id,"asDialog"=>1))',
								'visible' =>Yii::app()->session['isAdmin'],
								'click'=>"function(){
								    $.fn.yiiGridView.update('ticket-grid', {  //change my-grid to your grid's name
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
								              $.fn.yiiGridView.update('ticket-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",
								
						),    // update button		
						'delete'=>array(
								'visible' =>Yii::app()->session['isAdmin'],
								
						)										
						
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
