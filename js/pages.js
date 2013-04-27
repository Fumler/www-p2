

// pages class
function Pages () 
{
	this.currentPage = 70; // Currently selected page, root by default. 
	this.pageSelected = null;
}

var pages = new Pages ();

// $(document).ready (function () 
// {
//  	pages.pageSelected = pageSelected;
//  	pages.init ();
// });

Pages.prototype.init = function () 
{
	$.ajax({
		url: 'functions/fetchPages.php',
		data: {'id': -1},
		type: 'post',
		success: function( data )
		{
			$('#pages').html('<ul class="pages"></ul>');

	        for(var i = 0; i < data.length; i++)
	        {
	            $('#pages .pages').append
	            (

	            	'<li id="page_' + data[i].uid + '_' + data[i].id + '">' + 
	                '<span class="pageicon">&nbsp;</span>' + 
	                '<a href="javascript:pages.openPage(' + data[i].id + ');">' + 
	                data[i].name + '</a></li>'
	            );

	            $('#pages .pages').last().loaded = false;
	        }
		}
	});
}

Pages.prototype.createNewPage = function (name, parentID)
{
	console.log("Crazy magical world");
	console.log("Name: " + name + ", Parent: " + parentID);
}


Pages.prototype.openPage = function (id)
{
	this.pageSelected (id);
	this.currentPage = id;

	ajaxGet();
}


Pages.prototype.openClose = function (id) 
{
	this.pageSelected (id);
	this.currentPage = id;

	if( $('#page_1_' + id)[0].loaded )
	    {
	        $('#page_1_' + id + ' ul').toggle();
	    }
	    else
	    {
	        $('#page_1_' + id)[0].loaded = true;
	        $('#page_1_' + id).append('<ul class="pages"></ul>');

	        $.ajax ({
	            url: 'functions/fetchPages.php',
	            data: {'id': id},
	            type: 'post',
	            success: function (data) 
	            {
	            	if(data.length > 0) // If subpages
	            	{
	            		$('#page_1_' + id)[0].hasSubPages = true;
	            		$('#page_1_' + id).toggleClass ('opened');
	            	}
	            	else
	            	{
	            		$('#page_1_' + id)[0].hasSubPages = false;
	            	}

	                for (var i = 0; i < data.length; i++) 
	                {
	                    $('#page_1_' + id + ' ul').append
	                    (
		                    '<li id="page_' + data[i].uid + '_' + data[i].id + '">' + 
		                    '<span class="pageicon">&nbsp;</span>' + 
		                    '<a href="javascript:pages.openClose(' + data[i].id + ');">' +
		                    data[i].name + '</a></li>'
	                    );

	                    $('#page_1_' + id + ' ul li').last().loaded = false;
	                }
	            }
	        }); // ajax end
	    }
}