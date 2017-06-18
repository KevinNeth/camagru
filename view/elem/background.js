/*
*	Function only create to control to background
*/

let resize_background = () => {
	let body = document.getElementsByTagName("body")[0];
	let B = document.body;
	let H = document.documentElement;
	let height = undefined;
	let width = document.body.clientWidth;
		
	height = Math.max( B.scrollHeight, B.offsetHeight,H.clientHeight, H.scrollHeight, H.offsetHeight );
	body.style.backgroundSize =  width + "px " + height + "px";	
};
window.addEventListener("resize", resize_background);
resize_background();