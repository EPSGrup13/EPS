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
	let getHeader = document.querySelector("nav");
	let getFooter = document.querySelector(".footer");
	let getContent = document.querySelector(".content");

	if(sessionStorage.getItem("darkMode") == "true") //darkmode kapanacak.
	{
		sessionStorage.setItem("darkMode", true);
		sessionStorage.bg = 1;

		document.body.style.color = "White";
		getHeader.className = "nav";

		document.body.style.background = "none";
		document.body.style.backgroundColor = "#191919";

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
	else //darkmode açılacak.
	{
		sessionStorage.setItem("darkMode", false);
		sessionStorage.bg = 0;

		document.body.style.background = "url('https://www.labdoo.org/sites/default/files/1604-lubuntu-default-wallpaper-neutral.png')";

		document.body.style.color = "Black";
		getHeader.removeAttribute("style");
		getFooter.removeAttribute("style");
		getHeader.className = "nav nav-bg";
		getFooter.className = "footer footer-bg";
		getContent.className = "content";
		getContent.removeAttribute("style");

		let aList = document.getElementsByTagName("a");
		for(i=3;i<aList.length;i++) //3. linkten itibaren başlayacak, 1. logo 2.link 3.link şeklinde. (header içinde)
		{
			//console.log(aList[i]);
			aList[i].style.color = "White";
		}
	}
}

isChecked();