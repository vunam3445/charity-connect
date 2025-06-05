@extends('layouts.master')

@section('title', 'Giới thiệu - HUCE Charity')

@section('content')
<div class="container-fluid">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="about-hero" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0; border-radius: 15px; color: white; text-align: center;">
                <h1 class="display-4 font-weight-bold mb-4">
                    <i class="fas fa-heart text-danger"></i>
                    Về HUCE Charity
                </h1>
                <p class="lead">Kết nối những trái tim nhân ái, xây dựng cộng đồng tương trợ</p>
            </div>
        </div>
    </div>

    <!-- Mission Section -->
    <div class="row mb-5">
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-bullseye fa-3x text-primary"></i>
                    </div>
                    <h3 class="text-center mb-3">Sứ mệnh</h3>
                    <p class="text-muted">
                        HUCE Charity là nền tảng kết nối các tổ chức từ thiện và tình nguyện viên, 
                        nhằm tạo ra những hoạt động thiện nguyện có ý nghĩa và tác động tích cực đến cộng đồng. 
                        Chúng tôi tin rằng mỗi người đều có thể đóng góp vào việc xây dựng một xã hội tốt đẹp hơn.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-eye fa-3x text-success"></i>
                    </div>
                    <h3 class="text-center mb-3">Tầm nhìn</h3>
                    <p class="text-muted">
                        Trở thành nền tảng hàng đầu tại Việt Nam trong việc kết nối và tổ chức các hoạt động từ thiện, 
                        góp phần xây dựng một cộng đồng đoàn kết, tương trợ lẫn nhau và phát triển bền vững.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-5">Giá trị cốt lõi</h2>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                    <h5>Đoàn kết</h5>
                    <p class="text-muted">Kết nối mọi người cùng chung tay vì cộng đồng</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-shield-alt fa-3x text-info mb-3"></i>
                    <h5>Minh bạch</h5>
                    <p class="text-muted">Công khai, rõ ràng trong mọi hoạt động</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                    <h5>Tình yêu thương</h5>
                    <p class="text-muted">Lan tỏa yêu thương đến mọi người</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm text-center h-100">
                <div class="card-body p-4">
                    <i class="fas fa-star fa-3x text-primary mb-3"></i>
                    <h5>Chất lượng</h5>
                    <p class="text-muted">Cam kết chất lượng trong từng hoạt động</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="stats-section" style="background: linear-gradient(135deg, #ff7e5f 0%, #feb47b 100%); padding: 60px 0; border-radius: 15px; color: white;">
                <div class="container">
                    <h2 class="text-center mb-5">Thành tựu của chúng tôi</h2>
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-item">
                                <h2 class="display-4 font-weight-bold">500+</h2>
                                <p class="lead">Tình nguyện viên</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-item">
                                <h2 class="display-4 font-weight-bold">100+</h2>
                                <p class="lead">Tổ chức từ thiện</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-item">
                                <h2 class="display-4 font-weight-bold">1000+</h2>
                                <p class="lead">Sự kiện đã tổ chức</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="stat-item">
                                <h2 class="display-4 font-weight-bold">50,000+</h2>
                                <p class="lead">Người được hỗ trợ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-5">Đội ngũ phát triển</h2>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm text-center">
                        <div class="card-body p-4">
                            <div class="team-avatar mb-3">
                                <i class="fas fa-user-circle fa-5x text-primary"></i>
                            </div>
                            <h5>Sinh viên HUCE</h5>
                            <p class="text-muted">Đội ngũ phát triển</p>
                            <p class="small">Được phát triển bởi sinh viên Đại học Xây dựng Hà Nội với mong muốn đóng góp cho cộng đồng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact CTA -->
    <div class="row">
        <div class="col-12">
            <div class="cta-section text-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 40px; border-radius: 15px; color: white;">
                <h2 class="mb-3">Tham gia cùng chúng tôi</h2>
                <p class="lead mb-4">Hãy cùng chúng tôi tạo nên những thay đổi tích cực cho cộng đồng</p>
                <div class="btn-group" role="group">
                    <a href="/contact" class="btn btn-light btn-lg mr-3">
                        <i class="fas fa-envelope"></i> Liên hệ với chúng tôi
                    </a>
                    <a href="/events/approved" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calendar"></i> Tham gia sự kiện
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
}

.stat-item h2 {
    margin-bottom: 10px;
}

.team-avatar i {
    transition: color 0.3s ease;
}

.team-avatar:hover i {
    color: #667eea !important;
}

.btn-group .btn {
    margin: 0 10px;
}

@media (max-width: 768px) {
    .about-hero {
        padding: 40px 20px !important;
    }
    
    .stats-section {
        padding: 40px 20px !important;
    }
    
    .cta-section {
        padding: 40px 20px !important;
    }
    
    .btn-group {
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 5px 0;
    }
}
</style>
@endsection
