<h1>Folder Listing</h1>

<div id="folders">
	<p> HEI </p>
</div>

<?php
	session_start();
	$_SESSION[ 'user' ] = 1;
?>

<script>
	

	$(document).ready (function () 
	{
		console.log("Hei");

		$.ajax({
			url: 'pages/fetchFolders.php',
			data: {'id': -1},
			type: 'post',
			success: function( data )
			{
				$('#folders').html('<ul class="folders"></ul>');

		        for(var i = 0; i < data.length; i++)
		        {
		            $('#folders .folders').append
		            (

		            	'<li id="folder_' + data[i].uid + '_' + data[i].id + '">' + 
		                '<span class="foldericon">&nbsp;</span>' + 
		                '<a href="javascript:openClose(' + data[i].id + ');">' + 
		                data[i].name + '</a></li>'
		            );

		            $('#folders .folders').last().loaded = false;
		        }
			}
		});
	});

	function openClose( id ) 
	{
	    if( $('#folder_1_' + id)[0].loaded )
	    {
	        $('#folder_1_' + id + ' ul').toggle();
	    }
	    else
	    {
	        $('#folder_1_' + id)[0].loaded = true;
	        $('#folder_1_' + id).append('<ul class="folders"></ul>');

	        $.ajax ({
	            url: 'pages/fetchFolders.php',
	            data: {'id': id},
	            type: 'post',
	            success: function (data) 
	            {
	                for (var i = 0; i < data.length; i++) 
	                {
	                    $('#folder_1_' + id + ' ul').append
	                    (
		                    '<li id="folder_' + data[i].uid + '_' + data[i].id + '">' + 
		                    '<span class="foldericon">&nbsp;</span>' + 
		                    '<a href="javascript:openClose(' + data[i].id + ');">' +
		                    data[i].name + '</a></li>'
	                    );

	                    $('#folder_1_' + id + ' ul li').last().loaded = false;
	                }
	            }
	        }); // ajax end
	    }
	}

</script>