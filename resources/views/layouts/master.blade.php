<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HUCE Charity')</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/result-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles từ view con -->
    @yield('styles')

    <!-- CSS cho Modal -->
    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            overflow-y: auto;
        }

        .modal-content {
            background-color: white;
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            padding: 20px;
            max-height: 90vh;
            overflow-y: auto;
            z-index: 10001;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .modal-close {
            background: transparent;
            border: none;
            font-size: 22px;
            cursor: pointer;
            color: #333;
        }

        .modal-close:hover {
            color: #007bff;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        .form-control:invalid.was-validated {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            display: none;
        }

        .was-validated .form-control:invalid~.invalid-feedback {
            display: block;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            padding: 10px 15px;
            border-radius: 4px;
            border: none;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-outline {
            background-color: white;
            color: #007bff;
            border: 1px solid #007bff;
        }

        .btn-outline:hover {
            background-color: #f9f9f9;
        }

        /* Notification Dropdown Styles */
        .dropdown-noti-floating {
            position: fixed;
            top: 60px;
            right: 100px;
            width: 360px;
            background: white;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 9999;
            padding: 10px 0;
            display: none;
        }

        .dropdown-noti-header,
        .dropdown-noti-footer {
            padding: 10px 15px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-noti-body {
            max-height: 400px;
            overflow-y: auto;
        }

        .dropdown-noti-item {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .dropdown-noti-item:hover {
            background-color: #f0f8ff;
        }

        .dropdown-noti-title {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
            color: #333;
        }

        .dropdown-noti-meta {
            font-size: 12px;
            color: #888;
        }

        .dropdown-noti-content {
            font-size: 14px;
            color: #555;
            margin-top: 4px;
            white-space: normal;
            text-align: left;
            line-height: 1.4;
            display: none;
        }

        .dropdown-noti-empty {
            padding: 10px 15px;
            text-align: center;
            font-style: italic;
            color: #888;
        }

        .dropdown-noti-item.unread {
            border-left: 4px solid #8aace2;
            background-color: #fff8e9;
        }

        .dropdown-noti-item.read {
            border-left: 4px solid transparent;
            opacity: 0.8;
        }

        /* Footer Styles */
        .main-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: #ecf0f1;
            margin-top: 50px;
            position: relative;
            overflow: hidden;
        }

        .main-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #e74c3c, #f39c12, #f1c40f, #27ae60, #3498db, #9b59b6);
        }

        .footer-content {
            padding: 60px 0 40px;
            position: relative;
        }

        .footer-section {
            height: 100%;
        }

        .footer-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #ffffff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-subtitle {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #ffffff;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-subtitle::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #e74c3c, #f39c12);
            border-radius: 2px;
        }

        .footer-text {
            color: #bdc3c7;
            line-height: 1.7;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            position: relative;
            padding-left: 15px;
        }

        .footer-links a::before {
            content: '▶';
            position: absolute;
            left: 0;
            color: #e74c3c;
            font-size: 10px;
            transition: all 0.3s ease;
        }

        .footer-links a:hover {
            color: #ffffff;
            padding-left: 20px;
        }

        .footer-links a:hover::before {
            color: #f39c12;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: scale(0);
        }

        .social-link.facebook::before {
            background: #3b5998;
        }

        .social-link.twitter::before {
            background: #1da1f2;
        }

        .social-link.instagram::before {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
        }

        .social-link.youtube::before {
            background: #ff0000;
        }

        .social-link:hover::before {
            transform: scale(1);
        }

        .social-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .social-link i {
            position: relative;
            z-index: 2;
            font-size: 18px;
        }

        .contact-info {
            margin-top: 10px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            color: #bdc3c7;
            font-size: 15px;
        }

        .contact-item i {
            color: #e74c3c;
            margin-right: 12px;
            margin-top: 3px;
            font-size: 16px;
            width: 20px;
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 25px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .copyright {
            margin: 0;
            color: #bdc3c7;
            font-size: 14px;
        }

        .footer-bottom-links {
            display: flex;
            gap: 20px;
            justify-content: flex-end;
        }

        .footer-bottom-links a {
            color: #bdc3c7;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-bottom-links a:hover {
            color: #ffffff;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-content {
                padding: 40px 0 30px;
            }
            
            .footer-title {
                font-size: 20px;
            }
            
            .footer-subtitle {
                font-size: 16px;
            }
            
            .social-links {
                justify-content: center;
                margin-top: 30px;
            }
            
            .footer-bottom-links {
                justify-content: center;
                margin-top: 15px;
                flex-wrap: wrap;
            }
            
            .copyright {
                text-align: center;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('partials.header')

        <!-- Content Wrapper -->
        <div class="container-fluid mt-3">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="footer-content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- About Section -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="footer-section">
                                <h4 class="footer-title">
                                    <i class="fas fa-heart text-danger"></i>
                                    HUCE Charity
                                </h4>
                                <p class="footer-text">
                                    Kết nối những trái tim nhân ái, xây dựng cộng đồng tương trợ. 
                                    Cùng nhau tạo nên những thay đổi tích cực cho xã hội.
                                </p>
                                <div class="social-links">
                                    <a href="#" class="social-link facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="social-link twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="social-link instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" class="social-link youtube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div class="col-lg-2 col-md-6 mb-4">
                            <div class="footer-section">
                                <h5 class="footer-subtitle">Liên kết nhanh</h5>
                                <ul class="footer-links">
                                    <li><a href="{{ route('home') }}">Trang chủ</a></li>
                                    <li><a href="/events/approved">Sự kiện</a></li>
                                    <li><a href="{{ route('result.index') }}">Kết quả</a></li>
                                    <li><a href="/about">Giới thiệu</a></li>
                                    <li><a href="/contact">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Services -->
                        <div class="col-lg-2 col-md-6 mb-4">
                            <div class="footer-section">
                                <h5 class="footer-subtitle">Dịch vụ</h5>
                                <ul class="footer-links">
                                    <li><a href="#">Tình nguyện viên</a></li>
                                    <li><a href="#">Tổ chức từ thiện</a></li>
                                    <li><a href="#">Quyên góp</a></li>
                                    <li><a href="#">Hỗ trợ cộng đồng</a></li>
                                    <li><a href="#">Tư vấn miễn phí</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="footer-section">
                                <h5 class="footer-subtitle">Thông tin liên hệ</h5>
                                <div class="contact-info">
                                    <div class="contact-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>Đại học Xây dựng Hà Nội, Km10, Đại lộ Thăng Long, Hà Nội</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-phone"></i>
                                        <span>+84 24 3768 6281</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-envelope"></i>
                                        <span>contact@hucecharity.edu.vn</span>
                                    </div>
                                    <div class="contact-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Thứ 2 - Thứ 6: 8:00 - 17:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="copyright">
                                &copy; {{ date('Y') }} HUCE Charity. Bản quyền thuộc về Đại học Xây dựng Hà Nội.
                            </p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <div class="footer-bottom-links">
                                <a href="#">Chính sách bảo mật</a>
                                <a href="#">Điều khoản sử dụng</a>
                                <a href="#">Sitemap</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Notification Dropdown -->
        <div id="notificationDropdown" class="dropdown-noti-floating" style="display: none;">
            <div class="dropdown-noti-header">
                <span>Thông báo</span>
                <a href="#" id="markAllRead" style="font-size: 13px; color: orangered;">Đánh dấu đã đọc</a>
            </div>
            <div class="dropdown-noti-body">
                @forelse ($topNotifications as $noti)
                    <div class="dropdown-noti-item {{ $noti->is_read ? 'read' : 'unread' }}"
                        data-id="{{ $noti->type === 'personal' ? $noti->notification_id : $noti->notification_id }}"
                        data-type="{{ $noti->type }}">
                        <div class="dropdown-noti-title">{{ $noti->title }}</div>
                        <div class="dropdown-noti-meta">
                            Gửi từ: {{ !empty($noti->event_id) ? 'Sự kiện' : 'Hệ thống' }}   |
                            {{ \Carbon\Carbon::parse($noti->created_at)->diffForHumans() }}
                        </div>
                        <div class="dropdown-noti-content" style="display: none;">
                            {{ $noti->content }}
                        </div>
                    </div>
                @empty
                    <div class="dropdown-noti-empty">Bạn không có thông báo nào</div>
                @endforelse
            </div>
            <div class="dropdown-noti-footer">
                <a
                    href="{{ auth('volunteer')->check() ? route('notifications.received') : route('notifications.organization.received') }}">Xem
                    toàn bộ</a>
            </div>
        </div>

        <!-- Event Modal -->
        @if (auth('organization')->check())
            <div class="modal" id="eventModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"><i class="fas fa-plus-circle"></i> Tạo chiến dịch mới</h3>
                        <button class="modal-close" data-dismiss="modal">×</button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data"
                            id="eventForm" class="needs-validation" novalidate>
                            @csrf
                            <!-- Thêm hidden input để debug organization_id -->
                            <input type="hidden" name="organization_id"
                                value="{{ auth('organization')->user()->organization_id ?? '' }}">
                            <div class="form-group">
                                <label class="form-label" for="event_name">Tên chiến dịch</label>
                                <input type="text" id="event_name" name="name" class="form-control" required
                                    placeholder="Nhập tên chiến dịch">
                                <div class="invalid-feedback">Vui lòng nhập tên chiến dịch.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="event_description">Mô tả</label>
                                <textarea id="event_description" name="description" class="form-control" required placeholder="Nhập mô tả"></textarea>
                                <div class="invalid-feedback">Vui lòng nhập mô tả.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="start_date">Ngày bắt đầu</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                                <div class="invalid-feedback">Vui lòng chọn ngày bắt đầu.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="end_date">Ngày kết thúc</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="event_location">Địa điểm</label>
                                <input type="text" id="event_location" name="location" class="form-control" required
                                    placeholder="Nhập địa điểm">
                                <div class="invalid-feedback">Vui lòng nhập địa điểm.</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="min_quantity">Số lượng tối thiểu</label>
                                <input type="number" id="min_quantity" name="min_quantity" class="form-control"
                                    required min="1" placeholder="Nhập số lượng tối thiểu">
                                <div class="invalid-feedback">Vui lòng nhập số lượng tối thiểu (>= 1).</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="max_quantity">Số lượng tối đa</label>
                                <input type="number" id="max_quantity" name="max_quantity" class="form-control"
                                    required min="1" placeholder="Nhập số lượng tối đa">
                                <div class="invalid-feedback">Vui lòng nhập số lượng tối đa (>= 1).</div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="event_images">Hình ảnh</label>
                                <input type="file" id="event_images" name="images[]" class="form-control"
                                    accept="image/*" multiple>
                            </div>
                            <div id="formMessage" style="margin-top:10px; color: red;"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" form="eventForm">Tạo chiến dịch</button>
                    </div>
                </div>
            </div>
        @endif


        <!-- Chatbot Icon -->
        <div id="chatbot-icon" style="position: fixed; bottom: 32px; right: 32px; z-index: 9999; cursor: pointer;">
            <img src="/images/bot.png" alt="Chatbot" width="60" height="60"
                style="border-radius: 50%; box-shadow: 0 2px 8px rgba(0,0,0,0.2);">
        </div>

        <!-- Chatbot Popup -->
        <div id="chatbot-popup"
            style="display: none; position: fixed; bottom: 100px; right: 32px; width: 500px; height: 500px; max-width: 98vw; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.18); z-index: 10000; overflow: hidden;">
            <div
                style="background: #ff9800; color: #fff; padding: 12px 16px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
                <span>HUCE Chatbot</span>
                <span id="chatbot-close" style="cursor:pointer;">×</span>
            </div>
            <div id="chatbot-messages" style="height: 300px; overflow-y: auto; padding: 16px; background: #fafafa;">
            </div>
            <form id="chatbot-form" style="display: flex; border-top: 1px solid #eee;">
                <input type="text" id="chatbot-input" placeholder="Nhập câu hỏi..."
                    style="flex:1; border:none; padding: 12px; outline:none;">
                <button type="submit"
                    style="background: #ff9800; color: #fff; border:none; padding: 0 18px;">Gửi</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- IonIcons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Chatbot Script -->
    <script>
        document.getElementById('chatbot-icon').onclick = function() {
            document.getElementById('chatbot-popup').style.display = 'block';
        };
        document.getElementById('chatbot-close').onclick = function() {
            document.getElementById('chatbot-popup').style.display = 'none';
        };

        document.getElementById('chatbot-form').onsubmit = async function(e) {
            e.preventDefault();
            const input = document.getElementById('chatbot-input');
            const msg = input.value.trim();
            if (!msg) return;
            appendMessage('Bạn', msg, true);
            input.value = '';

            try {
                const res = await fetch('http://localhost:5000/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        message: msg
                    })
                });
                const data = await res.json();
                const items = data.items || data.results || data.events || data.query_results_data || null;
                appendMessage('Huce Bot', data.response_text, false, items);
            } catch (err) {
                appendMessage('Huce Bot', 'Có lỗi khi kết nối chatbot.', false);
            }
        };

        function appendMessage(sender, text, isUser, events = null) {
            const box = document.getElementById('chatbot-messages');
            const msgDiv = document.createElement('div');
            msgDiv.style.margin = '8px 0';
            msgDiv.style.textAlign = isUser ? 'right' : 'left';

            if (events && events.length > 0) {
                const maxShow = 4;
                let randomEvents = events;
                if (events.length > maxShow) {
                    randomEvents = events
                        .map(value => ({
                            value,
                            sort: Math.random()
                        }))
                        .sort((a, b) => a.sort - b.sort)
                        .map(({
                            value
                        }) => value)
                        .slice(0, maxShow);
                }

                let html = `<div style="margin-bottom:8px;">${text}</div>
                <div style="display:flex; flex-direction:column; gap:12px;">`;
                randomEvents.forEach(ev => {
                    let detailUrl = '';
                    if (ev.type === 'result' && ev.id) {
                        detailUrl = `/result/${ev.id}`;
                    } else if (ev.type === 'event' && ev.id) {
                        detailUrl = `/event/${ev.id}`;
                    } else {
                        detailUrl = '#';
                    }

                    // Handle image array - get first image from array or use single image
                    let displayImage = '/images/default-event.jpg';
                    if (ev.images) {
                        if (Array.isArray(ev.images)) {
                            // If images is an array, get the first image
                            displayImage = ev.images.length > 0 ? ev.images[0] : '/images/default-event.jpg';
                        } else if (typeof ev.images === 'string') {
                            // If images is a string, check if it contains multiple images separated by semicolon
                            // Also handle the case where the string is wrapped in quotes
                            let cleanImageString = ev.images.replace(/^"|"$/g, ''); // Remove outer quotes
                            const imageArray = cleanImageString.split(';').filter(img => img.trim());
                            displayImage = imageArray.length > 0 ? imageArray[0].trim() : '/images/default-event.jpg';
                        }
                    }

                    html += `
                    <div class="chatbot-event-card" 
                         style="display:flex;align-items:center;gap:12px; background:#fff; border:1px solid #eee; border-radius:10px; box-shadow:0 2px 8px #0001; padding:10px; cursor:pointer; transition:box-shadow 0.2s;"
                         onclick="const url='${detailUrl}'; console.log('Go to:', url); if(url && url !== '#') window.location.href=url;"
                         onmouseover="this.style.boxShadow='0 4px 16px #0002'"
                         onmouseout="this.style.boxShadow='0 2px 8px #0001'">
                        <img src="${displayImage}" alt="${ev.name || 'Event'}" style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                        <div>
                            <div style="font-weight:bold;">${ev.name || 'Không rõ tên'}</div>
                            <div style="font-size:13px;color:#888;">${ev.location || ''}</div>
                            <div style="font-size:12px;color:#ff9800;">
                                ${formatDate(ev.start_date)} - ${formatDate(ev.end_date)}
                            </div>
                            <div style="font-size:12px;color:#009688;">
                                ${(Number(ev.max_quantity) - Number(ev.quantity_now)) > 0
                                    ? `Còn ${Number(ev.max_quantity) - Number(ev.quantity_now)} chỗ`
                                    : 'Hết lượt đăng kí'}
                            </div>
                        </div>
                    </div>`;
                });
                html += '</div>';
                msgDiv.innerHTML = html;
            } else {
                msgDiv.innerHTML =
                    `<span style="display:inline-block; background:${isUser ? '#ff9800' : '#eee'}; color:${isUser ? '#fff' : '#333'}; padding:8px 12px; border-radius:12px; max-width:80%; word-break:break-word;">${text}</span>`;
            }
            box.appendChild(msgDiv);
            box.scrollTop = box.scrollHeight;
        }

        function formatDate(dateStr) {
            if (!dateStr) return '';
            const d = new Date(dateStr);
            return d.toLocaleDateString('vi-VN');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.user-menu').forEach(function(userMenu) {
                const avatarContainer = userMenu.querySelector('.avatar-container');
                const dropdownMenu = userMenu.querySelector('.dropdown-menu');
                if (!avatarContainer || !dropdownMenu) return;

                avatarContainer.addEventListener('click', function(e) {
                    e.stopPropagation();
                    document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList
                        .remove('show'));
                    dropdownMenu.classList.toggle('show');
                });
            });

            document.addEventListener('click', function() {
                document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
            });

            const bell = document.getElementById('notificationBell');
            const dropdown = document.getElementById('notificationDropdown');
            const markAllBtn = document.getElementById('markAllRead');

            if (bell && dropdown) {
                bell.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                    const rect = bell.getBoundingClientRect();
                    dropdown.style.top = `${rect.bottom + 8}px`;
                    dropdown.style.left = `${rect.right - dropdown.offsetWidth}px`;
                });

                document.addEventListener('click', function() {
                    dropdown.style.display = 'none';
                });

                dropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            if (dropdown) {
                dropdown.addEventListener('click', function(e) {
                    const item = e.target.closest('.dropdown-noti-item');
                    if (!item) return;

                    const content = item.querySelector('.dropdown-noti-content');
                    const id = item.dataset.id;
                    const type = item.dataset.type;
                    const isRead = item.classList.contains('read');

                    if (!isRead) {
                        axios.post('/notifications/mark-read', {
                            notification_id: id,
                            type: type
                        }).then(() => {
                            item.classList.remove('unread');
                            item.classList.add('read');
                        });
                    }

                    const isExpanded = item.classList.contains('expanded');
                    document.querySelectorAll('.dropdown-noti-item').forEach(i => {
                        i.classList.remove('expanded');
                        const c = i.querySelector('.dropdown-noti-content');
                        if (c) c.style.display = 'none';
                    });

                    if (!isExpanded && content) {
                        item.classList.add('expanded');
                        content.style.display = 'block';
                    }
                });
            }

            if (markAllBtn) {
                markAllBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    axios.post('/notifications/mark-all-read').then(() => {
                        document.querySelectorAll('.dropdown-noti-item').forEach(item => {
                            item.classList.remove('unread');
                            item.classList.add('read');
                        });
                    });
                });
            }

            const form = document.getElementById('eventForm');
            const startDateInput = document.getElementById('start_date');
            const formMessage = document.getElementById('formMessage');

            // Chỉ chạy logic cho form event nếu các elements tồn tại
            if (form && startDateInput && formMessage) {
                // Thiết lập min cho ngày bắt đầu = hôm nay + 7 ngày
                const today = new Date();
                today.setDate(today.getDate() + 7);

                const year = today.getFullYear();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const day = String(today.getDate()).padStart(2, '0');
                const minDate = `${year}-${month}-${day}`;

                startDateInput.min = minDate;

                // Kiểm tra khi người dùng gửi form
                form.addEventListener('submit', function(e) {
                    const selectedDate = new Date(startDateInput.value);
                    const now = new Date();
                    now.setHours(0, 0, 0, 0);
                    const limitDate = new Date(now);
                    limitDate.setDate(limitDate.getDate() + 7);

                    if (!startDateInput.value || selectedDate < limitDate) {
                        e.preventDefault();
                        formMessage.textContent = 'Ngày bắt đầu phải sau hiện tại ít nhất 7 ngày.';
                        startDateInput.classList.add('is-invalid');
                    } else {
                        formMessage.textContent = '';
                        startDateInput.classList.remove('is-invalid');
                    }
                });
            }




        });
    </script>

    @yield('scripts')
</body>

</html>
