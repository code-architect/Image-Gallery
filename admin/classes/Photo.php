<?php

class Photo extends DBObject {

    protected $tableName = 'photos';
    protected $tableNameArray = ['photo_id', 'photo_title', 'photo_description', 'photo_filename', 'photo_type', 'photo_size'];

    // file details
    protected $name_file;
    protected $tmp_file;
    protected $error_file;
    protected $size_file;

    // upload directory
    public $upload_directory = "images";

    // post data array
    public $photo_files = [];

    // custom errors
    public $errors;

    // File upload error List
    public $upload_error = [
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
     * @param $file $_FILES array
     * @param $post $_POST array
     * @return array
     */

    public function set_file($post = null, $file)
    {

        // checking if there any file or its empty or it an array or not
        if (empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "There is no file uploaded";
            return false;
        }
        // if there is an error i.e. if the error is not equals to 0
        elseif ($file['error'] != 0)
        {
            $this->errors[] = $this->upload_error[$file['error']];
            return false;
        }
        else
        {
            // If everything is ok
            // setting the details of the file into protected properties
            $this->name_file =  basename($file['name']);
            $this->tmp_file =   $file['tmp_name'];
            $this->error_file = $file['error'];
            $this->size_file =  $file['size'];

            if($post != null)
            {
                // Cleaning the post data
                $post_value = $this->db->clean_array($post);

                // check if the values are set then create an array for later use
                if(isset($this->name_file))
                {
                    $this->photo_files = [
                    'photo_title'       =>  $post_value['photo_title'],
                    'photo_alt_text'    =>  $post_value['photo_alt_text'],
                    'photo_description' =>  $post_value['photo_description'],
                    'photo_filename'    =>  $this->name_file,
                    'photo_size'        =>  $this->size_file

                    ];
                }
            }

        }

    }



//--------------------------------------------------------------------------------------//

    /**
     * @work IF only post array has been passed then only update this part
     * @param null $post
     */
    public function set_only_files($post = null)
    {
        if($post != null)
        {
            // Cleaning the post data
            $post_value = $this->db->clean_array($post);

            // check if the values are set then create an array for later use

                $this->photo_files = [
                    'photo_title'       =>  $post_value['photo_title'],
                    'photo_alt_text'    =>  $post_value['photo_alt_text'],
                    'photo_description' =>  $post_value['photo_description']
                ];

        }
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work Saving data into the database based of if the data already exists in the database or not,
     *       if exists then update it, and if not create a new one.
     * @param null $photo_id
     * @return bool
     */
    public function save($photo_id = null)
    {
        // if this id is present and its exists in the database do an update
        if($photo_id != null && $this->data_exists('photo_id', $photo_id)) {

            if (isset($this->photo_files))
            {
                // if there is no image
                if($this->tmp_file)
                {
                    if(move_uploaded_file($this->tmp_file, IMAGES_DIR.DS.$this->name_file))
                    {
                        $this->update_table($this->photo_files, 'photo_id', $photo_id);
                        $this->errors[] = "Updated Successfully";
                        unset($this->photo_files);
                        unset($this->tmp_file);
                        return true;
                    }
                }else
                {
                        $this->update_table($this->photo_files, 'photo_id', $photo_id);
                        $this->errors[] = "Updated Successfully";
                        unset($this->photo_files);
                        unset($this->tmp_file);
                        return true;
                }

            }
            else
            {
                $this->errors[] = $this->upload_error[$this->error_file];
                return false;
            }

        }
        else
        {
            // if there are no errors
            if(!empty($this->errors))
            {
                return false;
            }

            // If file name and temp file exists
            if(empty($this->name_file) || empty($this->tmp_file))
            {
                $this->errors[] = "The file was not available";
                return false;
            }

            // check if the same named image exists or not
            if($this->image_exists())
            {
                $this->errors[] = "This image already exists, change the name";
                return false;
            }


            // if uploading image is successful
            if(move_uploaded_file($this->tmp_file, IMAGES_DIR.DS.$this->name_file))
            {
                // if Uploading in to the database is succeeded, set an error and unset the array
                if($this->insert_into_table($this->photo_files))
                {
                    $this->errors[] = "File Uploaded";
                    unset($this->photo_files);
                    unset($this->tmp_file);
                    return true;
                }

            }
            else
            {
                $this->errors[] = $this->upload_error[$this->error_file];
                return false;
            }
        }
    }



//--------------------------------------------------------------------------------------//


    /**
     * @work To check if the image with the same name exists or not
     * @return bool
     */
    public function image_exists()
    {

        $data = $this->db->mysql_escape($this->photo_files['photo_filename']);
        $query = "SELECT photo_id FROM ".$this->tableName." WHERE photo_filename = '".$data."'";

        $result = $this->db->custom_query($query);
        $num = $result->num_rows;
        if($num > 0)
        {
            return true;
        }else{
            return false;
        }
    }


//--------------------------------------------------------------------------------------//

    /**
     * Get all the images
     * @param string $order ASC default
     * @return array
     */
    public function find_all_images($order = 'asc', $field = 'photo_date')
    {
        $query = "SELECT * FROM ".$this->tableName." ORDER BY ".$field." ".$order;
        $data = $this->db->execute_query($query);
        return $data;
    }


//-------------------------------------------------------------------------------------//


    public function image_id_exists($id)
    {
        $data = $this->db->mysql_escape($id);
        $query = "SELECT photo_id FROM ".$this->tableName." WHERE photo_id  = ".$data;

        $result = $this->db->custom_query($query);
        $num = $result->num_rows;
        if($num > 0)
        {
            return true;
        }else{
            return false;
        }
    }

}