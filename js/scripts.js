window.setInterval(function() {reloadFrame()},60000);
function reloadFrame() {
		//document.frames["reggraph"].location.reload();
		document.getElementById('reggraph').contentWindow.location = "./tasgraphregproj.php";
		document.getElementById('clsgraph').contentWindow.location = "./tasgraphclsproj.html";
		document.getElementById('opengraph').contentWindow.location = "./tasgraphopenproj.html";
	}
