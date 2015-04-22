package cs5200.h6.orm.dao;

//util and io
import java.util.ArrayList;
import java.io.File;
import java.util.List;

//xml.bind
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;
import javax.xml.bind.JAXBContext;

//xml.transform
import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerConfigurationException;
import javax.xml.transform.stream.StreamResult;
import javax.xml.transform.stream.StreamSource;
import javax.xml.transform.TransformerFactory;

//jpa
import javax.persistence.*;

import cs5200.h6.orm.models.*;
import cs5200.h6.xslt.*;

public class SiteDAO
 {
	EntityManagerFactory factory = Persistence.createEntityManagerFactory("dbms");
	EntityManager entmgr = factory.createEntityManager();

	public Site findSite(Integer id)
	{
		return entmgr.find(Site.class,id);
	}

	//findAllSites
	public List<Site> findAllSites()
	{
		Query query=entmgr.createQuery("select site from Site site ");
		return (List<Site>)query.getResultList();
	}
	
	public void exportSiteToXmlFile(SiteList sites, String xmlFileName) 
	{
		File xmlF = new File(xmlFileName);
		try {
			JAXBContext jaxb = JAXBContext.newInstance(SiteList.class);
			Marshaller marshaller = jaxb.createMarshaller();
			marshaller.setProperty(Marshaller.JAXB_FORMATTED_OUTPUT, true);
			marshaller.marshal(sites, xmlF);
		} catch (JAXBException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	
	public void convertXmlFileToOutputFile
	(
			String directorsXmlFileName,
			String outputFileName,
			String xsltFileName
    )
	{
		File inputXmlFile = new File(directorsXmlFileName);
		File outputXmlFile = new File(outputFileName);
		File xsltFile = new File(xsltFileName);
		
		//stream source
		StreamSource source = new StreamSource(inputXmlFile);
		StreamSource xslt = new StreamSource(xsltFile);
		StreamResult output = new StreamResult(outputXmlFile);
		
		TransformerFactory factory = TransformerFactory.newInstance();
		try 
		{
			Transformer transformer = factory.newTransformer(xslt);
			transformer.transform(source, output);
		} catch (TransformerConfigurationException e) 
		{
			e.printStackTrace();
		} catch (TransformerException e)
		{
			e.printStackTrace();
		}
	}
	
	
	//main
	public static void main(String[] args)
	{
		SiteDAO dao = new SiteDAO();
		List<Site> sites = dao.findAllSites();
			for(Site site: sites)
			{
				System.out.println(site.getName());
	 	    }
			SiteList sitelist=new SiteList();
			sitelist.setSites(sites);
			dao.exportSiteToXmlFile(sitelist,"xml/sites.xml");
			dao.convertXmlFileToOutputFile("xml/sites.xml", "xml/sites.html", "xml/sites2html.xslt");
			dao.convertXmlFileToOutputFile("xml/sites.xml", "xml/equipments.html", "xml/sites2equipment.xslt");
	}
}
//END