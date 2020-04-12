class Request {
	constructor() {
		this.xmlHttp = new XMLHttpRequest();
		self.status = false; //postta değiştirilebilmesi için self yapıldı.
		self.data = new Array();
	}

	get(url) {
		if(!url.includes("https://")) {
			url = devMode()+url;
		}
		this.xmlHttp.onreadystatechange = function() {
			if(this.readyState === 4 && this.status === 200) {
				//console.log(this.responseText);
				let splitData = JSON.parse(this.responseText);
				//kullanım şekli aşağıdaki gibi.
				/*console.log(splitData);
				console.log(splitData.website);
				console.log(splitData.website2);
				console.log(splitData.website.version);*/
				self.data = splitData;
			}
		}
		this.xmlHttp.open("get", url, false) // false -> asenkron değil.
		this.xmlHttp.send();
		return self.data;
	}

	post(url, data) {
		this.xmlHttp.onreadystatechange = function() {
			if(this.readyState === 4 && this.status === 200) {
				//console.log(this.responseText);
				let splitData = JSON.parse(this.responseText);
				if(splitData.status === "success") {
					displayWarning("alert success", splitData.message);
					self.status = true;
				} else {
					displayWarning("alert danger", splitData.message);
					self.status = false;
				}
			}
		}
		this.xmlHttp.open("post", (devMode()+url), false); // false -> asenkron değil.
		this.xmlHttp.send(data);
		return self.status;
	}
}

const dMode = false;
function devMode() {
	if(dMode === true) {
		return "http://epark.sinemakulup.com/external/tkeskin/";
	} else {
		return "";
	}
}

function devURL() {
	if(dMode === true) {
		return "external/tkeskin/";
	} else {
		return "";
	}
}

