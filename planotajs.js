let men = 0;
let clicked = null;
let dir = "C:\Users\aleksbalodis\Desktop\Planotajs\Mans planotajs"
let events = localStorage.getItem('events') ? JSON.parse(localStorage.getItem('events')) : [];

const kalendars = document.getElementById('kalendars'); //calendar
const jaunsIeraksts = document.getElementById('jaunsIeraksts'); //newEventModal
const dzestIerakstu = document.getElementById('dzestIerakstu'); //deleteEventModal
const ierakstaFons = document.getElementById('ierakstaFons'); //backDrop
const ierakstaNosauk = document.getElementById('ierakstaNosauk'); //eventTitleInput
const weekdays = ['Pirmdiena', 'Otrdiena', 'Tresdiena', 'Ceturtdiena', 'Piektdiena', 'Sestdiena', 'Svetdiena'];

function openModal(date) {
  clicked = date;

  const eventForDay = events.find(e => e.date === clicked);

  if (eventForDay) {
    document.getElementById('ierakstaPiezime').innerText = eventForDay.title;
    dzestIerakstu.style.display = 'block';
  } else {
    jaunsIeraksts.style.display = 'block';
  }

  ierakstaFons.style.display = 'block';
}

function load() {
  const dt = new Date();

  if (men !== 0) {
    dt.setMonth(new Date().getMonth() + men);
  }

  const day = dt.getDate();
  const month = dt.getMonth();
  const year = dt.getFullYear();

  const firstDayOfMonth = new Date(year, month, 1);
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  
  const dateString = firstDayOfMonth.toLocaleDateString('en-us', {
    weekday: 'long',
    year: 'numeric',
    month: 'numeric',
    day: 'numeric',
  });
  const paddingDays = weekdays.indexOf(dateString.split(', ')[0]);

  document.getElementById('menesis').innerText = 
    `${dt.toLocaleDateString('en-us', { month: 'long' })} ${year}`;

  kalendars.innerHTML = '';

  for(let i = 1; i <= paddingDays + daysInMonth; i++) {
    const daySquare = document.createElement('div');
    daySquare.classList.add('day');

    const dayString = `${month + 1}/${i - paddingDays}/${year}`;

    if (i > paddingDays) {
      daySquare.innerText = i - paddingDays;
      const eventForDay = events.find(e => e.date === dayString);

      if (i - paddingDays === day && men === 0) {
        daySquare.id = 'currentDay';
      }

      if (eventForDay) {
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('Ieraksts');
        eventDiv.innerText = eventForDay.title;
        daySquare.appendChild(eventDiv);
      }

      daySquare.addEventListener('click', () => openModal(dayString));
    } else {
      daySquare.classList.add('padding');
    }

    kalendars.appendChild(daySquare);    
  }
}

function closeModal() {
  ierakstaNosauk.classList.remove('error');
  jaunsIeraksts.style.display = 'none';
  dzestIerakstu.style.display = 'none';
  ierakstaFons.style.display = 'none';
  ierakstaNosauk.value = '';
  clicked = null;
  load();
}

function saveEvent() {
  if (ierakstaNosauk.value) {
    ierakstaNosauk.classList.remove('error');

    events.push({
      date: clicked,
      title: ierakstaNosauk.value,
    });

    localStorage.setItem('events', JSON.stringify(events));
    closeModal();
  } else {
    ierakstaNosauk.classList.add('error');
  }
}

function deleteEvent() {
  events = events.filter(e => e.date !== clicked);
  localStorage.setItem('events', JSON.stringify(events));
  closeModal();
}

function initButtons() {

  document.getElementById('saglabatPoga').addEventListener('click', saveEvent);
  document.getElementById('atceltPoga').addEventListener('click', closeModal);
  document.getElementById('dzestPoga').addEventListener('click', deleteEvent);
  document.getElementById('aizvertPoga').addEventListener('click', closeModal);
}

function download(content, fileName, contentType) {
  const a = document.createElement("a");
  const file = new Blob([content], { type: contentType });
  a.href = URL.createObjectURL(file);
  a.download = fileName;
  a.click();
}

function DownJSON() { 
  var datajson = JSON.parse(localStorage.getItem("events"));
  download(JSON.stringify(datajson), "data.json", "text/plain");
}

initButtons();
load();