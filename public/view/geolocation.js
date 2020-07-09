/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function () {
    var gpsLokasi = null;
    var koreksiLokasi = gpsLokasi;
    var leafletMap;
    var markerPointer;

    function showErrors(error) {
        var tag = '';
        switch (error.code) {
            case error.PERMISSION_DENIED:
                tag = "User denied the request for Geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                tag = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                tag = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                tag = "An unknown error occurred.";
                break;
        }        
        $.notify({title: "Information", message: tag}, {type: "info", delay: 3});
        initMap();
        //$('#lokasi').val(tag);
    }

    function showPosition(lat, lang) {
        console.log(lat, lang);
        $("#position").val("");
        $("#latitude").val(lat);
        $("#longitude").val(lang);
        //console.log(position);
        $.getJSON('https://geo.ub.ac.id/reverse.php', {
            lat: lat,
            lon: lang,
            format: 'json',
        }, function (result) {
            //console.log(result);
            if (result) {
                //console.log('City: ' + result.address.city);
                try {
                    $("#position").val(JSON.stringify(result));                
                    if (!result.address.state_district || !result.address.state) {
                        $.notify({title: "Information", message: "Lokasi tidak terdeteksi. Silakan ketikkan/masukkan secara manual lokasi Anda."}, {type: "danger", delay: 3});
                        return;
                    }
                    //$("#lokasi").val(result.address.state_district + ', ' + result.address.state);                    
                    $("#lokasi").val(result.display_name);   
                    $("#lokasi_koreksi").val(result.display_name);   
                } catch (e) {
                    $.notify({title: "Information", message: "Lokasi tidak terdeteksi. Silakan ketikkan/masukkan secara manual lokasi Anda."}, {type: "danger", delay: 3});
                }
            } else {
                $.notify({title: "Information", message: "Lokasi tidak terdeteksi. Silakan ketikkan/masukkan secara manual lokasi Anda."}, {type: "danger", delay: 3});
            }
        });
    }
    
    function showPositionAdjustment(lat, lang) {
        console.log(lat, lang);
        $("#position").val("");
        $("#latitude_koreksi").val(lat);
        $("#longitude_koreksi").val(lang);
        //console.log(position);
        $.getJSON('https://geo.ub.ac.id/reverse.php', {
            lat: lat,
            lon: lang,
            format: 'json',
        }, function (result) {
            //console.log(result);
            if (result) {
                //console.log('City: ' + result.address.city);
                try {
                    $("#position").val(JSON.stringify(result));

                    //$("#lokasi").val(result.address.state_district + ', ' + result.address.state);
                    $("#lokasi_koreksi").val(result.display_name);
                } catch (e) {
                    $.notify({title: "Information", message: "Lokasi tidak terdeteksi. Silakan pilih secara manual lokasi Anda."}, {type: "danger", delay: 3});
                }
            } else {
                $.notify({title: "Information", message: "Lokasi tidak terdeteksi. Silakan pilih secara manual lokasi Anda."}, {type: "danger", delay: 3});
            }
        });
    }

    populateLocation = function () {
        $("#position").val("");
        $("#latitude").val("");
        $("#longitude").val("");
        if (navigator.geolocation) {
            //console.log("it is supported");
            navigator.geolocation.getCurrentPosition(function(position){
                showPosition(position.coords.latitude, position.coords.longitude);
                gpsLokasi = [position.coords.latitude, position.coords.longitude];
                initMap();
            }, showErrors);

        } else
        {
            //console.log("geo location is not supported");
            $.notify({message: "Geo location is not supported!", title: "Warning"}, {type: "warning", delay: 5});
            initMap();
        }
    }

    populateLocation();
    $('.btn-auto-detect').click(function () {         
        populateLocation();
    });

    var lokasiRektorat = [-7.952296, 112.613023];
    function initMap(){
        if($("#latitude").val() != "" && $("#longitude").val() != "")
            koreksiLokasi = [$("#latitude").val(), $("#longitude").val()];
        else if(gpsLokasi == null)
            koreksiLokasi = lokasiRektorat;

        if(gpsLokasi != null) leafletMap = L.map('mapid').setView(gpsLokasi, 13);
        else leafletMap = L.map('mapid').setView(lokasiRektorat, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(leafletMap);
        markerPointer = L.marker(koreksiLokasi).addTo(leafletMap)
            .bindPopup('Lokasi Koreksi')
            .openPopup();
        if(gpsLokasi != null) {
            var defaultPointer = L.marker(gpsLokasi).addTo(leafletMap)
                .bindPopup('Lokasi GPS').openPopup();
            defaultPointer._icon.classList.add("marker-gps");
        }
        leafletMap.on('click', function(e) {
            koreksiLokasi = [e.latlng.lat, e.latlng.lng];
            showPositionAdjustment(e.latlng.lat, e.latlng.lng);

            markerPointer.setLatLng(e.latlng);
            leafletMap.panTo(e.latlng);
            if(leafletMap.getZoom() < 14) {
                setTimeout(function () {
                    leafletMap.setZoom(14);
                }, 300);
            }
            if(gpsLokasi != null) {
                var jarakKm = distance(koreksiLokasi[0], koreksiLokasi[1], gpsLokasi[0], gpsLokasi[1], 'K');
                markerPointer.bindPopup('Jarak Koreksi ' + jarakKm + " Km").openPopup();
            }
        });
    }

    $("#mapid-search").keydown(function (e) {
        if(e.keyCode  == 13) {
            e.preventDefault();
            return false;
        }
    });
    $("#mapid-search").keyup(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            var query = $(this).val();
            $.getJSON('https://geo.ub.ac.id/search', {
                q: query,
                format: 'json',
            }, function (result) {
                if (result && result.length > 0) {
                    result = result[0];
                    if(result.lat && result.lon){
                        koreksiLokasi = [result.lat, result.lon];
                        showPositionAdjustment(result.lat, result.lon);
                        markerPointer.setLatLng(new L.LatLng(result.lat, result.lon));

                        leafletMap.panTo(new L.LatLng(result.lat, result.lon));
                        if(leafletMap.getZoom() < 14) {
                            setTimeout(function () {
                                leafletMap.setZoom(14);
                            }, 300);
                        }
                        if(gpsLokasi != null) {
                            var jarakKm = distance(koreksiLokasi[0], koreksiLokasi[1], gpsLokasi[0], gpsLokasi[1], 'K');
                            markerPointer.bindPopup('Jarak Koreksi ' + jarakKm + " Km").openPopup();
                        }
                    }
                }
            });
        }
    })

    function distance(lat1, lon1, lat2, lon2, unit) {
        if ((lat1 == lat2) && (lon1 == lon2)) {
            return 0;
        }
        else {
            var radlat1 = Math.PI * lat1/180;
            var radlat2 = Math.PI * lat2/180;
            var theta = lon1-lon2;
            var radtheta = Math.PI * theta/180;
            var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
            if (dist > 1) {
                dist = 1;
            }
            dist = Math.acos(dist);
            dist = dist * 180/Math.PI;
            dist = dist * 60 * 1.1515;
            if (unit=="K") { dist = dist * 1.609344 }
            if (unit=="N") { dist = dist * 0.8684 }
            return dist.toFixed(2);
        }
    }

    $('#petaModal .btn-close-map').click(function () {
        $("#petaModal").hide();
    });
});

