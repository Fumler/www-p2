

// pages class
function Pages ()
{
	this.currentPage = -1; // Currently selected page, root by default.
	this.pageSelected = null;
	this.currentUser = -1;
	this.currentWidget = 0;
}

var pages = new Pages ();

Pages.prototype.init = function ()
{
	$.ajax({
		url: 'functions/fetchPages.php',
		data: {'id': -1},
		type: 'post',
		success: function( data )
		{
			$('#pages').html('<ul class="pages"></ul>');

			this.currentUser = data[0].uid;

	        for(var i = 0; i < data.length; i++)
	        {
	            $('#pages .pages').append
	            (
	            	'<li id="page_' + this.currentUser + '_' + data[i].id + '">' +
	                '<span class="pageicon">&nbsp;</span>' +
	                '<a href="javascript:pages.openPage(' + data[i].id + ');">' +
	                data[i].name + '</a></li>'
	            );

	            console.log("Id: page_" + this.currentUser + '_' + data[i].id);

	            $('#pages .pages').last().loaded = false;
	        }
		}
	});
}

Pages.prototype.createNewPage = function (name, parentID)
{
	console.log("Crazy magical world");
	console.log("Name: " + name + ", Parent: " + parentID);

	$.ajax ({
		url: 'functions/createNewPage.php',
		data: {'name': name, 'parentID': parentID},
		type: 'post',
		success: function (data)
		{
			if(data.error)
			{
				console.log("Error: " + data.error);
			}
			else
			{
				console.log("New Page Created");

				console.log(data[0][0].content);
				console.log(data[0][0].id);


				$("#content").html(data[0][0].content);
				pages.currentPage = data[0][0].id;
			}
		}
	});
}


Pages.prototype.openPage = function (id)
{
	this.pageSelected (id);
	this.currentPage = id;

    button = $('<button class="btn btn-warning">Edit mode</button>').click(pages.editPage);

	$.ajax ({
            url: 'functions/fetchPages.php',
            data: {'pageId': id},
            type: 'post',
            success: function (data)
            {
            	//$("#content").html(data);
            	$("#content").html(data[0][0]);
            	$("#settings").html('<li><a href="#" onclick="'+"ajaxGet('pages/settings.php', 'content')"+'">Settings</a></li>');

                if(pages.currentUser == data[0][1]) {
                    $("#edit_menu").append(button);
                    $("#edit_menu").append("<a id='pW' href='#' onclick=" + "pages.insertWidget('p')" + ">Paragraph</a><br />");
                    $("#edit_menu").append("<a id='ytW' href='#' onclick=" + "pages.insertWidget('yt');" + ">Youtube</a><br />");
                    $("#edit_menu").append("<a id='ssW' href='#' onclick=" + "pages.insertWidget('ss');" + ">Slideshow</a><br />");
                    $("#edit_menu").append("<a href='#' onclick="+ "pages.savePage()"+">Save Page</a>");
                }
            }
        });
}

Pages.prototype.editPage = function ()
{


    console.log("I am inside the function");

    switch(editMode) {
        case true:
            console.log("Edit is now true");
            $("#content").get(0).contentEditable = false;
            editMode = false;
            break;
        case false:
            console.log("Edit is now false");
            $("#content").get(0).contentEditable = true;
            editMode = true;
            break;
    }

    pages.toggleEditIcons();
}

Pages.prototype.toggleEditIcons = function () 
{
	var iconId = "editIcon";

	// Toggle edit icons
	var i = 0;
	while ($("#" + iconId + i).length > 0) {
		switch (editMode) {
			case true:
				$("#" + iconId + i).show();
				break;
			case false:
				$("#" + iconId + i).hide();
				break;
		}
		i++;
	}
}

Pages.prototype.savePage = function ()
{
    var content = $("#content").html();
    var contentPageId = this.currentPage;

    $.post("functions/updatePage.php", {'updateContent': content, 'contentPageId': contentPageId}, function(data){ alert(data)});

    // $.ajax ({
    //     url: 'functions/updatePage.php',
    //     data: {'updateContent': content},
    //     type: 'post',
    //     success: function () {
    //         console.log("UPDATED PAGE IN DB");
    //     }
    // });
}

Pages.prototype.insertWidget = function (type)
{
    widget = new Widget(type, this.currentWidget);

    pages.toggleEditIcons();

    this.currentWidget ++;
}


Pages.prototype.openClose = function (id)
{
	this.pageSelected(id);
	this.currentPage = id;
	console.log('#page_' + this.currentUser + '_' + id);

	if( $('#page_' + this.currentUser + '_' + id)[0].loaded )
    {
        $('#page_' + this.currentUser + '_' + id + ' ul').toggle();
    }
    else
    {
        $('#page_' + this.currentUser + '_' + id)[0].loaded = true;
        $('#page_' + this.currentUser + '_' + id).append('<ul class="pages"></ul>');

        $.ajax ({
            url: 'functions/fetchPages.php',
            data: {'id': id},
            type: 'post',
            success: function (data)
            {
            	console.log(data);
            	if(data.length > 0) // If subpages
            	{
            		$('#page_' + pages.currentUser + '_' + id)[0].hasSubPages = true;
            		$('#page_' + pages.currentUser + '_' + id).toggleClass ('opened');
            	}
            	else
            	{
            		$('#page_' + pages.currentUser + '_' + id)[0].hasSubPages = false;
            	}

                for (var i = 0; i < data.length; i++)
                {
                    $('#page_' + pages.currentUser + '_' + id + ' ul').append
                    (
	                    '<li id="page_' + data[i].uid + '_' + data[i].id + '">' +
	                    '<span class="pageicon">&nbsp;</span>' +
	                    '<a href="javascript:pages.openClose(' + data[i].id + ');">' +
	                    data[i].name + '</a></li>'
                    );

                    $('#page_' + pages.currentUser + '_' + id + ' ul li').last().loaded = false;
                }
            }
        }); // ajax end
    }
}
