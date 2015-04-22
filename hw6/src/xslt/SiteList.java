package cs5200.h6.xslt;

import java.util.List;

import cs5200.h6.orm.models.*;
import javax.xml.bind.annotation.*;

@XmlRootElement
@XmlAccessorType(value = XmlAccessType.FIELD)

public class SiteList 
{
	
	@XmlElement(name="site")
	private List<Site> Sites;

	public SiteList()
	{
		super();
	}

	public SiteList(List<Site> sites)
	{
		super();
		Sites = sites;
	}

	public List<Site> getSites()
	{
		return Sites;
	}

	public void setSites(List<Site> sites)
	{
		Sites = sites;
	}
}
