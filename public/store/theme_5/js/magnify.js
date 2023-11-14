const lens = {
	zoom : 5,
	set imgID(imgID) {
		this.img = document.getElementById(imgID)

		this.glass = getCreateLens(this.img)
		modifyLens(this.glass, this.img, this.zoom)

	},
	get w() { return this.glass.offsetWidth / 2 },
	get h() { return this.glass.offsetHeight / 2 },
}

function magnify(imgID, zoom) {

	lens.zoom = zoom
	lens.imgID = imgID

}

function getCreateLens(img) {

	// Get magnifier glass div
	glass = document.getElementById("magnifier-glass")

	if (glass==null) {
		// Create magnifier glass div
		glass = document.createElement("DIV");
		glass.setAttribute("class", "img-magnifier-glass");
		glass.setAttribute("id", "magnifier-glass")

		// Insert it before image preview div
		img.parentElement.insertBefore(glass, img);

		// Add event listener for mouse moves over the image
		glass.addEventListener("mousemove", moveMagnifier);
		img.addEventListener("mousemove", moveMagnifier);

		// Add event listener when mouse pointer is out of the image
		glass.addEventListener("mouseout", hideLens);
		img.addEventListener("mouseout", hideLens);

	}

	return glass
}

function modifyLens(glass, img, zoom) {

	const fetchFullResolutionImage = false; // disabled, for now

	if (fetchFullResolutionImage) {

		// Get full resolution image url
		var url = new URL(img.src)
		var rep = "height=" + url.searchParams.get("height")
		zoom_url = img.src.replace(rep, "")

	} else {

		zoom_url = img.src;
	}

	// Change lens parameters based on image properties
	glass.style.height = img.height + "px";
	glass.style.width = img.width + "px";
	glass.style.backgroundImage = "url('" + zoom_url + "')";
	glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";

}

function hideLens(){

	lens.glass.style.display = "none";
}

function showLens(){

	lens.glass.style.display = "block";

}

function getCursorPos(e) {

	var a, x = 0, y = 0;
	e = e || window.event;

	// Get the x and y positions of the image
	a = lens.img.getBoundingClientRect();

	// Calculate the cursor's x and y coordinates, relative to the image
	x = e.pageX - a.left;
	y = e.pageY - a.top;

	// Allow for any page scrolling
	x = x - window.pageXOffset;
	y = y - window.pageYOffset;

	return {x : x, y : y};

}

function moveMagnifier(e) {
	var pos, x, y;
	showLens()
	// Prevent any other events that may occur when moving over the image
	e.preventDefault();

	// Get the cursor's x and y positions
	pos = getCursorPos(e);
	x = pos.x;
	y = pos.y;

	// Get lens zoom, width and height, and image height and width
	w = lens.w
	h = lens.h
	zoom = lens.zoom
	width = lens.img.width
	height = lens.img.height

	// Prevent the magnifier glass from being positioned outside the image
	if (x > width - (w / zoom)) {x = width - (w / zoom);}
	if (x < w / zoom) {x = w / zoom;}
	if (y > height - (h / zoom)) {y = height - (h / zoom);}
	if (y < h / zoom) {y = h / zoom;}

	// Display what the magnifier glass shows
	glass.style.backgroundPosition = "-" + ((x * zoom) - w) + "px -" + ((y * zoom) - h) + "px";
}
