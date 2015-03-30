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

import package cs5200.dao.model.Movie;

public class MovieDAO {

	DataSource ds;
	
	public MovieDAO()
	{
	  try {
		Context ctx = new InitialContext();
		ds = (DataSource)ctx.lookup("java:comp/env/jdbc/MovieSocialNetworkDB");
		System.out.println(ds);
	  } catch (NamingException e) {
		e.printStackTrace();
	  }
	}
	
	// create a movie
	public void createMovie(Movie newMovie)
	{
		String sql = "insert into movie values (?,?,?,?)";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newMovie.getId());
			statement.setString(2, newMovie.getTitle());
			statement.setString(3, newMovie.getPosterImage());
			statement.setString(4, newMovie.getReleaseDate());
			
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	// retrieve all movies
	public List<Movie> readAllMovies()
	{
		List<Movie> movies = new ArrayList<Movie>();
		String sql = "select * from movie";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Movie movie = new Movie();
				movie.setId(results.getString("id"));
				movie.setTitle(results.getString("title"));
				movie.setPosterImage(results.getString("posterImage"));
				movie.setReleaseDate(results.getString("releaseDate"));
				movies.add(movie);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return movies;
	}
	// retrieve a movie by id
	public Movie readMovie(String movieId)
	{
		Movie movie = new Movie();
		
		String sql = "select * from movie where id = ?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, movieId);
			ResultSet result = statement.executeQuery();
			if(result.next())
			{
				movie.setId(result.getString("id"));
				movie.setTitle(result.getString("title"));
				movie.setPosterImage(result.getString("posterImage"));
				movie.setReleaseDate(result.getString("releaseDate"));
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return movie;
	}
	// update a movie by id
	public void updateMovie(String movieId, Movie movie)
	{
		String sql = "update movie set title=?, posterImage=?, releaseDate=? where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, movie.getTitle());
			statement.setString(2, movie.getPosterImage());
			statement.setString(3, movie.getReleaseDate());
			statement.setString(4, movieId);
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
	}
	// delete a movie by id
	public void deleteMovie(String movieId)
	{
		String sql = "delete from movie where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, movieId);
			return statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}