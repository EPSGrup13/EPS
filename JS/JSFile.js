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
                    addStatusElement("alert success", splitData.message, clearForm); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
                }
                else
                {
                	// Uyarı divini ekrana eklemek için
                    addStatusElement("alert danger", splitData.message, clearForm); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
                }
            }
        }
        //xmlHttp.open("post", "registrationTest.php");
        //xmlHttp.open("post", "registrationTest");
        xmlHttp.open("post", "registrationControl");  // ana dizinde normal şekilde verilebilir, haricinde base href hedef alındığından test dizininde http tam linki verilmeli.
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

    callback("registrationForm"); // clearForm() çağırılıyor, içerisine de gereken form adı gönderiliyor.
    setTimeout(function(){
        //document.querySelector("body").removeChild(newElement);
        let rmElement = document.getElementsByClassName(cName)[0];
        //console.log("Süre içerisinde", rmElement); //output test
        rmElement.parentNode.removeChild(rmElement);
    },3000);
}

function clearForm(formName) // form adı gönderiliyor, addStatusElement içerisinde callback'e veriliyor sonra o isim
{
	// METOD 1
	/*let genClass = document.getElementsByClassName("formkapsaminput");
	for(i = 0; i < genClass.length; i++)
	{
		//console.log(genClass[i].value);
		genClass[i].value = "";
	}*/

	// METOD 2
	document.getElementById(formName).reset();
}

function formValidation()
{
	validate(registration);
}

// Dinamik olan metod tercih edildi
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

// registration sonu --------------------------------------------------------------------------------

//id'yi seçmek için
/*function editProfile()
{
    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function()
        {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
            {
            	console.log(xmlHttp.responseText);
            }
        }
        //xmlHttp.open("post", "registrationTest.php");
        //xmlHttp.open("post", "registrationTest");
        xmlHttp.open("GET", "http://epark.sinemakulup.com/external/tkeskin/settings/profile/save");
        xmlHttp.send();
}*/

function editProfile()
{
	getInputValues(sendProfileData);
}

function getInputValues(callback)
{
	const getSelection = document.getElementById("cities");
    var formData = new FormData();
    let dataCounter = 0; // formData'nın length fonksiyonu olmadığından counter ile veri miktarı takip ediliyor.

    // İl kısmı için select, option'dan seçili olan çekiliyor.
	for(i = 0; i < getSelection.children.length; i++)
	{
		//console.log(getSelection.children[i]); //output test
		if(getSelection.children[i].selected)
		{
			console.log("seçili il: ", getSelection.children[i]);
			console.log("name: ", getSelection.children[i].name ,"id: ", getSelection.children[i].value);
			formData.append("cities", getSelection.children[i].value); // selection'da name olmadığından city -> cities şeklinde biz belirleyerek giriyoruz
			console.log(formData.get("cities"));
			dataCounter++;
		}
	}

	// geriye kalan inputlar.
	const getInputs = document.getElementsByClassName("profileInput");
	for(i = 0; i < getInputs.length; i++)
	{
		if(getInputs[i].name == "fullName" && getInputs[i].value != "" || getInputs[i].name == "pNo" && getInputs[i].value != "" || getInputs[i].name == "email" && getInputs[i].value != "") //  || getInputs[i].name == "city" && getInputs[i].value != ""
		{
			console.log("name: ", getInputs[i].name, " value: ", getInputs[i].value)
			formData.append(getInputs[i].name, getInputs[i].value);
			dataCounter++;
		}
	}


	//-------------
	console.log("formData veri sayısı: ", dataCounter);
	//formData'daki verileri kontrol amaçlı length fonksiyonu olmadığından bu şekilde test ediliyor.
	/*for(i = 0; i < dataCounter.length; i++) // .length olmaz ise formDAta[i] is undefined hatası veriyor.
	{
		console.log("Formdata name:", formData[i].name, " value:", formData[i].value);
	}*/

	callback(formData);

}

function sendProfileData(data)
{
	var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
    		//console.log("gönderildi");
            console.log(xmlHttp.responseText);

            /*let splitData = JSON.parse(xmlHttp.responseText); // Gelen JSON verisi ayrıştırılıyor.
            console.log(splitData);*/
            /*if(splitData.status === "success")
            {
            	// Uyarı divini ekrana eklemek için
                addStatusElement("alert success", splitData.message, clearForm); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
            }
            else
            {
            	// Uyarı divini ekrana eklemek için
                addStatusElement("alert danger", splitData.message, clearForm); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
            }*/
        }
        else
        {
        	//console.log("gönderilemedi");
        }
    }
    xmlHttp.open("post", "settings/profile/save"); // ana dizine atıldığında çalıştırılacak, haricinde base href alınıyor hedef olarak.
    //xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/editProfileControl");
    xmlHttp.send(data);
}

// editProfile sonu -----------------------------------------------------------------------------------

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

if(document.getElementsByClassName("dba")[0] != undefined)
{
	isChecked();
}


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