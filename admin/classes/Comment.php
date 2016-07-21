<?php
class Comment extends DBObject
{
    protected $tableName = 'comments';


    public function create_comment($arr = array())
    {
        // if not an array return false
        if(!is_array($arr))
        {
            return false;
        }
        // if empty return false
        elseif(empty($arr))
        {
            return false;
        }

        // if inserted into table return true
        if($this->insert_into_table($arr))
        {
            return true;
        }

    }



//-----------------------------------------------------------------------------------------------------//


    /**
     * check if comments for the particular image exists or not
     * @param $image_id
     * @return bool
     */
    public function comment_exists($image_id)
    {
        $image_id = $this->clean_data($image_id);
        $query = "SELECT comm_author_id FROM ".$this->tableName." WHERE comm_image_id = ".$image_id;
        $rows = $this->db->num_rows($query);
        if($rows == true){
            return true;
        } else {
            return false;
        }
    }

//-----------------------------------------------------------------------------------------------------//


    /**
     * @work find comments using photo id
     * @param $photo_id
     * @return array
     */
    public function find_comments($photo_id)
    {
        // cleaning given data
        $photo_id = $this->clean_data($photo_id);

        // if there comments exists for this image get comments else return false
        if($this->comment_exists($photo_id))
        {
            $sql = "SELECT c.comm_id, c.comm_author_id, c.comm_body, c.comm_date, u.user_name, u.user_id ";
            $sql .= "from " . $this->tableName . " as c INNER JOIN users as u ";
            $sql .= "where c.comm_author_id = u.user_id ";
            $sql .= "AND c.comm_image_id = " . $photo_id;

            // execute query and return data
            $data = $this->db->execute_query($sql);
            return $data;
        }else
        {
            return false;
        }
    }


//-----------------------------------------------------------------------------------------------------//











}