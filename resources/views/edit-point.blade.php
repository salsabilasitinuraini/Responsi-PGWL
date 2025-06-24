@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }

        /* Enhanced Modal Styling */
        .modal-content {
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 25px 30px;
            position: relative;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .modal-title::before {
            content: "📍";
            font-size: 1.8rem;
        }

        .btn-close {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            opacity: 1;
            transition: all 0.3s ease;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .btn-close:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.1);
        }

        .btn-close:focus {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.2);
        }

        .btn-close::before {
            content: "×";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
            color: white;
            line-height: 1;
        }

        .modal-body {
            padding: 30px;
            background: #f8f9fa;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label::before {
            width: 4px;
            height: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            content: "";
            border-radius: 2px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }

        .form-control::placeholder {
            color: #adb5bd;
        }

        .modal-footer {
            background: white;
            border: none;
            padding: 20px 30px;
            gap: 15px;
        }

        .btn {
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 13px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        #preview-image-point {
            border-radius: 12px;
            margin-top: 15px;
            border: 3px solid #e9ecef;
            transition: all 0.3s ease;
        }

        #preview-image-point:hover {
            border-color: #667eea;
            transform: scale(1.02);
        }

        /* Custom file input styling */
        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-display {
            background: white;
            border: 2px dashed #667eea;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-input-display:hover {
            background: #f8f9ff;
            border-color: #764ba2;
        }

        .file-input-display i {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 10px;
        }

        /* Form introduction styling */
        .form-intro {
            text-align: center;
            margin-bottom: 30px;
            padding: 15px;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Enhanced Modal Edit Point -->
    <div class="modal fade" id="editpointModal" tabindex="-1" aria-labelledby="editPointModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="editPointModalLabel">Edit Point Location</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('points.update', $id) }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')

                        <!-- Form Introduction -->
                        <div class="form-intro">
                            <p style="color: #6c757d; margin-bottom: 25px; text-align: center;">Update the information for this location point</p>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Point Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter a descriptive name for this location">
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4"
                                placeholder="Describe this location, its significance, or any relevant details..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="geom_point" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_point" name="geom_point" rows="3"
                                placeholder="Geometric coordinates will be filled automatically"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Photo</label>
                            <div class="file-input-wrapper">
                                <input type="file" class="form-control" id="image_point" name="image"
                                    onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0]); document.getElementById('preview-image-point').style.display = 'block';">
                                <div class="file-input-display">
                                    <i>📷</i>
                                    <div><strong>Click to upload photo</strong></div>
                                    <div style="color: #6c757d; font-size: 12px;">JPG, PNG, GIF up to 10MB</div>
                                </div>
                            </div>
                            <img src="" alt="" id="preview-image-point" class="img-thumbnail" width="400" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>

    <script>
        // Initialize map
        var map = L.map('map').setView([-7.6587330, 110.3772891], 13);

        // Define basemaps
        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var esri = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });

        var carto = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
            subdomains: 'abcd',
            maxZoom: 20
        });

        // Add default basemap
        osm.addTo(map);

        // Create basemap control
        var baseMaps = {
            "OpenStreetMap": osm,
            "Esri World Imagery": esri,
            "CartoDB Positron": carto
        };

        // Add layer control
        L.control.layers(baseMaps).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: false,
            edit: {
                featureGroup: drawnItems,
                edit: true,
                remove: true
            }
        });

        map.addControl(drawControl);

        map.on('draw:edited', function(e) {
            var layers = e.layers;

            layers.eachLayer(function(layer) {
                var drawnJSONObject = layer.toGeoJSON();
                console.log(drawnJSONObject);

                var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);
                console.log(objectGeometry);

                // layer properties
                var properties = drawnJSONObject.properties;
                console.log(properties);

                drawnItems.addLayer(layer);

                //menampilkan data ke dalam modal
                $('#name').val(properties.name);
                $('#description').val(properties.description);
                $('#geom_point').val(objectGeometry);
                if (properties.image) {
                    $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);
                    $('#preview-image-point').show();
                }

                //menampilkan modal edit point
                $('#editpointModal').modal('show');
            });

        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                //Memasukan layer point ke dalam drawnItems
                drawnItems.addLayer(layer);

                var properties = feature.properties;
                var objectGeometry = Terraformer.geojsonToWKT(feature.geometry);

                layer.on({
                    click: function(e) {
                        //menampilkan data ke dalam modal
                        $('#name').val(properties.name);
                        $('#description').val(properties.description);
                        $('#geom_point').val(objectGeometry);
                        if (properties.image) {
                            $('#preview-image-point').attr('src', "{{ asset('storage/images') }}/" + properties.image);
                            $('#preview-image-point').show();
                        } else {
                            $('#preview-image-point').hide();
                        }

                        //menampilkan modal edit point
                        $('#editpointModal').modal('show');
                    },
                });
            },
        });

        $.getJSON("{{ route('api.point', $id) }}", function(data) {
            point.addData(data);
            map.addLayer(point);
            map.fitBounds(point.getBounds(), {
                padding: [50, 50]
            });
        });

        // Enhanced modal interactions
        $('#editpointModal').on('hidden.bs.modal', function () {
            $('#preview-image-point').hide();
            $('#image_point').val('');
        });


    </script>



@endsection
