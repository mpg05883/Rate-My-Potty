<!DOCTYPE html>
<html lang="en">
<head>
    <!-- meta data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- self-made stylesheets -->
    <link rel="stylesheet" href="../styles/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../styles/style.css?v=<?php echo time(); ?>">

    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- animate css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <!-- awesome font-->
    <script src="https://kit.fontawesome.com/8cd52aea40.js" crossorigin="anonymous"></script>

    <!-- mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.0/mapbox-gl.js"></script>
    
    <!-- title -->
    <title>Rate My Potty | Home</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../img/logo.png">
    <!-- <style>
        .mapboxgl-popup {
        max-width: 400px;
        font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
    </style> -->
</head>
<body>
    <!-- include header -->
    <?php include '../components/header.php'; ?>
    <main>
        <!-- hero img container -->
        <div class="container-fluid" id="hero-img-container">
            <div id="hero-img">
            </div>
        </div>

        <!-- parent container's container -->
        <div class="row justify-content-center container-fluid" id="grandparent-container">
            <!-- container for the rest of the page -->
            <div class="col-6" id="parent-container">
                <!-- mission section -->
                <div class="py-4 container-fluid" id="mission-container">
                    <!-- mission header -->
                    <h2 class="pt-4 text-center fs-1 animate__animated animate__fadeInUp" id="mission-header">Our Mission</h2>
                    
                    <!-- mission statement -->
                    <p class="text-center lh-lg animate__animated animate__fadeInUp" id="mission-statement">
                        Welcome to Rate My Potty! We empower students to conquer the porcelain throne through the 
                        power of peer review. No more bathroom roulette! Unmask hidden gems and expose hygiene horrors, 
                        with user-driven reviews, and insider tips to guide you to the cleanest, most comfortable stalls of USC. 
                    </p>

                    <!-- review btn -->
                    <button onclick="location.href = '../pages/upload_form.php'" type="button" class="btn fw-medium animate__animated animate__fadeInUp animate__slower" id="review-btn">
                        <i class="fa-solid fa-pen-to-square fa-sm pe-1" style="color: #000000;"></i>
                        Write a review
                    </button>
                </div>

                <!-- map container -->
                <div class="rounded-5 my-4 py-4 animate__animated animate__fadeInUp container-fluid" id="map">
                <script>
                    // API tken
                    mapboxgl.accessToken = 'pk.eyJ1IjoibXBnZWUiLCJhIjoiY2xwb3k1ZTFjMHJseDJpcTRiZXFlcGwzaiJ9.xT9UpvZS1bB_T8WmRKS1vQ';
                    
                    // init map object
                    const map = new mapboxgl.Map({
                        container: 'map', // container's id
                        style: 'mapbox://styles/mapbox/streets-v12', // style
                        center: [-118.28567677747262, 34.02181012760304], // starting position [lng, lat]
                        zoom: 15.9 // starting zoom
                    });

                    // create the popup
                    // on each pop up, include
                    /*
                    building abbreviation
                    rating
                    anchor tag to bathrom.php
                    */
                    const popup = new mapboxgl.Popup({ offset: 25 }).setText(
                    'Construction on the Washington Monument began in 1848.'
                    );
                    
                    // create DOM element for the marker
                    const el = document.createElement('div');
                    el.id = 'marker';

                    // Create a default Marker and add it to the map.
                    const marker1 = new mapboxgl.Marker({color: '#017075', scale: 0.6})
                        .setLngLat([-118.28952532067683, 34.019544759288905])
                        .setPopup(popup) // sets a popup on this marker
                        .addTo(map);
                    
                    // // create polygon around USC
                    // map.on('load', () => {
                    // // Add a data source containing GeoJSON data.
                    // map.addSource('USC', {
                    //     'type': 'geojson',
                    //     'data': {
                    //         'type': 'Feature',
                    //         'geometry': {
                    //         'type': 'Polygon',
                    //             // These coordinates outline USC.
                    //             'coordinates': [
                    //                 [
                    //                     [-118.29139673746857, 34.025367694065935],
                    //                     [-118.29039673746857, 34.02538510637471],
                    //                     [-118.28813105261978, 34.02546801588798],
                    //                     [-118.28717900021753, 34.025036681260396],
                    //                     [-118.28022829535438, 34.02184295725684],
                    //                     [-118.28238982892475, 34.01845912939215],
                    //                     [-118.29140112312683, 34.018425687825]
                    //                 ]
                    //             ]
                    //         }
                    //     }
                    // });
                    
                    // // Add a new layer to visualize the polygon.
                    // map.addLayer({
                    // 'id': 'USC',
                    // 'type': 'fill',
                    // 'source': 'USC', // reference the data source
                    // 'layout': {},
                    // 'paint': {
                    // 'fill-color': '#015C63', // blue color fill
                    // 'fill-opacity': 0.15
                    // }
                    // });
                    // // Add a black outline around the polygon.
                    // map.addLayer({
                    // 'id': 'outline',
                    // 'type': 'line',
                    // 'source': 'USC',
                    // 'layout': {},
                    // 'paint': {
                    // 'line-color': '#000',
                    // 'line-width': 1
                    // }
                    // });
                    // });

                // map.on('load', () => {
                // map.addSource('places', {
                // 'type': 'geojson',
                // 'data': {
                // 'type': 'FeatureCollection',
                // 'features': [
                // {
                // 'type': 'Feature',
                // 'properties': {
                // 'description':
                // '<strong>Make it Mount Pleasant</strong><p>Make it Mount Pleasant is a handmade and vintage market and afternoon of live entertainment and kids activities. 12:00-6:00 p.m.</p>'
                // },
                // 'geometry': {
                // 'type': 'Point',
                // 'coordinates': [-118.29139673746857, 34.025367694065935]
                // }
                // },
                // {
                // 'type': 'Feature',
                // 'properties': {
                // 'description':
                // '<strong>Mad Men Season Five Finale Watch Party</strong><p>Head to Lounge 201 (201 Massachusetts Avenue NE) Sunday for a Mad Men Season Five Finale Watch Party, complete with 60s costume contest, Mad Men trivia, and retro food and drink. 8:00-11:00 p.m. $10 general admission, $20 admission and two hour open bar.</p>'
                // },
                // 'geometry': {
                // 'type': 'Point',
                // 'coordinates': [-118.29039673746857, 34.02538510637471]
                // }
                // },
                // {
                // 'type': 'Feature',
                // 'properties': {
                // 'description':
                // '<strong>Big Backyard Beach Bash and Wine Fest</strong><p>EatBar (2761 Washington Boulevard Arlington VA) is throwing a Big Backyard Beach Bash and Wine Fest on Saturday, serving up conch fritters, fish tacos and crab sliders, and Red Apron hot dogs. 12:00-3:00 p.m. $25.</p>'
                // },
                // 'geometry': {
                // 'type': 'Point',
                // 'coordinates': [-118.28813105261978, 34.02546801588798]
                // }
                // },
                // {
                // 'type': 'Feature',
                // 'properties': {
                // 'description':
                // '<strong>Ballston Arts & Crafts Market</strong><p>The Ballston Arts & Crafts Market sets up shop next to the Ballston metro this Saturday for the first of five dates this summer. Nearly 35 artists and crafters will be on hand selling their wares. 10:00-4:00 p.m.</p>'
                // },
                // 'geometry': {
                // 'type': 'Point',
                // 'coordinates': [-118.28717900021753, 34.025036681260396]
                // }
                // },
                // ]
                // }
                // });

                // // Add a layer showing the places.
                // map.addLayer({
                // 'id': 'places',
                // 'type': 'circle',
                // 'source': 'places',
                // 'paint': {
                // 'circle-color': '#4264fb',
                // 'circle-radius': 6,
                // 'circle-stroke-width': 2,
                // 'circle-stroke-color': '#ffffff'
                // }
                // });
                
                // // Create a popup, but don't add it to the map yet.
                // const popup = new mapboxgl.Popup({
                // closeButton: false,
                // closeOnClick: false
                // });
                
                // map.on('mouseenter', 'places', (e) => {
                // // Change the cursor style as a UI indicator.
                // map.getCanvas().style.cursor = 'pointer';
                
                // // Copy coordinates array.
                // const coordinates = e.features[0].geometry.coordinates.slice();
                // const description = e.features[0].properties.description;
                
                // // Ensure that if the map is zoomed out such that multiple
                // // copies of the feature are visible, the popup appears
                // // over the copy being pointed to.
                // while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                // coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                // }
                
                // // Populate the popup and set its coordinates
                // // based on the feature found.
                // popup.setLngLat(coordinates).setHTML('<p>hello</p>').addTo(map);
                // });
                
                // map.on('mouseleave', 'places', () => {
                // map.getCanvas().style.cursor = '';
                // popup.remove();
                // });
                // });
                                            

                </script>
                </div>
                
                    


                <!-- <h3 class="pt-4 fs-1 animate__animated animate__fadeInUp" id="top-bathrooms-header">Top Rated Bathrooms</h3>
                
                <div class="row justify-content-center container-fluid" id="card-container">
                    
                    <div class="col-lg-3 col-md-6 col-12 container animate__animated animate__fadeInUp animate__slow">
                        <div class="hover-enlarge bg-light mbo-4 rounded-4 card">
                            <div class="card-img-container">
                                <img class="py-4 card-img-top card-img" src="../img/rth.jpg" alt="rth">
                            </div>
                            <div class="p-2 card-body">
                                <div class="hover-enlarge">
                                    <h4 class="py-1 card-text">RTH</h4>
                                </div>
                                <div class="" id="rating-container">
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 container animate__animated animate__fadeInUp animate__slow">
                        <div class="bg-light m-4 rounded-4 card">
                            <div class="card-img-container">
                                <img class="py-4 card-img-top card-img" src="../img/rth.jpg" alt="rth">
                            </div>
                            <div class="p-2 card-body">
                                <div class="hover-enlarge">
                                    <h4 class="py-1 card-text">RTH</h4>
                                </div>
                                <div class="" id="rating-container">
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 container animate__animated animate__fadeInUp animate__slow">
                        <div class="bg-light m-4 rounded-4 card">
                            <div class="card-img-container">
                                <img class="py-4 card-img-top card-img" src="../img/rth.jpg" alt="rth">
                            </div>
                            <div class="p-2 card-body">
                                <div class="hover-enlarge">
                                    <h4 class="py-1 card-text">RTH</h4>
                                </div>
                                <div class="" id="rating-container">
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12 container animate__animated animate__fadeInUp animate__slow">
                        <div class="bg-light m-4 rounded-4 card">
                            <div class="card-img-container">
                                <img class="py-4 card-img-top card-img" src="../img/rth.jpg" alt="rth">
                            </div>
                            <div class="p-2 card-body">
                                <div class="hover-enlarge">
                                    <h4 class="py-1 card-text">RTH</h4>
                                </div>
                                <div class="" id="rating-container">
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star checked fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                    <span class="fa fa-star fa-sm"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            </div>
        </div>
    </main>
    <?php include '../components/footer.html'; ?>
    <!-- include js script tags at end of body -->
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>


<!-- 
        video on custom markers with google maps api: https://www.youtube.com/watch?v=CdDXbvBFXLY
        map marker/geo coding API (bascially free): https://www.here.com/get-started/pricing
        -->