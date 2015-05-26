<?php

$name = $_GET['file'];
//$upload_path = Yii::app()->request->hostInfo . Yii::app()->request->baseURL.'/protected/files/' ; // Yii::app()->params['uploadPath'];

//$upload_path = $_SERVER['DOCUMENT_ROOT'].'\\prjipcrdr\\protected\\files\\';
$upload_path = Yii::app()->basePath.'\\files\\';
if( file_exists( $upload_path.$name )){
	Yii::app()->getRequest()->sendFile( $name , file_get_contents( $upload_path.$name ) );
}
else{
//$this->render('download404');
	echo "The file does not exists.";
} 

?>