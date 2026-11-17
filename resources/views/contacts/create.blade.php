@extends('layouts.web')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 0;
    }

    .contact-container {
        max-width: 1200px;
        margin: auto;
        padding: 60px 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-header h2 {
        font-size: 36px;
        color: #1f2937;
    }

    .section-header p {
        color: #6b7280;
        font-size: 16px;
        max-width: 600px;
        margin: 20px auto 0;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .info-box, .form-box {
        background-color: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 25px;
    }

    .info-item i {
        font-size: 24px;
        color: #2563eb;
        margin-right: 16px;
    }

    .info-item h4 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #1f2937;
    }

    .info-item p {
        margin: 0;
        color: #4b5563;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 500;
        margin-bottom: 6px;
        color: #374151;
    }

    .form-group input, .form-group textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-group textarea {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        background-color: #2563eb;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #1e40af;
    }

    @media (max-width: 768px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@if(session('success'))
    <div class="mb-6">
        <div class="flex items-center bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg p-4" role="alert">
            <svg class="w-5 h-5 mr-2 flex-shrink-0 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 10-1.414 1.414L9 13.414l4.707-4.707z" clip-rule="evenodd" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif


<div class="contact-container">
    <div class="section-header">
        <h2>Contact Us</h2>
        <p>Have a question or need help? Our team is here to assist you. Reach out anytime!</p>
    </div>

    <div class="grid">
        <!-- Contact Info -->
        <div class="info-box">
            <div class="info-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                    <h4>Our Address</h4>
                    <p>{{$setting->address}}</p>
                </div>
            </div>

            <div class="info-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <h4>Email</h4>
                    <p>{{$setting->business_email}}</p>
                </div>
            </div>

            <div class="info-item">
                <i class="fas fa-phone-alt"></i>
                <div>
                    <h4>Phone</h4>
                    <p>{{$setting->phone}}</p>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="form-box">
            <form method="POST" action="{{ route('contacts.store') }}">
                @csrf

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" name="phone_number" id="phone_number" required>
                </div>

                <div class="form-group">
                    <label for="present_address">Present Address</label>
                    <input type="text" name="present_address" id="present_address">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" required></textarea>
                </div>

                <div>
                    <button type="submit" class="btn-submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