function registration()
{
    //var elements = document.getElementsByClassName("formArea");
    var elements = document.getElementsByClassName("formkapsaminput");
    var formData = new FormData();
    //console.log("elements len:" + elements.length); //output test
    for(var i=0; i<elements.length; i++)
    {
    	// Kullanıcı kayıt olurken şifresinde escape string olmayacak böylece özel karakterleri şifrede kullanabilecek.
    	if(elements[i].name === "password") {
	        formData.append(elements[i].name, rmSpace(elements[i].value)); // rmSpace şifrede boşluk girilirse onu kaldırır
    	} else
    		formData.append(elements[i].name, cleanVal(elements[i].value));
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
        //xmlHttp.open("post", "register");  // ana dizinde normal şekilde verilebilir, haricinde base href hedef alındığından test dizininde http tam linki verilmeli.
        //xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/register");
        xmlHttp.open("post", devMode()+"register");
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

// Status elementini formsuz (sadece inputlar gönderilerek) çalıştıran şekli
function addStatusElementWithoutForm(cName, message, callback, inputsArray)
{
    const newElement = document.createElement("div");
    newElement.className = cName;
    let newChild = document.createTextNode(message);
    newElement.appendChild(newChild);
    document.querySelector("body").appendChild(newElement);
    //console.log("Element ", newElement); //output test

    callback("profileInput", inputsArray); // clearInputs çağırılıyor
    setTimeout(function(){
        //document.querySelector("body").removeChild(newElement);
        let rmElement = document.getElementsByClassName(cName)[0];
        //console.log("Süre içerisinde", rmElement); //output test
        rmElement.parentNode.removeChild(rmElement);
    },3000);
}

// Sadece uyarı şekli ve mesajını alan şekil
function displayWarning(cName, message)
{
    const newElement = document.createElement("div");
    newElement.className = cName;
    let newChild = document.createTextNode(message);
    newElement.appendChild(newChild);
    document.querySelector("body").appendChild(newElement);
    //console.log("Element ", newElement); //output test

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


// editProfile başlangıcı----------------------------------------------------------------------------
function editProfile()
{
	getInputValues(sendProfileData);
}

function getInputValues(callback)
{
	let funcStatus = 1;
	const getSelection = document.getElementById("cities");
    var formData = new FormData();
    let dataCounter = 0; // formData'nın length fonksiyonu olmadığından counter ile veri miktarı takip ediliyor.
    let inputName = new Array(); // input'u daha sonra temizlemek için

    // İl kısmı için select, option'dan seçili olan çekiliyor. input olmadığından inputName array'ine eklenmiyor
	for(i = 0; i < getSelection.children.length; i++)
	{
		//console.log(getSelection.children[i]); //output test
		if(getSelection.children[i].selected)
		{
			//console.log("seçili il: ", getSelection.children[i]);
			//console.log("name: ", getSelection.children[i].name ,"id: ", getSelection.children[i].value);
			formData.append("cities", getSelection.children[i].value); // selection'da name olmadığından city -> cities şeklinde biz belirleyerek giriyoruz
			//console.log(formData.get("cities"));
			dataCounter++;
		}
	}

	// geriye kalan inputlar.
	const getInputs = document.getElementsByClassName("profileInput");
	for(i = 0; i < getInputs.length; i++)
	{
		// boş olmaması için de kontrol yapılıyor
		if(getInputs[i].name === "fullName" && getInputs[i].value !== "") //  || getInputs[i].name == "city" && getInputs[i].value != ""
		{
			let getVal = getInputs[i].value;
			let valLen = getVal.split(" ");
			if(getVal.charAt(0) === " " || getVal.charAt(getVal.length - 1) === " ") // girilen ismin başında boşluk olmamalı.
			{
				displayWarning("alert danger", "İsim Boşluk ile başlayamaz veya bitemez.");
				funcStatus = 0;
				break;
			}
			else if(valLen.length < 2)
			{
				displayWarning("alert danger", "Adınızı tam giriniz.");
				funcStatus = 0;
				break;
			}
			else
			{
				//console.log("name: ", getInputs[i].name, " value: ", getInputs[i].value)
				formData.append(getInputs[i].name, cleanVal(getInputs[i].value));

				inputName.push(getInputs[i].name); // veri girilmiş olan inputun name'i kaydedilip daha sonra o input temizlenecek
				dataCounter++;
			}
		} else if((getInputs[i].name === "pass" && getInputs[i].value !== "") || (getInputs[i].name === "pass" && document.getElementsByClassName("confirmPass")[0].value !== "")) {
			if(document.getElementsByClassName("confirmPass")[0].value === getInputs[i].value) {
				formData.append(getInputs[i].name, rmSpace(getInputs[i].value)); // password için özel karakterler silinmeyecek. Sadece boşluk var ise onlar kaldırılacak

				inputName.push(getInputs[i].name); // veri girilmiş olan inputun name'i kaydedilip daha sonra o input temizlenecek
				dataCounter++;
			} else {
				displayWarning("alert danger", "Şifrenizin yenilenebilmesi için iki alanında dolu ve aynı olması gerekir.");
				funcStatus = 0;
				break;
			}
		}
		// boş olmaması için de kontrol yapılıyor
		else if(getInputs[i].name === "pNo" && getInputs[i].value !== "" || getInputs[i].name === "email" && getInputs[i].value !== "")
		{
			//console.log("name: ", getInputs[i].name, " value: ", getInputs[i].value)
			formData.append(getInputs[i].name, cleanVal(getInputs[i].value));

			inputName.push(getInputs[i].name); // veri girilmiş olan inputun name'i kaydedilip daha sonra o input temizlenecek
			dataCounter++;
		}

	}


	//-------------
	//console.log("formData veri sayısı: ", dataCounter);
	//formData'daki verileri kontrol amaçlı length fonksiyonu olmadığından bu şekilde test ediliyor.
	/*for(i = 0; i < dataCounter.length; i++) // .length olmaz ise formDAta[i] is undefined hatası veriyor.
	{
		console.log("Formdata name:", formData[i].name, " value:", formData[i].value);
	}*/

	if(funcStatus === 1)
	{
		callback(formData, inputName, clearInputs); // data, inputsArray, callback <- callback içinde callback
	}
}

function sendProfileData(data, inputsArray, callback) //callback içinde callback. inputsArray bu fonksiyon içerisinde kendi olmadığından bu fonksiyon çağrılırken buraya taşındı, buradan da callback'e gönderildi
{
	var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function()
    {
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            //console.log(xmlHttp.responseText); // hiç veri gönderilmesse <empty string> döner.

            // Yeni girilen verileri sayfa yenilemeden placeholder'a eklemek için
            let splitData = JSON.parse(xmlHttp.responseText); // Gelen JSON verisi ayrıştırılıyor.
            //console.log(splitData);
            if(splitData.status === "success")
            {
            	/* Kullanıcı profilindeki verilerini güncellediği anda veriler
            	* direk placeholder'a da eklenir böylece gösterim için de
            	* sayfa yenilenmek zorunda kalmaz
            	*/
                let getElement = document.getElementsByClassName("profileInput");
                for(i = 0; i < getElement.length; i++)
                {
                	for(j = 0; j < inputsArray.length; j++)
                	{
                		//console.log(getElement[i].name, " " ,inputsArray[j]);
                		if(getElement[i].name == inputsArray[j])
                		{
                			//Metod 2
                			if(getElement[i].name !== "pass") {
                				// Eğer kullanıcı adı güncelleniyor ise ek olarak header'ı da güncelleyecek
                				if(getElement[i].name === "fullName")
                					document.getElementsByClassName("uprofile")[0].textContent = data.get(inputsArray[j]);
            					getElement[i].placeholder = data.get(inputsArray[j]); // pass haricindeki tüm inputların placeholderları yenilenecek
                			}
                			// Metod 2 sonu

                			// Metod 1
                			/*// Eğer kullanıcı adı güncelleniyor ise ek olarak header'ı da güncelleyecek
                			if(getElement[i].name === "fullName") {
                				document.getElementsByClassName("uprofile")[0].textContent = data.get(inputsArray[j]);
                				getElement[i].placeholder = data.get(inputsArray[j]);
                			} else if(getElement[i].name !== "pass") // şifre için placeholde yenileme yapılmayacak (şifrenin görünmemesi için)
                				getElement[i].placeholder = data.get(inputsArray[j]);*/
                		}
                	}
                }
                //-------------
            	// Uyarı divini ekrana eklemek için
                addStatusElementWithoutForm("alert success", splitData.message, clearInputs, inputsArray); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
				clearSpecificInput("confirmPass", 0); // confirmPass kısmı
            }
            else
            {
            	// Uyarı divini ekrana eklemek için
                addStatusElementWithoutForm("alert danger", splitData.message, clearInputs, inputsArray); //callback fonksiyonları çağırılırken içerisine gönderilen veri callback çağırılırken verilir, callback fonksiyonunun adı gönderilirken değil.
				clearSpecificInput("confirmPass", 0); // confirmPass kısmı
            }
        }
        /* readyState durumu 0-1-2-3-4 şeklinde ilerlediğinden else duurumu da readyState 4 olmadan çalışıyor,
        	bu yüzden ilk hata verip sonra başarılı yazıyor. Oluşan hatadan dolayı else durumu kaldırıldı */
        /*else
        {
            addStatusElementWithoutForm("alert danger", "Profili güncellerken sorun oluştu", clearInputs, inputsArray);
        }*/
    }
    //xmlHttp.open("post", "settings/profile/save"); // ana dizine atıldığında çalıştırılacak, haricinde base href alınıyor hedef olarak.
    //xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/settings/profile/save");
    xmlHttp.open("post", devMode()+"settings/profile/save");
    xmlHttp.send(data);
}

// gönderilen class name'i aynı olan elementlerde inputsArray içerisinde bulunan name'leri gezerek input value temizler. Form olmayan yöntemlerde kullanılır, form için clearForm metodu kullanılır.
function clearInputs(className, inputsArray) // (inputsArray, className)
{
	let element = document.getElementsByClassName(className);

	for(let i = 0; i < element.length; i++)
	{
		for(let j = 0; j < inputsArray.length; j++)
		{
			if(element[i].name == inputsArray[j])
			{
				//console.log(element[i], " " ,inputsArray[j]);
				element[i].value = "";
			}
		}
	}
}

function clearSpecificInput(className, index) {
	document.getElementsByClassName(className)[index].value = "";
}

// Belirtilmiş özel karakterleri gönderilen inputtan siler, koruma sağlamak amacıyla yapılmıştır
function cleanVal(value) { //function cleanVal(value)
	//let value = "!!+'\nasdart\r"; // örnek input, variable'a girilen \\ ile kullanıcıdan girilen \ aynıdır.
	const spcChars = ['!','\'','^','+','%','&','#','$','|','~',':',';','=','/','\\','(',')','{','}','[',']',',','_','-','*','<','>','\r','\n']; // '.' ve '@' email için kaldırıldı
	let getData = value;
	//getData = getData.replace(/\\/g, '\\\\'); // /"/g", '\\"' şeklinde kullanımı (" -> \\" şeklinde değiştiriliyor)
	for(let i = 0; i < getData.length; i++) {
		if(spcChars.includes(getData.charAt(i))) {
			getData = getData.slice(0,i) + getData.slice(i + 1);
			i--;
		}
	}

	return getData;
}

// editProfile sonu -----------------------------------------------------------------------------------

// lostPassword başlangıcı ----------------------------------------------------------------------------
function generateToken() {
	const emailInput = document.getElementsByClassName("lostPwi")[0];
    var formData = new FormData();
    if(emailInput.value.length !== 0) {
    	formData.append(emailInput.name, cleanVal(emailInput.value));

	    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                //console.log(xmlHttp.responseText); //output test
                let splitData = JSON.parse(xmlHttp.responseText); // Gelen JSON verisi ayrıştırılıyor.
                if(splitData.status === "success") {
                    displayWarning("alert success", splitData.message);
                    clearSpecificInput("lostPwi", 0);
                } else {
                    displayWarning("alert danger", splitData.message);
                }
            }
        }
        //xmlHttp.open("post", "lpgen");  // ana dizinde normal şekilde verilebilir, haricinde base href hedef alındığından test dizininde http tam linki verilmeli.
        //xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/lpgen");
		xmlHttp.open("post", devMode()+"lpgen");
        xmlHttp.send(formData);
    } else {
    	displayWarning("alert danger", "Alanı boş bırakmamalısınız");
    }
}

