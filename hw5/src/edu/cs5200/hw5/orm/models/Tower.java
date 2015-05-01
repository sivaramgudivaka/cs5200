package edu.cs5200.hw5.orm.models;
import java.util.List;
import javax.persistence.*;

@Entity
public class Tower
 {
	@Id
	private int Id;
	private String Name;
	private double Height;
	private int Sides;
	@ManyToOne
	@JoinColumn(name="siteId")
	private Site site;
	@OneToMany(mappedBy="tower", cascade=CascadeType.ALL, orphanRemoval=true)
	private List<Equipment> eqs;
	public Tower() 
	{
		super();
	}   
	public int getId()
	{
		return this.Id;
	}
	public void setId(int id)
	{
		this.Id = id;
	}   
	public String getName() 
	{
		return this.Name;
	}
	public void setName(String name) {
		this.name = name;
	}   
	public double getHeight() {
		return this.Height;
	}
	public void setHeight(double h)
	{
		this.Height = h;
	}   
	public int getSides() 
	{
		return this.Sides;
	}
	public void setSides(int sds) {
		this.Sides = sds;
	}
}