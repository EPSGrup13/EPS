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

	receiveData(url, data) { // post ile gerekli WHERE koşulu gönderilerek veri çekiliyor.
		this.xmlHttp.onreadystatechange = function() {
			if(this.readyState === 4 && this.status === 200) {
				try { // eğer parse yapılabilir bir veri ise
					let splitData = JSON.parse(this.responseText);
					self.data = splitData;
				} catch (e) { // eğer parse yapılamaz (hata yazısı) ise direk yazdır
					self.data = this.responseText;
				}
			}
		}
		this.xmlHttp.open("post", (devMode()+url), false); // false -> asenkron değil.
		this.xmlHttp.send(data);
		return self.data;
	}

	/* sadece TRUE - FALSE için değil, aynı zamanda ekrana yazdırılabilecek herhangi bir
	veriyi çekmek için de kullanılabilir bir hal almıştır. */
	booleanControl(url) {
		if(!url.includes("https://")) {
			url = devMode()+url;
		}
		this.xmlHttp.onreadystatechange = function() {
			if(this.readyState === 4 && this.status === 200) {
				//console.log(this.responseText);
				self.data = this.responseText;
			}
		}
		this.xmlHttp.open("get", url, false) // false -> asenkron değil.
		this.xmlHttp.send();
		return self.data;
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
    var elements = document.getElementsByClassName("form-input");
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

	const getForm = document.forms["registrationForm"];
	const getFormChildren = getForm.children;
	for(i = 1; i < getFormChildren.length - 1; i++) // kayıt ol kısmı haric, buton kısmı hariç
	{
		//console.log(getFormChildren[i].children[1]);
		if(getFormChildren[i].children[1].value.length === 0)
		{
			console.log(getFormChildren[i].children.length);
			if(getFormChildren[i].children.length === 2) // dıştaki div length.
			{
				const mkElement = document.createElement("span");
				mkElement.className = "mArea";
				const mkChild = document.createTextNode("Bu alanı boş bırakamazsınız");
				mkElement.appendChild(mkChild);

				getFormChildren[i].appendChild(mkElement);
				getFormChildren[i].children[1].style = "border: 1px solid red;";
			}

			counter++;
		}
		else
		{
			if(getFormChildren[i].children.length != 2) // dıştaki div alındı.
			{
				getFormChildren[i].children[1].removeAttribute("style");
				getFormChildren[i].children[2].remove();
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
				const mkChild = document.createTextNode("Bu alanı boş bırakamazsınız");
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
					getTime[i].children[0].src = devURL()+"images/car-orange.png";
					getTime[i].children[1].remove(); //inputu kaldır
					const newChild = document.createElement("span");
					newChild.style.color = "orange";
					newChild.appendChild(document.createTextNode("Onay Bekliyor"));
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
	} else {
		console.log("orjVer or currentVer is undefined");
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

	const getButton = document.getElementsByClassName("form-button")[0];
	if(getButton !== undefined) {
		getButton.addEventListener("click", function(e){
			e.preventDefault();
		})
	}
	const getEmail = document.getElementsByClassName("form-input")[0];
	const getPass = document.getElementsByClassName("form-input")[1];
	if(getEmail === undefined || getPass === undefined) {
		displayWarning("alert danger", "Girilen inputlar ile ilgili bir sorun oluştu.");
	} else if(getEmail.value.length === 0 || getPass.value.length === 0) {
		displayWarning("alert danger", "Alanları boş bırakamazsınız.");
	} else {
		formData.append(getEmail.name, cleanVal(getEmail.value));
		formData.append(getPass.name, getPass.value);
		const status = request.post("source/loginControl", formData);
		if(status === "true") { // string true
			clearSpecificInput("form-input", 0);
			clearSpecificInput("form-input", 1);
			setTimeout(function(){
			window.location.href = (devMode() + "cities"); // displaywarning 3sn. ama 0.6sn. sonra sayfa değiştirilerek displaywarning de kesilecek.
			}, 600);
		} else {
			clearSpecificInput("form-input", 1); // sadece şifreyi silmesi için
		}
	}
}

// Login sonu

function comments(parkId) {
	if(document.getElementsByClassName("parkPageForCity").length == 2) {
		const getSections = document.getElementsByClassName("parkPageForCity");

	    let opacity = 0.8;
	    for(let i = 0; i < 5; i++) {
		    setTimeout(function() {
		    	getSections[1].style.opacity = opacity;
		    	opacity = opacity - 0.2;
		    }, 10);
	    }

	    setTimeout(function() {
	    	try {
				getSections[1].remove();
	    	} catch (e) {
				getSections[0].classList.toggle("move-l");
	    	}
	    }, 500);

		getSections[0].classList.toggle("move-l");
	} else {
		const getParkSection = document.getElementsByClassName("parkPageForCity")[0];
		getParkSection.classList.toggle("move-l");

		const newElement = document.createElement("div");
	    newElement.className = "parkPageForCity scrollable";
	    newElement.style.marginLeft = "23px";
	    newElement.style.opacity = "0";
	    document.querySelector(".content").appendChild(newElement);


	    const getCommentSection = document.getElementsByClassName("parkPageForCity")[1];
	    let opacity = 0.2;
	    for(let i = 0; i < 5; i++) {
		    setTimeout(function() {
		    	getCommentSection.style.opacity = opacity;
		    	opacity = opacity + 0.2;
		    }, 200);
	    }

    	loadComments(parkId);
	}

}


// Yapılmış yorumları listelemek için
function loadComments(parkId) {
	const getCommentSection = document.getElementsByClassName("parkPageForCity")[1];
	const request = new Request();
	var formData = new FormData();

	formData.append("parkId", parkId);
	const data = request.receiveData("source/gt-comments", formData);
	if(typeof(data) === "string") { // eğer gelen response yorumlar değilde sadece yazı (hata yazısı) ise
		//console.log(data);
		const newElement = document.createElement("div");
		newElement.style.padding = "10px";
		newElement.style.color = "black";

	    let newChild = document.createTextNode(data);
	    newElement.appendChild(newChild);
	    getCommentSection.appendChild(newElement);

		// Eğer kişi kullanıcı girişi yapmış ise yorum yapabilecek
		const ans = request.booleanControl("source/ck-session");
		if(ans == 1) { // eğer TRUE ise ama === olarak değil
	    	mkComment(parkId);
		}/* else {
			console.log("load error");
		}*/
	} else { // eğer string değilse (yani yorumlar -> object) ise.
		/* data max length [8] */
		for(let i = 0; i < data.length; i++) {
			// outer div
			const newElement = document.createElement("div");
			newElement.className = "ext-cmt";
			newElement.style.color = "black";

			// inner
			const extTopic = document.createElement("div");
			extTopic.className = "ext-cmt-topic";

			const extTopicL = document.createElement("span");
			extTopicL.className = "ext-cmt-topic-l";

			extTopicL.appendChild(document.createTextNode(data[i][5] + " " + data[i][6] + " - " + data[i][1])); // [5] -> ad, [6] -> soyad | [1] -> puan
			// puan için star icon
			const icon = document.createElement("img");
			icon.src = devURL() + "images/star.png";
			icon.className = "star-icon";
			extTopicL.appendChild(icon);
			// --

			const extTopicR = document.createElement("span");
			extTopicR.className = "ext-cmt-topic-r";
			extTopicR.appendChild(document.createTextNode("Tarih: " + data[i][4] + " " + reArrangeDate(data[i][3]))); // [4] -> saat, [5] -> tarih

			extTopic.appendChild(extTopicL);
			extTopic.appendChild(extTopicR);
			newElement.appendChild(extTopic);

			const extMessage = document.createElement("div");
			extMessage.className = "ext-cmt-message";
			extMessage.appendChild(document.createTextNode(data[i][0])); // [0] -> comment
			newElement.appendChild(extMessage);

			// Metod 1
			/*for(let j = 0; j < data[i].length; j++) {
				//console.log(data[i][j]);
				newElement.appendChild(document.createTextNode(data[i][j]));
			}*/

			// Metod 2 - Dağınık veri listeleme yapılabilmesi mümkün olan
			/*newElement.appendChild(document.createTextNode("Başlık: " + data[i][0]));
			newElement.appendChild(document.createTextNode("Puan: " + data[i][2] + "\n"));
			newElement.appendChild(document.createTextNode("Yorum: " + data[i][1] + "\n"));
			newElement.appendChild(document.createTextNode("Person id: " + data[i][3] + " Ad Soyad gelecek\n"));
			newElement.appendChild(document.createTextNode("Tarih: " + data[i][4] + "\n"));
			newElement.appendChild(document.createTextNode("Saat: " + data[i][5] + "\n"));*/

		    getCommentSection.appendChild(newElement);
		}

		// Eğer kişi kullanıcı girişi yapmış ise yorum yapabilecek
		const ans = request.booleanControl("source/ck-session");
		if(ans == 1) { // eğer TRUE ise ama === olarak değil
	    	mkComment(parkId);
		}/* else {
			console.log("load error");
		}*/
	}
}

// Yeni yorum yapabilmek için alan
function mkComment(parkId) {
	const MAX_LENGTH = 255;
	const getCommentSection = document.getElementsByClassName("parkPageForCity")[1];
	if(getCommentSection !== undefined) {
		// outer div
		const newElement = document.createElement("div");
		newElement.style.color = "black";
		newElement.className = "cmt-mainSection";

		// inner
		const cmtHead = document.createElement("span");
		cmtHead.appendChild(document.createTextNode("Yorum Ekle:"));
		cmtHead.setAttribute("class", "cmt-head");
		newElement.appendChild(cmtHead);


		// slider ve puan birlikte --------------------------
		const outerRange = document.createElement("div");
		outerRange.className = "outerRange";

		const rangeSlider = document.createElement("input");
		rangeSlider.className = "point-slider";
		rangeSlider.setAttribute("type", "range");
		rangeSlider.setAttribute("min", "0");
		rangeSlider.setAttribute("max", "50");
		rangeSlider.setAttribute("value", "50");
		// değişimden sonra range değerini göstermek için
		rangeSlider.oninput = function() {
			rangeDisplay.textContent = "Puan: " + (rangeSlider.value / 10).toFixed(1); // float'a çevrilip ',' den sonra 1 digit
		}
		outerRange.appendChild(rangeSlider);

		// başlangıçta range değerini göstermek için
		const rangeDisplay = document.createElement("div");
		rangeDisplay.className = "point-display";
		rangeDisplay.textContent = "Puan: " + (rangeSlider.value / 10).toFixed(1); // float'a çevrilip ',' den sonra 1 digit
		outerRange.appendChild(rangeDisplay);

		newElement.appendChild(outerRange);
		// slider outer bitiş --------------------------------

		/* topic ----------
		const topic = document.createElement("input");
		topic.setAttribute("type", "text");
		topic.setAttribute("class", "cmt-topic");
		topic.setAttribute("name", "topic");
		topic.setAttribute("placeholder", "Konu Adı");
		// end-topic ------ */

		// message --------
		const message = document.createElement("textarea");
		//message.setAttribute("type", "text");
		message.setAttribute("class", "cmt-message");
		message.setAttribute("name", "message");
		message.setAttribute("placeholder", "Mesaj Alanı...");
		message.addEventListener("keyup", function() { // keydown sonra işlediğinden 1 eksik çıkar
			if(this.value.length <= MAX_LENGTH) {
				chLeft.textContent = MAX_LENGTH - this.value.length + " karakter hakkınız kaldı.";
			} else {
				this.value = this.value.slice(0, MAX_LENGTH);
				//chLeft.textContent = MAX_LENGTH - this.value.length + " karakter hakkınız kaldı.";
			}
		})
		// end-message ----

		//newElement.appendChild(topic);
		newElement.appendChild(message);

		const submitBtn = document.createElement("button");
		submitBtn.textContent = "Gönder";
		submitBtn.className = "cmt-btn";
		submitBtn.setAttribute("onclick", "sendComment(" + parkId + "); return false;");

		const clearBtn = document.createElement("button");
		clearBtn.textContent = "Temizle";
		clearBtn.className = "cmt-btn";
		clearBtn.setAttribute("onclick", "clTextArea(); return false;");

		const chLeft = document.createElement("span");
		chLeft.textContent = "255 karakter hakkınız kaldı.";
		chLeft.className = "";

		newElement.appendChild(submitBtn);
		newElement.appendChild(clearBtn);
		newElement.appendChild(chLeft);
		getCommentSection.appendChild(newElement);
	}
}

// Yorum yapma sistemi - yapılan yorumu çekip gönderiyor
function sendComment(parkId) {
	const request = new Request();
	var formData = new FormData();
	const pattern = /^([a-zçğıöşüA-ZÇĞİÖŞÜ]{1,})/; // Minimum 1 karakter a-zA-Z ile başlamalı. (TR karakterler de eklendi)

	const textArea = document.getElementsByClassName("cmt-message")[0];
	const comment = cleanVal(textArea.value);
	// point için
	const getPointArea = document.getElementsByClassName("point-slider")[0].value;
	const getPoint = (getPointArea / 10).toFixed(1);
	// point sonu
	if(comment.match(pattern)) {
		formData.append("comment", comment);
		formData.append("park_id", parkId);
		formData.append("point", getPoint);
		request.post("source/snd-message", formData);

		// Yorum başarılı olduğuna direk listeye eklenecek
		const fName = request.booleanControl("source/gt-session-pfname"); // Kişinin adını session'dan alıyor.
		const getCommentSection = document.getElementsByClassName("parkPageForCity")[1];
		// eğer Yorum bulunmamaktadır yazıyorsa o silinecek.
		if(getCommentSection.children[0].className === "") {
			getCommentSection.children[0].remove();
		}

		const newElement = document.createElement("div");
		newElement.className = "ext-cmt";
		newElement.style.color = "black";

		// inner
		const extTopic = document.createElement("div");
		extTopic.className = "ext-cmt-topic";

		const extTopicL = document.createElement("span");
		extTopicL.className = "ext-cmt-topic-l";

		// point alanı
		extTopicL.appendChild(document.createTextNode(fName + " - " + getPoint)); // -> ad, -> soyad | -> puan
		// puan için star icon
		const icon = document.createElement("img");
		icon.src = devURL() + "images/star.png";
		icon.className = "star-icon";
		extTopicL.appendChild(icon);
		// --

		let dNow = new Date();
		const extTopicR = document.createElement("span");
		extTopicR.className = "ext-cmt-topic-r";
		extTopicR.appendChild(document.createTextNode("Tarih: " + dNow.getHours() + ":" + dNow.getMinutes() + ":" + dNow.getSeconds() + " " + dNow.getDate() + "-" + dNow.getMonth() + "-" + dNow.getFullYear())); // -> saat, -> tarih

		extTopic.appendChild(extTopicL);
		extTopic.appendChild(extTopicR);
		newElement.appendChild(extTopic);

		const getCurrentComment = document.getElementsByClassName("cmt-message")[0].value; // textArea'daki veri çekiliyor.
		const extMessage = document.createElement("div");
		extMessage.className = "ext-cmt-message";
		extMessage.appendChild(document.createTextNode(getCurrentComment)); // -> comment
		newElement.appendChild(extMessage);

		// Yorum ekle kısmının üzerine eklenmesi için son index öncesine ekleniyor.
    	getCommentSection.insertBefore(newElement, getCommentSection.childNodes[getCommentSection.childNodes.length - 1]);

    	// yorum alanını temizlemek için
    	clTextArea();
	} else {
		displayWarning("alert danger", "Hatalı input");
	}
}

function clTextArea() {
	const textArea = document.getElementsByClassName("cmt-message")[0];
	textArea.value = "";
	document.getElementsByClassName("point-slider")[0].value = 50;
	document.getElementsByClassName("point-display")[0].textContent = "Puan 5.0";
}

// Yeni araç eklemek için dinamik input oluşturma alanı
function addCarSection() {
	const outerDiv = document.getElementsByClassName("nc-inline")[0];

	const newElement = document.createElement("input");
	newElement.setAttribute("type", "text");
	newElement.setAttribute("class", "n-car");
	newElement.setAttribute("name", "newCar[]");
	newElement.setAttribute("placeholder", "Örnek: 34ABC123");
	newElement.style.display = "block";
	outerDiv.appendChild(newElement);
}

// Araç ekleme sistemi için veriyi işleyip gönderen kısım
function addCar() {
	const request = new Request();
	var formData = new FormData();
	let dataArray = new Array();
	const pattern = /^([0-9]{2})([a-zA-Z]{1,3})([0-9]{1,3})$/; // 34ABC123 MAX LENGTH

	const getInputs = document.getElementsByClassName("n-car");
	if(getInputs.length !== 0) {
		for(let i = 0; i < getInputs.length; i++) {
			if(getInputs[i].value.length !== 0 && getInputs[i].value.match(pattern)) {
				dataArray.push(cleanVal(getInputs[i].value));
			} else if(getInputs[i].value.length === 0) {
				getInputs[i].remove();
				i--; // node silindiğinden arada bir i kaçırılmış oluyor.
			} else {
				getInputs[i].value = "";
			}
		}
	}

	if(dataArray.length !== 0) {
		formData.append("newCar", dataArray);
		const status = request.post("source/add-car", formData);
		if(status === "true") {
			// tüm inputları silecek.
			i = 0;
			while(getInputs !== undefined) {
				getInputs[i].remove();
				//i++; // i hiç arttırılmayacak, firstChild işlevi görecek.
			}
		}
	}
}

// Araç is_main yapmak için. (selected alıp, person_id -> is_main hepsini 0 sonra selected is_main-> 1)
function mkMain(plate) {
	const request = new Request();
	var formData = new FormData();

	formData.append("plate", plate);
	const status = request.post("source/chg-main", formData);
}

function logout() {
	displayWarning("alert warning", "Çıkış yapılıyor...");
	setTimeout(function(){
	window.location.href = (devMode() + "cities?logout");
	}, 600); // displaywarning 3sn. ama 0.6sn. sonra sayfa değiştirilerek displaywarning de kesilecek.
}

function updateRv(boolean, rvid) {
	const request = new Request();
	var formData = new FormData();

	if(boolean === "true") { // string olarak geliyor
		formData.append("status", "TRUE");
		formData.append("rvid", rvid);
		const status = request.post("updateRv", formData);
	} else {
		formData.append("status", "FALSE");
		formData.append("rvid", rvid);
		const status = request.post("updateRv", formData);
	}
}

function reArrangeDate(date) {
	const dateArray = date.split("-");
	const newDate = dateArray[2] + "-" + dateArray[1] + "-" + dateArray[0];
	return newDate;
}

/* Park Form başlangıcı */
function parkForm() {
	const request = new Request();
	var formData = new FormData();
	/* hepsi tek tek alınacak (validation için) */
	let status = 0;
	let parkName = document.getElementsByClassName("bilgi-girisi")[0].value;
	let email = document.getElementsByClassName("bilgi-girisi")[1].value;
	let phoneNo = document.getElementsByClassName("bilgi-girisi")[2].value;
	let address = document.getElementsByClassName("otopark-adresi")[0].value;
	const pattern1 = /^([a-zçğıöşüA-ZÇĞİÖŞÜ0-9]{1})([a-zçğıöşüA-ZÇĞİÖŞÜ0-9.,/: ])+$/; // otopark adı ve adres için.
	const pattern2 = /^([a-z])([a-zA-Z0-9])+\@{1}[a-z]+[.]{1}[a-z]+$/; // email için
	const pattern3 = /^[0-9]{3} [0-9]{3} [0-9]{2} [0-9]{2}$/; // phoneNo için

	// Conditional (Ternary) şeklinde
	parkName.match(pattern1) ? (email.match(pattern2) ? (phoneNo.match(pattern3) ? (address.match(pattern1) ? status = 1 : displayWarning("alert danger", "Hatalı adres girişi")) : displayWarning("alert danger", "Hatalı telefon numarası girişi")): displayWarning("alert danger", "Hatalı email girişi")) : displayWarning("alert danger", "Hatalı park adı girişi");
	if(status === 1) {
		formData.append("parkName", parkName);
		formData.append("email", email);
		formData.append("phoneNo", phoneNo);
		formData.append("address", address);
		const status = request.post("source/snd-parkform", formData);
		if(status === "true") {
			document.forms[0].reset();
		} else {
			console.log("failed");
		}
	}
}


/* Park Form sonu */

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
		sessionStorage.setItem("darkMode", "false");
		getCb.checked = false;
		setStyles();
	} else {
		sessionStorage.setItem("darkMode", "true");
		getCb.checked = true;
		setStyles();
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
		// Parks kısmında eklenen harici bg'a aynı özelliklerini sağlamak için
		if(document.getElementsByClassName("parkPageBox")[0] !== undefined && document.getElementsByClassName("parkPageBox")[0].style.background !== "none") {
			document.getElementsByClassName("parkPageBox")[0].style.background = "url("+devURL()+"images/parks-img1.jpg)";
			document.getElementsByClassName("parkPageBox")[0].style.backgroundRepeat = "no-repeat";
			document.getElementsByClassName("parkPageBox")[0].style.backgroundSize = "cover";
			document.getElementsByClassName("parkPageBox")[0].style.backgroundAttachment = "fixed";
		}
	} else { // darkmode açılınca
		document.body.classList.toggle("dm-v");
		getHeader.classList.toggle("dm-v2");
		getFooter.classList.toggle("dm-v2");
		if(document.getElementsByClassName("parkPageBox")[0] !== undefined) {
			document.getElementsByClassName("parkPageBox")[0].style.background = "none";
		}
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