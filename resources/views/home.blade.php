@extends('layouts.master')

@section('title', 'Trang chủ')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <style>
        .content {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            /* giới hạn 3 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 4.5em;
            /* khoảng tương ứng 3 dòng */
        }

        .slogan {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #e67e22;
            margin: 40px auto 30px;
            max-width: 700px;
            line-height: 1.5;
            padding-bottom: 30px;
        }

        .div-section {
            margin: 0 auto;
            width: 90%;
            align-items: center;
        }

        .section-title {
            font-size: 30px;
            font-weight: bold;
            margin: 20px 0 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .swiper {
            width: 100%;
            height: auto;
            margin-bottom: 30px;
        }

        .swiper-slide .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s;
            background-color: #fff;
        }

        .swiper-slide .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .info {
            padding: 12px;
        }

        .info h3 {
            font-size: 18px;
            margin: 0 0 6px;
        }

        .info p {
            font-size: 14px;
            color: #555;
            margin: 2px 0;
        }

        .content {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            /* giới hạn 3 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            min-height: 4.5em;
            /* khoảng tương ứng 3 dòng */
        }

        .see-all {
            font-size: 14px;
            text-decoration: none;
            margin-right: 10px;
        }

        .see-all {
            font-size: 14px;
            text-decoration: none;
            margin-right: 10px;
        }

        /* Style cho thông báo */
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            margin: 15px auto;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            width: 90%;
            max-width: 600px;
            text-align: center;
            position: relative;
            transition: opacity 0.5s ease;
        }

        .alert-danger::before {
            content: "⚠️ ";
            font-size: 1.2em;
        }





        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        .top-volunteers-section {
            font-family: 'Montserrat', sans-serif;
            margin: 50px auto;
            padding: 30px 20px 60px;
            border-radius: 20px;
            background: linear-gradient(135deg, #ff7e29 0%, #ffba33 100%);
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(255, 126, 41, 0.2);
        }

        .top-volunteers-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3Cpattern id='wave' width='200' height='200' patternUnits='userSpaceOnUse'%3E%3Cpath d='M0 25C 40 10, 60 40, 100 25 L 100 25 L 0 25 Z' fill='%23ffffff11' /%3E%3C/pattern%3E%3C/defs%3E%3Crect width='100%25' height='100%25' fill='url(%23wave)' /%3E%3C/svg%3E");
            opacity: 0.6;
            z-index: 0;
            animation: waveAnimation 15s linear infinite;
        }

        @keyframes waveAnimation {
            0% {
                background-position: 0 0;
            }

            100% {
                background-position: 400px 0;
            }
        }

        .top-title {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
            z-index: 1;
        }

        .top-title h2 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 0;
        }

        .volunteers-container {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 20px;
            position: relative;
            z-index: 1;
            max-width: 850px;
            margin: 0 auto;
        }

        .volunteer-card {
            background-color: white;
            border-radius: 16px;
            padding: 0;
            width: calc(33% - 20px);
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .volunteer-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            transform: scale(1.2);
        }

        .first-place {
            z-index: 3;
            height: 340px;
            margin-bottom: 30px;
        }

        .second-place {
            z-index: 2;
            height: 320px;
            margin-bottom: 10px;
        }

        .third-place {
            z-index: 1;
            height: 300px;
            margin-bottom: 0;
        }

        .medal-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            z-index: 2;
        }

        .medal-badge.first {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            width: 45px;
            height: 45px;
            font-size: 22px;
        }

        .medal-badge.second {
            background: linear-gradient(135deg, #C0C0C0, #A9A9A9);
        }

        .medal-badge.third {
            background: linear-gradient(135deg, #CD7F32, #8B4513);
        }

        .avatar-container {
            width: 100%;
            height: 60%;
            position: relative;
            overflow: hidden;
        }

        .first-place .avatar-container {
            height: 65%;
        }

        .volunteer-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .volunteer-info {
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.6) 60%, rgba(0, 0, 0, 0) 100%);
            color: white;
            padding: 20px 15px 5px;
            text-align: center;
            z-index: 1;
        }

        .volunteer-name {
            font-size: 18px;
            font-weight: 700;
            margin: 0 0 5px;
            color: white;
        }

        .first-place .volunteer-name {
            font-size: 22px;
        }

        .volunteer-username {
            font-size: 14px;
            color: #ffba33;
            margin: 0 0 5px;
            display: inline-block;
            padding: 3px 10px;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 20px;
        }

        .campaign-container {
            width: 100%;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 15px;
            height: 40%;
            justify-content: center;
        }

        .first-place .campaign-container {
            height: 35%;
        }

        .campaign-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
            text-align: center;
        }

        .campaign-value {
            font-size: 36px;
            font-weight: 700;
            color: #ff5722;
            line-height: 1;
        }

        .first-place .campaign-value {
            font-size: 42px;
        }

        .campaign-unit {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .volunteers-container {
                flex-direction: column;
                align-items: center;
            }

            .volunteer-card {
                width: 80%;
                max-width: 320px;
                margin-bottom: 40px !important;
                height: auto !important;
            }

            .volunteer-card.first-place {
                order: 1;
            }

            .volunteer-card.second-place {
                order: 2;
            }

            .volunteer-card.third-place {
                order: 3;
                margin-bottom: 0 !important;
            }

            .avatar-container {
                height: 250px;
            }
        }

        @media (max-width: 480px) {
            .volunteer-card {
                width: 100%;
            }
        }
    </style>

    </style>
