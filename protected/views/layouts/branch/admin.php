<?php
/* @var $this BranchController */
/* @var $model Branch */

$this->breadcrumbs=array(
	'Branches'=>array('index'),
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

<h3>Manage <medium>BRANCHES</medium>
 <a id="addlink" href='<?php echo Yii::app()->createUrl("branch/create",array("asDialog"=>1));?>'><i class="icon-plus"></i></a>
</h3>
<hr>
 

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'branch-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'brcode',
		'brname',
		array(
			'class'=>'CButtonColumn',
				'template'=>'{view}{update}{delete}',
				'buttons' => array(
						'view' => array(
								'url'=>'Yii::app()->createUrl("branch/view", array("id"=>$data->id,"asDialog"=>1))',	
								'click'=>"function(){
								    $.fn.yiiGridView.update('branch-grid', {  //change my-grid to your grid's name
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
								              $.fn.yiiGridView.update('branch-grid'); //change my-grid to your grid's name
								        }
								    })
								    return false;
								  }
								",
				
						),    // view button
						'update' => array(
								'url'=>'Yii::app()->createUrl("branch/update", array("id"=>$data->id,"asDialog"=>1))',
								'click'=>"function(){
								    $.fn.yiiGridView.update('branch-grid', {  //change my-grid to your grid's name
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
								              $.fn.yiiGridView.update('branch-grid'); //change my-grid to your grid's name
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
            //'title' => 'Dialog Box Title',
            'closeOnEscape' => true,
            'autoOpen' => false,
            'modal' => true,
        	'width' => auto,
        	'height' => auto,
        ),
)); ?>
<div id="detail-section" style="dispay:none;"></div>
<?php $this->endWidget(); 
echo "<br/>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}
?>

