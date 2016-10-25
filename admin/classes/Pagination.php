<?php

class Pagination extends DBObject{


    public $current_page;
    public $items_per_page;
    public $items_total_count;
    private $photo;


    public function __construct($page = 1, $items_per_page = 4)
    {
        parent::__construct();
        $this->photo = new Photo();

        // assigning values
        $this->current_page = (int)$page;
        $this->items_per_page = (int)$items_per_page;
        // Number of images exists in the database
        $this->items_total_count = $this->photo->count_all();
    }


//--------------------------------------------------------------------------------------------------------------------//


    public function next()
    {
        return $this->current_page + 1;
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function previous()
    {
        return $this->current_page - 1;
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function page_total()
    {
        return ceil($this->items_total_count/$this->items_per_page);
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function has_previous()
    {
        return $this->previous() >= 1 ? true : false;
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function has_next()
    {
        return $this->next() <= $this->page_total() ? true : false;
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function offset()
    {
        return ($this->current_page - 1) * $this->items_per_page;
    }

//--------------------------------------------------------------------------------------------------------------------//

    public function front_page_images_to_show($order = 'asc', $field = 'photo_date')
    {
        $sql = "SELECT * FROM photos ORDER BY ".$field." ".$order." LIMIT ".$this->items_per_page;
        $sql .= " OFFSET ".$this->offset();

        return $data = $this->db->execute_query($sql);
    }

//--------------------------------------------------------------------------------------------------------------------//
//--------------------------------------------------------------------------------------------------------------------//
}