@extends('layouts.master')

@section('title', 'Lịch sự kiện của bạn')

@section('content')
    <div class="schedule-container">
        <div class="container">
            <!-- Hiển thị thông báo nếu có -->
            @if (session('success'))
                <div class="alert alert-success"
                    style="padding: 10px; margin-bottom: 20px; background-color: rgba(46, 204, 113, 0.15); color: #27ae60; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error"
                    style="padding: 10px; margin-bottom: 20px; background-color: rgba(231, 76, 60, 0.15); color: #e74c3c; border-radius: 5px;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="schedule-card">
                <h1 class="schedule-title">
                    <i class="fas fa-calendar-alt"></i> 
                    Sự kiện bạn đã đăng ký
                </h1>
                <div class="calendar-container">
                    <div id="calendar"></div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('styles')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.css" rel="stylesheet">
    <style>
        /* Loại bỏ scroll cho body và html */
        html, body {
            overflow: hidden !important;
            height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        :root {
            --sc-primary: #e74c3c;
            --sc-secondary: #3498db;
            --sc-success: #2ecc71;
            --sc-warning: #f39c12;
            --sc-light-gray: #f5f5f5;
            --sc-dark-gray: #333;
            --sc-text-gray: #666;
            --sc-border-color: #ddd;
        }.schedule-container {
            background-color: var(--sc-light-gray);
            color: var(--sc-dark-gray);
            height: 100vh;
            padding: 20px 0;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            box-sizing: border-box;
        }        .schedule-container .container {
            max-width: 1000px;
            width: 90%;
            margin: 0 auto;
            padding: 0;
            height: calc(100vh - 40px);
            display: flex;
            flex-direction: column;
        }        .schedule-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0;
            padding: 20px;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            box-sizing: border-box;
        }.schedule-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--sc-dark-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-align: center;
            flex-shrink: 0;
        }

        .schedule-title i {
            margin-right: 10px;
            color: var(--sc-primary);
        }        .calendar-container {
            margin-top: 10px;
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }        #calendar {
            width: 100%;
            margin: 0 auto;
            font-size: 14px;
            background-color: white;
            height: 100% !important;
            flex: 1;
        }        /* FullCalendar styling */
        .fc .fc-daygrid-day-frame {
            padding: 2px !important;
            min-height: 85px !important;
            height: auto !important;
            max-height: none !important;
        }        .fc-daygrid-day-frame {
            height: auto !important;
            max-height: none !important;
        }/* Tối ưu hóa calendar để hiển thị 4 tuần */
        .fc-view-harness {
            height: 100% !important;
        }

        .fc-scroller {
            height: auto !important;
            max-height: 400px !important;
            overflow-y: auto !important;
        }

        /* Tối ưu hóa header */
        .fc-header-toolbar {
            margin-bottom: 10px !important; /* Giảm margin bottom */
            padding: 5px 0 !important;
        }

        /* Tối ưu hóa table */
        .fc-daygrid-body {
            width: 100% !important;
        }        /* Tối ưu hóa scrolling cho calendar */
        .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
            overflow: visible !important;
            max-height: none !important; /* Bỏ giới hạn chiều cao cho danh sách sự kiện */
        }

        /* Bỏ ràng buộc overflow cho event title */
        .fc-event-title {
            overflow: visible !important;
            white-space: normal !important;
            text-overflow: clip !important;
            word-wrap: break-word !important;
        }        /* Đảm bảo calendar không bị cut off */
        .fc-view {
            overflow: visible !important;
        }

        .fc-daygrid-month {
            width: 100% !important;
        }

        /* Bỏ giới hạn cho container sự kiện */
        .fc-daygrid-day-events {
            min-height: auto !important;
            max-height: none !important;
            overflow: visible !important;
        }

        .fc-daygrid-day-event-container {
            max-height: none !important;
            overflow: visible !important;
        }        /* Cải thiện hiển thị events */
        .fc-event {
            margin-bottom: 1px !important;
            font-size: 12px !important;
            padding: 3px 5px !important;
            line-height: 1.3 !important;
            min-height: 20px !important;
            border-radius: 4px !important;
            border: none !important;
            overflow: visible !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12) !important;
        }

        .fc-event-title {
            font-weight: bold !important;
            word-wrap: break-word !important;
            white-space: normal !important;
            line-height: 1.3 !important;
            overflow: visible !important;
        }        /* Ẩn more link và bỏ viền cho events */
        .fc-daygrid-more-link {
            display: none !important;
        }

        .fc-event, .fc-event:hover, .fc-event:focus {
            border: none !important;
            outline: none !important;
        }        /* Fix cho mobile landscape */
        @media (max-width: 768px) and (orientation: landscape) {
            .schedule-container {
                padding: 10px 0;
            }
            .schedule-card {
                height: 100%;
            }
        }

        /* Xóa bỏ comment không cần thiết */        /* Responsive styles */
        @media (max-width: 992px) {
            .schedule-container {
                padding: 15px 0;
            }
            .schedule-container .container {
                width: 95%;
                height: calc(100vh - 30px);
            }
            
            .schedule-card {
                height: 100%;
            }
        }        @media (max-width: 768px) {
            .schedule-container {
                padding: 10px 0;
            }
            
            .schedule-container .container {
                height: calc(100vh - 20px);
            }
            
            .schedule-card {
                padding: 15px;
                height: 100%;
                margin: 0;
            }
            
            .schedule-title {
                font-size: 20px;
                margin-bottom: 10px;
            }
              .fc .fc-daygrid-day-frame {
                min-height: 45px !important; /* Giảm chiều cao cho mobile */
            }
            
            .fc-event {
                font-size: 11px !important;
                padding: 2px 3px !important;
                min-height: 16px !important;
            }
            
            .fc-header-toolbar {
                margin-bottom: 5px !important;
                flex-direction: column !important;
                gap: 5px !important;
            }
            
            .fc-header-toolbar .fc-toolbar-chunk {
                display: flex !important;
                justify-content: center !important;
            }
        }        @media (max-width: 480px) {
            .schedule-container {
                padding: 5px 0;
            }
            
            .schedule-container .container {
                width: 98%;
                height: calc(100vh - 10px);
            }
            
            .schedule-card {
                padding: 10px;
                height: 100%;
            }
            
            .schedule-title {
                font-size: 18px;
                margin-bottom: 8px;
            }
              .fc .fc-daygrid-day-frame {
                min-height: 40px !important;
            }
            
            .fc-event {
                font-size: 10px !important;
                padding: 1px 2px !important;
                min-height: 14px !important;
                line-height: 1.2 !important;
            }
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');            // Phần định nghĩa màu sắc
            const eventColors = [
                '#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6',
                '#1abc9c', '#d35400', '#c0392b', '#27ae60', '#8e44ad',
                '#f1c40f', '#16a085', '#e67e22', '#2980b9', '#7f8c8d',
                '#FF5733', '#33FF57', '#5733FF', '#FF33A1', '#33A1FF',
                '#FF6B35', '#F7931E', '#FFD23F', '#06FFA5', '#118AB2',
                '#073B4C', '#B91372', '#8E44AD', '#E67E22', '#95A5A6',
                '#34495E', '#FF4757', '#5352ED', '#7BED9F', '#70A1FF',
                '#FF6348', '#FF4757', '#FFA502', '#2ED573', '#1E90FF'
            ];            const eventColorMap = {};
            let colorIndex = 0;

            // Hàm làm tối màu sắc
            function darkenColor(color, percent) {
                const num = parseInt(color.replace("#", ""), 16);
                const amt = Math.round(2.55 * -percent);
                const R = (num >> 16) + amt;
                const G = ((num >> 8) & 0x00FF) + amt;
                const B = (num & 0x0000FF) + amt;
                return (
                    "#" +
                    (0x1000000 +
                        (R < 255 ? (R < 1 ? 0 : R) : 255) * 0x10000 +
                        (G < 255 ? (G < 1 ? 0 : G) : 255) * 0x100 +
                        (B < 255 ? (B < 1 ? 0 : B) : 255))
                    .toString(16)
                    .slice(1)
                );
            }

            // Hàm kiểm tra độ sáng của màu
            function isLightColor(color) {
                const num = parseInt(color.replace("#", ""), 16);
                const R = (num >> 16) & 0xFF;
                const G = (num >> 8) & 0xFF;
                const B = num & 0xFF;
                const brightness = (R * 299 + G * 587 + B * 114) / 1000;
                return brightness > 155;
            }            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 500,
                aspectRatio: 1.5,
                locale: 'vi',
                contentHeight: 500,
                handleWindowResize: true,
                fixedWeekCount: false,
                showNonCurrentDates: false,
                weekNumbers: false,
                dayHeaders: true,
                expandRows: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },events: {
                    url: '/api/my-events',
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    failure: function(error) {
                        console.error('Lỗi khi tải sự kiện:', error);
                        alert('Không thể tải dữ liệu lịch. Vui lòng thử lại sau.');
                    }                },                eventContent: function(info) {
                    const title = info.event.title;
                    const eventId = info.event.id;
                    
                    // Tạo một key duy nhất dựa trên title để gán màu
                    const titleKey = title.toLowerCase().trim();
                    
                    // Xác định màu sắc cho sự kiện
                    if (!eventColorMap[titleKey]) {
                        eventColorMap[titleKey] = eventColors[colorIndex % eventColors.length];
                        colorIndex++;
                    }
                      const color = eventColorMap[titleKey];
                    const textColor = isLightColor(color) ? '#000000' : '#FFFFFF';
                    
                    // Tạo HTML cho sự kiện
                    const wrapper = document.createElement('div');
                    wrapper.className = 'fc-event-main-frame';
                    wrapper.style.backgroundColor = color;
                    wrapper.style.color = textColor;
                    wrapper.style.border = 'none';
                    wrapper.style.borderRadius = '4px';
                    wrapper.style.padding = '3px 5px';
                    wrapper.style.fontWeight = 'bold';
                    wrapper.style.fontSize = '12px';
                    wrapper.style.lineHeight = '1.3';
                    wrapper.style.boxShadow = '0 1px 3px rgba(0,0,0,0.12)';
                    wrapper.style.width = '100%';
                    wrapper.style.boxSizing = 'border-box';
                    wrapper.style.display = 'block';
                    wrapper.style.position = 'relative';
                    wrapper.style.zIndex = '1';
                    wrapper.style.wordWrap = 'break-word';
                    wrapper.style.whiteSpace = 'normal';
                    wrapper.style.overflowWrap = 'break-word';
                    wrapper.style.hyphens = 'auto';
                    wrapper.style.overflow = 'visible';
                    wrapper.style.minHeight = '18px';
                    
                    // Hiển thị tên đầy đủ cho tất cả sự kiện
                    wrapper.innerText = title;
                    
                    wrapper.title = title; // Tooltip vẫn hiển thị tên đầy đủ
                    
                    // Thêm hiệu ứng hover
                    wrapper.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.02)';
                        this.style.transition = 'transform 0.1s ease';
                        this.style.cursor = 'pointer';
                        this.style.zIndex = '10';
                    });
                    
                    // Xử lý sự kiện click
                    wrapper.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        window.location.href = '/event/' + info.event.id;
                    });
                    
                    wrapper.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1)';
                        this.style.zIndex = '1';
                    });
                    
                    return { domNodes: [wrapper] };
                },
                  loading: function(isLoading) {
                    if (isLoading) {
                        calendarEl.classList.add('opacity-50');
                    } else {
                        calendarEl.classList.remove('opacity-50');
                    }
                },
                
                dayMaxEvents: false,
            });calendar.render();

            // Tự động điều chỉnh kích thước khi window resize
            window.addEventListener('resize', function() {
                calendar.setOption('height', 500);
                calendar.setOption('contentHeight', 500);
            });
        });
    </script>
@endsection