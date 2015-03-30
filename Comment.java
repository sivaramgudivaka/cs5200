package cs5200.dao.model;
public class Comment 
{
	private String id;
	private String comment;
	private String date;
	private String movie;
	private String username;
	public String getId() 
	{
		return id;
	}
	public void setId(String id) 
	{
		this.id = id;
	}
	public String getComment()
	{
		return comment;
	}
	public void setComment(String comment)
	{
		this.comment = comment;
	}
	public String getDate() 
	{
		return date;
	}
	public void setDate(String date) 
	{
		this.date = date;
	}
	public String getMovie()
	{
		return movie;
	}
	public void setMovie(String movie) 
	{
		this.movie = movie;
	}
	public String getUsername() 
	{
		return username;
	}
	public void setUsername(String username) 
	{
		this.username = username;
	}
	public Comment() 
    {
		super();
	}
	public Comment(String id, String comment, String date, String movie, String username)
	{
		super();
		this.id = id;
		this.comment = comment;
		this.date = date;
		this.movie = movie;
		this.username = username;
	}
}
