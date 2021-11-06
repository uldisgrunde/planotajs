function Data(){
	fetch('https://dsp.tools/planotajs/index.php?q=markus&uid='+document.getElementById("seek").value)
		.then(response => response.json())
		.then(function(data) {	
			document.getElementById("did").innerHTML =data.records[0].uID;
			document.getElementById("dname").innerHTML = data.records[0].lietotajs;
		}
	)
}	