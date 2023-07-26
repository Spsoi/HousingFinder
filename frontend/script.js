let dataRequest = {
  "city_id" : null,
  "district_id" : null,
  "complex_id" : null,
  "street_id" : null,
  "building_id" : null,
  "corpus" : null,
  "total_floors" : null,
  "total_entrances" : null,
  "apartments_count" : null,
  "apartment_number_from" : null,
  "apartment_number_to" : null,
};

let globalIndex = 0;

function createDropdownFilter(data, selectorName) {
var selectElement = document.getElementById(selectorName);
selectElement.innerHTML = "";

for (var i = 0; i < data.length; i++) {
var optionElement = document.createElement("option");
var optionData = data[i];

if ( i === 0) {
  optionElement.setAttribute("selected", "selected");
}
  
if (optionData.city_name) {
  optionElement.dataset.type = 'city';
  optionElement.dataset.city_id = optionData.city_id;
} if (optionData.complex_name) {
  optionElement.value = optionData.complex_name;
  optionElement.dataset.type = 'complex';
} if (optionData.district_name) {
  optionElement.value = optionData.district_name;
  optionElement.dataset.type = 'district';
  optionElement.dataset.district_id = optionData.district_id;
} if (optionData.street_name) {
  optionElement.value = optionData.street_name;
  optionElement.dataset.type = 'street';
  optionElement.dataset.street_id = optionData.street_id;
}
optionElement.dataset.index = i;

optionElement.textContent = 
  (optionData.city_name       ? 'город '+optionData.city_name.trim() : '') + ' ' +
  (optionData.district_name   ? 'район ' + optionData.district_name.trim() : '') + ' ' +
  (optionData.complex_name    ? 'ЖК ' + optionData.complex_name.trim() : '') + ' ' +
  (optionData.street_name     ? 'ул. ' + optionData.street_name.trim() : '');
selectElement.appendChild(optionElement);
}

let option = selectElement.querySelectorAll('option');
selectedValue = 0;
if (option.length > 1) {
selectElement.addEventListener("change", function () {
  var selectedOption = this.options[this.selectedIndex];
  selectedValue = selectedOption.dataset.index;
 
  this.options[this.selectedIndex].setAttribute("selected", "selected");
  var options = this.options;
  for (var i = 0; i < options.length; i++) {
      if (options[i].dataset.index === selectedValue) {
          options[i].setAttribute("selected", "selected");
          insertDataToFormSearch(selectedValue, data);
          createDropdownBuildings(selectedValue, data, "dropdownBuilding");
      } else {
          options[i].removeAttribute("selected");
      }
  }
});
} else {
selectElement.addEventListener("click", function () {
  selectedValue = 0;
  insertDataToFormSearch(selectedValue, data) // TODO
  createDropdownBuildings(selectedValue, data, "dropdownBuilding");
});
}

globalIndex = selectedValue;
}

function createDropdownBuildings(selectedValue, data, selectorName) {
var selectElement = document.getElementById(selectorName);
selectElement.innerHTML = "";

const complexIdToSearch = data[selectedValue].complex_id;
const streetIdToSearch  = data[selectedValue].street_id;

const filteredDataToBuildings = data.filter((item) => {
return item.complex_id === complexIdToSearch && item.street_id === streetIdToSearch;
});
for (var i = 0; i < filteredDataToBuildings.length; i++) {
var optionElement = document.createElement("option");
var optionData = filteredDataToBuildings[i];
if ( i === 0) {
  optionElement.setAttribute("selected", "selected");
}
  
if (optionData.building_id) {
  optionElement.dataset.type = 'building';
  optionElement.dataset.building_id = optionData.building_id;
}
optionElement.dataset.index = i;
optionElement.textContent = 
  (optionData.building_number     ? 'дом '    + optionData.building_number.trim()  : '') + ' ' +
  (optionData.street_name         ? 'ул. '    + optionData.street_name.trim()    : '') + ' ' +
  (optionData.complex_name        ? 'ЖК '     + optionData.complex_name.trim()   : '') + ' ' +
  (optionData.district_name       ? 'Район. ' + optionData.district_name.trim()  : '');
selectElement.appendChild(optionElement);
}

let option = selectElement.querySelectorAll('option');
selectedValue = 0;

if (option.length > 1) {
selectElement.addEventListener("change", function () {
  var selectedOption = this.options[this.selectedIndex];
  selectedValue = selectedOption.dataset.index;
  this.options[this.selectedIndex].setAttribute("selected", "selected");
  var options = this.options;
  for (var i = 0; i < options.length; i++) {
      if (options[i].dataset.index === selectedValue) {
          options[i].setAttribute("selected", "selected");
          insertDataToFormSearch(selectedValue, data);
      } else {
          options[i].removeAttribute("selected");
      }
  }
});
} else {
selectElement.addEventListener("click", function () {
  selectedValue = 0;
  insertDataToFormSearch(selectedValue, data)
});
}
globalIndex = selectedValue;

}


