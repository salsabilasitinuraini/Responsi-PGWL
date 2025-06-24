@extends('layout.template')

@section('content')
<div class="container mt-4 mb-4">
    <!-- Data Points Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #4c1d95 0%, #6366f1 50%, #8b5cf6 100%);">
            <h4 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Data Points</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="pointsTable">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center" style="width: 220px;">Image</th>
                            <!-- <th>Created By</th> -->
                            <th class="text-center" style="width: 140px;">Created At</th>
                            <th class="text-center" style="width: 140px;">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $index => $point)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $point->name }}</td>
                            <td class="text-muted">{{ $point->description }}</td>
                            <td class="text-center">
                                <img src="{{ asset('storage/images/' . $point->image) }}"
                                     alt="{{ $point->name }}"
                                     class="img-thumbnail shadow-sm"
                                     width="200"
                                     title="{{ $point->image }}"
                                     style="max-height: 120px; object-fit: cover;">
                            </td>
                            <!-- <td>
                                <span class="badge bg-info text-dark">{{ $point->user_created }}</span>
                            </td> -->
                            <td class="text-center text-muted small">
                                {{ \Carbon\Carbon::parse($point->created_at)->format('d M Y') }}<br>
                                <small>{{ \Carbon\Carbon::parse($point->created_at)->format('H:i') }}</small>
                            </td>
                            <td class="text-center text-muted small">
                                {{ \Carbon\Carbon::parse($point->updated_at)->format('d M Y') }}<br>
                                <small>{{ \Carbon\Carbon::parse($point->updated_at)->format('H:i') }}</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    .card-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 1rem 0.75rem;
    }

    .table td {
        padding: 1rem 0.75rem;
        vertical-align: middle;
        border-color: #f8f9fa;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
        transition: all 0.2s ease;
    }

    .img-thumbnail {
        border-radius: 8px;
        transition: transform 0.2s ease;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        border-radius: 20px;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    /* DataTables Custom Styling */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 6px;
        margin: 0 2px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        border-color: #6366f1;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
        border-color: #8b5cf6;
        color: white !important;
    }

    .dataTables_wrapper .dataTables_filter input {
        border-radius: 20px;
        border: 1px solid #dee2e6;
        padding: 0.5rem 1rem;
    }

    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 0.375rem 0.75rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTables with custom options
        const tableOptions = {
            "pageLength": 10,
            "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
            "responsive": true,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                },
                "emptyTable": "Tidak ada data yang tersedia",
                "zeroRecords": "Tidak ditemukan data yang sesuai"
            }
        };

        let tablepoints = new DataTable('#pointsTable', tableOptions);
        let tablepolylines = new DataTable('#polylinesTable', tableOptions);
        let tablepolygons = new DataTable('#polygonsTable', tableOptions);
    });
</script>
@endsection
