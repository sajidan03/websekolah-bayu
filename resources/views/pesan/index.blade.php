@extends('layouts.app')

@section('content')
<style>
    /* Page Background with Gradient */
    .page-background {
        min-height: calc(100vh - 200px);
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 60px 20px;
        position: relative;
        overflow: hidden;
    }

    /* Decorative Circles */
    .page-background::before,
    .page-background::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
    }

    .page-background::before {
        width: 300px;
        height: 300px;
        top: -100px;
        left: -100px;
    }

    .page-background::after {
        width: 200px;
        height: 200px;
        bottom: -50px;
        right: -50px;
    }

    /* Main Card */
    .message-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        animation: slideUp 0.8s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Card Header */
    .card-header-section {
        background: linear-gradient(135deg, #71799d 0%, #443653 100%);
        padding: 40px 40px 60px;
        text-align: center;
        position: relative;
    }

    .card-header-section::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 8px;
        transform: translateX(-50%) rotate(45deg);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .header-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        }
        50% {
            transform: scale(1.05);
            box-shadow: 0 0 0 15px rgba(255, 255, 255, 0);
        }
    }

    .header-icon i {
        font-size: 36px;
        color: white;
    }

    .card-header-section h2 {
        color: white;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .card-header-section p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
    }

    /* Card Body */
    .card-body-section {
        padding: 50px 40px;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-label .required {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f9fafb;
    }

    .form-control:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: #9ca3af;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 140px;
    }

    /* Input Focus Animation */
    .form-group:focus-within .form-label {
        color: #667eea;
    }

    /* Checkbox Style */
    .form-check-custom {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        background: #f9fafb;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .form-check-custom:hover {
        background: #f3f4f6;
    }

    .form-check-custom input {
        width: 20px;
        height: 20px;
        accent-color: #667eea;
        cursor: pointer;
    }

    .form-check-custom label {
        margin-left: 12px;
        color: #6b7280;
        cursor: pointer;
        font-size: 0.9rem;
    }

    /* Submit Button */
    .btn-submit {
        width: 100%;
        padding: 16px 32px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .btn-submit i {
        margin-right: 8px;
    }

    /* Privacy Note */
    .privacy-note {
        text-align: center;
        margin-top: 20px;
        color: #9ca3af;
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .privacy-note i {
        color: #667eea;
    }

    /* Success Message Animation */
    .success-message {
        display: none;
        text-align: center;
        padding: 40px;
    }

    .success-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        animation: successPop 0.5s ease-out;
    }

    @keyframes successPop {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }

    .success-icon i {
        font-size: 50px;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-background {
            padding: 30px 15px;
        }

        .card-header-section {
            padding: 30px 25px 50px;
        }

        .card-header-section h2 {
            font-size: 1.5rem;
        }

        .card-body-section {
            padding: 30px 25px;
        }

        .header-icon {
            width: 60px;
            height: 60px;
        }

        .header-icon i {
            font-size: 28px;
        }
    }

    /* Floating Animation for Icon */
    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .header-icon {
        animation: float 3s ease-in-out infinite;
    }
</style>

<section class="page-background">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                
                <div class="message-card">
                    <!-- Header Section -->
                    <div class="card-header-section">
                        <div class="header-icon">
                            <i class="bi bi-envelope-paper-heart-fill"></i>
                        </div>
                        <h2>Kotak Saran</h2>
                        <p>
                            Kami menghargai setiap masukan dari Anda. 
                            Silakan sampaikan saran, kritik, atau pertanyaan melalui formulir berikut.
                        </p>
                    </div>

                    <!-- Body Section -->
                    <div class="card-body-section">
                        <form action="" method="POST">
                            @csrf

                            <!-- Message Field -->
                            <div class="form-group">
                                <label class="form-label">
                                    Pesan atau Komentar <span class="required">*</span>
                                </label>
                                <textarea 
                                    name="comment" 
                                    class="form-control" 
                                    rows="5"
                                    placeholder="Tuliskan pesan atau saran Anda..."
                                    maxlength="65525"
                                    required>
                                </textarea>
                            </div>

                            <!-- Name and Email Row -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Nama Lengkap <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="text"
                                            name="author"
                                            class="form-control"
                                            placeholder="Masukkan nama lengkap"
                                            maxlength="245"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="form-group">
                                        <label class="form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            placeholder="Masukkan alamat email"
                                            maxlength="100"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkbox -->
                            <div class="form-group">
                                <div class="form-check-custom">
                                    <input class="form-check-input" type="checkbox" id="save-info" name="save-info" checked>
                                    <label class="form-check-label" for="save-info">
                                        Simpan nama dan email saya untuk pengisian berikutnya.
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mb-0">
                                <button type="submit" class="btn-submit">
                                    <i class="bi bi-send-fill"></i>
                                    Kirim Saran
                                </button>
                            </div>

                            <!-- Privacy Note -->
                            <div class="privacy-note">
                                <i class="bi bi-shield-lock-fill"></i>
                                <span>Informasi yang Anda kirimkan akan dijaga kerahasiaannya.</span>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
