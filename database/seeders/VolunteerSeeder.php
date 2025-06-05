<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Volunteer;
use Carbon\Carbon;

class VolunteerSeeder extends Seeder
{
    public function run(): void
    {
        Volunteer::create([
            'volunteer_id' => "32355071-47b2-48bd-90b2-8c77f3bc282d",
            'username' => 'minh01',
            'password' => Hash::make('123456'),
            'email' => 'minh01@gmail.com',
            'address' => 'Hà Nội',
            'phone' => '0912345678',
            'avatar' => "avt-Vol1.png",
            'cover' => "cover-Vol (1).jpg",
            'point' => 50,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-02-15'),
            'updated_at' => Carbon::parse('2023-02-18'),
        ]);

        Volunteer::create([
            'volunteer_id' => "cf8f4cbf-b067-4cab-b10b-ea9d37361572",
            'username' => 'an02',
            'password' => Hash::make('123456'),
            'email' => 'an02@gmail.com',
            'address' => 'Đà Nẵng',
            'phone' => '0934567890',
            'avatar' => "avt-Vol2.jpg",
            'cover' => "cover-Vol (2).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-03-10'),
            'updated_at' => Carbon::parse('2023-03-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "7f2f8f95-43ea-4696-adaf-6371757f4fec",
            'username' => 'phuc03',
            'password' => Hash::make('123456'),
            'email' => 'phuc03@gmail.com',
            'address' => 'TP. HCM',
            'phone' => '0901234567',
            'avatar' => "avt-Vol3.png",
            'cover' => "cover-Vol (3).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-04-01'),
            'updated_at' => Carbon::parse('2023-04-01'),
        ]);

        Volunteer::create([
            'volunteer_id' => "fcfa6dc1-4704-4584-a6f1-3dd720456288",
            'username' => 'khoa04',
            'password' => Hash::make('123456'),
            'email' => 'khoa04@gmail.com',
            'address' => 'Huế',
            'phone' => '0987654321',
            'avatar' => "avt-Vol4.jpg",
            'cover' => "cover-Vol (4).jpg",
            'point' => 80,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-05-10'),
            'updated_at' => Carbon::parse('2023-05-15'),
        ]);

        Volunteer::create([
            'volunteer_id' => "6ac50f50-a42e-418c-af7e-95ccb6c41625",
            'username' => 'hieu05',
            'password' => Hash::make('123456'),
            'email' => 'hieu05@gmail.com',
            'address' => 'Cần Thơ',
            'phone' => '0968123456',
            'avatar' => "avt-Vol5.jpg",
            'cover' => "cover-Vol (5).jpg",
            'point' => 50,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-06-05'),
            'updated_at' => Carbon::parse('2023-06-08'),
        ]);

        Volunteer::create([
            'volunteer_id' => "8b02260f-061b-4686-87f2-197a6f32eecc",
            'username' => 'long06',
            'password' => Hash::make('123456'),
            'email' => 'long06@gmail.com',
            'address' => 'Hải Phòng',
            'phone' => '0977988888',
            'avatar' => "avt-Vol6.jpg",
            'cover' => "cover-Vol (6).jpg",
            'point' => 90,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-07-01'),
            'updated_at' => Carbon::parse('2023-07-02'),
        ]);

        Volunteer::create([
            'volunteer_id' => "44a2192e-b6cb-4046-a676-40287b8e3295",
            'username' => 'quan07',
            'password' => Hash::make('123456'),
            'email' => 'quan07@gmail.com',
            'address' => 'Quảng Ninh',
            'phone' => '0911222333',
            'avatar' => "avt-Vol7.jpg",
            'cover' => "cover-Vol (7).jpg",
            'point' => 0,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-08-20'),
            'updated_at' => Carbon::parse('2023-08-21'),
        ]);

        Volunteer::create([
            'volunteer_id' => "c34c0310-a8a3-40c8-9065-c7163b34bf2a",
            'username' => 'nam08',
            'password' => Hash::make('123456'),
            'email' => 'nam08@gmail.com',
            'address' => 'Lào Cai',
            'phone' => '0944332211',
            'avatar' => "avt-Vol8.jpg",
            'cover' => "cover-Vol (8).jpg",
            'point' => 80,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-09-05'),
            'updated_at' => Carbon::parse('2023-09-10'),
        ]);

        Volunteer::create([
            'volunteer_id' => "c10a78d6-3cc7-4de4-bb7a-afa3d99128b7",
            'username' => 'tuan09',
            'password' => Hash::make('123456'),
            'email' => 'tuan09@gmail.com',
            'address' => 'Bình Định',
            'phone' => '0938392929',
            'avatar' => "avt-Vol9.jpg",
            'cover' => "cover-Vol (9).jpg",
            'point' => 10,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-10-01'),
            'updated_at' => Carbon::parse('2023-10-03'),
        ]);

        Volunteer::create([
            'volunteer_id' => "245f61ce-04cd-4450-af64-28b46b608c2c",
            'username' => 'bao10',
            'password' => Hash::make('123456'),
            'email' => 'bao10@gmail.com',
            'address' => 'Vĩnh Long',
            'phone' => '0922233445',
            'avatar' => "avt-Vol10.jpg",
            'cover' => "cover-Vol (10).jpg",
            'point' => 75,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-11-11'),
            'updated_at' => Carbon::parse('2023-11-15'),
        ]);

        Volunteer::create([
            'volunteer_id' => "c8184928-56fb-4dae-b8f5-3980816ce1be",
            'username' => 'linh11',
            'password' => Hash::make('123456'),
            'email' => 'linh11@gmail.com',
            'address' => 'Hà Nội',
            'phone' => '0911444555',
            'avatar' => "avt-Vol11.jpg",
            'cover' => "cover-Vol (11).jpg",
            'point' => 55,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-01-10'),
            'updated_at' => Carbon::parse('2024-01-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "37dc84d4-5539-461f-acae-e2e3b0ba3023",
            'username' => 'thu12',
            'password' => Hash::make('123456'),
            'email' => 'thu12@gmail.com',
            'address' => 'TP. HCM',
            'phone' => '0907778899',
            'avatar' => "avt-Vol12.jpg",
            'cover' => "cover-Vol (12).jpg",
            'point' => 20,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-02-01'),
            'updated_at' => Carbon::parse('2024-02-03'),
        ]);

        Volunteer::create([
            'volunteer_id' => "ff831a23-0c07-4237-95b7-ca719992f777",
            'username' => 'dai13',
            'password' => Hash::make('123456'),
            'email' => 'dai13@gmail.com',
            'address' => 'Hà Giang',
            'phone' => '0966112233',
            'avatar' => "avt-Vol13.jpg",
            'cover' => "cover-Vol (13).jpg",
            'point' => 40,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-03-01'),
            'updated_at' => Carbon::parse('2024-03-01'),
        ]);

        Volunteer::create([
            'volunteer_id' => "f6014bd9-72f4-40f9-bd15-03ceedd06836",
            'username' => 'thuong14',
            'password' => Hash::make('123456'),
            'email' => 'thuong14@gmail.com',
            'address' => 'Hòa Bình',
            'phone' => '0910008888',
            'avatar' => "avt-Vol14.jpg",
            'cover' => "cover-Vol (14).jpg",
            'point' => 90,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-03-12'),
            'updated_at' => Carbon::parse('2024-03-14'),
        ]);

        Volunteer::create([
            'volunteer_id' => "e886cf15-1ea9-44a4-b1ba-dc28e0e1c7e8",
            'username' => 'ngoc15',
            'password' => Hash::make('123456'),
            'email' => 'ngoc15@gmail.com',
            'address' => 'Lâm Đồng',
            'phone' => '0977766677',
            'avatar' => "avt-Vol15.jpg",
            'cover' => "cover-Vol (15).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-04-05'),
            'updated_at' => Carbon::parse('2024-04-06'),
        ]);

        Volunteer::create([
            'volunteer_id' => "87f12ed1-2359-4a78-8ad4-1d2395755494",
            'username' => 'bao16',
            'password' => Hash::make('123456'),
            'email' => 'bao16@gmail.com',
            'address' => 'Thái Bình',
            'phone' => '0928383838',
            'avatar' => "avt-Vol16.jpg",
            'cover' => "cover-Vol (16).jpg",
            'point' => 75,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-05-01'),
            'updated_at' => Carbon::parse('2024-05-03'),
        ]);

        Volunteer::create([
            'volunteer_id' => "812d83ee-b97c-46be-bbe3-73d518f9cba1",
            'username' => 'my17',
            'password' => Hash::make('123456'),
            'email' => 'my17@gmail.com',
            'address' => 'Nam Định',
            'phone' => '0909001122',
            'avatar' => "avt-Vol17.jpg",
            'cover' => "cover-Vol (17).jpg",
            'point' => 95,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-06-06'),
            'updated_at' => Carbon::parse('2024-06-07'),
        ]);

        Volunteer::create([
            'volunteer_id' => "063c4bac-c8ef-423c-85d7-744c11e83682",
            'username' => 'van18',
            'password' => Hash::make('123456'),
            'email' => 'van18@gmail.com',
            'address' => 'Phú Thọ',
            'phone' => '0911121212',
            'avatar' => "avt-Vol18.jpg",
            'cover' => "cover-Vol (18).jpg",
            'point' => 10,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-07-07'),
            'updated_at' => Carbon::parse('2024-07-10'),
        ]);

        Volunteer::create([
            'volunteer_id' => "e6cecfb4-599f-4c9f-a973-47b86ba9817b",
            'username' => 'phat19',
            'password' => Hash::make('123456'),
            'email' => 'phat19@gmail.com',
            'address' => 'Ninh Bình',
            'phone' => '0939939393',
            'avatar' => "avt-Vol19.jpg",
            'cover' => "cover-Vol (19).jpg",
            'point' => 85,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-08-08'),
            'updated_at' => Carbon::parse('2024-08-10'),
        ]);

        Volunteer::create([
            'volunteer_id' => "b83b640d-b33d-4a50-b9f2-e630a0b238d4",
            'username' => 'hanh20',
            'password' => Hash::make('123456'),
            'email' => 'hanh20@gmail.com',
            'address' => 'Bắc Giang',
            'phone' => '0988777666',
            'avatar' => "avt-Vol20.jpg",
            'cover' => "cover-Vol (20).jpg",
            'point' => 50,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-09-09'),
            'updated_at' => Carbon::parse('2024-09-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "b4a06b82-8471-45bb-86b7-da2fe022d1a7",
            'username' => 'loan21',
            'password' => Hash::make('123456'),
            'email' => 'loan21@gmail.com',
            'address' => 'Nghệ An',
            'phone' => '0911221122',
            'avatar' => "avt-Vol21.jpg",
            'cover' => "cover-Vol (21).jpg",
            'point' => 60,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-10-01'),
            'updated_at' => Carbon::parse('2024-10-03'),
        ]);

        Volunteer::create([
            'volunteer_id' => "74056ecd-a218-4473-9205-57f9ef951f82",
            'username' => 'nhan22',
            'password' => Hash::make('123456'),
            'email' => 'nhan22@gmail.com',
            'address' => 'Kon Tum',
            'phone' => '0933445566',
            'avatar' => "avt-Vol22.jpg",
            'cover' => "cover-Vol (22).jpg",
            'point' => 5,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-10-20'),
            'updated_at' => Carbon::parse('2024-10-22'),
        ]);

        Volunteer::create([
            'volunteer_id' => "7f6b1d7d-c0c8-464a-8e06-1594882a0c5e",
            'username' => 'ha23',
            'password' => Hash::make('123456'),
            'email' => 'ha23@gmail.com',
            'address' => 'Thừa Thiên Huế',
            'phone' => '0909887766',
            'avatar' => "avt-Vol23.jpg",
            'cover' => "cover-Vol (23).jpg",
            'point' => 90,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-11-05'),
            'updated_at' => Carbon::parse('2024-11-08'),
        ]);

        Volunteer::create([
            'volunteer_id' => "c64e7bfe-544e-4f3f-b821-2e794cebd3bb",
            'username' => 'hung24',
            'password' => Hash::make('123456'),
            'email' => 'hung24@gmail.com',
            'address' => 'Yên Bái',
            'phone' => '0977234567',
            'avatar' => "avt-Vol24.jpg",
            'cover' => "cover-Vol (24).jpg",
            'point' => 32,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-12-01'),
            'updated_at' => Carbon::parse('2024-12-03'),
        ]);

        Volunteer::create([
            'volunteer_id' => "dcad1156-39f1-417a-a3ed-1f01be2a8422",
            'username' => 'mai25',
            'password' => Hash::make('123456'),
            'email' => 'mai25@gmail.com',
            'address' => 'An Giang',
            'phone' => '0966778899',
            'avatar' => "avt-Vol25.jpg",
            'cover' => "cover-Vol (25).jpg",
            'point' => 50,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-01-10'),
            'updated_at' => Carbon::parse('2025-01-11'),
        ]);

        Volunteer::create([
            'volunteer_id' => "2e682898-73a4-41c2-b4a5-8ce21296b94c",
            'username' => 'thanh26',
            'password' => Hash::make('123456'),
            'email' => 'thanh26@gmail.com',
            'address' => 'Lạng Sơn',
            'phone' => '0912233445',
            'avatar' => "avt-Vol26.jpg",
            'cover' => "cover-Vol (26).jpg",
            'point' => 5,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-02-01'),
            'updated_at' => Carbon::parse('2025-02-02'),
        ]);

        Volunteer::create([
            'volunteer_id' => "66fda81a-450c-42e2-8ce5-7db238c8026c",
            'username' => 'tam27',
            'password' => Hash::make('123456'),
            'email' => 'tam27@gmail.com',
            'address' => 'Bình Phước',
            'phone' => '0922123456',
            'avatar' => "avt-Vol27.jpg",
            'cover' => "cover-Vol (27).jpg",
            'point' => 88,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-02-10'),
            'updated_at' => Carbon::parse('2025-02-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "6acdeb4d-ffd0-4d3a-ab55-002776c70f45",
            'username' => 'yen28',
            'password' => Hash::make('123456'),
            'email' => 'yen28@gmail.com',
            'address' => 'Trà Vinh',
            'phone' => '0944112233',
            'avatar' => "avt-Vol28.jpg",
            'cover' => "cover-Vol (28).jpg",
            'point' => 92,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-03-01'),
            'updated_at' => Carbon::parse('2025-03-01'),
        ]);

        Volunteer::create([
            'volunteer_id' => "bd65444d-dd0c-4a54-9960-110af7eaccee",
            'username' => 'giang29',
            'password' => Hash::make('123456'),
            'email' => 'giang29@gmail.com',
            'address' => 'Quảng Nam',
            'phone' => '0933447788',
            'avatar' => "avt-Vol29.jpg",
            'cover' => "cover-Vol (29).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-03-20'),
            'updated_at' => Carbon::parse('2025-03-21'),
        ]);

        Volunteer::create([
            'volunteer_id' => "4d2f2887-f209-4b3f-9a08-17626b085b29",
            'username' => 'lam30',
            'password' => Hash::make('123456'),
            'email' => 'lam30@gmail.com',
            'address' => 'Phú Yên',
            'phone' => '0911445566',
            'avatar' => "avt-Vol30.jpg",
            'cover' => "cover-Vol (30).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-05'),
            'updated_at' => Carbon::parse('2025-04-05'),
        ]);

        Volunteer::create([
            'volunteer_id' => "371ef0a6-08b1-424c-b80b-7f1d24d5d6cc",
            'username' => 'thao31',
            'password' => Hash::make('123456'),
            'email' => 'thao31@gmail.com',
            'address' => 'Tuyên Quang',
            'phone' => '0988997766',
            'avatar' => "avt-Vol31.jpg",
            'cover' => "cover-Vol (31).jpg",
            'point' => 78,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-10'),
            'updated_at' => Carbon::parse('2025-04-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "4e6c0ebe-7056-42d0-8138-4b215ea31ed5",
            'username' => 'binh32',
            'password' => Hash::make('123456'),
            'email' => 'binh32@gmail.com',
            'address' => 'Hậu Giang',
            'phone' => '0966885544',
            'avatar' => "avt-Vol32.jpg",
            'cover' => "cover-Vol (32).jpg",
            'point' => 10,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-15'),
            'updated_at' => Carbon::parse('2025-04-16'),
        ]);

        Volunteer::create([
            'volunteer_id' => "f7205243-4c32-4074-916e-fa20ee3189dc",
            'username' => 'phuong33',
            'password' => Hash::make('123456'),
            'email' => 'phuong33@gmail.com',
            'address' => 'Sóc Trăng',
            'phone' => '0922889966',
            'avatar' => "avt-Vol33.jpg",
            'cover' => "cover-Vol (33).jpg",
            'point' => 90,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-18'),
            'updated_at' => Carbon::parse('2025-04-20'),
        ]);

        Volunteer::create([
            'volunteer_id' => "9db01909-7263-488e-bcd1-15e040ed5c5f",
            'username' => 'hieu34',
            'password' => Hash::make('123456'),
            'email' => 'hieu34@gmail.com',
            'address' => 'Bạc Liêu',
            'phone' => '0907886555',
            'avatar' => "avt-Vol34.jpg",
            'cover' => "cover-Vol (34).jpg",
            'point' => 75,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-21'),
            'updated_at' => Carbon::parse('2025-04-21'),
        ]);

        Volunteer::create([
            'volunteer_id' => "25b42ce4-fd29-480e-914a-47e4c8d9948a",
            'username' => 'nga35',
            'password' => Hash::make('123456'),
            'email' => 'nga35@gmail.com',
            'address' => 'Bến Tre',
            'phone' => '0911888999',
            'avatar' => "avt-Vol35.jpg",
            'cover' => "cover-Vol (35).jpg",
            'point' => 50,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-04-25'),
            'updated_at' => Carbon::parse('2025-04-26'),
        ]);

        Volunteer::create([
            'volunteer_id' => "8fa68d56-a1ba-4c4c-adf7-8cb1798bc72d",
            'username' => 'tuan36',
            'password' => Hash::make('123456'),
            'email' => 'tuan36@gmail.com',
            'address' => 'Đắk Lắk',
            'phone' => '0912223344',
            'avatar' => "avt-Vol36.jpg",
            'cover' => "cover-Vol (36).jpg",
            'point' => 20,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-03-01'),
            'updated_at' => Carbon::parse('2025-03-01'),
        ]);

        Volunteer::create([
            'volunteer_id' => "a38adfc9-516e-43d3-ac49-5e377c7bc6ff",
            'username' => 'anhthu37',
            'password' => Hash::make('123456'),
            'email' => 'anhthu37@gmail.com',
            'address' => 'Đồng Nai',
            'phone' => '0933224455',
            'avatar' => "avt-Vol37.jpg",
            'cover' => "cover-Vol (37).jpg",
            'point' => 45,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-02-20'),
            'updated_at' => Carbon::parse('2025-02-22'),
        ]);

        Volunteer::create([
            'volunteer_id' => "2a8a64c7-6793-47c0-a735-c7b5e8f79d49",
            'username' => 'hoang38',
            'password' => Hash::make('123456'),
            'email' => 'hoang38@gmail.com',
            'address' => 'Bình Thuận',
            'phone' => '0944556677',
            'avatar' => "avt-Vol38.jpg",
            'cover' => "cover-Vol (38).jpg",
            'point' => 16,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2025-01-10'),
            'updated_at' => Carbon::parse('2025-01-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "44f62172-db7c-4371-b22c-a1ef58507bab",
            'username' => 'trang39',
            'password' => Hash::make('123456'),
            'email' => 'trang39@gmail.com',
            'address' => 'Hà Tĩnh',
            'phone' => '0966771122',
            'avatar' => "avt-Vol39.jpg",
            'cover' => "cover-Vol (39).jpg",
            'point' => 65,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-12-25'),
            'updated_at' => Carbon::parse('2024-12-27'),
        ]);

        Volunteer::create([
            'volunteer_id' => "62faf6a6-f2b5-41b7-95ef-67f0654be540",
            'username' => 'phuc40',
            'password' => Hash::make('123456'),
            'email' => 'phuc40@gmail.com',
            'address' => 'Nam Định',
            'phone' => '0977338999',
            'avatar' => "avt-Vol40.jpg",
            'cover' => "cover-Vol (40).jpg",
            'point' => 98,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-11-15'),
            'updated_at' => Carbon::parse('2024-11-17'),
        ]);

        Volunteer::create([
            'volunteer_id' => "e5b2b414-6065-46e3-a9da-772c7df1dc6d",
            'username' => 'my41',
            'password' => Hash::make('123456'),
            'email' => 'my41@gmail.com',
            'address' => 'Hưng Yên',
            'phone' => '0913445566',
            'avatar' => "avt-Vol41.jpg",
            'cover' => "cover-Vol (41).jpg",
            'point' => 12,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-10-05'),
            'updated_at' => Carbon::parse('2024-10-05'),
        ]);

        Volunteer::create([
            'volunteer_id' => "c04e65d7-4cfa-489f-b5a8-baaee507142f",
            'username' => 'vuong42',
            'password' => Hash::make('123456'),
            'email' => 'vuong42@gmail.com',
            'address' => 'Phú Thọ',
            'phone' => '0933991122',
            'avatar' => "avt-Vol42.jpg",
            'cover' => "cover-Vol (42).jpg",
            'point' => 84,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-08-20'),
            'updated_at' => Carbon::parse('2024-08-22'),
        ]);

        Volunteer::create([
            'volunteer_id' => "678de664-5441-49a7-89ed-4662ec2656e7",
            'username' => 'minhthu43',
            'password' => Hash::make('123456'),
            'email' => 'minhthu43@gmail.com',
            'address' => 'Ninh Bình',
            'phone' => '0988997744',
            'avatar' => "avt-Vol43.jpg",
            'cover' =>  "cover-Vol (43).jpg",
            'point' => 15,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-07-11'),
            'updated_at' => Carbon::parse('2024-07-11'),
        ]);

        Volunteer::create([
            'volunteer_id' => "ac215121-f863-4377-b352-1f8d17202061",
            'username' => 'kien44',
            'password' => Hash::make('123456'),
            'email' => 'kien44@gmail.com',
            'address' => 'Vĩnh Phúc',
            'phone' => '0909773322',
            'avatar' => "avt-Vol44.jpg",
            'cover' => "cover-Vol (44).jpg",
            'point' => 76,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-05-25'),
            'updated_at' => Carbon::parse('2024-05-27'),
        ]);

        Volunteer::create([
            'volunteer_id' => "e567ea93-8707-42be-bf44-8633f257bf9d",
            'username' => 'hien45',
            'password' => Hash::make('123456'),
            'email' => 'hien45@gmail.com',
            'address' => 'Hà Nam',
            'phone' => '0944557788',
            'avatar' => "avt-Vol45.jpg",
            'cover' => "cover-Vol (45).jpg",
            'point' => 40,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-04-14'),
            'updated_at' => Carbon::parse('2024-04-15'),
        ]);

        Volunteer::create([
            'volunteer_id' => "5a7d20fb-7cf1-4583-bb10-65de7140b386",
            'username' => 'trieu46',
            'password' => Hash::make('123456'),
            'email' => 'trieu46@gmail.com',
            'address' => 'Thái Bình',
            'phone' => '0922337788',
            'avatar' => "avt-Vol46.jpg",
            'cover' => "cover-Vol (46).jpg",
            'point' => 58,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-03-10'),
            'updated_at' => Carbon::parse('2024-03-11'),
        ]);

        Volunteer::create([
            'volunteer_id' => "26927dc6-4473-456f-9cf0-4bd3238d34b8",
            'username' => 'thuong47',
            'password' => Hash::make('123456'),
            'email' => 'thuong47@gmail.com',
            'address' => 'Bình Định',
            'phone' => '0966991122',
            'avatar' => "avt-Vol47.jpg",
            'cover' => "cover-Vol (47).jpg",
            'point' => 70,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-02-01'),
            'updated_at' => Carbon::parse('2024-02-01'),
        ]);

        Volunteer::create([
            'volunteer_id' => "a7592edf-1894-4187-93bd-a995a70365e8",
            'username' => 'thienan48',
            'password' => Hash::make('123456'),
            'email' => 'thienan48@gmail.com',
            'address' => 'Cà Mau',
            'phone' => '0912334455',
            'avatar' => "avt-Vol48.jpg",
            'cover' => "cover-Vol (48).jpg",
            'point' => 87,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2024-01-10'),
            'updated_at' => Carbon::parse('2024-01-12'),
        ]);

        Volunteer::create([
            'volunteer_id' => "ac796b00-f132-43e1-8311-17cced0610d8",
            'username' => 'xuan49',
            'password' => Hash::make('123456'),
            'email' => 'xuan49@gmail.com',
            'address' => 'Tiền Giang',
            'phone' => '0977885544',
            'avatar' => "avt-Vol49.jpg",
            'cover' => "cover-Vol (49).jpg",
            'point' => 4,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-12-12'),
            'updated_at' => Carbon::parse('2023-12-13'),
        ]);

        Volunteer::create([
            'volunteer_id' => "a2b692fc-1a3d-4c07-b23b-71ce0c0d0c43",
            'username' => 'dao50',
            'password' => Hash::make('123456'),
            'email' => 'dao50@gmail.com',
            'address' => 'Kiên Giang',
            'phone' => '0955667788',
            'avatar' => "avt-Vol50.jpg",
            'cover' => "cover-Vol (50).jpg",
            'point' => 60,
            'role' => 'volunteer',
            'created_at' => Carbon::parse('2023-11-01'),
            'updated_at' => Carbon::parse('2023-11-03'),
        ]);
    }
}
