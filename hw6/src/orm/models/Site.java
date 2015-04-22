package cs5200.h6.orm.models;

//jpa
import javax.persistence.Id;
import javax.persistence.OneToMany;
import javax.persistence.CascadeType;
import javax.persistence.Entity;

//javax.bind.annotation
import javax.xml.bind.annotation.XmlRootElement;
import javax.xml.bind.annotation.XmlAccessorType;
import javax.xml.bind.annotation.*;

import java.util.*;

@Entity
@XmlRootElement
@XmlAccessorType(value = XmlAccessType.FIELD)

public class Site
 {
    @Id
    @XmlAttribute
	private Integer Id;
    @OneToMany(mappedBy="site",cascade=CascadeType.ALL, orphanRemoval=true)
    @XmlElement(name="tower")
    private List<Tower> Towers;
    
	public Site(List<Tower> towers)
	{
		super();
		Towers = towers;
	}
	public String getName()
	{
		return Name;
	}
	public void setName(String name)
	{
		Name = name;
	}
	public Integer getId() 
	{
		return Id;
	}
	public void setId(Integer id)
	{
		Id = id;
	}
	public double getLatitude()
	{
		return Latitude;
	}
	public void setLatitude(double latitude)
	{
		Latitude = latitude;
	}
	public double getLongitude() 
	{
		return Longitude;
	}
	public void setLongitude(double longitude) 
	{
		Longitude = longitude;
	}
	public Site(Integer id, String name, double latitude, double longitude)
	{
		super();
		Name = name;
		Latitude = latitude;
		Id = id;
		Longitude = longitude;
	}
	@XmlAttribute
	private String Name;
	public Site()
	{
		super();
	}
	@XmlAttribute
	private double Latitude;
	@XmlAttribute
	private double Longitude;
}