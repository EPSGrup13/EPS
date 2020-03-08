function darkMode()
{
	const getCb = document.getElementById("dm");
	if(sessionStorage.getItem("darkMode") == "true")
	{
		sessionStorage.setItem("darkMode", "false");
		isChecked();
		setStyles();
	}
	else
	{
		sessionStorage.setItem("darkMode", "true");
		isChecked();
		setStyles();
	}
}

function isChecked()
{
	const getCb = document.getElementById("dm");
	if(sessionStorage.getItem("darkMode") == "true" )
	{

		getCb.checked = true;
		setStyles();
	}
	else
	{
		getCb.checked = false;
		setStyles();
	}
}

function setStyles()
{
	sessionStorage.setItem("bgColor","#191919");
	sessionStorage.setItem("hdrColor","#2d2d2d");
	let getHeader = document.querySelector(".headerInline");
	let getFooter = document.querySelector(".footer");
	let getContent = document.querySelector(".content");

	if(sessionStorage.getItem("darkMode") == "true")
	{
		sessionStorage.setItem("darkMode", true);
		sessionStorage.bg = 1;

		document.body.style.color = "White";
		getHeader.className = "headerInline";
		getHeader.style.backgroundColor = sessionStorage.getItem("hdrColor");
		getFooter.style.backgroundColor = sessionStorage.getItem("hdrColor");
		getContent.style.backgroundColor = sessionStorage.getItem("bgColor");

		let aList = document.getElementsByTagName("a");
		for(i=0;i<aList.length;i++)
		{
			//console.log(aList[i]);
			aList[i].style.color = "White";
		}
	}
	else
	{
		sessionStorage.setItem("darkMode", false);
		sessionStorage.bg = 0;

		document.body.style.color = "Black";
		getHeader.removeAttribute("style");
		getFooter.removeAttribute("style");
		getHeader.className = "headerInline bg-dark";
		getFooter.className = "footer bg-dark";
		getContent.className = "content";
		getContent.removeAttribute("style");

		let aList = document.getElementsByTagName("a");
		for(i=0;i<aList.length;i++)
		{
			//console.log(aList[i]);
			aList[i].style.color = "Black";
		}
	}
}

isChecked();