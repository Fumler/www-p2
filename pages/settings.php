<form action="#" method="post" id="settings">
	<fieldset>
		<legend>
			Page Settings
		</legend>
		<ol>
			<p><input type="radio" name="settings" id="Public" value="Public"> Public</p>
			<p><input type="radio" name="settings" id="Private" value="Private" checked> Private</p>
		</ol>
		<button type="submit" class="btn btn-primary">
			Save
		</button>
	</fieldset>
</form>

<form action="#" method="post" id="theme">
	<fieldset>
		<legend>
			Change Theme
		</legend>
		<ol>
			<p><input type="radio" name="theme" id="Flat" value="Flat"> Flat UI</p>
			<p><input type="radio" name="theme" id="Bootstrap" value="Bootstrap" checked> Bootstrap</p>
		</ol>
		<button type="submit" class="btn btn-primary">
			Save
		</button>
	</fieldset>
</form>

<legend> User Groups </legend>
<!-- new user group modal -->
<a class="btn btn-primary" data-toggle="modal" href="#myModal" onclick="fixModal('new_user_group')">Create User Group</a>
<div class="new_user_group" id="new_user_group">
    <div class="modal hide fade in" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myModal">
        <div class="modal-header">
            <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
            <h3 id="myModalLabel">New User Group</h3>
        </div>
        <div class="modal-body">
            <form method="post" action='' id="new_user_group">
                <p><input type="text" class="span3" name="groupName" size="30" id="groupName" placeholder="Group Name" autofocus required></p>
                <p><button type="submit" class="btn btn-primary">Create</button>
                <a class="close btn btn-info" data-dismiss="modal">Close</a></p>
            </form>
        </div>
    </div>
</div>

<form action="#" method="post" id="delete">
	<fieldset>
		<legend>
			Delete Page
		</legend>
		<ol>
			<p><input type="text" class="span3" name="delete" id="delete" placeholder="Type DELETE" pattern="^DELETE$" required></p>
		</ol>
		<button type="submit" class="btn btn-primary">
			Delete
		</button>
	</fieldset>
</form>