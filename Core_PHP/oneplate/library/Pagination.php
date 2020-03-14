<?php

/*
 * Generate Pagination using bootstrap (3.3.7v) pagination structure
 */

class Pagination {

    public $start = 0;
    public $limit = 1;
    public $active = 0;
    public $total_record = 0;
    public $total_page = 0;
    public $prev_disable = false;
    public $next_disable = false;
	public $search = '';
	public $q_string = '';
	
    /**
     *
     * @var type to let the screen readers know that for what purpose this navigation is e.g. 'All active listing pages'
     */
    public $aria = '';
    public $url = '';

    /**
     * 
     * @param mysqli $db_handle connection of mysqli class
     * @param string $url       where pagination run
     * @param string $aria      (optional) for screen reader to know that what nav is this
     * @param int $active       (optional) active page number
     * @param int $start        (optional) start value for 'LIMIT' clause
     * @param int $limit        (optional) limit for 'LIMIT' clause
     */
    public function __construct($url, $total_records,$aria = '', $active = 0, $start = 0, $limit = 1) {
        $this->url = $url;
        $this->active = $active;
		
        $this->start = $start;
        $this->limit = $limit;
        if ($aria == '') {
            $this->aria = 'Pagination';
        } else {
            $this->aria = $aria;
        }
		
		
        $this->set_total_record($total_records);
        $this->set_limit();
	  	$this->set_total_page();
        $this->set_active();
		$this->set_start();
        $this->set_prev_state();
        $this->set_next_state();
		
		if(isset($_GET['q'])){
		$this->search = $_GET['q'];	
			foreach( $_GET as $key => $value){
			if(!in_array($key,['q','p'])){
				$this->q_string .= '&'.$key.'='.$value;
			}
		
		}
		}
    }
		
	
	
	
	
