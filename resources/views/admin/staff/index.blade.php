@extends('layouts.dashboard')
@section('title', 'Staff List')
@section('meta_description', 'System user list.')
@section('content')

<div class="d-flex gap-2 flex-column flex-md-row justify-content-between py-3 bg-light card-header" style="position: sticky; top: 0; z-index: 100;">
	<a href="{{route('dashboard')}}" class="JewelleryPrimaryButton">
							<i class="fas fa-arrow-left mr-2"></i> Back to Menu
						</a>
            <div class=" mb-2 mb-md-0 p-0">
                <h6 class="h2 mb-0 text-gray-800">STAFF</h6>
            </div>
            <div class=" d-flex gap-2 justify-content-md-end p-0">
				
                <a href="{{route('staff.create')}}"><button class="JewelleryPrimaryButton"><i class="bi bi-person-fill-add"></i>
                        Add Staff
                    </button></a>
            </div>
        
	
	</div>

<div class="container-fluid">
    <div class="row m-0 p-0">
                    
                    <!-- <div class="col-lg-6 col-md-6 col-sm-12 card shadow">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>   -->
                    </div>  

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
            
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <!-- DataTales Example -->
                    <div class="card my-4">
                   
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background-color:#df9700; color:#fff">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($Users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->name}}</td>
                                            <td><a class="text-decoration-none text-info" href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                            <td>{{$user->user_type}}</td>
                                            <td>
                                            <a href="{{ route('staff.edit', $user->id) }}" class="btn btn-info m-1"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ route('staff.destroy', $user->id) }}" method="POST"
                                                 style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this Staff?   ')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger m-1"><i class="bi bi-trash3"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- /.container-fluid -->

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ensure the document is fully loaded before executing the script
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById("myPieChart");

        // Data passed from Laravel
        var chartData = @json($chartData);

        // Check the structure of chartData in the console
        console.log(chartData);

        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartData.labels, // Categories or types
                datasets: [{
                    data: chartData.data, // Corresponding data
                    backgroundColor: [
                        '#4e73df', // Primary color
                        '#1cc88a', // Success color
                        '#36b9cc', // Info color
                        '#e74a3b', // Danger color
                        '#f6c23e'  // Warning color
                    ],
                    hoverBackgroundColor: [
                        '#2e59d9', // Darker primary color
                        '#17a673', // Darker success color
                        '#2c9faf', // Darker info color
                        '#d63f2a', // Darker danger color
                        '#f2b82e'  // Darker warning color
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                    },
                },
                cutoutPercentage: 80,
            },
        });
    });
</script>
@endsection