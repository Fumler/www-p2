function ajaxGet(url, div)
{
	$.ajax({
	type: "GET",
	url: url,
	async: true,
	success: function (response) {
		// console.log(response);
	    //return response;
	    $("#"+div).html(response);
	}
	});
}