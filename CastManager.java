package cs5200.dao;

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

import package cs5200.dao.model.Cast;

public class CastDAO {

	DataSource ds;
	
	public CastDAO()
	{
	  try {
		Context ctx = new InitialContext();
		ds = (DataSource)ctx.lookup("java:comp/env/jdbc/CastSocialNetworkDB");
		System.out.println(ds);
	  } catch (NamingException e) {
		e.printStackTrace();
	  }
	}
	
	// create a cast
	public void createCast(Cast newCast)
	{
		String sql = "insert into cast values (?,?,?,?)";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newCast.getId());
			statement.setString(2, newCast.getActorId());
			statement.setString(3, newCast.getMovieId());
			statement.setString(4, newCast.getCharacterName());
			
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	// retrieve all casts
	public List<Cast> readAllCast()
	{
		List<Cast> Casts = new ArrayList<Cast>();
		String sql = "select * from cast";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Cast cast = new Cast();
				Cast.setId(results.getString("id"));
				Cast.setActorId(results.getString("actorId"));
				Cast.setMovieId(results.getString("movie"));
				Cast.setCharacterName(results.getString("characterName"));
				Casts.add(Cast);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return Casts;
	}
	
	// retrieve all Casts by actor
	public List<Cast> readAllCastForActor(String actorId)
	{
		List<Cast> casts = new ArrayList<Cast>();
		String sql = "select * from cast where actorId=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, actorId);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Cast cast = new Cast();
				cast.setId(results.getString("id"));
				cast.setActorId(results.getString("actorId"));
				cast.setMovieId(results.getString("movie"));
				cast.setCharacterName(results.getString("characterName"));
				casts.add(cast);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return casts;
	}
	
	public List<Cast> readAllCastForMovie(String movieId)
	{
		List<Cast> casts = new ArrayList<Cast>();
		String sql = "select * from cast where movie=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, movieId);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Cast cast = new Cast();
				cast.setId(results.getString("id"));
				cast.setActorId(results.getString("actorId"));
				cast.setMovieId(results.getString("movie"));
				cast.setCharacterName(results.getString("characterName"));
				casts.add(cast);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return casts;
	}
	
	// retrieve a Cast by id
	public Cast readCastForId(String castId)
	{
		Cast cast = new Cast();
		
		String sql = "select * from cast where id = ?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, CastId);
			ResultSet result = statement.executeQuery();
			if(result.next())
			{
				cast.setId(results.getString("id"));
				cast.setActorId(results.getString("actorId"));
				cast.setMovieId(results.getString("movie"));
				cast.setCharacterName(results.getString("characterName"));
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return cast;
	}
	// update a Cast by id
	public void updateCast(String castId, Cast newCast)
	{
		String sql = "update cast set id=?, actorId=?, movie=?, characterName=? where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newCast.getId());
			statement.setString(2, newCast.getActorId());
			statement.setString(3, newCast.getMovieId());
			statement.setString(4, newCast.getCharacterName());
			statement.setString(5, castId);
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
	}
	// delete a Cast by id
	public void deleteCast(String CastId)
	{
		String sql = "delete from cast where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, CastId);
			return statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}