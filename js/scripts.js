window.setInterval(function() {reloadFrame()},60000);
function reloadFrame() {
		//document.frames["reggraph"].location.reload();
		//document.getElementById('reggraph').contentWindow.location = "./tasgraphregproj.php";
		//document.getElementById('clsgraph').contentWindow.location = "./tasgraphclsproj.html";
		//document.getElementById('opengraph').contentWindow.location = "./tasgraphopenproj.html";
		document.getElementById('projspen').contentWindow.location = "./tasgraphprojspen.php";
                document.getElementById('noproj').contentWindow.location = "./tasgraphnoproj.php";
                document.getElementById('nojobs').contentWindow.location = "./tasgraphnojobs.php";
                document.getElementById('projprog').contentWindow.location = "./tasgraphprojprog.php";
	}