    /**
     * 
     * @return string complete html of pagination bloclk
     */
    public function generate() {
        /**
         * pagination wrapper start
         */
		$buffer = 3;
        $response = '<nav aria-label="' . $this->aria . '">
                        <ul class="pagination">';
        /**
         * previous button
         */
		
		    /*  if ($this->prev_disable) {
            $response .= '<li class="disabled">
                            <a href="#" aria-label="Previous">';
        } else {
            $response .= '<li>
                            <a href="' . $this->url . '?p=' . ($this->active - 1) . '&l=' . $this->limit .'&q=' . $this->search . '" aria-label="Previous">';
        }
        $response .= '        <span aria-hidden="true">&laquo;</span>
                            </a>
                          </li>';
        
          page links
         
        for ($i = 1; $i <= $this->total_page; $i++) {
            if ($i == $this->active) {
                $response .= '<li class="active">
                                <a href="#">' . $i . ' <span class="sr-only">(current)</span></a>';
            } else {
                $response .= '<li>
                                <a href="' . $this->url . '?p=' . $i . '&l=' . $this->limit .'&q=' . $this->search.'">' . $i . '</a>';
            }
            '</li>';
        }
        
          next button
         
        if ($this->next_disable) {
            $response .= '<li class="disabled">
                            <a href="#" aria-label="Next">';
        } else {
            $response .= '<li>
                            <a href="' . $this->url . '?p=' . ($this->active +1) . '&l=' . $this->limit . '" aria-label="Next">';
        }
        $response .= '        <span aria-hidden="true">&raquo;</span>
                            </a>
                          </li>';
        
        $response .= '   </ul>
                    </nav>';
        return $response;*/
		
		$limit=$this->limit;
		//echo $limit;die;
			$total_pages =$this->total_page;
	$adjacents = 3;
	// echo $total_pages;die;
		
	/* Setup vars for query. */
		if(isset($_GET['p'])){
			$page=$_GET['p'];
		}
		else{
		$page=0;
		
		}//how many items to show per page
	if(isset($page)){ 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	//echo $start;
	}else{
		$start = 0;								//if no page var is given, set start to 0
	}
	/* Get data. */
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = $total_pages;
	//	echo $lastpage; die;                     //lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;	
		
		$pagination = "";
		
		if($this->search=="" ){
		if($lastpage > 1)
		{
		
		$pagination .= "<ul class=\"pagination\">";
		//previous button
		if ($page > 1) 
			
			$pagination.= "<li><a href=\"$this->url?p=$prev\" >« previous</a></li>";
			
		else
			$pagination.= '<li class="disabled"><a href="#">« previous</a></li>';	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= '<li class="active"><a href="">'.$counter.'</a></li>';
				else
					$pagination.= "<li><a href=\"$this->url?p=$counter\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$this->url?p=$counter\">$counter</a></li>";					
				}
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lastpage\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$this->url?p=1\">1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=2\">2</a></li>";
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page){
						$pagination.= "<li><span class=\"current\">$counter</span></li>";
					}else{
						$pagination.= "<li><a href=\"$this->url?p=$counter\">$counter</a></li>";					
				}
				}
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lpm1\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lastpage\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$this->url?p=1\">1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=2\">2</a></li>";
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$this->url?p=$counter\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$this->url?p=$next\">next »</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a hre=\"#\">next »</a></li>";
		$pagination.= "</ul>\n";		
	}
		}
		else{
			if($lastpage > 1)
		{
		$pagination .= "<ul class=\"pagination\">";
		//previous button
		if ($page > 1) 
			
			$pagination.= "<li><a href=\"$this->url?p=$prev&q={$this->search}{$this->q_string}\" >« previous</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a href=\"#\">« previous</a></li>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
				else
					$pagination.= "<li><a href=\"$this->url?p=$counter&q={$this->search}{$this->q_string}\">$counter</a></li>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$this->url?p=$counter&q={$this->search}{$this->q_string}\">$counter</a></li>";
				}
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lpm1&q={$this->search}{$this->q_string}\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lastpage&q={$this->search}{$this->q_string}\">$lastpage</a></li>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<li><a href=\"$this->url?p=1&q={$this->search}{$this->q_string}\">1</a>";
				$pagination.= "<li><a href=\"$this->url?p=2&q={$this->search}{$this->q_string}\">2</a></li>";
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a href=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$this->url?p=$counter&q={$this->search}{$this->q_string}\">$counter</a></li>";					
				}
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lpm1&q={$this->search}{$this->q_string}\">$lpm1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=$lastpage&q={$this->search}{$this->q_string}\">$lastpage</a></li>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<li><a href=\"$this->url?p=1&q={$this->search}{$this->q_string}\">1</a></li>";
				$pagination.= "<li><a href=\"$this->url?p=2&q={$this->search}{$this->q_string}\">2</a></li>";
				$pagination.= "<li class=\"disabled\"><a href=\"#\">....</a></li>";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<li class=\"active\"><a hre=\"#\">$counter</a></li>";
					else
						$pagination.= "<li><a href=\"$this->url?p=$counter&q={$this->search}{$this->q_string}\">$counter</a></li>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<li><a href=\"$this->url?p=$next&q={$this->search}{$this->q_string}\">next »</a></li>";
		else
			$pagination.= "<li class=\"disabled\"><a hre=\"#\" >next »</a></li>";
		$pagination.= "</ul>\n";		
	}
		
		}
		
		return $pagination;
    }

    /**
     * 
     * @param string $fuction   :Function name of MysqliWrapper to get total count from specific table
     */
    public function set_total_record($total_records) {
        $this->total_record = $total_records;
    }

    public function get_total_record() {
        return $this->total_record;
    }
    
    public function set_limit($limit = '') {
        $this->limit = (isset($_GET['l']) && is_numeric($_GET['l'])) ? $_GET['l'] : $this->limit;
		$this->limit = (!empty($limit) && is_numeric($limit)) ? $limit : $this->limit ;
		$this->set_total_page();
		$this->set_start();
    }

    public function get_limit() {
        return $this->limit;
    }

    public function set_total_page() {
        $this->total_page = ceil($this->total_record / $this->limit);
    }

    public function get_total_page() {
        return $this->total_page;
    }

    public function set_active() {
        $this->active = ($this->active == 0) ? 1 : $this->active;
        $this->active = (isset($_GET['p']) && is_numeric($_GET['p'])) ? $_GET['p'] : $this->active;
    }

    public function get_active() {
        return $this->active;
    }
	
	

    public function set_start() {
        $this->start = ($this->active > 1) ? (($this->active - 1) * $this->limit) : $this->start;
    }

    public function get_start() {
        return $this->start;
    }

    public function set_prev_state() {
        $this->prev_disable = ($this->active <= 1) ? TRUE : FALSE;
    }

    public function get_prev_state() {
        return $this->prev_disable;
    }

    public function set_next_state() {
        $this->next_disable = ($this->active >= $this->total_page) ? TRUE : FALSE;
    }

    public function get_next_state() {
        return $this->next_disable;
    }

}
