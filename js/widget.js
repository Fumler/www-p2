// Widget class
function Widget(type, id) {
	// Create the elements needed for the frame.
	// DIVS
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
	this.deleteIconA	=	document.createElement('a');

	// ICONS
	this.editIcon 		= 	document.createElement('i');
	this.deleteIcon 	= 	document.createElement('i');

	// IFRAME
	this.iFrame 		=	document.createElement('iframe');

	// BR
	this.br 			=	document.createElement('br');

	// Sends data off to the appropriate functions
	if (type == "yt") {
		this.ytPopulate(type, id);
	}
	else if (type == "ss") {
		this.ssPopulate(type, id);
	}
}

Widget.prototype.ytPopulate = function(type, id) {
	// Sets the correct ID for the div
	this.frameDivId = type + "FrameDiv" + id;
	this.frameDiv.id = this.frameDivId;

	// Style
	this.frameDiv.style.borderStyle = 'solid';
	this.frameDiv.style.display		= 'inline-block';

	// Set up anchor-icons
	this.createIcon(type, id, 0);
	this.createIcon(type, id, 1);

	// Youtube specific iframe
	this.iFrameID = type + "FrameID" + id;
	this.iFrame.id = this.iFrameID;
	this.iFrame.className = "youtube-player";
	this.iFrame.type = "text/html";
	this.iFrame.src = "http://www.youtube.com/embed/4a-apSofamw";	// default video
	this.iFrame.width = '640';
	this.iFrame.height = '385';
	this.iFrame.setAttribute('frameborder', '0');

	// Append to the main div
	this.frameDiv.appendChild(this.br);
	this.frameDiv.appendChild(this.iFrame);

	// Create the modals
	this.createYtEditModal(type, id);

	// Append to the content div
	var content = document.getElementById('content');
	content.appendChild(this.frameDiv);
	content.appendChild(this.editModal);
}

Widget.prototype.ssPopulate = function(type, id) {
	// Sets the correct ID for the div
	this.frameDivId = type + "FrameDiv" + id;
	this.frameDiv.id = this.frameDivId;
	console.log(this.frameDiv.id);
}

Widget.prototype.createIcon = function(type, id, icon) {
	// create the icon and append it to the above anchor
	// Edit icon
	if (icon == 0) {
		this.editIconA.setAttribute('role', "button");
		this.editIconA.setAttribute('data-toggle', "modal");

		this.editIconId = type + "EditIcon" + id;
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
	// Delete icon
	else if (icon > 0) {
		this.deleteIconA.setAttribute('role', "button");
		this.deleteIconA.setAttribute('data-toggle', "modal");

		this.deleteIconId = type + "DeleteIcon" + id;
		this.deleteIconA.id = this.deleteIconId;

		this.deleteIconA.style.float = 'right';

		this.deleteModalId = type + "DeleteModal" + id;
		this.deleteIconA.href = "#" + this.deleteModalId;

		// Set the correct clas
		this.deleteIcon.className = 'icon-trash';

		// Append the elements correctly
		this.deleteIconA.appendChild(this.deleteIcon);

		this.frameDiv.appendChild(this.deleteIconA);
	}
}


Widget.prototype.createYtEditModal = function(type, id) {
	// START EDIT MODAL DIV
	this.editModal.id = this.editModalId;
	this.editModal.setAttribute('class', 'modal hide fade');
	this.editModal.setAttribute('tabindex', '-1');
	this.editModal.setAttribute('role', 'dialog');
	this.editModalLabel = type + "EditModalLabel";
	this.editModal.setAttribute('aria-labelledby', this.editModalLabel);
	this.editModal.setAttribute('aria-hidden', 'true');

	//#START HEADER DIV#//
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
	//#END HEADER DIV#//

	//##START BODY DIV##//
	this.editModalBody.setAttribute('class', 'modal-body');

	// Setting up the form
	this.editModalForm = document.createElement('form');
	this.editModalFormId = type + "editForm" + id;
	this.editModalForm.id = this.editModalFormId;

	this.editModalFormLabel = document.createElement('label');
	this.editModalFormLabel.innerHTML = "Youtube ID (http://www.youtube.com/watch?v=<b>ID</b>)";

	// Appending the label to the form
	this.editModalForm.appendChild(this.editModalFormLabel);

	this.editModalFormInput = document.createElement('input');
	this.editModalFormInputId = type + "Input" + id;
	this.editModalFormInput.id = this.editModalFormInputId;
	this.editModalFormInput.type = 'text';
	this.editModalFormInput.setAttribute('placeholder', 'YouTube ID');

	// Append input to the form
	this.editModalForm.appendChild(this.editModalFormInput);

	// Append form to body div
	this.editModalBody.appendChild(this.editModalForm);

	// Append body div to main modal div
	this.editModal.appendChild(this.editModalBody);
	//##END BODY DIV##//

	//###START FOOTER DIV###//
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
	this.editModalFooterButtonSave.setAttribute('onclick', "ytSaveContent();");
	this.editModalFooterButtonSave.innerHTML = "Save Changes";

	// Append second button
	this.editModalFooter.appendChild(this.editModalFooterButtonSave);

	// Append footer to main modal div
	this.editModal.appendChild(this.editModalFooter);
}