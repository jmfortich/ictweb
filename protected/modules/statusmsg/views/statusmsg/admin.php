<?php
/* @var $this StatusmsgController */
/* @var $model Statusmsg */

$this->breadcrumbs=array(
	'Statusmsgs'=>array('index'),
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

<h3>Manage <medium>STATUS MSG</medium>
 <a id="addlink" href='<?php echo Yii::app()->createUrl("statusmsg/statusmsg/create",array("asDialog"=>1));?>'><i class="icon-plus"></i></a>
</h3>
<hr>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'statusmsg-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		array('name'=>'user_search','value'=>'$data->user->fullname','header'=>'User'),
		'msg',
		'dateadded',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
				'buttons'=>array(
						'delete' => array(
								'visible'=>'Yii::app()->session["isAdmin"]==1'
						
						),    // update button
)
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
        	'open'=>'js:function(){$("#dlg-detail input:first").focus();}',
        ),
)); ?>
<div id="detail-section" style="dispay:none;"></div>
<hr><br>
<?php $this->endWidget(); 
echo "<br/>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div  class="alert alert-' . $key . '"><i class="icon-ok"></i> ' . $message . "</div>\n";
}
?>
