<?php

class Photo extends DBObject {

    protected $tableName = 'photos';
    protected $tableNameArray = ['photo_title', 'photo_description', 'photo_filename', 'photo_type', 'photo_size'];

    // file details
    protected $name_file;
    protected $type_file;
    protected $tmp_file;
    protected $error_file;
    protected $size_file;

    // custom errors
    public $errors;

    // File upload error List
    protected $upload_error = [
        UPLOAD_ERR_OK 			=>	'There is no error, the file uploaded with success.',
        UPLOAD_ERR_INI_SIZE		=>	'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
        UPLOAD_ERR_FORM_SIZE	=>	'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
        UPLOAD_ERR_PARTIAL		=>	'The uploaded file was only partially uploaded.',
        UPLOAD_ERR_NO_FILE		=>	'No file was uploaded.',
        UPLOAD_ERR_NO_TMP_DIR	=>	'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE	=>	'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION	=>	'A PHP extension stopped the file upload.'
    ];


//--------------------------------------------------------------------------------------//


    /**
     * @work Check if there is a $_FILE data array and set those values
     * @param $file
     */
    public function set_file($file)
    {
        // checking if there any file or its empty or it an array or not
        if (empty($file) || !$file || !is_array($file)) {
            $this->custom_error = "There is no file uploaded";
            return false;
        }
        // if there is an error i.e. if the error is not equals to 0
        elseif ($file['error'] != 0)
        {
            $this->errors = $this->upload_error[$file['error']];
            return false;
        }
        else
        {
            // If everything is ok
            // setting the details of the file into protected properties
            $this->name_file =  basename($file['name']);
            $this->type_file =  $file['type'];
            $this->tmp_file =   $file['tmp_name'];
            $this->error_file = $file['error'];
            $this->size_file =  $file['size'];
        }

    }













}