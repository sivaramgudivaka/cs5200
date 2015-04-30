<?php

class search
{
	private $sid;
	private $keyword;
	private $uid;
	
	public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

  }
}

class SearchDAO
{
	//get_most_searched : returns the most searched media files
	public function get_most_searched()
	{
		$con = connect();
		$most_searched = "SELECT MediaId,keyword FROM keywords WHERE keyword IN (SELECT keyword FROM search)
						  GROUP BY keyword ORDER BY COUNT( keyword ) DESC LIMIT 0 , 30";
		$query = mysqli_query($con,$most_searched);
		return $query;
	}

}

?>
