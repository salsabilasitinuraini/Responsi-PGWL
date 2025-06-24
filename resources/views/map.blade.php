@extends('layout.template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }

        .leaflet-control-layers {
            margin-top: 90px !important;
            z-index: 999 !important;
        }

       #pilihTujuan {
    position: absolute;
    bottom: 510px;
    left: 10px;
    z-index: 1000;
    padding: 10px;
    border-radius: 8px;
    background: white;
    font-size: 14px;
    border: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    min-width: 200px;
    max-height: 180px;
    overflow-y: auto;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
}

#pilihTujuan:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

#pilihTujuan option {
    padding: 8px;
    background: white;
    color: #333;
}

#pilihTujuan option:hover {
    background-color: #f8f9fa;
}

    </style>
@endsection


@section('content')
    <div id="map"></div>

    <select id="pilihTujuan">
    <option disabled selected>-- Pilih Tujuan Wisata --</option>
    @foreach ($points as $p)
        <option value="{{ $p->lat }},{{ $p->lng }}">{{ $p->name }}</option>
    @endforeach
</select>

    </select>
    <!-- Enhanced Modal Create Point -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="createPointModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content enhanced-modal">
                <!-- Enhanced Header -->
                <div class="modal-header enhanced-header">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="header-text">
                            <h1 class="modal-title" id="createPointModalLabel">Create New Point</h1>
                            <p class="modal-subtitle">Add a new location to your map</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data"
                    id="createPointForm">
                    <div class="modal-body enhanced-body">
                        @csrf

                        <!-- Progress Indicator -->
                        <div class="form-progress">
                            <div class="progress-steps">
                                <div class="step active" data-step="1">
                                    <div class="step-number">1</div>
                                    <span>Basic Info</span>
                                </div>
                                <div class="step" data-step="2">
                                    <div class="step-number">2</div>
                                    <span>Location</span>
                                </div>
                                <div class="step" data-step="3">
                                    <div class="step-number">3</div>
                                    <span>Photo</span>
                                </div>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>
                        </div>

                        <!-- Step 1: Basic Information -->
                        <div class="form-step active" data-step="1">
                            <div class="step-header">
                                <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                                <p>Enter the basic details for your new point</p>
                            </div>

                            <div class="form-group-enhanced">
                                <label for="name" class="form-label-enhanced">
                                    <i class="fas fa-tag"></i>
                                    Point Name <span class="required">*</span>
                                </label>
                                <input type="text" class="form-control-enhanced" id="name" name="name"
                                    placeholder="Enter a descriptive name for this location" required>
                                <div class="form-feedback"></div>
                            </div>

                            <div class="form-group-enhanced">
                                <label for="description" class="form-label-enhanced">
                                    <i class="fas fa-align-left"></i>
                                    Description
                                </label>
                                <textarea class="form-control-enhanced" id="description" name="description" rows="4"
                                    placeholder="Describe this location, its significance, or any relevant details..."></textarea>
                                <div class="character-count">
                                    <span id="char-count">0</span>/500 characters
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Geometry -->
                        <div class="form-step" data-step="2">
                            <div class="step-header">
                                <h3><i class="fas fa-map-pin"></i> Location Coordinates</h3>
                                <p>The coordinates will be automatically filled when you click on the map</p>
                            </div>

                            <div class="form-group-enhanced">
                                <label for="geom_point" class="form-label-enhanced">
                                    <i class="fas fa-crosshairs"></i>
                                    Geometry Coordinates <span class="required">*</span>
                                </label>
                                <div class="geometry-input-wrapper">
                                    <textarea class="form-control-enhanced" id="geom_point" name="geom_point" rows="3"
                                        placeholder="Click on the map to set coordinates automatically" readonly></textarea>
                                    <div class="geometry-status">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span id="coordinate-status">No coordinates set</span>
                                    </div>
                                </div>
                                <div class="form-help">
                                    <i class="fas fa-lightbulb"></i>
                                    Tip: Click anywhere on the map to automatically capture the coordinates
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Photo Upload -->
                        <div class="form-step" data-step="3">
                            <div class="step-header">
                                <h3><i class="fas fa-camera"></i> Photo Upload</h3>
                                <p>Add a photo to make your point more visually appealing</p>
                            </div>

                            <div class="form-group-enhanced">
                                <label for="image_point" class="form-label-enhanced">
                                    <i class="fas fa-image"></i>
                                    Photo
                                </label>
                                <div class="photo-upload-area" id="photoUploadArea">
                                    <input type="file" class="form-control-file" id="image_point" name="image"
                                        accept="image/*" onchange="handleImageUpload(this)">
                                    <div class="upload-placeholder" id="uploadPlaceholder">
                                        <div class="upload-icon">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </div>
                                        <div class="upload-text">
                                            <strong>Click to upload</strong> or drag and drop
                                        </div>
                                        <div class="upload-hint">
                                            PNG, JPG, GIF up to 10MB
                                        </div>
                                    </div>
                                    <img src="" alt="" id="preview-image-point" class="image-preview"
                                        style="display: none;">
                                    <div class="image-actions" id="imageActions" style="display: none;">
                                        <button type="button" class="btn-remove-image" onclick="removeImage()">
                                            <i class="fas fa-trash"></i> Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Footer -->
                    <div class="modal-footer enhanced-footer">
                        <div class="footer-navigation">
                            <button type="button" class="btn btn-nav btn-prev" id="prevBtn" onclick="changeStep(-1)"
                                style="display: none;">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button type="button" class="btn btn-nav btn-next" id="nextBtn" onclick="changeStep(1)">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                        <div class="footer-actions">
                            <button type="button" class="btn btn-secondary-enhanced" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-primary-enhanced" id="submitBtn"
                                style="display: none;">
                                <i class="fas fa-save"></i> Create Point
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Modal Styles */
        .enhanced-modal {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .enhanced-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 24px 30px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .header-text .modal-title {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .modal-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin: 4px 0 0 0;
        }

        .btn-close-custom {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-close-custom:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }

        .enhanced-body {
            padding: 30px;
            background: #f8f9fa;
        }

        /* Progress Indicator */
        .form-progress {
            margin-bottom: 30px;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            opacity: 0.5;
            transition: all 0.3s ease;
        }

        .step.active {
            opacity: 1;
        }

        .step-number {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .step span {
            font-size: 12px;
            font-weight: 500;
            color: #6c757d;
        }

        .step.active span {
            color: #495057;
        }

        .progress-bar {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            width: 33.33%;
            transition: width 0.3s ease;
        }

        /* Form Steps */
        .form-step {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .form-step.active {
            display: block;
        }

        .step-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .step-header h3 {
            color: #495057;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .step-header h3 i {
            color: #667eea;
            margin-right: 8px;
        }

        .step-header p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        /* Enhanced Form Elements */
        .form-group-enhanced {
            margin-bottom: 24px;
        }

        .form-label-enhanced {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-label-enhanced i {
            color: #667eea;
            width: 16px;
        }

        .required {
            color: #dc3545;
        }

        .form-control-enhanced {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            background: white;
        }

        .form-control-enhanced:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control-enhanced:invalid {
            border-color: #dc3545;
        }

        .form-control-enhanced:valid {
            border-color: #28a745;
        }

        .character-count {
            text-align: right;
            font-size: 12px;
            color: #6c757d;
            margin-top: 4px;
        }

        /* Geometry Input */
        .geometry-input-wrapper {
            position: relative;
        }

        .geometry-status {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            color: #6c757d;
        }

        .form-help {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #6c757d;
            margin-top: 8px;
            padding: 8px 12px;
            background: #e3f2fd;
            border-radius: 6px;
            border-left: 3px solid #2196f3;
        }

        /* Photo Upload */
        .photo-upload-area {
            position: relative;
            border: 2px dashed #dee2e6;
            border-radius: 12px;
            background: white;
            transition: all 0.2s ease;
            overflow: hidden;
        }

        .photo-upload-area:hover {
            border-color: #667eea;
            background: #f8f9ff;
        }

        .form-control-file {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }

        .upload-placeholder {
            padding: 40px 20px;
            text-align: center;
        }

        .upload-icon {
            font-size: 48px;
            color: #667eea;
            margin-bottom: 16px;
        }

        .upload-text {
            font-size: 16px;
            color: #495057;
            margin-bottom: 8px;
        }

        .upload-hint {
            font-size: 12px;
            color: #6c757d;
        }

        .image-preview {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            display: block;
        }

        .image-actions {
            position: absolute;
            top: 12px;
            right: 12px;
        }

        .btn-remove-image {
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all 0.2s ease;
        }

        .btn-remove-image:hover {
            background: #dc3545;
        }

        /* Enhanced Footer */
        .enhanced-footer {
            background: white;
            padding: 20px 30px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-navigation {
            display: flex;
            gap: 12px;
        }

        .footer-actions {
            display: flex;
            gap: 12px;
        }

        .btn-nav {
            padding: 10px 20px;
            border: 2px solid #667eea;
            background: white;
            color: #667eea;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            background: #667eea;
            color: white;
        }

        .btn-secondary-enhanced {
            padding: 12px 24px;
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary-enhanced:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }

        .btn-primary-enhanced {
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-primary-enhanced:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .enhanced-header {
                padding: 20px;
            }

            .enhanced-body {
                padding: 20px;
            }

            .enhanced-footer {
                padding: 16px 20px;
                flex-direction: column;
                gap: 16px;
            }

            .footer-navigation,
            .footer-actions {
                width: 100%;
                justify-content: center;
            }


        }
    </style>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        // Step Navigation
        function changeStep(direction) {
            const newStep = currentStep + direction;

            if (newStep >= 1 && newStep <= totalSteps) {
                // Hide current step
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.remove('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.remove('active');

                // Show new step
                currentStep = newStep;
                document.querySelector(`.form-step[data-step="${currentStep}"]`).classList.add('active');
                document.querySelector(`.step[data-step="${currentStep}"]`).classList.add('active');

                // Update progress bar
                const progressFill = document.querySelector('.progress-fill');
                progressFill.style.width = `${(currentStep / totalSteps) * 100}%`;

                // Update navigation buttons
                updateNavigationButtons();
            }
        }

        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            // Previous button
            prevBtn.style.display = currentStep === 1 ? 'none' : 'flex';

            // Next/Submit button
            if (currentStep === totalSteps) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'flex';
            } else {
                nextBtn.style.display = 'flex';
                submitBtn.style.display = 'none';
            }
        }

        // Image Upload Handling
        function handleImageUpload(input) {
            const file = input.files[0];
            if (file) {
                const preview = document.getElementById('preview-image-point');
                const placeholder = document.getElementById('uploadPlaceholder');
                const actions = document.getElementById('imageActions');

                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
                placeholder.style.display = 'none';
                actions.style.display = 'block';
            }
        }

        function removeImage() {
            const input = document.getElementById('image_point');
            const preview = document.getElementById('preview-image-point');
            const placeholder = document.getElementById('uploadPlaceholder');
            const actions = document.getElementById('imageActions');

            input.value = '';
            preview.src = '';
            preview.style.display = 'none';
            placeholder.style.display = 'block';
            actions.style.display = 'none';
        }

        // Character counter for description
        document.getElementById('description').addEventListener('input', function() {
            const charCount = document.getElementById('char-count');
            const length = this.value.length;
            charCount.textContent = length;

            if (length > 500) {
                charCount.style.color = '#dc3545';
            } else if (length > 400) {
                charCount.style.color = '#ffc107';
            } else {
                charCount.style.color = '#6c757d';
            }
        });

        // Form validation
        document.getElementById('createPointForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const geometry = document.getElementById('geom_point').value.trim();

            if (!name || !geometry) {
                e.preventDefault();
                alert('Please fill in all required fields');
                return false;
            }
        });

        // Update coordinate status when geometry is filled
        document.getElementById('geom_point').addEventListener('input', function() {
            const status = document.getElementById('coordinate-status');
            if (this.value.trim()) {
                status.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i> Coordinates set';
            } else {
                status.innerHTML = '<i class="fas fa-map-marker-alt"></i> No coordinates set';
            }
        });

        // Reset modal when closed
        document.getElementById('createpointModal').addEventListener('hidden.bs.modal', function() {
            currentStep = 1;
            document.querySelectorAll('.form-step').forEach(step => step.classList.remove('active'));
            document.querySelectorAll('.step').forEach(step => step.classList.remove('active'));
            document.querySelector('.form-step[data-step="1"]').classList.add('active');
            document.querySelector('.step[data-step="1"]').classList.add('active');
            document.querySelector('.progress-fill').style.width = '33.33%';
            updateNavigationButtons();

            // Reset form
            document.getElementById('createPointForm').reset();
            removeImage();
            document.getElementById('char-count').textContent = '0';
            document.getElementById('char-count').style.color = '#6c757d';

             // Tambahkan ini untuk reload halaman
    location.reload();
        });
    </script>

    <!-- Modal Create Polyline-->
    <div class="modal fade" id="createpolylineModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polyline</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('polylines.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polyline" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polyline" name="geom_polyline" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polyline" name="image"
                                onchange="document.getElementById('preview-image-polyline').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polyline" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygon-->
    <div class="modal fade" id="createpolygonModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Polygon</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="fill point name">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="geom_polygon" class="form-label">Geometry</label>
                            <textarea class="form-control" id="geom_polygon" name="geom_polygon" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Photo</label>
                            <input type="file" class="form-control" id="image_polygon" name="image"
                                onchange="document.getElementById('preview-image-polygon').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" alt="" id="preview-image-polygon" class="img-thumbnail"
                                width="400">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Leaflet Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

<!-- Leaflet Routing Machine JS -->
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <script>
        var map = L.map('map').setView([-7.260342673181978, 110.12307415252009], 11.5);


        // Basemap 1: OpenStreetMap
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Basemap 2: Esri World Imagery
        var esri = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; <a href="https://www.esri.com/">Esri</a> &mdash; Source: Esri, i-cubed, USDA, USGS'
            });


        // Basemap 3: CartoDB Positron
        var carto = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://carto.com/">CARTO</a>'
        });

        var wmsLayer = L.tileLayer.wms("http://localhost:8080/geoserver/responsi_pgwl/wms", {
            layers: 'responsi_pgwl:BATAS_ADMINISTRASI_KECAMATAN',
            format: 'image/png',
            transparent: true,
            version: '1.1.0',
            attribution: "© GeoServer",
            tiled: true, // opsional, untuk tile performance
            crs: L.CRS.EPSG4326 // atau abaikan jika menggunakan default
        }).addTo(map).setOpacity(0.7);





        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: true,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;

            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            // data yang dihasilkan strukturnya berupa GeoJSOn
            console.log(drawnJSONObject);
            // console.log(objectGeometry);

            // berupa permisalan : jika,

            if (type === 'polyline') {
                console.log("Create " + type);

                $('#geom_polyline').val(objectGeometry)

                //Memunculkan modal untuk create polyline
                $('#createpolylineModal').modal('show');


            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);


                $('#geom_polygon').val(objectGeometry)
                //Memunculkan modal untuk create polygon
                $('#createpolygonModal').modal('show');



                //memunculkan modal create point


            } else if (type === 'marker') {
                console.log("Create " + type);

                $('#geom_point').val(objectGeometry)

                //Memunculkan modal untuk create marker
                $('#createpointModal').modal('show');

            } else {
                console.log('undefined');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON Points with Enhanced Popup Styling and Custom Icon
        var point = L.geoJson(null, {
            pointToLayer: function(feature, latlng) {
                // Custom icon menggunakan Font Awesome
                var customIcon = L.divIcon({
                    className: 'custom-marker',
                    html: '<i class="fa-solid fa-location-dot fa-2x" style="color: #	#5ac8fa; text-shadow: 0 0 10px #	#5ac8fa, 0 0 20px #	#5ac8fa, 0 0 30px #	#5ac8fa;"></i>',
                    iconSize: [30, 30],
                    iconAnchor: [15, 30],
                    popupAnchor: [0, -30]
                });
                return L.marker(latlng, {
                    icon: customIcon
                });
            },
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('points.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                // Debug: cek data yang tersedia
                console.log('Feature properties:', feature.properties);

                var popupContent = `
                <div class="custom-popup">
                    <!-- Header Section -->
                    <div class="popup-header">
                        <h3 class="popup-title">
                            <i class="fas fa-map-marker-alt"></i>
                            ${feature.properties.name}
                        </h3>
                    </div>

                    <!-- Image Section -->
                    <div class="popup-image">
                        <img src="{{ asset('storage/images/') }}/${feature.properties.image}"
                             alt="${feature.properties.name}"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="no-image" style="display: none;">
                            <i class="fas fa-image"></i>
                            <span>Gambar tidak tersedia</span>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="popup-content">
                        <div class="info-item">
                            <i class="fas fa-info-circle"></i>
                            <div class="info-text">
                                <strong>Deskripsi:</strong>
                                <p style="text-align: justify;">${feature.properties.description.replace(/\n/g, '<br>')}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="info-text">
                                <strong>Dibuat:</strong>
                                <span class="date-text">${feature.properties.created_at}</span>
                            </div>
                        </div>

                        <div class="info-item">
                            <i class="fas fa-user"></i>
                            <div class="info-text">
                                <strong>Dibuat Oleh:</strong>
                                <span class="author-text">${feature.properties.user_created}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="popup-actions">
                        <div class="btn-group">
                            <a href="${routeedit}" class="btn btn-edit">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>

                            <form action="${routedelete}" method="POST" class="delete-form"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">
                                    <i class="fas fa-trash-alt"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <style>
                    .custom-popup {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        max-width: 320px;
                        margin: 0;
                        padding: 0;
                    }

                    .popup-header {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 15px;
                        margin: -20px -20px 15px -20px;
                        border-radius: 8px 8px 0 0;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    }

                    .popup-title {
                        margin: 0;
                        font-size: 18px;
                        font-weight: 600;
                        display: flex;
                        align-items: center;
                        gap: 8px;
                    }

                    .popup-title i {
                        color: #ffd700;
                        font-size: 16px;
                    }

                    .popup-image {
                        margin: 15px -5px;
                        border-radius: 8px;
                        overflow: hidden;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                        position: relative;
                    }

                    .popup-image img {
                        width: 100%;
                        height: 180px;
                        object-fit: cover;
                        display: block;
                        transition: transform 0.3s ease;
                    }

                    .popup-image:hover img {
                        transform: scale(1.05);
                    }

                    .no-image {
                        width: 100%;
                        height: 180px;
                        background: #f8f9fa;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        color: #6c757d;
                        border: 2px dashed #dee2e6;
                    }

                    .no-image i {
                        font-size: 48px;
                        margin-bottom: 10px;
                        opacity: 0.5;
                    }

                    .no-image span {
                        font-size: 14px;
                        font-weight: 500;
                    }

                    .popup-content {
                        padding: 0 5px;
                    }

                    .info-item {
                        display: flex;
                        align-items: flex-start;
                        gap: 12px;
                        margin-bottom: 15px;
                        padding: 10px;
                        background: #f8f9fa;
                        border-radius: 6px;
                        border-left: 3px solid #667eea;
                    }

                    .info-item i {
                        color: #667eea;
                        font-size: 16px;
                        margin-top: 2px;
                        min-width: 16px;
                    }

                    .info-text {
                        flex: 1;
                    }

                    .info-text strong {
                        color: #2c3e50;
                        font-weight: 600;
                        font-size: 13px;
                        text-transform: uppercase;
                        letter-spacing: 0.5px;
                    }

                    .info-text p {
                        margin: 5px 0 0 0;
                        color: #555;
                        line-height: 1.4;
                        font-size: 14px;
                    }

                    .date-text, .author-text {
                        color: #555;
                        font-size: 14px;
                        margin-top: 5px;
                        display: block;
                    }

                    .author-text {
                        font-weight: 500;
                        color: #667eea;
                    }

                    .popup-actions {
                        margin-top: 20px;
                        padding-top: 15px;
                        border-top: 1px solid #e9ecef;
                    }

                    .btn-group {
                        display: flex;
                        gap: 10px;
                        justify-content: center;
                    }

                    .btn {
                        padding: 10px 20px;
                        border: none;
                        border-radius: 6px;
                        font-size: 14px;
                        font-weight: 500;
                        text-decoration: none;
                        display: flex;
                        align-items: center;
                        gap: 6px;
                        cursor: pointer;
                        transition: all 0.2s ease;
                        min-width: 80px;
                        justify-content: center;
                    }

                    .btn-edit {
                        background: linear-gradient(135deg, #28a745, #20c997);
                        color: white;
                        box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);
                    }

                    .btn-edit:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);
                        text-decoration: none;
                        color: white;
                    }

                    .btn-delete {
                        background: linear-gradient(135deg, #dc3545, #c82333);
                        color: white;
                        box-shadow: 0 2px 4px rgba(220, 53, 69, 0.3);
                    }

                    .btn-delete:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.4);
                    }

                    .delete-form {
                        margin: 0;
                        display: inline-block;
                    }

                    /* Custom marker styling */
                    .custom-marker {
                        background: none;
                        border: none;
                        text-align: center;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }

                    .custom-marker i {
                        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                        transition: all 0.2s ease;
                    }

                    .custom-marker:hover i {
                        transform: scale(1.1);
                        filter: brightness(1.2);
                    }

                    /* Responsive adjustments */
                    @media (max-width: 480px) {
                        .custom-popup {
                            max-width: 280px;
                        }

                        .btn-group {
                            flex-direction: column;
                        }

                        .btn {
                            width: 100%;
                        }
                    }

                    /* Animation for popup appearance */
                    .custom-popup {
                        animation: popupFadeIn 0.3s ease-out;
                    }

                    @keyframes popupFadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(-10px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
            `;

                layer.on({
                    click: function(e) {
                        layer.bindPopup(popupContent, {
                            maxWidth: 350,
                            className: 'custom-leaflet-popup'
                        }).openPopup();
                    },
                    mouseover: function(e) {
                        layer.bindTooltip(feature.properties.name, {
                            permanent: false,
                            direction: 'top',
                            className: 'custom-tooltip'
                        });
                    },
                });
            },
        });

        // Custom tooltip styling (add this CSS to your main stylesheet)
        const tooltipStyle = `
        <style>
            .custom-tooltip {
                background: rgba(0, 0, 0, 0.8) !important;
                color: white !important;
                border: none !important;
                border-radius: 4px !important;
                font-weight: 500 !important;
                padding: 8px 12px !important;
                font-size: 13px !important;
            }

            .custom-tooltip:before {
                border-top-color: rgba(0, 0, 0, 0.8) !important;
            }

            .custom-leaflet-popup .leaflet-popup-content-wrapper {
                background: white;
                border-radius: 8px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                padding: 20px;
            }

            .custom-leaflet-popup .leaflet-popup-tip {
                background: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    `;

        // Add the tooltip style to document head
        document.head.insertAdjacentHTML('beforeend', tooltipStyle);




        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polyline
        var polyline = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polylines.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polylines.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Panjang: " + feature.properties.length_km + " km" + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                    "' alt='' width='200px' height='200px'>" +
                    "<br>" +
                    "<div class='row mt-4'>" +
                    "<div class='col-6 text-center'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-center'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    '@csrf' + '@method('DELETE')' +
                    "<button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>" +
                    "</div>" + "<br>" + "<p>Dibuat Oleh: " + feature.properties.user_created + "</p>";
                layer.on({
                    click: function(e) {
                        polyline.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polyline.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polylines') }}", function(data) {
            polyline.addData(data);
            map.addLayer(polyline);
        });

        // GeoJSON Polygon
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {

                var routedelete = "{{ route('polygons.destroy', ':id') }}";
                routedelete = routedelete.replace(':id', feature.properties.id);

                var routeedit = "{{ route('polygons.edit', ':id') }}";
                routeedit = routeedit.replace(':id', feature.properties.id);

                var popupContent = "Nama: " + feature.properties.name + "<br>" +
                    "Deskripsi: " + feature.properties.description + "<br>" +
                    "Luas: " + feature.properties.area_hektar + " ha" + "<br>" +
                    "Dibuat: " + feature.properties.created_at + "<br>" +
                    "<img src='{{ asset('storage/images') }}/" + feature.properties.image +
                    "' alt='' width='200px' height='200px'>" +
                    "<br>" +
                    "<div class='row mt-4'>" +
                    "<div class='col-6 text-center'>" +
                    "<a href='" + routeedit +
                    "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i></a>" +
                    "</div>" +
                    "<div class='col-6 text-center'>" +
                    "<form method='POST' action='" + routedelete + "'>" +
                    '@csrf' + '@method('DELETE')' +
                    "<button type='submit' class='btn btn-sm btn-danger' onclick='return confirm(`Yakin akan dihapus?`)'><i class='fa-solid fa-trash-can'></i></button>" +
                    "</form>" +
                    "</div>" + "<br>" + "<p>Dibuat Oleh: " + feature.properties.user_created + "</p>";

                layer.on({
                    click: function(e) {
                        polygon.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        polygon.bindTooltip(feature.properties.name);
                    },
                });
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

       // Definisikan baseMaps dan overlayMaps
var baseMaps = {
    "OpenStreetMap": osm,
    "Esri World Imagery": esri,
    "CartoDB Positron": carto
};

var overlayMaps = {
    "Points": point,
    
    "Batas Kecamatan (WMS)": wmsLayer // tambahkan WMS ke overlay
};

// Tambahkan layer control ke peta
L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

// Simpan lokasi awal dan marker lokasi pengguna secara global
const defaultCenter = [-7.284655561071246, 110.10533067375863];
const defaultZoom = 11.5;
let userMarker = null;
let userLatLng = null; // simpan lokasi user secara global
let routingControl = null;

// Tambahkan kontrol lokasi dan reset
L.Control.MyLocation = L.Control.extend({
    onAdd: function(map) {
        const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control leaflet-control-custom');

        // Tombol Lokasi Saya
        const locateBtn = L.DomUtil.create('button', '', container);
        locateBtn.innerHTML = '📍';
        locateBtn.title = 'Temukan Lokasi Saya';
        locateBtn.style.margin = '2px';
        locateBtn.onclick = function() {
            map.locate({ setView: true, maxZoom: 20 });
        };

        // Tombol Reset ke Titik Awal
        const resetBtn = L.DomUtil.create('button', '', container);
        resetBtn.innerHTML = '🔁';
        resetBtn.title = 'Kembali ke Titik Awal';
        resetBtn.style.margin = '2px';
        resetBtn.onclick = function() {
            map.setView(defaultCenter, defaultZoom);
        };

        return container;
    },
    onRemove: function(map) {}
});

// Fungsi untuk menampilkan marker lokasi pengguna
map.on('locationfound', function(e) {
    userLatLng = e.latlng; // simpan lokasi user

    if (userMarker) {
        map.removeLayer(userMarker);
    }

    const icon = L.divIcon({
        className: 'custom-user-marker',
        html: '<i class="fa-solid fa-map-marker-alt fa-3x" style="color: #667eea; text-shadow: 2px 2px 0px #fff, -2px -2px 0px #fff, 2px -2px 0px #fff, -2px 2px 0px #fff, 0px 2px 0px #fff, 2px 0px 0px #fff, 0px -2px 0px #fff, -2px 0px 0px #fff, 2px 2px 5px rgba(0,0,0,0.5);"></i>',
        iconSize: [50, 68],
        iconAnchor: [25, 68],
        popupAnchor: [0, -50]
    });

    userMarker = L.marker(e.latlng, { icon }).addTo(map)
        .bindPopup(`<b>Lokasi Anda</b><br>Lat: ${e.latlng.lat.toFixed(5)}<br>Lng: ${e.latlng.lng.toFixed(5)}`)
        .openPopup();

    // Tambahkan lingkaran akurasi
    L.circle(e.latlng, {
        radius: 10000,
        color: '#667eea',
        fillColor: '#667eea',
        fillOpacity: 0.1
    }).addTo(map);
});

// Penanganan error lokasi
map.on('locationerror', function() {
    alert("Gagal menemukan lokasi. Pastikan Anda mengaktifkan izin lokasi di browser.");
});

// Tambahkan tombol kontrol ke peta
L.control.myLocation = function(opts) {
    return new L.Control.MyLocation(opts);
};
L.control.myLocation({ position: 'topleft' }).addTo(map);

// Fungsi untuk menampilkan rute ke tujuan dari lokasi pengguna
function tampilkanRute(tujuanLatLng) {
    if (!userLatLng) {
        alert("Lokasi Anda belum ditemukan. Klik tombol 📍 terlebih dahulu.");
        return;
    }

    // Hapus routing lama jika ada
    if (routingControl) {
        map.removeControl(routingControl);
    }

    // Tambahkan routing baru
    routingControl = L.Routing.control({
        waypoints: [
            userLatLng,
            tujuanLatLng
        ],
        routeWhileDragging: false,
        show: false,
        addWaypoints: false,
        draggableWaypoints: false,
        createMarker: function () { return null; }
    }).addTo(map);

    routingControl.on('routesfound', function(e) {
        const route = e.routes[0];
        const distance = route.summary.totalDistance / 1000;
        const time = route.summary.totalTime / 60;
        alert(`Jarak: ${distance.toFixed(2)} km\nWaktu tempuh: ${time.toFixed(0)} menit`);
    });
}

// Saat dropdown diubah, tampilkan rute ke tujuan yang dipilih
document.getElementById('pilihTujuan').addEventListener('change', function() {
    const [lat, lng] = this.value.split(',');
    const tujuanLatLng = L.latLng(parseFloat(lat), parseFloat(lng));
    tampilkanRute(tujuanLatLng);
});

// Setelah titik baru ditambahkan
document.getElementById('createPointForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah pengiriman form default
    // Lakukan AJAX untuk menyimpan titik baru
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(response) {
            // Jika berhasil, ambil data terbaru
            $.getJSON("{{ route('api.points') }}", function(data) {
                point.clearLayers(); // Hapus layer lama
                point.addData(data); // Tambahkan data baru
                map.addLayer(point); // Tambahkan layer ke peta
            });
            $('#createpointModal').modal('hide'); // Tutup modal
        },
        error: function() {
            alert('Gagal menambahkan titik baru.');
        }
    });
});



    @endsection
