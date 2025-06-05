<header class="header">
    <a href="/" style="text-decoration: none;">
        <div class="logo">
            HUCE Charity
        </div>
    </a>

    <form class="search-bar" method="GET" action="{{ route('search.events.page') }}">
        <input type="text" name="query" placeholder="Tìm kiếm tên chiến dịch" value="{{ request('query') }}">
        <button type="submit" style="display:none"></button>
    </form>

    <nav class="nav-links">
        <a href="/list">Tổ chức</a>
        <a href="/schedule">Lịch trình</a>

        @if(auth('organization')->check())
        <button class="create-service" id="openEventModal">Tạo chiến dịch</button>
        @php
        echo '<script>
            console.log("Organization Auth: true");
        </script>';
        @endphp
        @elseif(auth('volunteer')->check())
        <a href="{{ route('scan.qr') }}" class="create-service">Điểm danh</a>
        @php
        echo '<script>
            console.log("Volunteer Auth: true");
        </script>';
        @endphp
        @else
        @php
        echo '<script>
            console.log("No Auth: User not logged in as organization or volunteer");
        </script>';
        @endphp
        @endif

        <!-- Chuông thông báo -->
        <div id="notificationBell" class="notification" title="Xem thông báo" style="cursor: pointer;">
            🔔
        </div>

        <div class="user-menu">

            <div class="avatar-container">
                @if (auth('volunteer')->check())
                @php

                $avatar = auth('volunteer')->user()->avatar ?? 'default-avatar.png';
                @endphp
                <img
                    src=" {{ $avatar ? asset('images/' . $avatar) : asset('images/default-avatar.png') }}" alt="Avatar"
                    class="avatar-img">

                @elseif (auth('organization')->check())
                @php
                $avatar = auth('organization')->user()->avatar ?? 'default-avatar.png';
                @endphp
                <img
                    src=" {{ asset('images/' . $avatar) }}" alt="Avatar"
                    class="avatar-img">
                @else
                @php

                @endphp
                <img
                    src="{{ asset('images/default-avatar.png') }}"
                    alt="Avatar"
                    class="avatar-img">
                @endif
                <span class="dropdown-icon">▼</span>
            </div>
            <div class="dropdown-menu">
                @if(auth('volunteer')->check())
                <a href="{{ route('volunteer.profile', ['id' => auth('volunteer')->user()->volunteer_id]) }}">Xem thông tin cá nhân</a>
                <a href="/editvolunteer">Sửa thông tin cá nhân</a>
                <hr>
                <a href="/logout">Đăng xuất</a>
                @elseif(auth('organization')->check())
                <a href="/organizations/{{ auth('organization')->user()->organization_id }}">Xem thông tin tổ chức</a>
                <a href="/editorganization">Sửa thông tin tổ chức</a>
                <a href="{{ route('notification.organization.send.event.view') }}">Gửi thông báo</a>
                <a href="/dashboard">Bảng điều khiển</a>
                <hr>
                <a href="/logout">Đăng xuất</a>
                @else
                <a href="{{ route('login') }}">Đăng nhập</a>
                <a href="{{ route('register') }}">Đăng ký</a>
                @endif
            </div>
        </div>
    </nav>

    <script>
        console.log("Immediate log: Header script running at", new Date().toLocaleString());

        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOMContentLoaded event fired at', new Date().toLocaleString());

            const openEventModalBtn = document.getElementById('openEventModal');
            const eventModal = document.getElementById('eventModal');
            const closeModalBtn = document.querySelector('#eventModal .modal-close');
            const testButton = document.getElementById('testButton');
            const eventForm = document.getElementById('eventForm');
            const formMessage = document.getElementById('formMessage');

            console.log('Debug Elements:', {
                openEventModalBtn: !!openEventModalBtn,
                eventModal: !!eventModal,
                closeModalBtn: !!closeModalBtn,
                testButton: !!testButton,
                eventForm: !!eventForm,
                formMessage: !!formMessage
            });

            function openModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'block';
                    modal.style.visibility = 'visible';
                    modal.style.opacity = '1';
                    document.body.style.overflow = 'hidden';
                    console.log('Modal opened:', modalId);
                } else {
                    console.error(`Modal with ID ${modalId} not found. Check if event.create view is loaded.`);
                }
            }

            function closeModal(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                    console.log('Modal closed:', modalId);
                }
            }

            if (openEventModalBtn) {
                openEventModalBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Create Campaign button clicked');
                    openModal('eventModal');
                });
            } else {
                console.error('Open modal button (#openEventModal) not found');
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function() {
                    closeModal('eventModal');
                });
            } else {
                console.warn('Close modal button not found');
            }

            const cancelButtons = document.querySelectorAll('#eventModal .modal-footer .btn-outline');
            if (cancelButtons.length > 0) {
                cancelButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        closeModal('eventModal');
                    });
                });
            }

            if (eventModal) {
                eventModal.addEventListener('click', function(event) {
                    if (event.target === eventModal) {
                        closeModal('eventModal');
                    }
                });
            } else {
                console.warn('Event modal not found');
            }


            if (eventForm && formMessage) {
                eventForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    if (!eventForm.checkValidity()) {
                        eventForm.classList.add('was-validated');
                        return;
                    }

                    const formData = new FormData(eventForm);
                    formMessage.style.color = 'black';
                    formMessage.textContent = 'Đang gửi...';

                    fetch(eventForm.action, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json'
                            },
                            body: formData
                        })
                        .then(async response => {
                            const data = await response.json();
                            formMessage.style.color = data.success ? 'green' : 'red';
                            formMessage.textContent = data.message || (data.success ? 'Tạo thành công!' : 'Lỗi server: ' + (data.error || 'Không xác định'));
                            if (data.success) {
                                setTimeout(() => {
                                    closeModal('eventModal');
                                    eventForm.reset();
                                    window.location.reload();
                                }, 1500);
                            } else {
                                console.error('Server error details:', data.error);
                            }
                        })
                        .catch(error => {
                            console.error('Fetch error:', error);
                            formMessage.style.color = 'red';
                            formMessage.textContent = 'Lỗi kết nối';
                        });
                });
            } else {
                console.error('eventForm or formMessage not found in DOM');
            }
        });

        window.onerror = function(message, source, lineno, colno, error) {
            console.error('Global error:', {
                message,
                source,
                lineno,
                colno,
                error
            });
            return true;
        };
    </script>
