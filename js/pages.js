

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
	                data[i].name + '</a> - <a href="javascript:pages.deletePage(' + data[i].id + ');">Delete this page</a></li>'
	            );

	            console.log("Id: page_" + this.currentUser + '_' + data[i].id);

	            $('#pages .pages').last().loaded = false;
	        }
		}
	});
}

Pages.prototype.deletePage = function(pageId) {
    if(pageId == null) {
        pageIdId = this.currentPage;

        $.post("functions/deletePage.php", {'page_id': pageIdId}, function(data){ pages.init();});


    } else {
        $.post("functions/deletePage.php", {'page_id': pageId}, function(data){ pages.init();});
    }
};

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

                if(pages.currentUser == data[0][1]) {
                    pages.addToolbar("#edit_menu");
                    pages.addSettingsModal("#edit_menu");
                    $("#edit_menu").append('<div id="editor"></div>');
                    pages.addEditButtons("#editor");
                    $("#editor").hide();

                    pages.setPrivacyRadio(data[0][2]);
                }
            }
        });
}

Pages.prototype.setPrivacyRadio = function(privacy) {
    // Sets the radio buttons in the settings modal correctly
    if (privacy == 0) {
        document.getElementById('p1').checked = false;
        document.getElementById('p2').checked = true;
    }
    else if (privacy == 1) {
        document.getElementById('p1').checked = true;
        document.getElementById('p2').checked = false;
    }
}

Pages.prototype.savePrivacy = function() {
    // Only get one of the radio buttons since they are mutually exclusive
    var contentPageId = this.currentPage;
    var privacy = 0;

    if (document.getElementById('p1').checked)
        privacy = 1;

    $.post("functions/updatePage.php", {'privacy': privacy, 'contentPageId': contentPageId}, function(data){ alert(data)});
}

Pages.prototype.addToolbar = function(div) {
    // add the edit page toggle
    $(div).append("</br>");
    $(div).append(button);
    $(div).append("  <a class='btn btn-success' href='#' onclick="+ "pages.savePage()"+">Save Page </a>");
    $(div).append("  <a class='btn btn-primary' id='settingsBtn' href='#settingsModal' role='button' data-toggle='modal'>Settings </a> ");
    $(div).append("</br></br>");
    $(div).append("<h3>Add widgets</h3>");
    $(div).append("  <a class='btn btn-primary' id='ytW' href='#' onclick=" + "pages.insertWidget('yt');" + ">Youtube </a>");
    $(div).append("  <a class='btn btn-primary' id='ssW' href='#' onclick=" + "pages.insertWidget('ss');" + ">Slideshow </a>  ");

    var clean = $('  <button class="btn btn-primary" href="#">Clear</button>');
    clean.click(function() { $("#content").empty();});
    $(div).append(clean);
};

Pages.prototype.addSettingsModal = function(div) {
	$(div).append('<div id="settingsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">'
                        + '<div class="modal-header">'
                            + '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>'
                            + '<h3 id="settingsModalLabel">Page Settings</h3>'
                        + '</div>'
                        + '<div class="modal-body">'
                            + '<div id="radioGroup">'
                                + '<label>Privacy settings</label>'
                                + 'Public    <input type="radio" name="privacy" id="p1">'
                                + 'Private   <input type="radio" name="privacy" id="p2">'
                            + '</div>'
                        + '</div>'
                        + '<div class="modal-footer">'
                            + '<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>'
                            + '<button class="btn btn-primary" data-dismiss="modal" onclick="pages.savePrivacy();">Save Changes</button>'
                        + '</div>'
                    + '</div>');
}

Pages.prototype.addEditButtons = function(div) {
        var bold = $('<button class="btn " data-original-title="Bold - Ctrl+B"><strong>B</strong></button>');
        var italic = $('<button class="btn " data-original-title="Italic - Ctrl+I"><i>I</i></button>');
        var hone = $('<button class="btn " data-original-title="H1">H1</button>');
        var htwo = $('<button class="btn " data-original-title="H2">H2</button>');
        var hthree = $('<button class="btn " data-original-title="H3">H3</button>');
        var para = $('<button class="btn " data-original-title="P">P</button>');

        $(div).append('<div class="btn-toolbar"></div>');
        $(div + " .btn-toolbar").append('<div class="btn-grp"></div>');
        bold.click(function() { document.execCommand("bold", false, null);});
        $(div + " .btn-toolbar .btn-grp").append(bold);

        italic.click(function() { document.execCommand("italic", false, null);});
        $(div + " .btn-toolbar .btn-grp").append(italic);

        hone.click(function() { document.execCommand("formatBlock", false, "<H1>");});
        $(div + " .btn-toolbar .btn-grp").append(hone);

        htwo.click(function() { document.execCommand("formatBlock", false, "<H2>");});
        $(div + " .btn-toolbar .btn-grp").append(htwo);

        hthree.click(function() { document.execCommand("formatBlock", false, "<H3>");});
        $(div + " .btn-toolbar .btn-grp").append(hthree);

        para.click(function() { document.execCommand("formatBlock", false, "<P>");});
        $(div + " .btn-toolbar .btn-grp").append(para);

};

Pages.prototype.editPage = function ()
{


    console.log("I am inside the function");

    switch(editMode) {
        case true:
            console.log("Edit is now true");
            $("#content").get(0).contentEditable = false;
            $("#editor").hide();
            editMode = false;
            break;
        case false:
            console.log("Edit is now false");
            $("#content").get(0).contentEditable = true;
            $("#editor").show();
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
