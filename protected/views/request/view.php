
<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Requests'=>array('index'),
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

	$('#ajaxlinkapprove').click(function(){
		$.ajax({
			type:'GET',
			url:  'approve',
			data: 'id=$model->id',
			beforeSend: function() {
						           $('#content').addClass('ajaxloading');
						        },
			complete: function() {
						          $('#content').removeClass('ajaxloading');
						        },
			success: function(data) {
				  var rid = $model->id;
				  
				  $.post('/ictweb/index.php/request/rdetail/'+rid,function(data){
						$('#detailview').html(data);
				  });
				  if(data=='Success')		
					alert('The request is now approved!');	
				  /* $('#ajaxmsg').html('The request is now approved!');
				  $('#ajaxmsg').show();
				  $('#ajaxmsg').animate({opacity: 0.9}, 1000).fadeOut('slow');*/
			
			 	  }
			});	
		return false;
	});	
	
	$('#ajaxlinkdisapprove').click(function(){
		$.ajax({
			type:'GET',
			url:  'disapprove',
			data: 'id=$model->id',
			beforeSend: function() {
						           $('#content').addClass('ajaxloading');
						        },
			complete: function() {
						          $('#content').removeClass('ajaxloading');
						        },
			success: function(data) {
				  var rid = $model->id;
				  
				  $.post('/ictweb/index.php/request/rdetail/'+rid,function(data){
						$('#detailview').html(data);
				  });
				  if(data=='Success')		
					alert('The request is now disapproved!');	
			 	  }
			});	
		return false;
	});	
	");

Yii::app()->clientScript->registerScript(
'myHideEffect',
'$(".alert-info").animate({opacity: 0.9}, 1000).fadeOut("slow");');

?>

<h3>View <medium>REQUEST <?php echo $model->id; ?></medium>&nbsp;

<?php if(Yii::app()->session['role']==3){?>
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("request/create",array("asDialog"=>1))?>"><i class="icon-plus"></i></a>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("request/update",array("id"=>$model->id,"asDialog"=>1))?>"><i class="icon-pencil"></i></a>&nbsp;
<a href="<?php echo Yii::app()->createUrl("request/admin")?>"><i class="icon-arrow-left"></i></a>&nbsp;
<?php }
if(Yii::app()->session['isAdmin']==1 and $model->statusid==1 or $model->statusid==5){?>
<a id="ajaxlinkapprove" href="#"><img src="<?php echo Yii::app()->theme->baseUrl . '/img/approve.png'?>" class="icon-"></a>&nbsp;
<?php 
}
if(Yii::app()->session['isAdmin']==1 and ($model->statusid==1 or $model->statusid==4)){?>
<a id="ajaxlinkdisapprove" href="#"><img src="<?php echo Yii::app()->theme->baseUrl . '/img/dislike.png'?>" class="icon-"></a>&nbsp;
<?php 
}