function insertDataToFormSearch(index, data) {
const item = data[index];

dataRequest.city_id = null;
dataRequest.district_id = null;
dataRequest.complex_id = null;
dataRequest.street_id = null;
dataRequest.building_id = null;
dataRequest.corpus = null;
dataRequest.total_floors = null;
dataRequest.entrances = null;
dataRequest.apartments_count = null;
dataRequest.apartment_number_from = null;
dataRequest.apartment_number_to = null;

document.getElementById("city").value = '';
document.getElementById("district").value = '';
document.getElementById("complex").value = '';
document.getElementById("street").value = '';
document.getElementById("building").value = '';
document.getElementById("corpus").value = '';
document.getElementById("total_floors").value = '';
document.getElementById("floor").value = '';
document.getElementById("rooms").value = '';
document.getElementById("area").value = '';
document.getElementById("rent_price").value = '';

if (item.city_name) {
document.getElementById("city").value = item.city_name;
dataRequest.city_id = item.city_id;
}

if (item.district_name) {
document.getElementById("district").value = item.district_name;
dataRequest.district_id = item.district_id;
}

if (item.complex_name) {
document.getElementById("complex").value = item.complex_name;
dataRequest.complex_id = item.complex_id;
}

if (item.street_name) {
document.getElementById("street").value = item.street_name;
dataRequest.street_id = item.street_id;
}

if (item.building_number) {
document.getElementById("building").value = item.building_number;
dataRequest.building_id = item.building_id;
}

if (item.building_corpus) {
document.getElementById("corpus").value = item.building_corpus;
dataRequest.corpus = item.corpus;
}

if (item.building_total_floors) {
document.getElementById("total_floors").value = item.building_total_floors;
dataRequest.total_floors = item.total_floors;
}
}

function insertDataToFormSearch(index, data) {
const item = data[index];

dataRequest.city_id = null;
dataRequest.district_id = null;
dataRequest.complex_id = null;
dataRequest.street_id = null;
dataRequest.building_id = null;
dataRequest.corpus = null;
dataRequest.total_floors = null;
dataRequest.entrances = null;
dataRequest.apartments_count = null;
dataRequest.apartment_number_from = null;
dataRequest.apartment_number_to = null;

document.getElementById("city").value = '';
document.getElementById("district").value = '';
document.getElementById("complex").value = '';
document.getElementById("street").value = '';
document.getElementById("building").value = '';
document.getElementById("corpus").value = '';
document.getElementById("total_floors").value = '';
document.getElementById("floor").value = '';
document.getElementById("rooms").value = '';
document.getElementById("area").value = '';
document.getElementById("rent_price").value = '';

if (item.city_name) {
document.getElementById("city").value = item.city_name;
dataRequest.city_id = item.city_id;
}

if (item.district_name) {
document.getElementById("district").value = item.district_name;
dataRequest.district_id = item.district_id;
}

if (item.complex_name) {
document.getElementById("complex").value = item.complex_name;
dataRequest.complex_id = item.complex_id;
}

if (item.street_name) {
document.getElementById("street").value = item.street_name;
dataRequest.street_id = item.street_id;
}

if (item.building_number) {
document.getElementById("building").value = item.building_number;
dataRequest.building_id = item.building_id;
}

if (item.building_corpus) {
document.getElementById("corpus").value = item.building_corpus;
dataRequest.corpus = item.corpus;
}

if (item.building_total_floors) {
document.getElementById("total_floors").value = item.building_total_floors;
dataRequest.total_floors = item.total_floors;
}
}

// Вызываем функцию для создания выпадающего списка при загрузке страницы
let cities = null;
document.addEventListener('DOMContentLoaded', function() {

function filterFetch(method, url, data, func) {
return fetch(url, {
          method: method,
          headers: {
              'Content-Type': 'application/json',
          },
          body: JSON.stringify(data),
      }) 
      .then((response) => {
          return response.json();
      })
      .then((data) => {
          console.log('filterFetch', data);
          createDropdownFilter(data, "dropdownFilter");
      })
      .catch((error) => {
          console.error('Ошибка при фильтрации списка:', error);
      });
}

let timer; // Переменная для хранения таймер

const filter = document.getElementById('filter');
filter.addEventListener('input', function () {
clearTimeout(timer); // Очистить предыдущий таймер
timer = setTimeout(function () {
  let data = {
      'phonetic' : filter.value
  }
  const response = filterFetch('POST', 'http://localhost:8080/api/phonetic/filter', data);
}, 1000);
});

document.getElementById("submitBtn").addEventListener("click", function (event) {
event.preventDefault(); // Prevent default button click behavior

const form = document.getElementById("searchForm");
const formData = new FormData(form);
const jsonData = {};

// Convert FormData to JSON object
formData.forEach((value, key) => {
jsonData[key] = value;
});

const testUrl = "http://localhost:8080/api/search/apartment"; // Replace this with your actual test URL

// Send the JSON data to the test URL using fetch
fetch(testUrl, {
method: "POST",
headers: {
"Content-Type": "application/json",
},
body: JSON.stringify(jsonData),
})
.then((response) => response.json())
.then((data) => {
console.log(data); // TODO render
})
.catch((error) => {
console.error("Error:", error);
});
});

});