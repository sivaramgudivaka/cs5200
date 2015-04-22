<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1" import="edu.neu.cs5200.asst5.orm.dao.*,edu.neu.cs5200.asst5.orm.models.*,java.util.*"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<%
SiteDAO dao= new SiteDAO();
List<Site> sites= dao.findAllSites();
%>
<h1>Sites</h1>

<table class="table table-striped">
<%
 for(Site site: sites)
 {
%> <tr>	 
<td> <%= site.getName()%> </td>
</tr>
 <%
  }
%>
</table>
</div>

</body>
</html>