function updatePass() {
	updateProcess();
}

function updateProcess() {
	let counter = 0;
	const parentNode = document.getElementById("lp-val"); //class'da children veya childNodes alamıyor, o yüzden id kullanıldı
	const pnChildren = parentNode.children; //childNodes tüm elementleri vereceğinden sadece div ve butonlar istendiğinden children kullanıldı
	for(let i = 2; i < pnChildren.length - 1; i++) { // buton hariç // i = 0 -> i = 2 olarak değiştirildi, üste 2 element eklendiğinden 3. ve 4. element gerekiyor sadece (index 2,3)
		//console.log(pnChildren[i].children[0]);
		if(pnChildren[i].children[0].value.length < 1) { // button hariç
			if(pnChildren[i].children.length === 1) {
				const mkElement = document.createElement("span");
				mkElement.className = "mArea";
				const mkChild = document.createTextNode("Bu alanı boş bırakamassınız");
				mkElement.appendChild(mkChild);

				pnChildren[i].appendChild(mkElement);
				pnChildren[i].children[0].style = "border: 1px solid red;";
			}
		} else {
			if(pnChildren[i].children.length !== 1) {
				pnChildren[i].children[0].removeAttribute("style");
				pnChildren[i].children[1].remove();
				counter++;
			} else {
				counter++;
			}
		}
	}

	if(counter === 2) {
		const getOuterDiv = document.getElementById("lp-val");
		if(rmSpace(getOuterDiv.children[2].firstElementChild.value) === rmSpace(getOuterDiv.children[3].firstElementChild.value)) { // children[0] ve [1] değişiklikten sonra -> [2] ve [3]
			sendPassData();
		} else {
			displayWarning("alert danger", "Şifre alanları eşit olmalı");
		}
	}
}

