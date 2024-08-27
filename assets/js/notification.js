function askNotificationPermission(){
	if(!window.Notification) {
		console.log('Browser does not support notifications.');
	} else {
		console.log('Browser does support notifications.');
		if (Notification.permission === 'granted') {
			// show notification here
		} else {
			// request permission from user
			Notification.requestPermission().then(function(p) {
			   if(p === 'granted') {
				   // show notification here
				   
			   } else {
				   console.log('User blocked notifications.');
			   }
			}).catch(function(err) {
				console.error(err);
			});
		}
	}
}
function showNotification(x){
	var notify = new Notification('Sistem Bilik APD', {
			'body': x
	});
}