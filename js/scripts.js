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
function validString(str) 
{
    if ((str.length == 0) || (str == 'none'))
        {return false}
    else
        {return true}
}

function checkCommonValues(form)
{
    if (validString(form.prov_cd.value) == false)
    {
	alert("Please select a province")
	form.prov_cd.focus()
	return false
    } 
    else if (validString(form.kpi_cd.value) == false)
    {
        alert("Please select a KPI")
	form.kpi_cd.focus()
	return false
    }
    else if ((validString(form.year.value) == false) || (form.year.value < 4) || (form.year.value.length > 4))
    {
        alert("Please enter a valid year")
	form.year.focus()
	return false
    }
    else if (validString(form.qty.value) == false)
    {
        alert("Please enter a valid quantity")
        form.qty.focus()
        return false
    } 
    else if (validString(form.quater.value) == false)
    {
        alert("Please select a quater")
	form.kpi_cd.focus()
	return false
    }
}

function checkPrgDetailsForm(form){
    if (!checkCommonValues(form))
        result = false;
    if (result) {
        if (validString(form.qty.value) == false)
        {
            alert("Please enter a valid quantity")
            form.qty.focus()
            return false
        } 
    }
}

function checkBgtDetailsForm(form) {
    return checkCommonValues(form)
}

function checktasform(form) 		
{
    if (form.name == "PrgDetailsForm") {
        return checkPrgDetailsForm(form)
    }
    else if (form.name == "BgtDetailsForm") {
        return checkBgtDetailsForm(form)
    }
    else {
        alert("Form values not validated")
        return false
    }
}

function calcPct(form)
{
    if (form.name == "PrgDetailsForm") {
        var bgtEltName = ""
        if (form.prov_cd.value != "none") {
            bgtEltName = "budget"+form.prov_cd.value+"Qty"
        }
        var bgtElement = document.getElementsByName(bgtEltName)
        var budgetPct = 0
        if (bgtElement.length > 0) {
            budgetPct = form.qty.value/bgtElement[0].value*100
        }
        form.pct.value = budgetPct
    }    
}