function sendPassData() {
	const pass = document.getElementsByClassName("lp-input")[0];
    var formData = new FormData();
    formData.append(pass.name, cleanVal(pass.value));
    var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                //console.log(xmlHttp.responseText); //output test
                let splitData = JSON.parse(xmlHttp.responseText); // Gelen JSON verisi ayrıştırılıyor.
                if(splitData.status === "success") {
					displayWarning("alert success", splitData.message);
					clearSpecificInput("lp-input", 0);
					clearSpecificInput("lp-input", 1);
                } else {
                    displayWarning("alert danger", splitData.message);
                }
            }
        }
        //xmlHttp.open("post", "lpcont");  // ana dizinde normal şekilde verilebilir, haricinde base href hedef alındığından test dizininde http tam linki verilmeli.
        //xmlHttp.open("post", "http://epark.sinemakulup.com/external/tkeskin/lpcont");
		xmlHttp.open("post", devMode()+"lpcont");
        xmlHttp.send(formData);
}

// Girilen şifrelerde boşluk var ise onu kaldırır
function rmSpace(password) {
	for(let i = 0; i < password.length; i++) {
		if(password.charAt(i) === " ") {
			password = password.slice(0,i) + password.slice(i + 1);
			i--;
		}
	}

	return password;
}

// lostPassword sonu ----------------------------------------------------------------------------------

