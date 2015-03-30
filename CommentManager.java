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

import package cs5200.dao.model.Comment;

public class CommentDAO {

	DataSource ds;
	
	public CommentDAO()
	{
	  try {
		Context ctx = new InitialContext();
		ds = (DataSource)ctx.lookup("java:comp/env/jdbc/CommentSocialNetworkDB");
		System.out.println(ds);
	  } catch (NamingException e) {
		e.printStackTrace();
	  }
	}
	
	// create a comment
	public void createComment(Comment newComment)
	{
		String sql = "insert into comment values (null,?,?,?,?)";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newComment.getComment());
			statement.setString(2, newComment.getDate());
			statement.setString(3, newComment.getUsername());
			statement.setString(4, newComment.getMovie());
			
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
	// retrieve all comments
	public List<Comment> readAllComments()
	{
		List<Comment> comments = new ArrayList<Comment>();
		String sql = "select * from comment";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Comment comment = new Comment();
				comment.setId(results.getString("id"));
				comment.setComment(results.getString("comment"));
				comment.setDate(results.getString("date"));
				comment.setUsername(results.getString("username"));
				comment.setMovie(results.getString("movie"));
				comments.add(comment);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return comments;
	}
	
	// retrieve all comments by username
	public List<Comment> readAllCommentsForUsername(String username)
	{
		List<Comment> comments = new ArrayList<Comment>();
		String sql = "select * from comment where username=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, username);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Comment comment = new Comment();
				comment.setId(results.getString("id"));
				comment.setComment(results.getString("comment"));
				comment.setDate(results.getString("date"));
				comment.setUsername(results.getString("username"));
				comment.setMovie(results.getString("movie"));
				comments.add(comment);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return comments;
	}
	
	public List<Comment> readAllCommentsForMovie(String movieId)
	{
		List<Comment> comments = new ArrayList<Comment>();
		String sql = "select * from comment where movie=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, movieId);
			ResultSet results = statement.executeQuery();
			while(results.next())
			{
				Comment comment = new Comment();
				comment.setId(results.getString("id"));
				comment.setComment(results.getString("comment"));
				comment.setDate(results.getString("date"));
				comment.setUsername(results.getString("username"));
				comment.setMovie(results.getString("movie"));
				comments.add(comment);
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return comments;
	}
	
	// retrieve a comment by id
	public Comment readComment(String commentId)
	{
		Comment comment = new Comment();
		
		String sql = "select * from comment where id = ?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, commentId);
			ResultSet result = statement.executeQuery();
			if(result.next())
			{
				comment.setId(result.getString("id"));
				comment.setComment(result.getString("comment"));
				comment.setDate(result.getString("date"));
				comment.setMovie(result.getString("movie"));
				comment.setUsername(result.getString("username"));
			}
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
		return comment;
	}
	// update a comment by id
	public void updateComment(String commentId, String newComment)
	{
		String sql = "update comment set comment=? where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, newComment);
			statement.setString(2, commentId);
			statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}		
	}
	// delete a comment by id
	public void deleteComment(String commentId)
	{
		String sql = "delete from comment where id=?";
		try {
			Connection connection = ds.getConnection();
			PreparedStatement statement = connection.prepareStatement(sql);
			statement.setString(1, commentId);
			return statement.executeUpdate();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}