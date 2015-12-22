<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clearT extends CI_Controller {
     public function index()
     {
     }
     public function del()
     {
         $userName = 'testUser';
        /*** the upload directory ***/
        $upload_dir= 'TMP_UPLOAD';
        
        //User Upload Folder Name
        $upload_dir = $upload_dir.'/'.$userName;
         
        $this->deleteDir($upload_dir);
     }
     public function deleteDir($dirPath) {
        log_message('debug', '!!!!!DDDDEEEELLLLL!!!!!!!!'.$dirPath);
        if (!is_dir($dirPath)) {
            log_message('debug', $dirPath.' NOT A DIR?');
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

}