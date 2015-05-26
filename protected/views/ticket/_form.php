<?php
/* @var $this TicketController */
/* @var $model Ticket */
/* @var $form CActiveForm */
?>

<div class="form wide">

<?php 

//Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
Yii::import('application.extensions.timepicker.EJuiDateTimePicker');

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>true,
	'clientOptions'=>array('validateOnSubmit'=>true),
	'htmlOptions' =>array('enctype'=>"multipart/form-data" ),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'requestid'); ?>
		<?php 
				echo $form->textField($model,'requestid',array('readonly'=>true));
		?>
		<?php echo $form->error($model,'requestid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resourceid'); ?>
		<?php  
				  echo $form->dropDownList($model, 'resourceid', CHtml::listData(Profile::model()->findAll(array('order'=>'firstname ASC')), 'user_id', 'fullname'),array('disabled'=>Yii::app()->session['role']!=3));
						
		?>
		<?php echo $form->error($model,'resourceid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priorityid'); ?>
		<?php 
			  echo $form->dropDownList($model, 'priorityid', CHtml::listData(Priority::model()->findAll(), 'id', 'pname'),array('disabled'=>Yii::app()->session['role']!=3));
						
		?>
		<?php echo $form->error($model,'priorityid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startdt'); ?>
		<?php 
			$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
					'model'=>$model,
					'attribute'=>'startdt',
					'options'=>array(
							'showAnim'=>'blind',
							'showSecond'=>true,
                            'timeFormat'=>'hh:mm:ss',
                            'dateFormat'=>'yy-mm-dd',
							//'changeMonth' => true,
							//'changeYear' => true,
					),
			));
		//echo $form->textField($model,'startdt'); 
			/*	$this->widget('CJuiDateTimePicker',array(
						'model'=>$model, //Model object
						'attribute'=>'startdt', //attribute name
						'mode'=>'datetime', //use "time","date" or "datetime" (default)
						'language' => '',
											
						'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								'timeformat'=>'hh:mm:ss a',
								'showSecond'=>true,
								//'timeformat'=>'hh:mm:ss',
								'disabled'=>Yii::app()->session['role']!=3,
								
				) // jquery plugin options
				));*/
				
		?>
		<?php echo $form->error($model,'startdt'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'finishdt'); ?>
		<?php 
		$this->widget('application.extensions.timepicker.EJuiDateTimePicker',array(
				'model'=>$model,
				'attribute'=>'finishdt',
				'options'=>array(
						'showAnim'=>'blind',
						'showSecond'=>true,
						'timeFormat'=>'hh:mm:ss',
						'dateFormat'=>'yy-mm-dd',
						//'changeMonth' => true,
						//'changeYear' => true,
				),
		));
		// echo $form->textField($model,'finishdt'); 
				/*
				$this->widget('CJuiDateTimePicker',array(
						'model'=>$model, //Model object
						'attribute'=>'finishdt', //attribute name
						'mode'=>'datetime', //use "time","date" or "datetime" (default)
						'language' => '',
						'options'=>array(
								'dateFormat'=>'yy-mm-dd',
								//'timeFormat'=>strtolower(Yii::app()->locale->timeFormat),
								'timeformat'=>'hh:mm:ss',
								'showSecond'=>true,
								
								'disabled'=>Yii::app()->session['role']!=3,
				) // jquery plugin options
				));*/
		?>
		<?php echo $form->error($model,'finishdt'); ?>
	</div>
<!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'actualstart'); ?>
		<?php echo $form->textField($model,'actualstart'); ?>
		<?php echo $form->error($model,'actualstart'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'resolution'); ?>
		<?php echo $form->textArea($model,'resolution',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'resolution'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'actualfinish'); ?>
		<?php echo $form->textField($model,'actualfinish'); ?>
		<?php echo $form->error($model,'actualfinish'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assignedby'); ?>
		<?php echo $form->textField($model,'assignedby'); ?>
		<?php echo $form->error($model,'assignedby'); ?>
	</div>
	
-->
	<div class="row">
		<?php echo $form->labelEx($model,'progress'); ?>
		<?php echo $form->textField($model,'progress'); ?>
		<?php echo $form->error($model,'progress'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'wdeliverable'); ?>
		<?php 
			 	echo $form->dropDownList($model, 'wdeliverable', array(0=>'No',1=>'Yes'),array('disabled'=>Yii::app()->session['role']!=3));
		?>
		<?php echo $form->error($model,'wdeliverable'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'remark'); ?>
		<?php // echo $form->textField($model,'remark',array('size'=>60,'maxlength'=>100)); 
			echo $form->textArea($model,'remark',array('rows'=>4, 'cols'=>50))
		?>
		<?php echo $form->error($model,'remark'); ?>
	</div>
	<?php if($model->wdeliverable==1){?>
	<div id="divattach1" class="row">
	    <?php echo $form->labelEx($model,'attach1'); ?>
	    <?php echo $form->fileField($model,'attach1'); ?>
		<?php  //  echo $form->error($model, 'attach1', array('clientValidation' => 'js:customValidateFile(messages)'), false, true);	?>
		<?php echo $form->error($model, 'attach1');	?>
	</div>	
	<?php }?>
	<div class="row buttons">
		<?php 
			if($model->isNewRecord)
				echo CHtml::submitButton( 'Create',array('class'=>'btn-primary')); 							
			else{
				if($model->wdeliverable==1)
					echo CHtml::submitButton( 'Save',array('class'=>'btn-primary','onclick'=>'return validation(this);')); 
				else
					echo CHtml::submitButton( 'Create',array('class'=>'btn-primary')); 	
			}	?>	
	</div>

<?php $this->endWidget(); 

?>

</div><!-- form -->

<script type="text/javascript">

 function validation(thisform)
 {
    with(thisform)
    {
       if(validateFileExtension(Ticket_attach1, "Ticket_attach1_em_", "pdf/office/image files are only allowed!",
       new Array("jpg","pdf","jpeg","gif","png","doc","docx","xls","xlsx","ppt","txt","")) == false)
       {
          return false;
       }
       if(validateFileSize(Ticket_attach1,1048576, "Ticket_attach1_em_", "Document size should be less than 1MB!")==false)
       {
          return false;
       }
    }
 }

 function validateFileExtension(component,msg_id,msg,extns)
 {
    var flag=0;
    with(component)
    {
       var ext=value.substring(value.lastIndexOf('.')+1);
       for(i=0;i<extns.length;i++)
       {
          if(ext==extns[i])
          {
             flag=0;
             break;
          }
          else
          {
             flag=1;
          }
       }
       if(flag!=0)
       {
          document.getElementById(msg_id).innerHTML=msg;
		  document.getElementById("divattach1").className="row error";
		  document.getElementById(msg_id).style="";
          return false;
       }
       else
       {
          return true;
       }
    }
 }

 function validateFileSize(component,maxSize,msg_id,msg)
 {
    if(navigator.appName=="Microsoft Internet Explorer")
    {
       if(component.value)
       {
          var oas=new ActiveXObject("Scripting.FileSystemObject");
          var e=oas.getFile(component.value);
          var size=e.size;
       }
    }
    else
    {
       if(component.files[0]!=undefined)
       {
          size = component.files[0].size;
       }
    }
    if(size!=undefined && size>maxSize)
    {
    	document.getElementById(msg_id).innerHTML=msg;
		document.getElementById("divattach1").className="row error";
		document.getElementById(msg_id).style="";       

       return false;
    }
    else
    {
       return true;
    }
 }

</script>