</header>

@section('styles')
<style>
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1000;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .search-bar {
        flex-grow: 1;
        margin: 0 20px;
    }

    .search-bar input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .nav-links a {
        text-decoration: none;
        color: #333;
        font-size: 16px;
    }

    .nav-links a:hover {
        color: #007bff;
    }

    .create-service {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        pointer-events: auto !important;
        z-index: 1000;
    }

    .create-service:hover {
        background-color: #0056b3;
    }

    .notification {
        font-size: 20px;
        position: relative;
    }

    .user-menu {
        position: relative;
        display: inline-block;
    }

    .avatar-container {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .avatar-img {
        border-radius: 50%;
        width: 36px;
        height: 36px;
        object-fit: cover;
    }

    .dropdown-icon {
        font-size: 10px;
        margin-left: 5px;
        color: #666;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 200px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        border-radius: 8px;
        padding: 10px 0;
        margin-top: 5px;
    }

    .dropdown-menu.show {
        display: block;
    }

    .dropdown-menu a {
        color: #333;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        font-size: 14px;
    }

    .dropdown-menu a:hover {
        background-color: #f9f9f9;
    }

    .dropdown-menu hr {
        border: none;
        height: 1px;
        background-color: #eee;
        margin: 5px 0;
    }
</style>
@endsection