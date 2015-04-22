package cs5200.h6.orm.models;

//jpa
import javax.persistence.Id;
import javax.persistence.Entity;
import javax.persistence.ManyToOne;
import javax.persistence.JoinColumn;


import javax.xml.bind.annotation.*;
@Entity
@XmlRootElement
@XmlAccessorType(value = XmlAccessType.FIELD)

public class Equipment 
{
	@Id
	@XmlAttribute
	private Integer Id;
	public Equipment()
	{
		super();
	}
	public Equipment(Integer id, String name, String brand, String description,	double price, Tower tower)
	{
		super();
		Id = id;
		Name = name;
		Brand = brand;
		Description = description;
		Price = price;
		this.tower = tower;
	}
	public String getDescription()
	{
		return Description;
	}
	public void setDescription(String description)
	{
		Description = description;
	}
	public Integer getId()
	{
		return Id;
	}
	public void setId(Integer id)
	{
		Id = id;
	}
	public String getBrand()
	{
		return Brand;
	}
	public void setBrand(String brand)
	{
		Brand = brand;
	}
	public String getName() 
	{
		return Name;
	}
	public void setName(String name)
	{
		Name = name;
	}
	public double getPrice()
	{
		return Price;
	}
	public void setPrice(double price)
	{
		Price = price;
	}
	@XmlAttribute
	private String Name;
	@XmlAttribute
	private String Brand;
	@XmlAttribute
	private String Description;
	@XmlAttribute
	private double Price;
	@ManyToOne
	@JoinColumn(name="towerId")
	@XmlTransient
	private Tower tower;
	public Equipment(Tower tower) {
		super();
		this.tower = tower;
	}
}