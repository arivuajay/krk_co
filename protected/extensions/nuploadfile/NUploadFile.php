<?php

/*
 * Nupload file behavior
 * @author	Naser Kholghi <kholghi67@gmail.com>
 * @link	https://github.com/na3r/NUploadFile
 * @version 1.0
 */

class NUploadFile extends CActiveRecordBehavior {

    protected $_uploadDirectory;
    protected $_fileField;
    protected $_tmpFile;
    /*
     * set true if you want to delete the file on delete record and when user upload new file
     */
    protected $_removeFile = true;

    public function afterFind($event) {
        if (!is_array($this->fileField))
            $this->_tmpFile = $this->owner->{$this->fileField};
    }

    public function afterDelete($event) {
        $this->removeFile($this->owner->{$this->fileField});
    }

    public function uploadFile() {
        $path = $this->uploadDirectory;
        if (!is_dir($path))
            mkdir($path);
        if (is_array($this->fileField)) {
            foreach ($this->fileField as $the_fileField):
                $fileField = $this->owner->{$the_fileField};
                $fileField = CUploadedFile::getInstance($this->owner, $the_fileField);
                if ($fileField instanceof CUploadedFile) {
                    //generate unique name for uploaded file
                    $newName = trim(md5(time() . rand(1, 20))) . '.' . CFileHelper::getExtension($fileField->name);
                    $fileField->saveAs($path . $newName);
                    $this->owner->{$the_fileField} = $this->_getDirName() . $newName;
                    if (!$this->owner->isNewRecord)
                        $this->removeFile($tmpFile);
//				$this->removeFile($path.$tmpFile);
                }else {
                    $this->owner->{$the_fileField} = $tmpFile;
                }
            endforeach;
            return true;
        } else {
            if (!$this->owner->isNewRecord)
                $tmpFile = $this->_tmpFile;

            $fileField = $this->owner->{$this->fileField};
            $fileField = CUploadedFile::getInstance($this->owner, $this->fileField);
            if ($fileField instanceof CUploadedFile) {
                //generate unique name for uploaded file
                $newName = trim(md5(time())) . '.' . CFileHelper::getExtension($fileField->name);
                $fileField->saveAs($path . $newName);
                $this->owner->{$this->fileField} = $this->_getDirName() . $newName;
                if (!$this->owner->isNewRecord)
                    $this->removeFile($tmpFile);
//				$this->removeFile($path.$tmpFile);
                return true;
            }
            $this->owner->{$this->fileField} = $tmpFile;
        }
    }

    public function removeFile($fileName) {
        $path = UPLOAD_DIR . $fileName;
//		$path = $this->uploadDirectory.$fileName;
        if (is_file($path) && $this->removeFile)
            unlink($path);
    }

    /*
     * return class name as directory name
     */

    private function _getDirName() {
        return DIRECTORY_SEPARATOR . strtolower(get_class($this->owner)) . DIRECTORY_SEPARATOR;
//                return '';
    }

    public function setUploadDirectory($dir) {
        if (!is_dir($dir))
            throw new CException(Yii::t('NUploadFile', '"{dir}" directory is not exists', array('{dir}' => $dir)));
        $this->_uploadDirectory = $dir;
    }

    /*
     * return upload directory path. if null returns runtimePath
     */

    public function getUploadDirectory() {
        $dirName = $this->_getDirName();
        if ($this->_uploadDirectory == null)
            return Yii::app()->runtimePath . $dirName;
        return str_replace('//', '/', $this->_uploadDirectory . $dirName);
    }

    public function setFileField($fileField) {
        $this->_fileField = $fileField;
    }

    public function getFileField() {
        return $this->_fileField;
    }

    public function setRemoveFile($removeFile) {
        $this->_removeFile = $removeFile;
    }

    public function getRemoveFile() {
        return $this->_removeFile;
    }

    public function getFilePath($relative = false) {
        $filePath = $this->owner->{$this->fileField};
        if ($this->_uploadDirectory == null) {
            $this->_uploadDirectory = UPLOAD_DIR;
//			return Yii::app()->runtimePath.$filePath;
            if (!$relative):
                return Yii::app()->createAbsoluteUrl(str_replace(DS, '/', $this->_uploadDirectory . $filePath));
            else:
                return str_replace('//', '/', DS . $this->_uploadDirectory . $filePath);
            endif;
        }
    }

}
