<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile('http://www.google.com/jsapi');
//$cs->registerScriptFile($baseUrl.'/js/jsapi.js');
//$cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
//$cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
//$cs->registerCoreScript('jquery' );
//$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/jquery-ui.js');
$cs->registerScriptFile($baseUrl.'/js/highcharts.js');
$cs->registerScriptFile($baseUrl.'/js/jquery.highchartTable-min.js');
?>

<script type="text/javascript">
$(document).ready(function() {
	$('table.highchart').highchartTable();
});
</script>

<?php 
if(Yii::app()->session['role']==3){
?>	




<div id="accordion3" >
		<h4><strong>Requests'Status Summary</strong></h4>
			<div id="result">
	            <table class="highchart" data-graph-container-before="1" data-graph-type="column">
	                <thead>
	                    <tr>
	                    <th>Month</th>	     
	                  <?php 
	                 		$statarr=CHtml::listData(Status::model()->findAll(), 'id', 'sname');
	                 		foreach($statarr as $val){
	                 ?>                   
	                        <th><?php echo $val;?></th>
					  <?php }?>
	                    </tr>
	                </thead>
	
	                <tbody>	                
	                 <?php 
	                 	if(!empty($result)){
	                 		for($x=1;$x<=12;$x++){
	                 ?>
	                 	<tr>
	                  		<td><?php echo date("F", mktime(0, 0, 0, $x, 10));?>
	                        <td><?php echo getCountfrmArr($result, $x, 1)?></td>
	                        <td><?php echo getCountfrmArr($result, $x, 2)?></td>
	                        <td><?php echo getCountfrmArr($result, $x, 3)?></td>	
	                        <td><?php echo getCountfrmArr($result, $x, 4)?></td>	
	                        <td><?php echo getCountfrmArr($result, $x, 5)?></td>	                                                
	                                                                        
	                    </tr>
	                  <?php }}
	                  	else
	                  	{ ?>	                    	                    
						<tr>
						<td colspan="5">No results found.</td>
						</tr>
	
						<?php }?>
	                </tbody>
	            </table>
	            
	            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::link('See all...',array('request/admin'))?> 
	
	</div></div>
<?php }?>

		<div id="accordion4" >
		<h4><strong>Tickets'Completion Summary</strong></h4>
			<div id="result">
	            <table class="highchart" data-graph-container-before="1" data-graph-type="column">
	                <thead>
	                    <tr>
	                        <th>Month</th>  
	                        <th>100% Complete</th> 
	                        <th>50%-99%</th>
	                        <th>Below 50%</th>               
	                    </tr>
	                </thead>
	
	                <tbody>
	                <?php 
	              	    if(!empty($result2)){
	                 		for($x=1;$x<=12;$x++){
	                 ?>
	                 	<tr>
	                  		<td><?php echo date("F", mktime(0, 0, 0, $x, 10));?>
	                        <td><?php echo getCountfrmArr2($result2, $x, 1)?></td>
	                        <td><?php echo getCountfrmArr2($result2, $x, 2)?></td>
	                        <td><?php echo getCountfrmArr2($result2, $x, 3)?></td>	                                                
	                    </tr>
	                  <?php }}
	                     else{?>                  	                    
						<tr>
						<td colspan="4">No results found.</td>
						</tr>
						<?php }?>
					
	                </tbody>
	            </table>
	            
	            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::link('See all...',array('ticket/admin'))?> 
	
	</div></div>
	<br/>
<?php 
//CVarDumper::dump($result,10,true);

function getCountfrmArr($result,$mon,$statusid){
	//CVarDumper::dump($arr,10,true);exit();
	$res=0;
	foreach($result as $row){
		if($row['mon']==$mon and $row['statusid']==$statusid){
			$res=$row['tally'];
			break;
		}
	}
	return $res;
}

function getCountfrmArr2($result2,$mon,$progress){
	//CVarDumper::dump($arr,10,true);exit();
	$res=0;
	foreach($result2 as $row){
		switch($progress){
			case 1: 
				if($row['mon']==$mon and $row['progress']==100){
					$res=$row['tally'];
				}
				break;
			case 2:
				if($row['mon']==$mon and $row['progress']<100 and $row['progress']>=50){
					$res=$row['tally'];
				}
				break;
			case 3:
				if($row['mon']==$mon and $row['progress']<50){
					$res=$row['tally'];
				}
				break;				
		}

	}
	return $res;
}
?>	
