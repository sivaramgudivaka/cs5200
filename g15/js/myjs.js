function checkSession(num)
{
if(num==0)
{
	var x=5;
}

else
document.getElementById("opt"+num).className="option_element_current";
/*switch(num)
	{
		case 0: break;
		case 1: document.getElementById("opt1").className="option_element_current"; disableFields();break;
		case 2: document.getElementById("opt2").className="option_element_current";break;
		case 8: document.getElementById("opt8").className="option_element_current";break;
		case 3: document.getElementById("opt3").className="option_element_current";break;
		case 31: document.getElementById("opt31").className="option_element_current";break;
		case 4: document.getElementById("opt4").className="option_element_current";break;
		case 5: document.getElementById("opt5").className="option_element_current";break;
		case 6: document.getElementById("opt6").className="option_element_current";break;
	}*/
	
	var id=document.getElementById("greeting");
	if(id.innerHTML!="Welcome guest")
	{
		document.getElementById("login").style.display="none";
		document.getElementById("register").style.display="none";
		document.getElementById("options").style.display="inline";
	}
	else
		document.getElementById("logout").style.display="none";
	
}

