<?php
/* @var $this GroupController */
/* @var $model Group */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
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
?>

<h3>View <medium>GROUP: <?php echo $model->gname; ?></medium>&nbsp;

<?php if(Yii::app()->session['role']==3){?>
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("docViewer/group/create",array("asDialog"=>1))?>"><i class="icon-plus"></i></a>&nbsp;
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("docViewer/group/update",array("id"=>$model->id,"asDialog"=>1))?>"><i class="icon-pencil"></i></a>&nbsp;
<a href="<?php echo Yii::app()->createUrl("docViewer/group/admin")?>"><i class="icon-arrow-left"></i></a>&nbsp;
<?php }?>
</h3>
<hr>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usergroup-grid',
	'dataProvider'=>$dataProvider->search(),
	'filter'=>$dataProvider,
	'columns'=>array(
		'id',
		array('name'=>'userid','value'=>'$data->user->fullname'),
		'groupid',
		array(
			'class'=>'CButtonColumn',
				'template'=>'{delete}',
				'buttons' => array(
						'view' => array(
								'url'=>'Yii::app()->createUrl("docViewer/usergroup/view", array("id"=>$data->id,"asDialog"=>1))',
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
								              $.fn.yiiGridView.update('usergroup-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",
				
						),    // view button
						'update' => array(
								'url'=>'Yii::app()->createUrl("docViewer/usergroup/update", array("id"=>$data->id,"asDialog"=>1))',
								//'visible'=>'$data->verified!=1 and $data->resourceid==Yii::app()->session["userid"]',
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
								              $.fn.yiiGridView.update('usergroup-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",
				
						),    // update button
				
						'delete' => array(
								'url'=>'Yii::app()->createUrl("docViewer/usergroup/delete", array("id"=>$data->id))',
								'visible'=>'Yii::app()->session["isAdmin"]==1',
				
						),    // delete button
			),	
		),
	),
)); 

if(Yii::app()->session['role']==3){?>
<a class="ajaxlink" href="<?php echo Yii::app()->createUrl("docViewer/usergroup/create",array("asDialog"=>1,"id"=>$model->id))?>"><i class="icon-plus"></i>Add User</a>&nbsp;
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
        ),
)); ?>
<div id="detail-section" style="dispay:none;"></div>
<hr><br>
<?php $this->endWidget(); 
echo "<br/>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}