// reservation başlangıcı
function mkReservation() {
	const request = new Request(); // obje oluşturuldu.
    var formData = new FormData();
    let dataArray = new Array();

	const getForm = document.getElementsByClassName("parkReservationTimeForm")[0];
	getForm.addEventListener("submit", run);
	let counter = 0;

	const getTime = document.getElementsByClassName("cb-time");
	for(let i = 0; i < getTime.length; i++) {
		if(getTime[i].children[1].name !== undefined && getTime[i].children[1].value !== undefined && getTime[i].children[1].checked) {
			//console.log(getTime[i].children[1].name, " " ,getTime[i].children[1].value);
			dataArray.push(getTime[i].children[1].value);
			counter++;
		}
	}

	if(counter === 0) {
		displayWarning("alert danger", "Saat seçiniz");
	} else {
		formData.append("time", dataArray);
		let getParkUrl = window.location.href.split("/");
		formData.append("park_url", getParkUrl[getParkUrl.length - 1]);
		/*console.log(formData.get("time"));
		console.log(formData.get("park_url"));
		console.log(getParkUrl[getParkUrl.length - 1]);*/
		const status = request.post("makeReservation", formData);

		//console.log(status);
		if(status === "true") { // string true
			for(i = 0; i < getTime.length; i++) {
				if(getTime[i].children[1].checked) {
					getTime[i].children[0].src = devURL()+"images/car-red.png";
					getTime[i].children[1].remove(); //inputu kaldır
					const newChild = document.createElement("span");
					newChild.style.color = "red";
					newChild.appendChild(document.createTextNode("DOLU"));
					getTime[i].appendChild(newChild); //dolu yazısını koy
				}
			}
		}
	}
}

// default submit butonunun özellikleri kaldırıldı
function run(e) {
	e.preventDefault();
}

// reservation bitişi

function ckVersion() {
	const request1 = new Request();
	const request2 = new Request();
	let orjVer = request1.get("https://raw.githubusercontent.com/EPSGrup13/EPS/master/config/data.json"); // splitData çekiliyor.
	let currentVer = request2.get("config/data.json")
	if(orjVer !== undefined && currentVer !== undefined) {
		if(orjVer.website.version !== currentVer.website.version && (sessionStorage.getItem("bar-warning") === "true" || sessionStorage.getItem("bar-warning") == undefined)) {
			console.log(orjVer.website.version, " ", currentVer.website.version); // versiyonları göstermek için.
			stickyBar("sticky-bar warning ta-center", ("Orijinal versiyon: " +orjVer.website.version+ " fakat kullandığınız: " +currentVer.website.version+ " olarak görünmekte!"));
		} else {
			console.log(orjVer.website.version, " ", currentVer.website.version);
			console.log("Versiyon uyumlu veya bastırılmış");
		}
	}
}

