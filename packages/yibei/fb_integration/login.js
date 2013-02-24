

$(document).ready(function() {
	$('.fb_login_control').click(function() {

		FB.getLoginStatus(function(response) {
			console.log('Status received');
			if (response.status === 'connected') {
				console.log('User logged in');
				$.getJSON('/fb_auth_callback.json?signed=' + response.authResponse.signedRequest, function(data) {
					console.log(data);	
				});
				console.log(response);

			}
			else if (response.status === 'not_authorized') {
				console.log('Not authorized');
				fb_login();
			}
			else {
				console.log('Not connected');
				fb_login();
			}
		});
		console.log('FB login triggered');
		return false;
	});



});

function fb_login()
{
    FB.login(function(response) {
        if (response.authResponse) {
        	console.log('Login OK');
		} else {
        	console.log('Login failed');
        }
    });
}

