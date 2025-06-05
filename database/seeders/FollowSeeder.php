<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FollowSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '32355071-47b2-48bd-90b2-8c77f3bc282d',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '32355071-47b2-48bd-90b2-8c77f3bc282d',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'cf8f4cbf-b067-4cab-b10b-ea9d37361572',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f2f8f95-43ea-4696-adaf-6371757f4fec',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f2f8f95-43ea-4696-adaf-6371757f4fec',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f2f8f95-43ea-4696-adaf-6371757f4fec',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f2f8f95-43ea-4696-adaf-6371757f4fec',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'fcfa6dc1-4704-4584-a6f1-3dd720456288',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'fcfa6dc1-4704-4584-a6f1-3dd720456288',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'fcfa6dc1-4704-4584-a6f1-3dd720456288',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6ac50f50-a42e-418c-af7e-95ccb6c41625',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6ac50f50-a42e-418c-af7e-95ccb6c41625',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6ac50f50-a42e-418c-af7e-95ccb6c41625',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6ac50f50-a42e-418c-af7e-95ccb6c41625',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '8b02260f-061b-4686-87f2-197a6f32eecc',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '8b02260f-061b-4686-87f2-197a6f32eecc',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '8b02260f-061b-4686-87f2-197a6f32eecc',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '8b02260f-061b-4686-87f2-197a6f32eecc',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44a2192e-b6cb-4046-a676-40287b8e3295',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44a2192e-b6cb-4046-a676-40287b8e3295',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44a2192e-b6cb-4046-a676-40287b8e3295',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44a2192e-b6cb-4046-a676-40287b8e3295',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c34c0310-a8a3-40c8-9065-c7163b34bf2a',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c10a78d6-3cc7-4de4-bb7a-afa3d99128b7',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c10a78d6-3cc7-4de4-bb7a-afa3d99128b7',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '245f61ce-04cd-4450-af64-28b46b608c2c',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c8184928-56fb-4dae-b8f5-3980816ce1be',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c8184928-56fb-4dae-b8f5-3980816ce1be',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c8184928-56fb-4dae-b8f5-3980816ce1be',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '37dc84d4-5539-461f-acae-e2e3b0ba3023',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ff831a23-0c07-4237-95b7-ca719992f777',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ff831a23-0c07-4237-95b7-ca719992f777',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ff831a23-0c07-4237-95b7-ca719992f777',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ff831a23-0c07-4237-95b7-ca719992f777',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ff831a23-0c07-4237-95b7-ca719992f777',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'f6014bd9-72f4-40f9-bd15-03ceedd06836',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'f6014bd9-72f4-40f9-bd15-03ceedd06836',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'f6014bd9-72f4-40f9-bd15-03ceedd06836',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e886cf15-1ea9-44a4-b1ba-dc28e0e1c7e8',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e886cf15-1ea9-44a4-b1ba-dc28e0e1c7e8',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '87f12ed1-2359-4a78-8ad4-1d2395755494',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '87f12ed1-2359-4a78-8ad4-1d2395755494',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '87f12ed1-2359-4a78-8ad4-1d2395755494',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '87f12ed1-2359-4a78-8ad4-1d2395755494',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '87f12ed1-2359-4a78-8ad4-1d2395755494',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '812d83ee-b97c-46be-bbe3-73d518f9cba1',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '812d83ee-b97c-46be-bbe3-73d518f9cba1',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '063c4bac-c8ef-423c-85d7-744c11e83682',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '063c4bac-c8ef-423c-85d7-744c11e83682',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '063c4bac-c8ef-423c-85d7-744c11e83682',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e6cecfb4-599f-4c9f-a973-47b86ba9817b',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'b83b640d-b33d-4a50-b9f2-e630a0b238d4',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'b4a06b82-8471-45bb-86b7-da2fe022d1a7',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '74056ecd-a218-4473-9205-57f9ef951f82',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f6b1d7d-c0c8-464a-8e06-1594882a0c5e',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f6b1d7d-c0c8-464a-8e06-1594882a0c5e',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '7f6b1d7d-c0c8-464a-8e06-1594882a0c5e',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c64e7bfe-544e-4f3f-b821-2e794cebd3bb',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c64e7bfe-544e-4f3f-b821-2e794cebd3bb',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c64e7bfe-544e-4f3f-b821-2e794cebd3bb',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'dcad1156-39f1-417a-a3ed-1f01be2a8422',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'dcad1156-39f1-417a-a3ed-1f01be2a8422',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'dcad1156-39f1-417a-a3ed-1f01be2a8422',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'dcad1156-39f1-417a-a3ed-1f01be2a8422',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2e682898-73a4-41c2-b4a5-8ce21296b94c',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2e682898-73a4-41c2-b4a5-8ce21296b94c',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2e682898-73a4-41c2-b4a5-8ce21296b94c',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2e682898-73a4-41c2-b4a5-8ce21296b94c',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2e682898-73a4-41c2-b4a5-8ce21296b94c',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '66fda81a-450c-42e2-8ce5-7db238c8026c',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6acdeb4d-ffd0-4d3a-ab55-002776c70f45',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6acdeb4d-ffd0-4d3a-ab55-002776c70f45',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6acdeb4d-ffd0-4d3a-ab55-002776c70f45',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '6acdeb4d-ffd0-4d3a-ab55-002776c70f45',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'bd65444d-dd0c-4a54-9960-110af7eaccee',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'bd65444d-dd0c-4a54-9960-110af7eaccee',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'bd65444d-dd0c-4a54-9960-110af7eaccee',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4d2f2887-f209-4b3f-9a08-17626b085b29',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4d2f2887-f209-4b3f-9a08-17626b085b29',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '371ef0a6-08b1-424c-b80b-7f1d24d5d6cc',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4e6c0ebe-7056-42d0-8138-4b215ea31ed5',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4e6c0ebe-7056-42d0-8138-4b215ea31ed5',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4e6c0ebe-7056-42d0-8138-4b215ea31ed5',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4e6c0ebe-7056-42d0-8138-4b215ea31ed5',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '4e6c0ebe-7056-42d0-8138-4b215ea31ed5',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'f7205243-4c32-4074-916e-fa20ee3189dc',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'f7205243-4c32-4074-916e-fa20ee3189dc',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '9db01909-7263-488e-bcd1-15e040ed5c5f',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '9db01909-7263-488e-bcd1-15e040ed5c5f',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '25b42ce4-fd29-480e-914a-47e4c8d9948a',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '25b42ce4-fd29-480e-914a-47e4c8d9948a',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '25b42ce4-fd29-480e-914a-47e4c8d9948a',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '25b42ce4-fd29-480e-914a-47e4c8d9948a',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '8fa68d56-a1ba-4c4c-adf7-8cb1798bc72d',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a38adfc9-516e-43d3-ac49-5e377c7bc6ff',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a38adfc9-516e-43d3-ac49-5e377c7bc6ff',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a38adfc9-516e-43d3-ac49-5e377c7bc6ff',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2a8a64c7-6793-47c0-a735-c7b5e8f79d49',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '2a8a64c7-6793-47c0-a735-c7b5e8f79d49',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44f62172-db7c-4371-b22c-a1ef58507bab',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '44f62172-db7c-4371-b22c-a1ef58507bab',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '62faf6a6-f2b5-41b7-95ef-67f0654be540',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '62faf6a6-f2b5-41b7-95ef-67f0654be540',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '62faf6a6-f2b5-41b7-95ef-67f0654be540',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e5b2b414-6065-46e3-a9da-772c7df1dc6d',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e5b2b414-6065-46e3-a9da-772c7df1dc6d',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e5b2b414-6065-46e3-a9da-772c7df1dc6d',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c04e65d7-4cfa-489f-b5a8-baaee507142f',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'c04e65d7-4cfa-489f-b5a8-baaee507142f',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '678de664-5441-49a7-89ed-4662ec2656e7',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ac215121-f863-4377-b352-1f8d17202061',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ac215121-f863-4377-b352-1f8d17202061',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'e567ea93-8707-42be-bf44-8633f257bf9d',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '5a7d20fb-7cf1-4583-bb10-65de7140b386',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '5a7d20fb-7cf1-4583-bb10-65de7140b386',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '5a7d20fb-7cf1-4583-bb10-65de7140b386',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '5a7d20fb-7cf1-4583-bb10-65de7140b386',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '5a7d20fb-7cf1-4583-bb10-65de7140b386',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '26927dc6-4473-456f-9cf0-4bd3238d34b8',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '26927dc6-4473-456f-9cf0-4bd3238d34b8',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => '26927dc6-4473-456f-9cf0-4bd3238d34b8',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a7592edf-1894-4187-93bd-a995a70365e8',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a7592edf-1894-4187-93bd-a995a70365e8',
            'organization_id' => 'b2b392fc-2a4d-4d07-b23c-41cd0c7d2c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a7592edf-1894-4187-93bd-a995a70365e8',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'ac796b00-f132-43e1-8311-17cced0610d8',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a2b692fc-1a3d-4c07-b23b-71ce0c0d0c43',
            'organization_id' => 'b2b692fd-1a4d-4c07-b23b-91ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a2b692fc-1a3d-4c07-b23b-71ce0c0d0c43',
            'organization_id' => 'b3b692ec-1a4d-4c07-b27b-41ce0c7a0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a2b692fc-1a3d-4c07-b23b-71ce0c0d0c43',
            'organization_id' => 'b2c692fc-1a6d-4c07-c23b-41ce0c7e0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('follows')->insert([
            'id' => Str::uuid(),
            'volunteer_id' => 'a2b692fc-1a3d-4c07-b23b-71ce0c0d0c43',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
