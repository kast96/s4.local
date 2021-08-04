
document.addEventListener('DOMContentLoaded', function() {
    ymaps.ready(init);

    function init () {
        var centerCoord = $('.js-map').data('objectcoord') || [59.93914514163674,30.33349282507063];

        var myMap = new ymaps.Map('map', {
            center: centerCoord,
            zoom: 10
        }),
        objectManager = new ymaps.ObjectManager(),
        masObjects =[];

        myMap.behaviors.disable('drag');
        myMap.geoObjects.add(objectManager);

        $('.js-map-item').each(function () {
            var objectId = $(this).data('objectid'),
                objectCoord = $(this).data('objectcoord'),
                objectText =  $(this).find('.js-map-item-value').text();

            var elementsObjects =
                {
                    "type": "Feature",
                    "id": objectId,
                    "options": {
                        "preset": "islands#darkGreenIcon",
                    },
                    "geometry":{
                        "type": "Point",
                        "coordinates": objectCoord
                    },
                    "properties":{
                        "balloonContentBody": '<div class="map-popup">' +
                            '<div class="map-popup-body"><i class="map-popup-icon las la-map-marker"></i>' + objectText + '</div>' +
                            '<a class="map-popup-button button button_dark" href="javascript:;">выбрать</a>' +
                            '</div>',
                    }
                };

            masObjects.push(elementsObjects);
        });

        objectManager.add({
                "type": "FeatureCollection",
                "features": masObjects
        });

        objectManager.objects.events.add('click', function (e) {
            var objectId=e.get('objectId');
            viewObject(objectId);
        });

        [].forEach.call(document.querySelectorAll('[data-objectId]'), function(el) {
            el.addEventListener('click', function() {
                var objectId=el.getAttribute("data-objectId");
                viewObject(objectId);
            });
        });

        function viewObject(objectId){
            $('.js-map-item').removeClass('active');

            document.querySelector('[data-objectId="'+objectId+'"]').classList.add('active');

            objectManager.objects.each(function (item) {
                    objectManager.objects.setObjectOptions(item.id, {
                    preset: 'islands#darkGreenIcon'
                });
            });
            objectManager.objects.setObjectOptions(objectId, {
                preset: 'islands#darkGreenIcon'
            });

            myMap.setCenter(objectManager.objects.getById(objectId).geometry.coordinates, 10, {
                checkZoomRange: true
            });
        }
    }
});
