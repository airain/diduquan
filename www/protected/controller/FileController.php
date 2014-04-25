<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/AppController");
class FileController extends AppController{
	
	public function beforeRun($resource, $action){
		parent::beforeRun($resource, $action);
	}

    public function index(){
    	//Just replace these
		return 404;
    }
    
	public function upload(){
		$valid = array(
			'success' => true,
			'message' => '成功'
		);
		$targetFolder = Doo::conf()->SITE_PATH.'files'; // Relative to the root
	
		$verifyToken = md5('unique_feiplus' . $_POST['timestamp']);
		
		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png','txt','cvs'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$valid['file'] = $targetFile;
			} else {
				$valid['success'] = false;
				$valid['message'] = "上传失败";
			}
		}
		
		echo json_encode($valid);
	}

}
?>