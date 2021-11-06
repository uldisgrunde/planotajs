function validateForm() {
  let x = document.getElementById("nosaukums").value;
  if (x == "") {
    alert("Aizpildi nosaukumu!");
    return false;
  }
} 

function serializeJSON (form) {
 var obj = {};
  Array.prototype.slice.call(form.elements).forEach(
	function (field) {
		if (!field.id || field.disabled || ['file', 'reset', 'submit', 'button'].indexOf(field.type) > -1) {
			return;
		}
		if (field.type === 'select-multiple') {
		  var options = [];
		  Array.prototype.slice.call(field.options).forEach(
			function (option) {
				if (!option.selected){
					return;
				} 
					options.push(option.value);
			}
		);
			if (options.length) {
				obj[field.name] = options;
			}
			return;
		}
		if (['checkbox', 'radio'].indexOf(field.type) > -1 && !field.checked) {
			return;
		}
		obj[field.id] = field.value;
	  }
  );
  return JSON.stringify(obj, null, 2);
}
function para(){
	var query = getQueryParams(document.location.search);
	if(query.alert=="undefined"){
		for(key in query) {
			alert(key);
		} 
	}else{
		document.getElementById("alert").innerHTML=query.alert;
	}
}
function getQueryParams(qs) {
    qs = qs.split('+').join(' ');

    var params = {},
        tokens,
        re = /[?&]?([^=]+)=([^&]*)/g;
    while (tokens = re.exec(qs)) {
        params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
    }
    return params;
}
