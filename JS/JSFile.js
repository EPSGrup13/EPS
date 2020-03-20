function registration()
{
    //var elements = document.getElementsByClassName("formArea");
    var elements = document.getElementsByClassName("formkapsaminput");
    var formData = new FormData();
    //console.log("elements len:" + elements.length); //output test
    for(var i=0; i<elements.length; i++)
    {
        formData.append(elements[i].name, elements[i].value);
        //console.log("name: "+ elements[i].name + ", val: " + elements[i].value); //output test
    }
    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
                //alert(xmlHttp.responseText);
                //console.log(xmlHttp.responseText); //output test
                let splitData = JSON.parse(xmlHttp.responseText); // Gelen JSON verisi ayrıştırılıyor.
                //console.log(splitData.status, " ", splitData.message); //output test
                if(splitData.status === "success")
                {
                	// Uyarı divini ekrana eklemek için
                    addStatusElement("alert success", splitData.message, clearForm);
                }
                else
                {
                	// Uyarı divini ekrana eklemek için
                    addStatusElement("alert danger", splitData.message, clearForm);
                }
            }
        }
        //xmlHttp.open("post", "registrationTest.php");
        //xmlHttp.open("post", "registrationTest");
        xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/registrationControl");
        xmlHttp.send(formData);
}

// Uyarı divi, 4 farklı uyarıya göre ayarlanacak, en üstte göründükten 3sn. sonra otomatik silinecek
function addStatusElement(cName, message, callback) // alert alert-success gibi.
{
    const newElement = document.createElement("div");
    newElement.className = cName;
    let newChild = document.createTextNode(message);
    newElement.appendChild(newChild);
    document.querySelector("body").appendChild(newElement);
    //console.log("Element ", newElement); //output test

    callback(); // clearForm() çağrılıyor.
    setTimeout(function(){
        //document.querySelector("body").removeChild(newElement);
        let rmElement = document.getElementsByClassName(cName)[0];
        //console.log("Süre içerisinde", rmElement); //output test
        rmElement.parentNode.removeChild(rmElement);
    },3000);
}

function clearForm()
{
	// METOD 1
	/*let genClass = document.getElementsByClassName("formkapsaminput");
	for(i = 0; i < genClass.length; i++)
	{
		//console.log(genClass[i].value);
		genClass[i].value = "";
	}*/

	// METOD 2
	document.getElementById("registrationForm").reset();
}

function formValidation()
{
	validate(registration);
}

// METOD 2 - Dinamik
function validate(callback)
{
	let counter = 0;

	const getForm = document.forms["registrationForm"]; // *
	const getFormChildren = getForm.children[0].children;
	//console.log(getFormChildren); //output test
	for(i = 2; i < getFormChildren.length - 1; i++) // img, h3 ve submit hariç (ilk 2 son 1)
	{
		//console.log(getFormChildren[i].firstElementChild);
		//console.log(getFormChildren[i].children.length);
		if(getFormChildren[i].firstElementChild.value == "")
		{
			if(getFormChildren[i].children.length == 1) // dıştaki div alındı.
			{
				const mkElement = document.createElement("span");
				mkElement.className = "mArea";
				const mkChild = document.createTextNode("Bu alanı boş bırakamassınız");
				mkElement.appendChild(mkChild);

				getFormChildren[i].appendChild(mkElement);
				getFormChildren[i].firstElementChild.style = "border: 1px solid red;";
			}

			counter++;
		}
		else
		{
			if(getFormChildren[i].children.length != 1) // dıştaki div alındı.
			{
				getFormChildren[i].firstElementChild.removeAttribute("style");
				getFormChildren[i].children[1].remove();
			}
		}
	}

	if(counter == 0)
	{
		callback();
	}
}




// METOD 1 -- test yapıldıktan sonra duruma göre kaldırılacak.
/*
function validate(callback)
{
	const getForm = document.forms["registrationForm"];
	//console.log(getForm); //output test
	if(getForm["userName"].value != "" && getForm["pass"].value != "" && getForm["fName"].value != "" && getForm["lName"].value != "" && getForm["email"].value != "" && getForm["pNo"].value != "")
	{
		callback();
	}
	else
	{
		if(getForm["userName"].value == "");
		{
			//console.log(getForm["userName"].getAttribute("name"));
			//console.log(getForm["userName"].className);
			const parent = getForm["userName"].parentNode;
			console.log("parent: ", parent);

			const getChildren = parent.children;
			console.log("children:", getChildren);
			if(getChildren.length == 1)
			{
				const mkElement = document.createElement("span");
				mkElement.className = "mArea";
				let mkChild = document.createTextNode("Bu alanı boş bırakamassınız");
				mkElement.appendChild(mkChild);

				getForm["userName"].parentNode.appendChild(mkElement);
				getForm["userName"].style = "border: 1px solid red;";
			}
			detectArea("userName");
		}
		if(getForm["pass"].value == "");
		{
			
		}
		if(getForm["fName"].value == "");
		{
			
		}
		if(getForm["lName"].value == "");
		{
			
		}
		if(getForm["email"].value == "");
		{
			
		}
		if(getForm["pNo"].value == "");
		{
			
		}
	}
}

function detectArea(area)
{
	//console.log(getForm["userName"].getAttribute("name"));
	//console.log(getForm["userName"].className);
	const parent = getForm[area].parentNode;
	console.log("parent: ", parent);

	const getChildren = parent.children;
	console.log("children:", getChildren);
	if(getChildren.length == 1)
	{
		const mkElement = document.createElement("span");
		mkElement.className = "mArea";
		let mkChild = document.createTextNode("Bu alanı boş bırakamassınız");
		mkElement.appendChild(mkChild);

		getForm[area].parentNode.appendChild(mkElement);
		getForm[area].style = "border: 1px solid red;";
	}
}*/
// registration sonu --------------------------------------------------------------------------------

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

		/*document.body.style.color = "White";*/
		getHeader.className = "nav";

		document.body.style.background = "none";
		document.body.style.backgroundColor = "#191919";

		getHeader.style.backgroundColor = sessionStorage.getItem("hdrColor");
		getFooter.style.backgroundColor = sessionStorage.getItem("hdrColor");
		getContent.style.backgroundColor = sessionStorage.getItem("bgColor");

		//Color normalde de beyaz olduğundan bir süreliğine deaktif edilmiştir.
		/*let aList = document.getElementsByTagName("a");
		for(i=0;i<aList.length;i++)
		{
			//console.log(aList[i]);
			aList[i].style.color = "White";
		}*/
	}
	else //darkmode açılacak.
	{
		sessionStorage.setItem("darkMode", false);
		sessionStorage.bg = 0;

		document.body.style.background = "url('/images/bgimg1.png')";

		//Color normalde de beyaz olduğundan bir süreliğine deaktif edilmiştir.
		/*document.body.style.color = "Black";*/
		getHeader.removeAttribute("style");
		getFooter.removeAttribute("style");
		getHeader.className = "nav nav-bg";
		getFooter.className = "footer footer-bg";
		getContent.className = "content";
		getContent.removeAttribute("style");
	}
}

isChecked();
// Ayrılmış alan ------------------------------------------------------------------


/*index.php için, rel external olanlar _blank açtırılıyor.*/
function YeniSekme() {
    if (!document.getElementsByTagName) return;
    var linkler = document.getElementsByTagName("a");
    var linklerAdet = linkler.length;
    for (var i = 0; i < linklerAdet; i++) {
        var tekLink = linkler[i];
        if (tekLink.getAttribute("href") && tekLink.getAttribute("rel") == "external") {
            tekLink.target = "_blank";
        }
    }
}