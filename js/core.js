var jGalleryTimer = 0;
var jGalleryFirstStart = true;
var jGallery_action = false;
function jGallery(id, visible, timeInterval, transitionInterval)
{
	var visible = (visible) ? visible : 1;
	var timeInterval = (timeInterval) ? timeInterval : 5000;
	var transitionInterval = (transitionInterval) ? transitionInterval : 500;
	var w = (w) ? w : $("."+id+"-gallery-div :first").width();
	var cnt = $("#gallery-"+id+"-holder > div").size();

	if(jGalleryTimer)
	{
		clearInterval(jGalleryTimer);
		jGalleryTimer = 0;
	}

	if(!jGalleryFirstStart)
	{
		if(!jGallery_move(id, cnt, -1, w, visible, transitionInterval))
			jGallery_restart(id, cnt, transitionInterval);
	}

	jGalleryFirstStart = false;

	jGalleryTimer = setInterval(function(){ jGallery(id, visible, timeInterval, transitionInterval); }, timeInterval);
}

function jGallery_move(id, cnt, dir, w, visible, transitionInterval)
{
	if(jGallery_action)
		return false;

	var curr = document.getElementById("gallery-"+id+"-holder").style.left;
	curr = parseFloat(curr);

	if(isNaN(curr))
		curr = 0;
	if(dir > 0)
	{
		if(curr >= 0)
			return false;
	}
	else
	{
		if(curr + cnt * w - visible * w <= 0)
			return false;
	}

	jGallery_action = true;
	var offset = w;

	if(dir < 0)
		dir = "-";
	else
		dir = "+";

	$("#gallery-"+id+"-holder").animate(
		{left : dir+"="+offset+"px"},
		{queue:true, duration:transitionInterval, complete: function() {jGallery_action = false;}}
	);

	return true;
}

function jGallery_restart(id, cnt, transitionInterval)
{
	if(jGallery_action)
		return false;

	var curr = document.getElementById("gallery-"+id+"-holder").style.left;
	curr = parseFloat(curr);

	if(isNaN(curr))
		curr = 0;
	if(curr >= 0)
		return false;

	jGallery_action = true;
	var offset = curr * (-1);

	$("#gallery-"+id+"-holder").animate(
		{left : "+="+offset+"px"},
		{queue:true, duration:transitionInterval*cnt, complete: function() {jGallery_action = false;}}
	);

	return true;
}
