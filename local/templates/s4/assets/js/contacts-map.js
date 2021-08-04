
document.addEventListener('DOMContentLoaded', function() {
    ymaps.ready(init);

    function init () {
        $('.js-map').each(function () {
            var centerCoord = $(this).data('centercoord') || [59.93914514163674,30.33349282507063],
                idMap = $(this).data('mapid'),
                $item = $(this).find('.js-map-item'),
                local = GLOBAL.parseData($(this).data('maplocal'));

            var myMap = new ymaps.Map(idMap, jQuery.extend({}, local, {
                center: centerCoord,
                zoom: 15,
            })),
            objectManager = new ymaps.ObjectManager(),
            masObjects =[];

            //myMap.behaviors.disable('drag');
            myMap.geoObjects.add(objectManager);

            $item.each(function () {
                var objectId = $(this).data('objectid'),
                    objectCoord = $(this).data('objectcoord'),
                    objectText =  $(this).find('.js-map-item-value').html();

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
                                '<div class="map-popup-body map-popup-body_simple">' + objectText + '</div>' +
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

                myMap.setCenter(objectManager.objects.getById(objectId).geometry.coordinates, 15, {
                    checkZoomRange: true
                });
            }
        });
    }
});
