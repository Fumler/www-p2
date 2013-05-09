// Widget class
function Widget(type, id) {
	// Create the elements needed for the frame.
	// DIVS
	this.mainFrameDiv	= 	document.createElement('div');
	this.frameDiv 		=	document.createElement('div');
	
	this.editModal 		=	document.createElement('div');
	this.editModalHeader=	document.createElement('div');
	this.editModalBody	=	document.createElement('div');
	this.editModalFooter=	document.createElement('div');
	
	this.deleteModal 	=	document.createElement('div');
	this.deleteModalHead=	document.createElement('div');
	this.deleteModalBody=	document.createElement('div');
	this.deleteModalFoot=	document.createElement('div');

	// ANCHORS
	this.editIconA		= 	document.createElement('a');

	// ICONS
	this.editIcon 		= 	document.createElement('i');
	this.deleteIcon 	= 	document.createElement('i');

	// IFRAME
	this.iFrame 		=	document.createElement('iframe');

	// BR
	this.br 			=	document.createElement('br');

	// Sends data off to the appropriate functions
	if (type == "yt") {
		this.populateModal(type, id);
	}
	else if (type == "ss") {
		this.populateModal(type, id);
	}
}

Widget.prototype.populateModal = function(type, id) {
	this.mainFrameDivId = type + "mainFrameDiv" + id;
	this.mainFrameDiv.id = this.mainFrameDivId;

	// Sets the correct ID for the div
	this.frameDivId = type + "FrameDiv" + id;
	this.frameDiv.id = this.frameDivId;

	// Set up anchor-icons
	this.createIcon(type, id);

	this.iFrameID = type + "FrameID" + id;
	this.iFrame.id = this.iFrameID;

	if (type == "yt") {
		// Youtube specific iframe
		this.iFrame.className = "youtube-player";
		this.iFrame.type = "text/html";
		this.iFrame.src = "http://www.youtube.com/embed/4a-apSofamw";	// default video
		this.iFrame.width = '640';
		this.iFrame.height = '385';
		this.iFrame.setAttribute('frameborder', '0');
	}
	else if (type == "ss") {
		// flickr slideshow specific frame
		this.iFrame.src = "img/default-image.png";	// temp image
		this.iFrame.width = '500';
		this.iFrame.height = '500';
		this.iFrame.setAttribute('frameborder', '0');
	}

	// Append to the main div
	this.frameDiv.appendChild(this.br);
	this.frameDiv.appendChild(this.iFrame);

	// Create the modals
	this.createEditModal(type, id);

	// Append to the content div
	var content = document.getElementById('content');
	this.mainFrameDiv.appendChild(this.frameDiv);
	this.mainFrameDiv.appendChild(this.editModal);
	this.appendFunctions(type, id);
	content.appendChild(this.mainFrameDiv);
}

Widget.prototype.createIcon = function(type, id) {
	// create the icon and append it to the above anchor
	// Edit icon
	this.editIconA.setAttribute('role', "button");
	this.editIconA.setAttribute('data-toggle', "modal");

	this.editIconId = "editIcon" + id;
	this.editIconA.id = this.editIconId;

	this.editIconA.style.float = 'left';

	this.editModalId = type + "EditModal" + id;
	this.editIconA.href = "#" + this.editModalId;

	// Set the correct class
	this.editIcon.className = 'icon-edit';

	// Append the elements correctly
	this.editIconA.appendChild(this.editIcon);

	this.frameDiv.appendChild(this.editIconA);
}


