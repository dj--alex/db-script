function initPage()
{
	var navRoot = document.getElementById("navigation");
	var lis = navRoot.getElementsByTagName("li");
	for (var i=0; i<lis.length; i++)
	{
		lis[i].onmouseover = function()
		{
			this.className = "hover";
		}
		lis[i].onmouseout = function()
		{
			this.className = "";
		}
	}
	var navRoot = document.getElementById("top-navigation");
	var lis = navRoot.getElementsByTagName("li");
	for (var i=0; i<lis.length; i++)
	{
		lis[i].onmouseover = function()
		{
			this.className = "hover";
		}
		lis[i].onmouseout = function()
		{
			this.className = "";
		}
	}
	var navRoot = document.getElementById("doors");
	var lis = navRoot.getElementsByTagName("li");
	for (var i=0; i<lis.length; i++)
	{
		lis[i].onmouseover = function()
		{
			this.className = "hover";
		}
		lis[i].onmouseout = function()
		{
			this.className = "";
		}
	}
}

if (window.attachEvent && !window.opera)
	window.attachEvent("onload", initPage);
