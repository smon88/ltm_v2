const passengersTxt = document.getElementById('arrayPassengers').value;
const passengersArray = passengersTxt
    .replace(/\[|\]|/g, '')
    .split(',')
    .map(Number);
let amountPassengers = 0;

for (var i=0; i<passengersArray.length; i++){
    for (var o=0; o<passengersArray[i]; o++){
        amountPassengers++;
    }
}

document.getElementById('amountPeople').textContent = amountPassengers;

function searchCity(codeToFind, input){
    fetch('./assets/json/airports.json')
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(jsonData => {
            const result = jsonData.find(item => item.code === codeToFind);

            if (result) {
                input.value = result.city;
            } else {
                console.log('Elemento no encontrado.');
            }
        })
        .catch(error => {
            console.error('Error al cargar el archivo JSON:', error);
        });
}

const cityOrigin = document.getElementById('cityOrigin');
const originCodeInput = document.getElementById('originCode').value; 
const cityDestiny = document.getElementById('cityDestiny');
const destinyCodeInput = document.getElementById('destinyCode').value;

searchCity(originCodeInput, cityOrigin);
searchCity(destinyCodeInput, cityDestiny);

setTimeout(() => {
    document.querySelector('.header__data-l p.header__fly').textContent = `${cityOrigin.value} > ${cityDestiny.value}`;
    document.getElementById('originCity').value = cityOrigin.value;
    document.getElementById('destinyCity').value = cityDestiny.value;
}, 100);

let savedFlights = [];
let savedFlightsVuelta = []; // Guardar los vuelos de vuelta
let selectedFlightIda = null; // Variable para guardar el vuelo de ida seleccionado

const origin = document.getElementById('originCode').value;
const destiny = document.getElementById('destinyCode').value;

function formatTime(hour, minutes) {
    const period = hour >= 12 ? 'p. m.' : 'a. m.';
    hour = hour % 12 || 12; // Convierte a formato de 12 horas
    return `${hour}:${minutes < 10 ? '0' : ''}${minutes} ${period}`;
}

function generateFlightOptions() {
    const flights = [];
    const minPrice = 49999;
    const maxPrice = 69999;
    const baseDuration = 77; // 1 hora 17 minutos en minutos
    const numFlights = Math.floor(Math.random() * (10 - 4 + 1)) + 4; // entre 4 y 10 vuelos
    const startHour = 14; // 2:00 p. m.
    const endHour = 20; // Hasta las 8:00 p. m.

    let basePrice;

    for (let i = 0; i < numFlights; i++) {
        let duration = baseDuration;
        let type = "Directo";

        // Generar si el vuelo tiene una parada
        if (Math.random() > 0.5) {
            duration += Math.floor(Math.random() * 30) + baseDuration; // Añade hasta 30 minutos
            type = "1 parada";

            if (i === 1) {
                type = "Directo";
            }
        }

        // Generar la hora de salida dentro del rango permitido
        const departureHour = Math.floor(Math.random() * (endHour - startHour + 1)) + startHour;
        const departureMinutes = Math.floor(Math.random() * 60);
        const arrivalHour = departureHour + Math.floor(duration / 60);
        const arrivalMinutes = (departureMinutes + duration % 60) % 60;

        const departureTime = formatTime(departureHour, departureMinutes);
        const arrivalTime = formatTime(arrivalHour, arrivalMinutes);

        // Generar precio, asegurando que el primer vuelo sea el más económico
        let price;

        if (i === 0) {
            basePrice = minPrice + Math.floor(Math.random() * (maxPrice - minPrice)); // precio base dentro del rango
            price = basePrice;
        } else {
            price = basePrice + Math.floor(Math.random() * (maxPrice - basePrice)); // precios superiores al vuelo más económico
        }

        // El segundo vuelo tiene la duración más corta
        if (i === 1) {
            duration = baseDuration - Math.floor(Math.random() * 10); // tiempo más corto para el segundo vuelo
        }

        // Asegurarse que el precio no exceda el máximo permitido
        price = Math.min(price, maxPrice);

        flights.push({
            departureTime,
            arrivalTime,
            type,
            duration,
            price,
            operator: "LATAM Airlines Colombia"
        });
    }

    savedFlights.push(flights); // Guardar los vuelos generados
    return flights;
}

