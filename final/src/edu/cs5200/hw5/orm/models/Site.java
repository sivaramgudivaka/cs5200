package edu.cs5200.hw5.orm.models;
import javax.persistence.Id;
import javax.persistence.OneToMany;
import javax.persistence.CascadeType;
import javax.persistence.Entity;
import java.util.*;

@Entity
public class Site
 {
    @Id
	private Integer Id;
    @OneToMany(mappedBy="site",cascade=CascadeType.ALL, orphanRemoval=true)
    private List<Tower> Towers;
    
	public Site(List<Tower> towers)
	{
		super();
		Towers = towers;
	}
	public Integer getId() 
	{
		return Id;
	}
	public void setId(Integer id)
	{
		this.Id = id;
	}
	public String getName()
	{
		return Name;
	}
	public void setName(String name) 
	{
		this.Name = name;
	}
	public double getLatitude() 
	{
		return Latitude;
	}
	public void setLatitude(double l) 
	{
		this.Latitude = l;
	}
	public Site(Integer id, String name, double latitude, double longitude)
	{
		super();
		this.Id = id;
		this.Name = name;
		this.Latitude = latitude;
		this.Longitude = longitude;
	}
	public double getLongitude()
	{
		return Longitude;
	}
	public void setLongitude(double longitude) 
	{
		this.Longitude = longitude;
	}
	private String Name;
	public Site() 
	{
		super();
	}
	private double Latitude;
	private double Longitude;
}

