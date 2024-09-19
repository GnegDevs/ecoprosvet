const slides = document.querySelectorAll('.carousel-slide');
const prevButton = document.querySelector('.prev');
const nextButton = document.querySelector('.next');
let currentSlide = 0;
const intervalTime = 5000;
let slideInterval;

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === index) {
      slide.classList.add('active');
    }
  });
}

function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length;
  showSlide(currentSlide);
}

function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length;
  showSlide(currentSlide);
}

nextButton.addEventListener('click', () => {
  nextSlide();
  resetInterval();
});

prevButton.addEventListener('click', () => {
  prevSlide();
  resetInterval();
});

function resetInterval() {
  clearInterval(slideInterval);
  slideInterval = setInterval(nextSlide, intervalTime);
}

// Автоматическое переключение слайдов
slideInterval = setInterval(nextSlide, intervalTime);

var points_json = '{"Points":[{"MapPoinName": "Город 1","MapPointPopulation": 125000,"MapPointCoordinates": "58.211748, 59.979321"}, {"MapPoinName": "Город 2","MapPointPopulation": 105000,"MapPointCoordinates": "51.221748, 53.929321"}]}';
    var points = $.parseJSON(points_json);
    // Создание обработчика для события window.onLoad
    YMaps.jQuery(function () {
        // Создание экземпляра карты и его привязка к созданному контейнеру
        var map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]),

            // Центр карты
            center,

            // Масштаб
            zoom = 10;

        // Получение информации о местоположении пользователя
        if (YMaps.location) {
            center = new YMaps.GeoPoint(YMaps.location.longitude, YMaps.location.latitude);

            if (YMaps.location.zoom) {
                zoom = 3;
            }

            map.openBalloon(center, "Место вашего предположительного местоположения:<br/>"
                + (YMaps.location.country || "")
                + (YMaps.location.region ? ", " + YMaps.location.region : "")
                + (YMaps.location.city ? ", " + YMaps.location.city : "")
            )
        }else {
            center = new YMaps.GeoPoint(37.64, 55.76);
        }
        for(var i=0;i < points.Points.length;i++){
            var tmp_points = points.Points[i]['MapPointCoordinates'].split(', ');

            var placemark = new YMaps.Placemark(new YMaps.GeoPoint(tmp_points[0],tmp_points[1]));

                placemark.description = "point "+i+" description";
                map.addOverlay(placemark);

            center = new YMaps.GeoPoint(tmp_points[0], tmp_points[1]);

        }
        // Рисуем карту
        map.setCenter(center, zoom);
    });