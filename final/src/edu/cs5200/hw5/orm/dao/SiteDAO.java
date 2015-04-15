package edu.cs5200.hw5.orm.dao;
import edu.cs5200.hw5.orm.models.*;

import java.util.List;
import javax.persistence.*;

import javax.ws.rs.*;
import javax.ws.rs.core.MediaType;

@Path("/site")
public class SiteDAO
 {
	EntityManagerFactory emf = Persistence.createEntityManagerFactory("dbms");
	EntityManager em = emf.createEntityManager();	
	@POST
	@Path("/")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public List<Site> CreateSite(Site site) 
	{
		em.getTransaction().begin();
		em.persist(site);
		em.getTransaction().commit();
		List<Site> sites=findAllSites();
		sites.add(site);
		return sites;
	}
	@GET
	@Path("/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	public Site findSite(@PathParam("id")Integer id)
	{
		return em.find(Site.class,id);
	}
	@GET	
	@Path("/")
	@Produces(MediaType.APPLICATION_JSON)
	
	public List<Site> findAllSites()
	{
		Query query=em.createQuery("select site from Site site ");
		return (List<Site>)query.getResultList();
	}
	@PUT
	@Path("/{id}")
	@Consumes(MediaType.APPLICATION_JSON)
	@Produces(MediaType.APPLICATION_JSON)
	public List<Site> updateSite(@PathParam("id")Integer id,Site site)
	{
		site=findSite(id);
		site.setName("hello");
		em.getTransaction().begin();
		em.merge(site);
		em.getTransaction().commit();
		return findAllSites();
	}
	@DELETE
	@Path("/{id}")
	@Produces(MediaType.APPLICATION_JSON)
	
	public List<Site> removeSite(@PathParam("id") int siteId)
	{
		Site site=findSite(sireId);
		em.getTransaction().begin();
		em.remove(site);
		em.getTransaction().commit();
		return findAllSites();
	}
	public static void main(String[] args)
	{
		SiteDAO dao = new SiteDAO();		
		List<Site> updatedsites = dao.removeSite(3);
			for(Site updatedsite: updatedsites)
			{
				System.out.println(updatedsite.getName());
	 	    }
	}	
}
