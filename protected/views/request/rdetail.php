<?php
 $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'itemTemplate'=> "<tr class=\"{class}\"><td style='width:20%'><b>{label}</b></td><td>{value}</td></tr>\n",
		'attributes'=>array(
				'id',
				array('label'=>'Recipient','name'=>'recipient','value'=>$model->recipient0->fullname." / ".$model->recipient0->pos->ptitle." - ".$model->recipient0->rbranch->brname),
				'subj',
				'desc',
				array('label'=>'Category','name'=>'category_search','value'=>$model->category->ctitle),
				'reqdate',
				'neededon',
				array('label'=>'Source','name'=>'rsouceid','value'=>$model->rsource->rsname),
				array('name'=>'requestedby','value'=>$model->requestedby0->fullname." / ".$model->requestedby0->pos->ptitle." - ".$model->requestedby0->rbranch->brname),
				array('label'=>'Attachment','type'=>'html','value'=>CHtml::link(CHtml::encode($model->attach1),'downloadfile?file='.$model->attach1), 'visible'=>empty($model->attach1) ? false: true),

				array('name'=>'statusid','value'=>$model->status->sname),
		),
));
 ?>