const flights = generateFlightOptions();

function renderFlights(flights, origin, destiny) {
    const flightsContainer = document.querySelector('.flights');
    flightsContainer.innerHTML = ''; // Limpiar el contenedor antes de renderizar

    flights.forEach((flight) => {
        const flightElement = document.createElement('div');
        flightElement.classList.add('flights__element');

        flightElement.innerHTML = `
            <div class="flights__top">
                <div class="flights__mark">
                    <span class="flights__advise"></span>
                    <span class="flights__advise"></span>
                </div>
                <div class="flights__times">
                    <div class="flights__times-txt">
                        <p>${flight.departureTime}</p>
                        <p>${origin}</p>
                    </div>
                    <div class="flights__times-duration">
                        <p>Duración</p>
                        <p>${Math.floor(flight.duration / 60)} h ${flight.duration % 60} min</p>
                    </div>
                    <div class="flights__times-txt">
                        <p>${flight.arrivalTime}</p>
                        <p>${destiny}</p>
                    </div>
                </div>
            </div>
            <div class="flights__bot">
                <div class="flights__type">
                    <div class="flights__left">${flight.type}</div>
                    <div class="flights__right">
                        <p>Tarifa desde</p>
                        <p>COP ${flight.price.toLocaleString('es-CO')}</p>
                    </div>
                </div>
                <div class="flights__footer">
                    <span>Operado por</span>
                    <div>
                        <img height="16" src="https://s.latamairlines.com/images/boreal/collections/v1/logos/latam/SymbolPositive.svg" alt="LATAM Airlines Colombia">
                        LATAM Airlines Colombia
                    </div>
                </div>
            </div>
        `;

        flightElement.addEventListener('click', () => chooseFlight(flight));
        flightsContainer.appendChild(flightElement);
    });
}

function chooseFlight(flight) {
    const titleFlight = document.getElementById('titleFlight');
    const typeTravel = document.querySelector('#typeTravel').value;
    const resume = document.getElementById('resume');
    const resumeIda = document.getElementById('resumeIda');
    const resumeVuelta = document.getElementById('resumeVuelta');
    const flightWrap = document.getElementById('flights-wrapper');
    const option = document.getElementById('option');
    const btnContinue = document.getElementById('btnContinue');

    const pricesArray = document.getElementById('arrayPriceTxt');
    const pricesFormat = pricesArray.value
        .split(',');

    if (typeTravel === "Ida y vuelta") {
        if (!selectedFlightIda) {
            selectedFlightIda = flight;
            resume.classList.remove('hidde');
            resumeIda.classList.remove('hidde');
            titleFlight.textContent = "vuelo de vuelta";
            updateFlightInfo(resumeIda, flight, origin, destiny);  // Actualizar información del vuelo de ida
            loaderPage();
            generateAndRenderReturnFlights(); // Generar vuelos de vuelta
        } else {
            savedFlightsVuelta.push(flight); // Guardar la selección de la vuelta
            resumeVuelta.classList.remove('hidde');
            updateFlightInfo(resumeVuelta, flight, destiny, origin);  // Actualizar información del vuelo de vuelta
            flightWrap.classList.add('hidde');
            option.classList.remove('hidde');
            btnContinue.classList.remove('hidde');
            console.log('Vuelos seleccionados:', {
                ida: selectedFlightIda,
                vuelta: flight
            });

            // Guardamos los precios en un array de precios definido
            pricesFormat[0] = `[${selectedFlightIda.price}]`;
            pricesFormat[1] = `[${flight.price}]`;
            document.getElementById('originType').value = selectedFlightIda.type;
            document.getElementById('destinyType').value = flight.type;
            document.getElementById('originDepartureTime').value = selectedFlightIda.departureTime;
            document.getElementById('originArrivalTime').value = selectedFlightIda.arrivalTime;
            document.getElementById('destinyDepartureTime').value = flight.departureTime;
            document.getElementById('destinyArrivalTime').value = flight.arrivalTime;
        }
    } else if (typeTravel === "Solo ida") {
        resume.classList.remove('hidde');
        resumeIda.classList.remove('hidde');
        updateFlightInfo(resumeIda, flight, origin, destiny);  // Actualizar información del vuelo de ida
        flightWrap.classList.add('hidde');
        option.classList.remove('hidde');
        btnContinue.classList.remove('hidde');
        pricesFormat[0] = `[${flight.price}]`;
        pricesFormat[1] = "[0]";
        document.getElementById('originType').value = flight.type;
    }

    pricesArray.value = pricesFormat;
}

