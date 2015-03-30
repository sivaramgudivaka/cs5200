package cs5200.dao.model;
public class Movie
 {
	private String id;
	private String title;
	private String posterImage;
	private String releaseDate;
	public Movie()
	{
		super();
	}
	public Movie(String id, String title, String posterImage, String releaseDate)
	{
		super();
		this.id = id;
		this.title = title;
		this.posterImage = posterImage;
		this.releaseDate = releaseDate;
	}
	public String getId()
	{
		return id;
	}
	public void setId(String id) 
	{
		this.id = id;
	}
	public String getTitle()
	{
		return title;
	}
	public void setTitle(String title)
	{
		this.title = title;
	}
	public String getPosterImage()
	{
		return posterImage;
	}
	public void setPosterImage(String posterImage)
	{
		this.posterImage = posterImage;
	}
	public String getReleaseDate() 
	{
		return releaseDate;
	}
	public void setReleaseDate(String releaseDate)
	{
		this.releaseDate = releaseDate;
	}
}
