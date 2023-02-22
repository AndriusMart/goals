import "./bootstrap";

let currentCity = "Kaunas"; // default city

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function (position) {
        let lat = position.coords.latitude;
        let lon = position.coords.longitude;
        let url = `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=4b8ae4fdc2fa26b5e710d1bf79129fde&units=metric`;
        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                currentCity = data.name;
                getWeatherData();
            });
    });
}
getWeatherData();
function getWeatherData(city = currentCity) {
    fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=4b8ae4fdc2fa26b5e710d1bf79129fde&units=metric`
    )
        .then((response) => response.json())
        .then((data) => {
            let weatherResult = document.querySelector("#weather-result");
            weatherResult.innerHTML = `
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">${data.name}</h5>
          <p class="card-text">Temperature: ${data.main.temp} &#8451;</p>
          <p class="card-text">Weather: ${data.weather[0].description}</p>
        </div>
      </div>
    `;
        })
        .catch((error) => {
            console.log(error);
        });
}
document.querySelector("#submit").addEventListener("click", function (event) {
    event.preventDefault();
    let city = document.querySelector("#city").value;
    fetch(
        `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=4b8ae4fdc2fa26b5e710d1bf79129fde&units=metric`
    )
        .then((response) => response.json())
        .then((data) => {
            let weatherResult = document.querySelector("#weather-result");
            weatherResult.innerHTML = `
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">${data.name}</h5>
              <p class="card-text">Temperature: ${data.main.temp} &#8451;</p>
              <p class="card-text">Weather: ${data.weather[0].description}</p>
            </div>
          </div>
        `;
        })
        .catch((error) => {
            let weatherResult = document.querySelector("#weather-result");
            weatherResult.innerHTML = `
          <div class="card">
            We can't find city named like this: ${city}
          </div>
        `;
            console.log(error);
        });
});

// Get all the HTML elements that have the "left-value" class
let leftValues = document.querySelectorAll(".left-value");
let myDiv = document.querySelectorAll(".myDiv");

// Loop through each element and check if its value is less than 2
for (let i = 0; i < leftValues.length; i++) {
    let leftValue = leftValues[i].textContent;
    let Div = myDiv[i].textContent;
    console.log(Div);
    console.log(leftValue);
    if (leftValue < 2) {
        myDiv[i].style.backgroundColor = "red";
    }
}
