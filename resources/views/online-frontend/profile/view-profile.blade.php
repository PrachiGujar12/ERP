<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .profile-header {
        background: #f8f9fa;
        padding: 2rem 0;
    }

    .profile-header .avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 3px solid #6c757d;
        object-fit: cover;
    }

    .profile-info {
        margin-top: 1rem;
    }

    .profile-info h2 {
        margin: 0;
    }

    .profile-info p {
        margin: 0;
        color: #6c757d;
    }

    .profile-section {
        margin-top: 2rem;
    }

    .profile-card {
        border-radius: 0.5rem;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a href="{{ url('home') }}" class="navbar-brand">
                <img src="{{ asset('asset/images/logo/Raman-Jewellers-Logo-A.png') }}" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('customer.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="profile-header text-center">
        <img src="https://via.placeholder.com/120" alt="Profile Avatar" class="avatar">
        <div class="profile-info">
            <h2>{{ Auth::guard('online-customer')->user()->first_name }}
                {{ Auth::guard('online-customer')->user()->last_name }}</h2>
            <p>{{ Auth::guard('online-customer')->user()->email }}</p>
        </div>
    </div>

    <div class="container profile-section">
        <div class="row">
            <div class="col-md-6">
                <div class="card profile-card p-3 shadow-sm">
                    <h5>Contact Information</h5>
                    <p><strong>Phone:</strong> {{ Auth::guard('online-customer')->user()->mobile_no }}</p>
                    <p><strong>Email:</strong> {{ Auth::guard('online-customer')->user()->email }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card profile-card p-3 shadow-sm">
                    <h5>Address</h5>
                    @if (empty(Auth::guard('online-customer')->user()->address))
                    <p>No address found. <a href="#" data-bs-toggle="modal" data-bs-target="#addAddressModal">Add
                            Address</a></p>
                    @else
                    <p>{{ Auth::guard('online-customer')->user()->address }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container profile-section">

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card profile-card p-3 shadow-sm">
                    <h5>Order History</h5>
                    <p>No recent orders.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card profile-card p-3 shadow-sm">
                    <h5>Account Settings</h5>
               
                    <a href="{{ route('edit-customer-profile', Auth::guard('online-customer')->user()->online_customer_id) }}" 
                    class="btn btn-primary btn-sm mt-2">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('customer.addAddress') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAddressModalLabel">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Address</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>