function stickyBar(cName, message) {
	const existingElement = document.getElementsByClassName("sticky-bar");
	if(existingElement.length !== 1) {
	    const newElement = document.createElement("div");
	    newElement.className = cName;

	    const subElement = document.createElement("button");
	    subElement.className = "sb-btn";
	    subElement.textContent = "Birdaha Gösterme";
	    subElement.addEventListener("click", close);

	    let newChild = document.createTextNode(message);
	    newElement.appendChild(newChild);
	    newElement.appendChild(subElement);
	    document.querySelector("body").appendChild(newElement);

	 	sessionStorage.setItem("bar-warning", "true");
	}
}

function close() {
	const element = document.getElementsByClassName("sticky-bar")[0];
	element.classList.toggle("hide");
	sessionStorage.setItem("bar-warning", "false");

    setTimeout(function(){
		element.classList.toggle("close");
    },500);
}

// Login

function login() {
	const request = new Request();
	var formData = new FormData();

	$getButton = document.getElementsByClassName("l-btn")[0];
	$getButton.addEventListener("click", function(e){
		e.preventDefault();
	})
	$getEmail = document.getElementsByClassName("formkapsaminput")[0];
	$getPass = document.getElementsByClassName("formkapsaminput")[1];
	if($getEmail.value.length === 0 || $getPass.value.length === 0) {
		displayWarning("alert danger", "Alanları boş bırakamassınız.");
	} else {
		formData.append($getEmail.name, cleanVal($getEmail.value));
		formData.append($getPass.name, $getPass.value);
		const status = request.post("source/loginControl", formData);
		if(status === "true") { // string true
			clearSpecificInput("formkapsaminput", 0);
			clearSpecificInput("formkapsaminput", 1);
			setTimeout(function(){
			window.location.href = (devMode() + "cities"); // displaywarning 3sn. ama 1sn. sonra sayfa değiştirilerek displaywarning de kesilecek.
			}, 1000);
		} else {
			clearSpecificInput("formkapsaminput", 1); // sadece şifreyi silmesi için
		}
	}
}

// Login sonu

function logout() {
	displayWarning("alert warning", "Çıkış yapılıyor...");
	setTimeout(function(){
	window.location.href = (devMode() + "cities?logout");
	}, 1000); // displaywarning 3sn. ama 1sn. sonra sayfa değiştirilerek displaywarning de kesilecek.
}

function darkMode()
{
	const getCb = document.getElementById("dm");
	if(getCb.checked === true) {
		sessionStorage.setItem("darkMode", "true");
		isChecked();
	} else {
		sessionStorage.setItem("darkMode", "false");
		isChecked();
	}
}

function isChecked()
{
	const getCb = document.getElementById("dm");
	if(sessionStorage.getItem("darkMode") === "false" || sessionStorage.getItem("darkMode") == undefined) {
		setStyles();
		sessionStorage.setItem("darkMode", "false");
		getCb.checked = false;
	} else {
		setStyles();
		sessionStorage.setItem("darkMode", "true");
		getCb.checked = true;
	}
}

function setStyles()
{
	let getHeader = document.querySelector(".headerInline");
	let getFooter = document.querySelector(".footer");
	let getContent = document.querySelector(".content");

	if(sessionStorage.getItem("darkMode") === "false") { // darkmode kapanınca
		document.body.classList.remove("dm-v");
		getHeader.classList.remove("dm-v2");
		getFooter.classList.remove("dm-v2");
	} else { // darkmode açılınca
		document.body.classList.toggle("dm-v");
		getHeader.classList.toggle("dm-v2");
		getFooter.classList.toggle("dm-v2");
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