function updateFlightInfo(element, flight, origin, destiny) {
    const flightInfoHTML = `
        <div class="flights__top">
            <div class="flights__times">
                <div class="flights__times-txt">
                    <p>${flight.departureTime}</p>
                    <p>${origin}</p>
                </div>
                <div class="flights__times-duration">
                    <p><strong class="flights__type--txt">${flight.type}</strong></p>
                    <p>${Math.floor(flight.duration / 60)} h ${flight.duration % 60} min</p>
                </div>
                <div class="flights__times-txt">
                    <p>${flight.arrivalTime}</p>
                    <p>${destiny}</p>
                </div>
            </div>
        </div>
        <div class="flights__bot flights__bot--border">
            <div class="flights__footer">
                <span>Operado por</span>
                <div>
                    <img height="16" src="https://s.latamairlines.com/images/boreal/collections/v1/logos/latam/SymbolPositive.svg" alt="LATAM Airlines Colombia">
                    LATAM Airlines Colombia
                </div>
            </div>
        </div>
        <div class="flights__change">
            <span onclick="${element.id === 'resumeIda' ? 'clearSelections()' : 'changeVueltaForm()'}">Cambiar tu vuelo</span>
            <div class="flights__info">
                <p>Precio por pasajero</p>
                <p>COP ${flight.price.toLocaleString('es-CO')}</p>
            </div>
        </div>
    `;

    element.querySelector('.flights__element').innerHTML = flightInfoHTML;
}

function generateAndRenderReturnFlights() {
    const flights = generateFlightOptions();
    renderFlights(flights, destiny, origin);
    savedFlightsVuelta = flights; // Guardar los vuelos de vuelta
}

// Generar y renderizar los vuelos inicialmente
renderFlights(flights, origin, destiny);

function changeVueltaForm(){
    // Esconder todos los elementos excepto el resumen del vuelo de ida
    document.getElementById('resumeVuelta').classList.add('hidde');
    document.getElementById('option').classList.add('hidde');
    document.getElementById('btnContinue').classList.add('hidde');
    loaderPage();
    document.getElementById('flights-wrapper').classList.remove('hidde');
}

// Función para resetear la informacion de los vuelos
function clearSelections() {
    // Reiniciar las selecciones
    selectedFlightIda = null;
    savedFlightsVuelta = [];
    savedFlights = [];

    // Cambiar titulo
    document.getElementById('titleFlight').textContent = "vuelo de ida";

    loaderPage();

    // Esconder resúmenes
    document.getElementById('resume').classList.add('hidde');
    document.getElementById('resumeIda').classList.add('hidde');
    document.getElementById('resumeVuelta').classList.add('hidde');

    // Mostrar nuevamente el contenedor de vuelos
    document.getElementById('flights-wrapper').classList.remove('hidde');
    document.getElementById('option').classList.add('hidde');
    document.getElementById('btnContinue').classList.add('hidde');

    // Generar nuevos vuelos de ida
    const flightsContainer = document.querySelector('.flights');
    flightsContainer.innerHTML = ''; // Limpiar vuelos anteriores
    const newFlights = generateFlightOptions(); // Generar nuevos vuelos
    renderFlights(newFlights, origin, destiny);
}

// Cargue del loader
function loaderPage(){
    document.getElementById('loader').classList.remove('hidde');
    document.getElementById('flights').classList.add('hidde');

    setTimeout(() => {
        document.getElementById('loader').classList.add('hidde');
        document.getElementById('flights').classList.remove('hidde');
    }, 2000);
}

loaderPage();

// Agregar costo de flexibilidad de viaje
function chooseOption(op){
    const prices = document.getElementById('arrayPriceTxt');
    const pricesFormat = prices.value
        .split(',');

    switch (op) {
        case 0:
            document.getElementById('option').classList.add('active');
            pricesFormat[2] = '[34520]';
            break;
        case 1:
            document.getElementById('option').classList.remove('active');
            pricesFormat[2] = '[0]';
            break;
    }

    prices.value = pricesFormat;
}