Widget.prototype.createEditModal = function(type, id) {
	// START MAIN EDIT MODAL DIV
	this.editModal.id = this.editModalId;
	this.editModal.setAttribute('class', 'modal hide fade');
	this.editModal.setAttribute('tabindex', '-1');
	this.editModal.setAttribute('role', 'dialog');
	this.editModalLabel = type + "EditModalLabel" + id;
	this.editModal.setAttribute('aria-labelledby', this.editModalLabel);
	this.editModal.setAttribute('aria-hidden', 'true');

	//#
	// START HEADER DIV
	//#
	this.editModalHeader.setAttribute('class', 'modal-header');
	this.editModalHeaderButton = document.createElement('button');
	this.editModalHeaderButton.type = 'button';
	this.editModalHeaderButton.setAttribute('class', 'close');
	this.editModalHeaderButton.setAttribute('data-dismiss', 'modal');
	this.editModalHeaderButton.setAttribute('aria-hidden', 'true');
	this.editModalHeaderButton.innerHTML = "x";

	// Append button
	this.editModalHeader.appendChild(this.editModalHeaderButton);

	this.editModalHeaderH3 = document.createElement('h3');
	this.editModalHeaderH3.id = this.editModalLabel;
	this.editModalHeaderH3.innerHTML = "Edit";

	// Append H3
	this.editModalHeader.appendChild(this.editModalHeaderH3);

	// Append header to main modal div
	this.editModal.appendChild(this.editModalHeader);
	//#
	// END HEADER DIV
	//#

	//##
	// START BODY DIV
	//##
	this.editModalBody.setAttribute('class', 'modal-body');

	// Setting up the form
	this.editModalForm = document.createElement('form');
	this.editModalFormId = type + "editForm" + id;
	this.editModalForm.id = this.editModalFormId;

	// Label
	this.editModalFormLabel = document.createElement('label');

	// Input
	this.editModalFormInput = document.createElement('input');
	this.editModalFormInput.type = 'text';

	// Youtube specific body
	if (type == "yt") {
		this.editModalFormLabel.innerHTML = "Youtube ID (http://www.youtube.com/watch?v=<b>ID</b>)";

		// Appending the label to the form
		this.editModalForm.appendChild(this.editModalFormLabel);

		// Input attributes
		this.editModalFormInputId = type + "Input" + id;
		this.editModalFormInput.id = this.editModalFormInputId;
		this.editModalFormInput.setAttribute('placeholder', 'YouTube ID');

		// Append input to the form
		this.editModalForm.appendChild(this.editModalFormInput);

		// Append form to body div
		this.editModalBody.appendChild(this.editModalForm);
	}
	// Flickr slideshow specific body
	else if (type = "ss") {
		this.editModalFormLabel.innerHTML = "User ID";

		// Append label to the form
		this.editModalForm.appendChild(this.editModalFormLabel);

		// Input attributes
		this.editModalFormInputId = "fUserID" + id;
		this.editModalFormInput.id = this.editModalFormInputId;
		this.editModalFormInput.setAttribute('placeholder', 'User ID');

		// Append input to the form
		this.editModalForm.appendChild(this.editModalFormInput);

		// Append form to body div
		this.editModalBody.appendChild(this.editModalForm);

		//-
		// RADIO GROUP BEGIN
		//-
		this.editModalRadioGroup = document.createElement('div');
		this.editModalRadioGroupId = "radioGroup" + id;
		this.editModalRadioGroup.id = this.editModalRadioGroupId;
		this.editModalRadioGroup.innerHTML = "Tag";

		// First radio button
		this.editModalRadioOne = document.createElement('input');
		this.editModalRadioOneId = "fr1" + id;
		this.editModalRadioOne.id = this.editModalRadioOneId;
		this.editModalRadioOne.type = 'radio';
		this.editModalRadioName = "flickrR" + id;
		this.editModalRadioOne.name = this.editModalRadioName;
		this.editModalRadioOne.checked = 'checked';
		this.editModalRadioOne.value = '1';
		
		// Append
		this.editModalRadioGroup.appendChild(this.editModalRadioOne);
		this.editModalRadioGroup.innerHTML += "Set";

		// Second radio button
		this.editModalRadioTwo = document.createElement('input');
		this.editModalRadioTwoId = "fr2" + id;
		this.editModalRadioTwo.id = this.editModalRadioTwoId;
		this.editModalRadioTwo.type = 'radio';
		this.editModalRadioTwo.name = this.editModalRadioName;
		this.editModalRadioTwo.value = '2';

		// Append
		this.editModalRadioGroup.appendChild(this.editModalRadioTwo);
		this.editModalRadioGroup.appendChild(this.br);
		this.editModalRadioGroup.appendChild(this.br);

		// Append group to body
		this.editModalBody.appendChild(this.editModalRadioGroup);
		//-
		// RADIO GROUP END
		//-

		//--
		// START TAG_ID DIV
		//--
		// Div
		this.editModalBodyFlickrOne = document.createElement('div');
		this.editModalBodyFlickrOneId = this.editModalRadioName + "1";
		this.editModalBodyFlickrOne.id = this.editModalBodyFlickrOneId;
		this.editModalBodyFlickrOne.setAttribute('class', 'desc2');

		// Form
		this.editModalBodyFlickrOneForm = document.createElement('form');
		this.editModalBodyFlickrOneFormId = id + "flickrForm1";
		this.editModalBodyFlickrOneForm.id = this.editModalBodyFlickrOneFormId;

		// Input
		this.editModalBodyFlickrOneInput = document.createElement('input');
		this.editModalBodyFlickrOneInputId = "fTagId" + id;
		this.editModalBodyFlickrOneInput.type = 'text';
		this.editModalBodyFlickrOneInput.setAttribute('placeholder', 'Tag ID');

		// Append input
		this.editModalBodyFlickrOneForm.appendChild(this.editModalBodyFlickrOneInput);

		// Append form
		this.editModalBodyFlickrOne.appendChild(this.editModalBodyFlickrOneForm);

		// Append div to modal body
		this.editModalBody.appendChild(this.editModalBodyFlickrOne);
		//--
		// END TAG_ID DIV
		//--

		//---
		// START SET_ID DIV
		//---
		// Div
		this.editModalBodyFlickrTwo = document.createElement('div');
		this.editModalBodyFlickrTwoId = this.editModalRadioName + "2";
		this.editModalBodyFlickrTwo.id = this.editModalBodyFlickrTwoId;
		this.editModalBodyFlickrTwo.setAttribute('class', 'desc2');
		this.editModalBodyFlickrTwo.style.display = "none";

		// Form
		this.editModalBodyFlickrTwoForm = document.createElement('form');
		this.editModalBodyFlickrTwoFormId = id + "flickrForm2";
		this.editModalBodyFlickrTwoForm.id = this.editModalBodyFlickrOneFormId;

		// Input
		this.editModalBodyFlickrTwoInput = document.createElement('input');
		this.editModalBodyFlickrTwoInputId = "fSetId" + id;
		this.editModalBodyFlickrTwoInput.type = 'text';
		this.editModalBodyFlickrTwoInput.setAttribute('placeholder', 'Set ID');

		// Append input
		this.editModalBodyFlickrTwoForm.appendChild(this.editModalBodyFlickrTwoInput);

		// Append form
		this.editModalBodyFlickrTwo.appendChild(this.editModalBodyFlickrTwoForm);

		// Append div to modal body
		this.editModalBody.appendChild(this.editModalBodyFlickrTwo);
		//---
		// END SET_ID DIV
		//---
	}

	// Append body div to main modal div
	this.editModal.appendChild(this.editModalBody);
	//##
	// END BODY DIV
	//##

	//###
	// START FOOTER DIV
	//###
	this.editModalFooter.setAttribute('class', 'modal-footer');

	// First button
	this.editModalFooterButtonClose = document.createElement('button');
	this.editModalFooterButtonClose.setAttribute('class', 'btn');
	this.editModalFooterButtonClose.setAttribute('data-dismiss', 'modal');
	this.editModalFooterButtonClose.setAttribute('aria-hidden', 'true');
	this.editModalFooterButtonClose.innerHTML = "Close";

	// Append first button
	this.editModalFooter.appendChild(this.editModalFooterButtonClose);

	// Second button
	this.editModalFooterButtonSave = document.createElement('button');
	this.editModalFooterButtonSave.setAttribute('class', 'btn btn-primary');
	this.editModalFooterButtonSave.setAttribute('data-dismiss', 'modal');
	this.editModalFooterButtonSave.setAttribute('onclick', type + "saveContent" + id + "();");
	this.editModalFooterButtonSave.innerHTML = "Save changes";

	// Append second button
	this.editModalFooter.appendChild(this.editModalFooterButtonSave);

	// Append footer to main modal div
	this.editModal.appendChild(this.editModalFooter);
	//###
	// END FOOTER DIV
	//###
}