?>
</h3>
<hr>
<div id="detailview">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'itemTemplate'=> "<tr class=\"{class}\"><td style='width:20%'><b>{label}</b></td><td>{value}</td></tr>\n",	
	'attributes'=>array(
		array('name'=>'id'),
		array('label'=>'Recipient','name'=>'recipient','value'=>$model->recipient0->fullname." / ".$model->recipient0->pos->ptitle." - ".$model->recipient0->rbranch->brname),			
		'subj',
		'desc',
		array('label'=>'Category','name'=>'category_search','value'=>$model->category->ctitle),			
		'reqdate',
		'neededon',
		array('label'=>'Source','name'=>'rsouceid','value'=>$model->rsource->rsname),				
		array('name'=>'requestedby','value'=>$model->requestedby0->fullname." / ".$model->requestedby0->pos->ptitle." - ".$model->requestedby0->rbranch->brname),		
		array('label'=>'Attachment','type'=>'html','value'=>CHtml::link(CHtml::encode($model->attach1),'downloadfile?file='.$model->attach1), 'visible'=>empty($model->attach1) ? false: true),			
		array('label'=>'Remark','value'=>$model->remark),
		array('name'=>'statusid','value'=>$model->status->sname),			
	),
)); 
?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$dataProvider->search(),
	'filter'=>$dataProvider,
	'rowCssClassExpression'=>'(strtotime($data->actualfinish)>strtotime($data->finishdt) || ($data->actualfinish=="0000-00-00 00:00:00" and time()>strtotime($data->finishdt)))? "red":"even"',
		'rowHtmlOptionsExpression' => 'array("id"=>$data->requestid)',
		'columns'=>array(
		array('name'=>'resourceid', 'value'=>'$data->resource->fullname'), 
		'startdt',
		'finishdt',	
		'actualfinish',		
		array('name'=>'priorityid', 'value'=>'$data->priority->pname'),
		//array('name'=>'rsourceid', 'value'=>'$data->rsource->rsname'),
		//array('name'=>'assignedby', 'value'=>'$data->assignedby0->fullname'),
		//array('name'=>'wdeliverable','value'=>'$data->wdeliverable==0 ? "No": "Yes"'),	
		array('name'=>'wdeliverable',
				'value'=>'CHtml::checkBox("wdeliverable",$data->wdeliverable,array("value"=>$data->wdeliverable,"id"=>"cid_".$data->id))', 
				'type'=>'raw',
				'header'=>'w/DI',
        		'htmlOptions'=>array('width'=>'25',
        				
		),),
		'progress',
		//array('name'=>'statusid', 'value'=>'$data->status->sname'),
		'remark',
		array('name'=>'verified',
				'value'=>'CHtml::checkBox("verified",$data->verified,array("value"=>$data->verified,"id"=>"vid_".$data->id))',
				'type'=>'raw',
				'header'=>'V',
				'htmlOptions'=>array('width'=>'15'),				
		),
		array(
			'class'=>'CButtonColumn',
				'template'=>'{view}{update}{delete}{submit}{approve}{disapprove}',
				'buttons' => array(
						'view' => array(
								'url'=>'Yii::app()->createUrl("ticket/view", array("id"=>$data->id,"asDialog"=>1))',	
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
				
						),    // view button
						'update' => array(
								'url'=>'Yii::app()->createUrl("ticket/update", array("id"=>$data->id,"asDialog"=>1))',
								'visible'=>'($data->verified!=1 and $data->resourceid==Yii::app()->session["userid"]) or Yii::app()->session["role"]==3',							
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

						'delete' => array(
								'url'=>'Yii::app()->createUrl("ticket/delete", array("id"=>$data->id))',
								'visible'=>'Yii::app()->session["isAdmin"]==1',
						
						),    // delete button		

						'submit' => array(
								'url'=>'Yii::app()->createUrl("ticket/submit", array("id"=>$data->id,"asDialog"=>1))',
								'label'=>'request for close',
								'visible'=>'Yii::app()->session["userid"]==$data->resourceid and $data->progress!=100 and ($data->wdeliverable!=1 or ($data->wdeliverable==1 and $data->attach1!=""))',
								'imageUrl' => Yii::app()->theme->baseUrl . '/img/check.png',
								'click'=>'function(){
								var rid = $(this).closest("tr").attr("id");
								$.fn.yiiGridView.update("ticket-grid", {  
								        type:"GET",
								        url:$(this).attr("href"),
										beforeSend : function() {
											           $("#content").addClass("ajaxloading");
											        },
										complete : function() {
											          $("#content").removeClass("ajaxloading");
											        },
								        success:function(data) {
												
											  $("#detail-section").html(data);
								              $.fn.yiiGridView.update("ticket-grid"); 

									 		  $.post("/ictweb/index.php/request/rdetail/"+rid,function(data){
												$("#detailview").html(data);
											  });	
											alert("The ticket is successfully submitted for verification!");		
								        }
								    })
								    return false;
								  }
								',
						
						),    // submit button
						'approve' => array(
								'url'=>'Yii::app()->createUrl("ticket/approve", array("id"=>$data->id,"asDialog"=>1))',
								'visible'=>'Yii::app()->session["userid"]=='.$model->requestedby.' and $data->verified!=1',
								'imageUrl' => Yii::app()->theme->baseUrl . '/img/approve.png',
								'click'=>"function(){
								  var rid = $(this).closest('tr').attr('id');
								  if($(this).parent().parent().children(':nth-child(7)').text()<100){
										alert('This is not yet completed!');	
								  }
								  else{
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
								
											 $.post('/ictweb/index.php/request/rdetail/'+rid,function(data){
												$('#detailview').html(data);
											  });
											alert('The ticket is now approved!');		
								        }
								    })
									
								  }
								    return false;
								  }
								",
						
						),    // approve button						
						
						'disapprove' => array(
								'url'=>'Yii::app()->createUrl("ticket/unapprove", array("id"=>$data->id,"asDialog"=>1))',
								'visible'=>'Yii::app()->session["userid"]=='.$model->requestedby.' and $data->progress==100',
								'imageUrl' => Yii::app()->theme->baseUrl . '/img/dislike.png',
								'click'=>"function(){
									 var rid = $(this).closest('tr').attr('id');  
								  if($(this).parent().parent().children(':nth-child(7)').text()<100){
										alert('This is not yet completed!');	
								  }
								  else{
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
											$.post('/ictweb/index.php/request/rdetail/'+rid,function(data){
												$('#detailview').html(data);
											  });		
											alert('The ticket is now disapproved!');	
										}
								    })
									
								  }
								    return false;
								  }
								",
						
						),    // disapprove button
				),
		),
	),
)); ?>

<?php if(Yii::app()->session['role']==3 and $model->recipient==Yii::app()->session['userid'] and $model->statusid!=4){?>
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("ticket/create",array("asDialog"=>1,"id"=>$model->id,"dt"=>$model->neededon))?>"><i class="icon-plus"></i>Add Task</a>&nbsp;
<?php }?>

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
	echo '<div id="ajaxmsg" class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}

?>

<div id="ajaxmsg" class="alert-info"></div>
