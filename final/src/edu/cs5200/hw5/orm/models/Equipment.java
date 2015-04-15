package edu.cs5200.hw5.orm.models;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;

@Entity
public class Equipment
 {
	@Id
	private Integer Id;
	public Equipment()
	{
		super();
	}
	public Equipment(Integer Id, String Name, String Brand, String Descr,
			double Price, Tower tower)
	{
		super();
		this.Id = Id;
		this.Name = Name;
		this.Brand = Brand;
		this.Descr = Descr;
		this.Price = Price;
		this.tower = tower;
	}
	public Integer getId()
	{
		return Id;
	}
	public void setId(Integer Id)
	{
		this.Id = Id;
	}
	public String getName()
	{
		return Name;
	}
	public void setName(String name)
	{
		this.Name = name;
	}
	public String getBrand()
	{
		return Brand;
	}
	public void setBrand(String brand)
	{
		this.Brand = brand;
	}
	public String getDescription()
	{
		return Descr;
	}
	public void setDescription(String d)
	{
		this.Descr = d;
	}
	public double getPrice() 
	{
		return Price;
	}
	public void setPrice(double price) 
	{
		this.Price = price;
	}	
	private String Name;
	private String Brand;
	private String Descr;
	private double Price;
	@ManyToOne
	@JoinColumn(name="towerId")
	private Tower tower;
	public Equipment(Tower tower)
	{
		super();
		this.tower = tower;
	}
}


