var old_console = console;

console = { log : function(msg) {
	$('#debug').append(msg + '<br />');
	old_console.log(msg);
}};
