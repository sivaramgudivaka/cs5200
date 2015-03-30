package cs5200.dao.model;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import javax.naming.Context;
import javax.naming.InitialContext;
import javax.naming.NamingException;
import javax.sql.DataSource;

import package cs5200.dao.model.Actor;

public class ActorDAO {

	DataSource ds;
	
	public ActorDAO()
	{
	  try {
		Context ctx = new InitialContext();
		ds = (DataSource)ctx.lookup("java:comp/env/jdbc/ActorSocialNetworkDB");
		System.out.println(ds);
	  } catch (NamingException e) {
		e.printStackTrace();
	  }
	}
	
	// create an actor
	public void createActor(Actor newActor)
	{
		String sql = "insert into actor values (null,?,?,?,?)";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newActor.getId());
			statement.setString(2, newActor.getFirstName());
			statement.setString(3, newActor.getLastName());
			statement.setString(4, newActor.getDateOfBirth());
			
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	// retrieve all actors
	public List<Actor> readAllActors()
	{
		List<Actor> actors = new ArrayList<Actor>();
		String sql = "select * from actor";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Actor actor = new Actor();
				actor.setId(results.getString("id"));
				actor.setFirstName(results.getString("firstName"));
				actor.setLastName(results.getString("lastName"));
				actor.setDateOfBirth(results.getString("dateOfBirth"));
				actors.add(actor);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return actors;
	}
	// retrieve an actor by id
	public Actor readActor(String actorId)
	{
		Actor actor = new Actor();
		
		String sql = "select * from actor where id = ?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, actorId);
			ResultSet result = statement.executeQuery();
			if(result.next())
			{
				actor.setId(result.getString("id"));
				actor.setFirstName(result.getString("firstName"));
				actor.setLastName(result.getString("lastName"));
				actor.setDateOfBirth(result.getString("dateOfBirth"));
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return actor;
	}
	// update a actor by id
	public void updateActor(String actorId, Actor actor)
	{
		String sql = "update actor set firstName=?, LastName=?, dateOfBirth=? where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, actor.getFirstName());
			statement.setString(2, actor.getLastName());
			statement.setString(3, actor.getDateOfBirth());
			statement.setString(4, actorId);
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
	}
	// delete a actor by id
	public void deleteActor(String actorId)
	{
		String sql = "delete from actor where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, actorId);
			return statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}