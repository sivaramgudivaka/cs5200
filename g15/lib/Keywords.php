<?php

class keywords
{
	private $mediaid;
	private $keywordid;
	private $keyword;
	
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

class KeywordsDAO
{
	public function get_keywords($keywords)
	{
		$mid = $keywords->__get('mediaid');
		$con = connect();
		$result = mysqli_query($con,"SELECT keyword FROM keywords WHERE MediaId='$mid'");
		return $result;
	}
	
	public function delete_keywords($keywords)
	{
		$mid = $keywords->__get('mediaid');
		$con = connect();
		mysqli_query($con,"DELETE FROM keywords WHERE MediaId='$mid'");
	}
	
	public function create_keywords($mediaid, $keys)
	{
		$con = connect();
		mysqli_query($con, "insert into keywords(keyword,MediaId) values ".$keys);
	}
	
	public function media_content_extract()
	{
		$con = connect();  
		$qn = "SELECT MediaId,keyword FROM keywords WHERE keyword IN (SELECT keyword FROM search)
        	   GROUP BY keyword ORDER BY COUNT(keyword) DESC LIMIT 0 , 30";
		$query = mysqli_query($con, $qn);
		return $query;
	}

}

?>
