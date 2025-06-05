@extends('layouts.master')

@section('title', 'Quét mã QR điểm danh')

@section('styles')
<style>
    .scan-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
    }

    .scan-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .scan-title {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .scan-subtitle {
        color: #666;
        font-size: 16px;
    }

    .scan-area {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    #reader {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
    }

    .scan-result {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        display: none;
    }

    .result-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .result-content {
        color: #666;
        line-height: 1.6;
    }

    .success-message {
        color: #4caf50;
        font-weight: 500;
    }

    .error-message {
        color: #f44336;
        font-weight: 500;
    }

    .scan-instructions {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
    }

    .instructions-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    .instructions-list {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .instructions-list li {
        color: #666;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
    }

    .instructions-list li i {
        color: #2196f3;
        margin-right: 8px;
    }
</style>
@endsection

@section('content')
<div class="scan-container">
    <div class="scan-header">
        <h1 class="scan-title">Quét mã QR điểm danh</h1>
        <p class="scan-subtitle">Đưa mã QR vào khung hình để điểm danh</p>
    </div>

    <div class="scan-area">
        <div id="reader"></div>
    </div>

    <div class="scan-result" id="scanResult">
        <h2 class="result-title">Kết quả quét</h2>
        <div class="result-content" id="resultContent"></div>
    </div>

    <div class="scan-instructions">
        <h3 class="instructions-title">Hướng dẫn sử dụng</h3>
        <ul class="instructions-list">
            <li><i class="fas fa-check-circle"></i> Cho phép truy cập camera khi được yêu cầu</li>
            <li><i class="fas fa-check-circle"></i> Đưa mã QR vào khung hình</li>
            <li><i class="fas fa-check-circle"></i> Giữ yên cho đến khi quét thành công</li>
            <li><i class="fas fa-check-circle"></i> Đợi xác nhận điểm danh</li>
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const html5QrCode = new Html5Qrcode("reader");
    const scanResult = document.getElementById('scanResult');
    const resultContent = document.getElementById('resultContent');

    // Cấu hình quét QR
    const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    };

    let isProcessing = false;

    // Bắt đầu quét
    html5QrCode.start(
        { facingMode: "environment" },
        config,
        onScanSuccess,
        onScanFailure
    );

    // Xử lý khi quét thành công
    function onScanSuccess(decodedText, decodedResult) {
        if (isProcessing) return;
        isProcessing = true;
        try {
           
            // Parse URL để lấy event_id
            const url = new URL(decodedText);

            
            const pathParts = url.pathname.split('/').filter(part => part !== '');

            
            // Tìm event_id trong pathParts
            const eventId = pathParts[pathParts.length - 1];

            // Kiểm tra dữ liệu bắt buộc
            if (!eventId) {
                throw new Error('Mã QR không chứa thông tin sự kiện');
            }
            
            // Hiển thị kết quả
            scanResult.style.display = 'block';
            
            // Gửi request điểm danh
            axios.post('/api/check-in', {
                event_id: eventId
            })
            .then(response => {
                if (response.data.success) {
                    resultContent.innerHTML = `
                        <p class="success-message">
                            <i class="fas fa-check-circle"></i> Điểm danh thành công!
                        </p>
                        <p>Thời gian: ${new Date().toLocaleString()}</p>
                        <p>Sự kiện: ${response.data.event_name}</p>
                    `;
                    html5QrCode.stop();
                } else {
                    resultContent.innerHTML = `
                        <p class="error-message">
                            <i class="fas fa-times-circle"></i> ${response.data.message}
                        </p>
                    `;
                    setTimeout(() => {
                        scanResult.style.display = 'none';
                        isProcessing = false;
                        html5QrCode.resume();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error during check-in:', error);
                resultContent.innerHTML = `
                    <p class="error-message">
                        <i class="fas fa-times-circle"></i> Có lỗi xảy ra khi điểm danh: ${error.response?.data?.message || error.message}
                    </p>
                `;
                setTimeout(() => {
                    scanResult.style.display = 'none';
                    isProcessing = false;
                    html5QrCode.resume();
                }, 3000);
            });
        } catch (error) {
            console.error('Error processing QR code:', error);
            scanResult.style.display = 'block';
            resultContent.innerHTML = `
                <p class="error-message">
                    <i class="fas fa-times-circle"></i> Mã QR không hợp lệ: ${error.message}
                </p>
            `;
            setTimeout(() => {
                scanResult.style.display = 'none';
                isProcessing = false;
                html5QrCode.resume();
            }, 3000);
        }
    }

    // Xử lý khi quét thất bại
    function onScanFailure(error) {
        // Chỉ log lỗi, không dừng quét
        console.warn(`Quét thất bại: ${error}`);
    }
});
</script>
@endsection 