@endsection

@section('content')
    <div class="main-container">
        <!-- Thêm thông báo lỗi từ session -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="slogan">
            Cảm ơn bạn đã ghé thăm! Mỗi hành động nhỏ của bạn có thể tạo nên sự thay đổi lớn cho cộng đồng.
        </div>

        <div class="div-section">
            <div class="section-title">
                <span>Chiến dịch của Tổ chức</span>
                <a href="{{ route('event.index') }}" class="see-all">Xem tất cả →</a>
            </div>
            <div class="swiper event-slider">
                <div class="swiper-wrapper">
                    @foreach ($events as $event)
                        <div class="swiper-slide">
                            <div class="card" onclick="goToEvent('{{ $event->event_id }}')">
                                @php
                                    $images = [];
                                    if (!empty($event->images)) {
                                        if (is_string($event->images)) {
                                            $images = array_filter(array_map('trim', explode(';', $event->images)));
                                        } elseif (is_array($event->images)) {
                                            $images = $event->images;
                                        }
                                    }
                                    $firstImage = !empty($images) ? $images[0] : 'images/default-event.jpg';
                                @endphp
                                <img src="{{ asset($firstImage) }}" alt="event"
                                    onerror="this.src='{{ asset('images/default-event.jpg') }}'">

                                <div class="info">
                                    <h3>{{ $event->name }}</h3>
                                    <p class="content">{{ $event->description }}</p>
                                    <p><strong>Thời gian:</strong>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                        {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}
                                    </p>
                                    <p><strong>Tham gia:</strong> {{ $event->quantity_now }} / {{ $event->max_quantity }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

        <!-- Sự kiện sắp diễn ra -->
        @if ($upcomingEvents->isNotEmpty())
            <div class="div-section">
                <div class="section-title">
                    <span>Sự kiện sắp diễn ra</span>
                </div>
                <div class="swiper event-slider">
                    <div class="swiper-wrapper">
                        @foreach ($upcomingEvents as $event)
                            <div class="swiper-slide">
                                <div class="card" onclick="goToEvent('{{ $event->event_id }}')">
                                    @php
                                        $images = explode(';', $event->images);
                                        $firstImage = trim($images[0] ?? 'images/default-event.jpg');
                                    @endphp
                                    <img src="{{ asset($firstImage) }}" alt="event">
                                    <div class="info">
                                        <h3>{{ $event->name }}</h3>
                                        <p class="content">{{ $event->description }}</p>
                                        <p><strong>Thời gian:</strong>
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                                        <p><strong>Tham gia:</strong> {{ $event->quantity_now }} /
                                            {{ $event->max_quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif

        <!-- Sự kiện từ tổ chức đang theo dõi -->
        @if ($followedEvents->isNotEmpty())
            <div class="div-section">
                <div class="section-title">
                    <span>Sự kiện từ tổ chức bạn theo dõi</span>
                </div>
                <div class="swiper event-slider">
                    <div class="swiper-wrapper">
                        @foreach ($followedEvents as $event)
                            <div class="swiper-slide">
                                <div class="card" onclick="goToEvent('{{ $event->event_id }}')">
                                    @php
                                        $images = explode(';', $event->images);
                                        $firstImage = trim($images[0] ?? 'images/default-event.jpg');
                                    @endphp
                                    <img src="{{ asset($firstImage) }}" alt="event">
                                    <div class="info">
                                        <h3>{{ $event->name }}</h3>
                                        <p class="content">{{ $event->description }}</p>
                                        <p><strong>Thời gian:</strong>
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y') }}</p>
                                        <p><strong>Tham gia:</strong> {{ $event->quantity_now }} /
                                            {{ $event->max_quantity }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        @endif


        <div class="div-section">
            <div class="section-title">
                <span>Kết quả chiến dịch</span>
                <a href="{{ route('result.index') }}" class="see-all">Xem tất cả →</a>
            </div>
            <div class="swiper result-slider">
                <div class="swiper-wrapper">
                    @foreach ($results as $result)
                        <div class="swiper-slide">
                            <div class="card" onclick="goToResult('{{ $result->result_id }}')">
                                @php
                                    $images = [];
                                    if (!empty($result->images)) {
                                        if (is_string($result->images)) {
                                            $images = array_filter(array_map('trim', explode(';', $result->images)));
                                        } elseif (is_array($result->images)) {
                                            $images = $result->images;
                                        }
                                    }
                                    $firstImage = !empty($images) ? $images[0] : 'images/default-event.jpg';
                                @endphp
                                <img src="{{ asset($firstImage) }}" alt="result"
                                    onerror="this.src='{{ asset('images/default-event.jpg') }}'">

                                <div class="info">
                                    <h3>{{ $result->event->name ?? 'Chiến dịch' }}</h3>
                                    <p class="content">{{ $result->content }}</p>
                                    @if ($result->event)
                                        <p><strong>Thời gian:</strong>
                                            {{ \Carbon\Carbon::parse($result->event->start_date)->format('d/m/Y') }} -
                                            {{ \Carbon\Carbon::parse($result->event->end_date)->format('d/m/Y') }}
                                        </p>
                                        <p><strong>Tham gia:</strong> {{ $result->event->quantity_now }} /
                                            {{ $result->event->max_quantity }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>

    </div>



    <!-- Top Volunteers Section -->
    <div class="top-volunteers-section">
        <div class="top-title">
            @php
                use Carbon\Carbon;

                $now = Carbon::now();
                // Lùi lại tháng để lấy quý trước
                $end = $now->copy()->subMonths()->startOfMonth();
                $start = $end->copy()->subMonths()->startOfMonth();
            @endphp

            <h2>Tình nguyện viên nổi bật từ tháng {{ $start->month }} đến tháng {{ $end->month }}/{{ $end->year }}
            </h2>


        </div>

        <div class="volunteers-container">
            @if (isset($topVolunteers[1]))
                <div class="volunteer-card second-place"
                    onclick="window.location.href='/volunteer/{{ $topVolunteers[1]->volunteer_id }}'"
                    style="cursor: pointer;">
                    <div class="medal-badge second">2</div>
                    <div class="avatar-container">
                        <img src="{{ asset('/images/' . ($topVolunteers[1]->avatar ?? 'default-avatar.jpg')) }}"
                            alt="{{ $topVolunteers[1]->username }}" class="volunteer-avatar">
                        <div class="volunteer-info">
                            <h3 class="volunteer-name">{{ $topVolunteers[1]->username }}</h3>
                        </div>
                    </div>
                    <div class="campaign-container">
                        <span class="campaign-label">Số chiến dịch đã tham gia</span>
                        <span class="campaign-value">{{ $topVolunteers[1]->participation_count }}</span>
                        <span class="campaign-unit">chiến dịch</span>
                    </div>
                </div>
            @endif

            @if (isset($topVolunteers[0]))
                <div class="volunteer-card first-place"
                    onclick="window.location.href='/volunteer/{{ $topVolunteers[0]->volunteer_id }}'"
                    style="cursor: pointer;">
                    <div class="medal-badge first">1</div>
                    <div class="avatar-container">
                        <img src="{{ asset('/images/' . ($topVolunteers[0]->avatar ?? 'default-avatar.jpg')) }}"
                            alt="{{ $topVolunteers[0]->username }}" class="volunteer-avatar">
                        <div class="volunteer-info">
                            <h3 class="volunteer-name">{{ $topVolunteers[0]->username }}</h3>
                        </div>
                    </div>
                    <div class="campaign-container">
                        <span class="campaign-label">Số chiến dịch đã tham gia</span>
                        <span class="campaign-value">{{ $topVolunteers[0]->participation_count }}</span>
                        <span class="campaign-unit">chiến dịch</span>
                    </div>
                </div>
            @endif

            @if (isset($topVolunteers[2]))
                <div class="volunteer-card third-place"
                    onclick="window.location.href='/volunteer/{{ $topVolunteers[2]->volunteer_id }}'"
                    style="cursor: pointer;">
                    <div class="medal-badge third">3</div>
                    <div class="avatar-container">
                        <img src="{{ asset('/images/' . ($topVolunteers[2]->avatar ?? 'default-avatar.jpg')) }}"
                            alt="{{ $topVolunteers[2]->username }}" class="volunteer-avatar">
                        <div class="volunteer-info">
                            <h3 class="volunteer-name">{{ $topVolunteers[2]->username }}</h3>
                        </div>
                    </div>
                    <div class="campaign-container">
                        <span class="campaign-label">Số chiến dịch đã tham gia</span>
                        <span class="campaign-value">{{ $topVolunteers[2]->participation_count }}</span>
                        <span class="campaign-unit">chiến dịch</span>
                    </div>
                </div>
            @endif
        </div>

    </div>




@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        new Swiper('.event-slider', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: '.event-slider .swiper-pagination',
                clickable: true
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            speed: 600,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    slidesPerGroup: 1
                },
                768: {
                    slidesPerView: 2,
                    slidesPerGroup: 2
                },
                1024: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                }
            }
        });

        new Swiper('.result-slider', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: '.result-slider .swiper-pagination',
                clickable: true
            },
            autoplay: {
                delay: 3000,
                disableOnInteraction: false
            },
            speed: 600,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                    slidesPerGroup: 1
                },
                768: {
                    slidesPerView: 2,
                    slidesPerGroup: 2
                },
                1024: {
                    slidesPerView: 3,
                    slidesPerGroup: 3
                }
            }
        });

        function goToEvent(eventId) {
            window.location.href = '/event/' + eventId;
        }

        function goToResult(resultId) {
            window.location.href = '/result/' + resultId;
        }

        // Tự động ẩn thông báo sau 5 giây
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert-danger');
            if (alert) {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 500); // Chờ 0.5s để hoàn thành hiệu ứng fade
                }, 5000); // 5000ms = 5 giây
            }
        });



        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.volunteer-card');

            // Add initial state
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
            });

            // Define the order of animation (center, left, right)
            const firstPlace = document.querySelector('.first-place');
            const secondPlace = document.querySelector('.second-place');
            const thirdPlace = document.querySelector('.third-place');

            // Animate cards with sequence
            setTimeout(() => {
                firstPlace.style.opacity = '1';
                firstPlace.style.transform = 'translateY(0)';
                firstPlace.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

                setTimeout(() => {
                    secondPlace.style.opacity = '1';
                    secondPlace.style.transform = 'translateY(0)';

                    setTimeout(() => {
                        thirdPlace.style.opacity = '1';
                        thirdPlace.style.transform = 'translateY(0)';
                    }, 150);
                }, 150);
            }, 300);

            // Simple hover glow effect for avatar
            cards.forEach(card => {
                const avatar = card.querySelector('.avatar-container');

                card.addEventListener('mouseenter', () => {
                    avatar.style.boxShadow = '0 0 20px rgba(255, 126, 41, 0.6)';
                    avatar.style.borderColor = 'rgba(255, 126, 41, 0.8)';
                });

                card.addEventListener('mouseleave', () => {
                    avatar.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
                    avatar.style.borderColor = 'rgba(255, 126, 41, 0.3)';
                });
            });

            function goToResult(resultId) {
                window.location.href = '/result/' + resultId;
            }

            // Tự động ẩn thông báo sau 5 giây
            document.addEventListener('DOMContentLoaded', function() {
                const alert = document.querySelector('.alert-danger');
                if (alert) {
                    setTimeout(() => {
                        alert.style.opacity = '0';
                        setTimeout(() => {
                            alert.style.display = 'none';
                        }, 500); // Chờ 0.5s để hoàn thành hiệu ứng fade
                    }, 5000); // 5000ms = 5 giây
                }
            });
        });
    </script>
@endsection
