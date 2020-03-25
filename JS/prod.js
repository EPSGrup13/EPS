function statusSidebar() {
	const getSb = document.getElementsByClassName("p-sidebar")[0];

	// Butona basıldığında classList'e girilen class'ları ekler birdaha basılınca çıkarır
	getSb.classList.toggle("show");
	document.querySelector("body").classList.toggle("moveR");
}

/*function expand(event) {
	event.target.classList.toggle("sub-m-expand");
}*/

function expand() {
	document.getElementsByClassName("sub-m")[0].classList.toggle("sub-m-expand");
	document.getElementsByClassName("sb-a")[1].classList.toggle("bd-yellow");
}