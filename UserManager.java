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
import package cs5200.dao.model.User;

public class UserDAO {

	DataSource ds;
	
	public UserDAO()
	{
	  try {
		Context ctx = new InitialContext();
		ds = (DataSource)ctx.lookup("java:comp/env/jdbc/MovieSocialNetworkDB");
		System.out.println(ds);
	  } catch (NamingException e) {
		e.printStackTrace();
	  }
	}
	
	// create a user
	public void createUser(User newUser)
	{
		String sql = "insert into user values (?,?,?,?,?,?)";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, user.getFirstName());
			statement.setString(2, user.getLastName());
			statement.setString(3, user.getUsername());
			statement.setString(4, user.getPassword());
			statement.setString(5, user.getEmail());
			statement.setString(6, user.getDateOfBirth());
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return null;
	}
	// retrieve all users
	public List<User> readAllUsers()
	{
		List<User> users = new ArrayList<User>();
		String sql = "select * from user";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				User user = new User();
				user.setFirstName(results.getString("firstName"));
				user.setLastName(results.getString("lastName"));
				user.setUsername(results.getString("username"));
				user.setPassword(results.getString("password"));
				user.setEmail(results.getString("email"));
				user.setDateOfBirth(results.getString("dateOfBirth"));
				users.add(user);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return users;
	}
	// retrieve a user by un
	public User readUser(String username)
	{
		User user = new User();

		String sql = "select * from user where username = ?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, username);
			ResultSet result = statement.executeQuery();
			if(result.next())
			{
				user.setEmail(result.getString("email"));
				user.setFirstName(result.getString("firstName"));
				user.setLastName(result.getString("lastName"));
				user.setUsername(result.getString("username"));
				user.setPassword(result.getString("password"));
				user.setDateOfBirth(results.getString("dateOfBirth"));
			}
						
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return user;
	}
	// update a user by username
	public void updateUser(String username, User user)
	{
		String sql = "update user set firstName=?, lastName=?, username=?, password=?, email=? where username=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, user.getFirstName());
			statement.setString(2, user.getLastName());
			statement.setString(3, user.getUsername());
			statement.setString(4, user.getPassword());
			statement.setString(5, user.getEmail());
			statement.setString(6, username);
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return user;
	}
	// delete a user by username
	public void deleteUser(String username)
	{
		String sql = "delete from user where username=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, username);
			return statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return 0;
	}
}