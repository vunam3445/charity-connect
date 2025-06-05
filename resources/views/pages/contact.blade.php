@extends('layouts.master')

@section('title', 'Liên hệ - HUCE Charity')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="contact-hero" style="background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%); padding: 80px 0; border-radius: 15px; color: white; text-align: center;">
                <h1 class="display-4 font-weight-bold mb-4">
                    <i class="fas fa-envelope"></i>
                    Liên hệ với chúng tôi
                </h1>
                <p class="lead">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-lg-8 mb-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <h3 class="mb-4">
                        <i class="fas fa-paper-plane text-primary"></i>
                        Gửi tin nhắn cho chúng tôi
                    </h3>
                    
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Họ và tên *</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="subject" class="form-label">Chủ đề *</label>
                                <select class="form-control" id="subject" required>
                                    <option value="">Chọn chủ đề</option>
                                    <option value="general">Tư vấn chung</option>
                                    <option value="volunteer">Đăng ký tình nguyện viên</option>
                                    <option value="organization">Đăng ký tổ chức</option>
                                    <option value="event">Hỏi về sự kiện</option>
                                    <option value="support">Hỗ trợ kỹ thuật</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Nội dung tin nhắn *</label>
                            <textarea class="form-control" id="message" rows="6" required placeholder="Nhập nội dung tin nhắn của bạn..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane"></i>
                            Gửi tin nhắn
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="col-lg-4 mb-5">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h4 class="mb-4">
                        <i class="fas fa-info-circle text-success"></i>
                        Thông tin liên hệ
                    </h4>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-map-marker-alt text-danger mt-1 mr-3"></i>
                            <div>
                                <h6>Địa chỉ</h6>
                                <p class="text-muted mb-0">Đại học Xây dựng Hà Nội<br>Km10, Đại lộ Thăng Long<br>Quận Nam Từ Liêm, Hà Nội</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-phone text-success mt-1 mr-3"></i>
                            <div>
                                <h6>Điện thoại</h6>
                                <p class="text-muted mb-0">+84 24 3768 6281</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-envelope text-primary mt-1 mr-3"></i>
                            <div>
                                <h6>Email</h6>
                                <p class="text-muted mb-0">contact@hucecharity.edu.vn</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-item mb-3">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-clock text-warning mt-1 mr-3"></i>
                            <div>
                                <h6>Giờ làm việc</h6>
                                <p class="text-muted mb-0">Thứ 2 - Thứ 6: 8:00 - 17:00<br>Thứ 7: 8:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FAQ Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="mb-3">
                        <i class="fas fa-question-circle text-info"></i>
                        Câu hỏi thường gặp
                    </h5>
                    <div class="accordion" id="faqAccordion">
                        <div class="card border-0 mb-2">
                            <div class="card-header p-0 border-0">
                                <button class="btn btn-link text-left w-100 p-3" type="button" data-toggle="collapse" data-target="#faq1">
                                    <small><strong>Làm sao để đăng ký tình nguyện viên?</strong></small>
                                </button>
                            </div>
                            <div id="faq1" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body p-3 pt-0">
                                    <small class="text-muted">Bạn có thể đăng ký tài khoản tình nguyện viên trực tiếp trên website của chúng tôi.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0 mb-2">
                            <div class="card-header p-0 border-0">
                                <button class="btn btn-link text-left w-100 p-3" type="button" data-toggle="collapse" data-target="#faq2">
                                    <small><strong>Tổ chức có thể đăng ký như thế nào?</strong></small>
                                </button>
                            </div>
                            <div id="faq2" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body p-3 pt-0">
                                    <small class="text-muted">Tổ chức cần đăng ký và chờ admin phê duyệt trước khi có thể tạo sự kiện.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card border-0">
                            <div class="card-header p-0 border-0">
                                <button class="btn btn-link text-left w-100 p-3" type="button" data-toggle="collapse" data-target="#faq3">
                                    <small><strong>Chi phí sử dụng dịch vụ?</strong></small>
                                </button>
                            </div>
                            <div id="faq3" class="collapse" data-parent="#faqAccordion">
                                <div class="card-body p-3 pt-0">
                                    <small class="text-muted">Tất cả các dịch vụ trên nền tảng đều hoàn toàn miễn phí.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    <div class="map-container" style="height: 400px; border-radius: 8px; overflow: hidden;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863855929338!2d105.73253731476331!3d21.040132985995754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313455e940879933%3A0x91b2b72c8db84e5!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBYw6J5IGThu7FuZyBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1647000000000!5m2!1svi!2s" 
                            width="100%" 
                            height="400" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form data
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const subject = document.getElementById('subject').value;
    const message = document.getElementById('message').value;
    
    // Simple validation
    if (!name || !email || !subject || !message) {
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Vui lòng điền đầy đủ các trường bắt buộc.'
        });
        return;
    }
    
    // Show success message (in real application, you would send this to a server)
    Swal.fire({
        icon: 'success',
        title: 'Gửi thành công!',
        text: 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi trong thời gian sớm nhất.',
        confirmButtonText: 'OK'
    }).then(() => {
        // Reset form
        document.getElementById('contactForm').reset();
    });
});
</script>

<style>
.contact-item {
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.contact-item:last-child {
    border-bottom: none;
}

.contact-item h6 {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.form-control:focus {
    border-color: #ff7e5f;
    box-shadow: 0 0 0 0.2rem rgba(255, 126, 95, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%);
    border: none;
    transition: transform 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 126, 95, 0.4);
}

.accordion .btn-link {
    color: #333;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s ease;
}

.accordion .btn-link:hover {
    background-color: #f8f9fa;
    text-decoration: none;
    color: #333;
}

.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .contact-hero {
        padding: 40px 20px !important;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .map-container {
        height: 300px !important;
    }
}
</style>
@endsection
