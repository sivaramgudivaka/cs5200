package cs5200.h6.orm.models;


import java.util.List;
import javax.persistence.*;
import javax.xml.bind.annotation.*;

@Entity
@XmlRootElement
@XmlAccessorType(value = XmlAccessType.FIELD)

public class Tower
 {
	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@XmlAttribute
	private int Id;
	@XmlAttribute
	private String Name;
	@XmlAttribute
	private double Height;
	@XmlAttribute
	private int Sides;
	@ManyToOne
	@JoinColumn(name="siteId")
	@XmlTransient
	private Site site;
	@OneToMany(mappedBy="tower", cascade=CascadeType.ALL, orphanRemoval=true)
	@XmlElement(name="equipment")
	private List<Equipment> equipments;
		
	public Tower()
	{
		super();
	}   
	
	public double getHeight() 
	{
		Height;
	}

	public void setHeight(double height)
	{
		Height = height;
	}   
	public int getSides()
	{
		return Sides;
	}

	public void setSides(int sides) 
	{
		Sides = sides;
	}
	
	public int getId()
	{
		return Id;
	}
	
	public void setId(int id) 
	{
		Id = id;
	}   
	
	public String getName()
	{
		return Name;
	}

	public void setName(String name) 
	{
		Name = name;
	}   
}