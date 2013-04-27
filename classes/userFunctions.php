<?php

/**
 * Method used to check if a user is logged in.
 *
 * @return boolean true if a user is logged in, otherwise returns false
 */
function loggedOn () 
{
	if(session_id()=='') 
	{
		session_start();
	}
	if ($_SESSION['uid'] > -1)	
	{
		return true;
	}								// User ID > -1 means a user is logged in
	else
	{
		return false;
	}
}

function getSalt()
{
	return 'SADFOJKadja§!aojd£$]€}[{';
}

function getSitekey()
{
	return 'NativeAmericanwarriorTontorecOuntstheuntoldtalesthattrAnsformedJohnReidamanoftheLawintoalegeNdofjustice';
}
	
?>