Widget.prototype.appendFunctions = function(type, id) {
	this.script = document.createElement('script');
	this.script.type = "text/javascript";

	this.script.innerHTML += "function " + type + "saveContent" + id + "() {";

	// THIS IS DIRTY i know T_T
	if (type == "yt") {
		this.script.innerHTML += "var input = $('#" + this.editModalFormInputId + "').val();";
		this.script.innerHTML += "document.getElementById('" + this.iFrameID + "').src = 'http://www.youtube.com/embed/' + input;}";
	}
	else if (type == "ss") {
		this.script.innerHTML += "var userID = $('#" + this.editModalFormInputId + "').val();";
		this.script.innerHTML += "if ($('#" + this.editModalRadioOneId + "').is(':checked')) {";
			this.script.innerHTML += "var tagID = $('#" + this.editModalBodyFlickrOneInputId + "').val();";
			this.script.innerHTML += "document.getElementById('" + this.iFrameID + "').src = 'http://www.flickr.com/slideShow/index.gne?user_id=' + userID + '&tag_id=' + tagID;}"
		this.script.innerHTML += "else if ($('#" + this.editModalRadioTwoId + "').is(':checked')) {";
			this.script.innerHTML += "var setID = $('#" + this.editModalBodyFlickrTwoInputiD + "').val();";
			this.script.innerHTML += "document.getElementById('" + this.iFrameID + "').src = 'http://www.flickr.com/slideShow/index.gne?user_id=' + userID + '&photoset_id=' + setID;}";

		// Resize iframe
		this.script.innerHTML += "document.getElementById('" + this.iFrameID + "').width = 500;";
		this.script.innerHTML += "document.getElementById('" + this.iFrameID + "').height = 500;}";

		// Radiobutton function
		this.script.innerHTML += "$(document).ready(function () {";
			this.script.innerHTML += "$('input[name$=" + '"' + this.editModalRadioName + '"' + "]').click(function() {";
				this.script.innerHTML += "var value = $(this).val();";
				this.script.innerHTML += "$('div.desc2').hide();";
				this.script.innerHTML += "$('#" + this.editModalRadioName + "' + value).show();";
			this.script.innerHTML += "});";
		this.script.innerHTML += "});";
	}

	this.mainFrameDiv.appendChild(this.script);
}