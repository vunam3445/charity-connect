<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Organization;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        Organization::create([
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'username' => 'tuthien_hn',
            'password' => Hash::make('123456'),
            'email' => 'tuthienhn@example.com',
            'address' => 'Hà Nội',
            'phone' => '0123456789',
            'founded_at' => '2020-01-01',
            'representative' => 'Nguyễn Văn Hiếu',
            'description' => 'Tổ chức thiện nguyện chuyên hỗ trợ người vô gia cư và trẻ em lang thang tại Hà Nội.',
            'avatar' => "avaOrg1.jpg",
            'cover' => "coverOrg1.jpg",
            'website' => 'https://tuthienhn.org',
            'approved' => 'approved',
            'role' => 'organization',
            'note' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Organization::create([
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'username' => 'trai_tim_mien_nam',
            'password' => Hash::make('123456'),
            'email' => 'traitim@example.com',
            'address' => 'TP. HCM',
            'phone' => '0911111111',
            'founded_at' => '2018-05-20',
            'representative' => 'Trần Văn Nam',
            'description' => 'Mang yêu thương đến với cộng đồng miền Nam qua các chương trình bữa ăn và chăm sóc sức khỏe.',
            'avatar' => "avaOrg2.jpg",
            'cover' => "coverOrg2.jpg",
            'website' => 'https://traitimmiennam.vn',
            'approved' => 'approved',
            'role' => 'organization',
            'note' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Organization::create([
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'username' => 'sach_va_niem_tin',
            'password' => Hash::make('123456'),
            'email' => 'sachniem@example.com',
            'address' => 'Đà Nẵng',
            'phone' => '0922222222',
            'founded_at' => '2019-07-10',
            'representative' => 'Phan Văn Quyết',
            'description' => 'Chuyên tổ chức chương trình tặng sách, lớp học kỹ năng cho trẻ em nghèo vùng ven biển.',
            'avatar' => "avaOrg3.jpg",
            'cover' => "coverOrg3.jpg",
            'website' => 'https://sachvaniemtin.org',
            'approved' => 'approved',
            'role' => 'organization',
            'note' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Organization::create([
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'username' => 'anh_sang_vung_cao',
            'password' => Hash::make('123456'),
            'email' => 'anhvang@example.com',
            'address' => 'Cần Thơ',
            'phone' => '0933333333',
            'founded_at' => '2021-03-15',
            'representative' => 'Lê Văn Quang',
            'description' => 'Hỗ trợ học sinh vùng cao bằng các chương trình tặng đèn học, sách vở và học bổng.',
            'avatar' => "avaOrg4.jpg",
            'cover' => "coverOrg4.jpg",
            'website' => 'https://anhsangvungcao.vn',
            'approved' => 'approved',
            'role' => 'organization',
            'note' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Organization::create([
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'username' => 'nu_cuoi_tu_te',
            'password' => Hash::make('123456'),
            'email' => 'nucuoi@example.com',
            'address' => 'Hải Phòng',
            'phone' => '0944444444',
            'founded_at' => '2022-08-01',
            'representative' => 'Ngô Văn Quý',
            'description' => 'Tạo ra những nụ cười bằng các hoạt động chăm sóc bệnh nhân, hỗ trợ giáo dục và đời sống.',
            'avatar' => "avaOrg5.jpg",
            'cover' => "coverOrg5.jpg",
            'website' => 'https://nucuoitute.org',
            'approved' => 'approved',
            'role' => 'organization',
            'note' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
