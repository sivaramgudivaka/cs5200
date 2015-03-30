package cs5200.dao.model;
public class User
 {
	private String userName;
	private String password;
	private String firstName;
	private String lastName;
	private String email;
	private String dateOfBirth;
	
	public User()
	{
		super();
	}
	public User(String userName, String password, String firstName,	String lastName, String email, String dateOfBirth) 
	{
		super();
		this.userName = userName;
		this.password = password;
		this.firstName = firstName;
		this.lastName = lastName;
		this.email = email;
		this.dateOfBirth = dateOfBirth;
	}
	public String getUserName()
	{
		return userName;
	}
	public void setUserName(String userName) 
	{
		this.userName = userName;
	}
	public String getPassword() 
	{
		return password;
	}
	public void setPassword(String password)
	{
		this.password = password;
	}
	public String getFirstName() 
	{
		return firstName;
	}
	public void setFirstName(String firstName) 
	{
		this.firstName = firstName;
	}
	public String getLastName()
	{
		return lastName;
	}
	public void setLastName(String lastName) 
	{
		this.lastName = lastName;
	}
	public String getEmail()
	{
		return email;
	}
	public void setEmail(String email)
	{
		this.email = email;
	}
	public String getDateOfBirth()
	{
		return dateOfBirth;
	}
	public void setDateOfBirth(String dateOfBirth)
	{
		this.dateOfBirth = dateOfBirth;
	}
}
