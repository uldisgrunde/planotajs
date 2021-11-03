 let dati=`{
	initialView: 'dayGridMonth',
	timeZone: 'UTC+3',
	locale: 'lv',
	eventColor: '#378006',
	firstDay: 1,
	events: [`;
		while(???) {
			dati=+`{
		title: '".$row["title"]."',
		start: '".$row["start_date"]."',
		end: '".$row["end_date"]."'
		},
		`";
		}
dati=+`	]
	}`;

document.addEventListener('DOMContentLoaded', 
	function() {
		let calendar = new FullCalendar.Calendar(document.getElementById('calendar'),dati);
		calendar.render();
	}
);


	while(???) {
	document.getElementById('scrolldiv').InnerHTML=+`<div class='item'>
		<label for='${dati[item]["title"]}'>${dati[item]["start_date"]} - ${dati[item]["end_date"]}</label>
			<div class='iteminfo'>
				<span name='${dati[item]["title"]}'>${dati[item]["title"]}</span>
				<input id='deletesubmit' type='button'onclick='del(${dati[item]["id"]})' value='X'>
			</div>
		</div>`
	}
