<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Result;

class ResultSeeder extends Seeder
{
    public function run(): void
    {
        $results = [
            [
                'event_id' => 'e351d301-c48a-4c8c-97a1-1a2540d617a1',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Trồng Rừng Tình Nguyện" đã thu hút hơn 60 tình nguyện viên tham gia trực tiếp trồng gần 2.000 cây xanh tại khu vực rừng bị suy thoái ở Hòa Bình. Các hoạt động truyền thông về bảo vệ rừng và kỹ năng sinh tồn trong thiên nhiên cũng nhận được phản hồi tích cực từ cộng đồng địa phương. Đây là một bước tiến nhỏ nhưng ý nghĩa trong hành trình gìn giữ và phục hồi hệ sinh thái rừng.',
                'images' => 'images/ev1A6.jpg;images/ev1A7.jpg;images/ev1A8.jpg;images/ev1A9.jpg;images/ev1A10.jpg',
            ],

            [
                'event_id' => 'a7b9f74d-056e-44c6-82cd-b8c1b9a6a0d5',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Sức Khỏe Vùng Cao – San Sẻ Yêu Thương" đã diễn ra thành công tại xã Suối Tọ, Sơn La với sự tham gia của hơn 50 tình nguyện viên và các y bác sĩ địa phương. Hơn 300 lượt người dân đã được khám sức khỏe tổng quát, cấp phát thuốc miễn phí và hướng dẫn vệ sinh cá nhân. Các hoạt động nâng cấp nhà vệ sinh trường học và hệ thống nước sạch cũng hoàn tất, tạo điều kiện sinh hoạt tốt hơn cho trẻ em nơi đây.

                Chiến dịch không chỉ mang lại giá trị thiết thực về mặt y tế mà còn tạo nên cầu nối yêu thương giữa thành thị và miền núi, lan tỏa thông điệp về lòng nhân ái và sự sẻ chia.',
                'images' => 'images/ev2A1.jpg;images/ev2A3.jpg;images/ev2A4.jpg',
            ],
            [
                'event_id' => 'e0055c4e-2ea9-4c4f-913f-75e4fa1661a3',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Trung Thu Cho Em – Vui Hội Trăng Rằm" đã diễn ra trọn vẹn tại xã Mường Lống, Kỳ Sơn, Nghệ An. Với sự góp mặt của hơn 40 tình nguyện viên, chương trình đã mang đến không khí Trung thu rộn ràng với các tiết mục văn nghệ, múa lân, làm lồng đèn, thi vẽ tranh và tặng quà cho hơn 200 em nhỏ.

                Những chiếc bánh Trung thu, lồng đèn ngộ nghĩnh cùng tình cảm ấm áp từ các tình nguyện viên đã làm nên một đêm hội ý nghĩa, chan chứa tình yêu thương. Không chỉ là một ngày lễ, chiến dịch đã gieo vào lòng các em nhỏ niềm vui, sự hứng khởi và khát vọng về một tương lai tươi sáng hơn.',
                'images' => 'images/ev3A1.jpg;images/ev3A2.jpg',
            ],
            [
                'event_id' => 'f5a322cd-f140-4c62-89d1-6f5fc594cf80',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Hành Trình Ánh Sáng – Mang Lại Niềm Tin" đã kết thúc tốt đẹp tại xã Mường Nhé, tỉnh Điện Biên. Hơn 35 tình nguyện viên đã cùng nhau tổ chức các lớp học kỹ năng mềm, các hoạt động trò chơi bổ ích và trao tặng hơn 300 suất quà gồm sách vở, đồ dùng học tập, bánh kẹo và quần áo cho các em nhỏ địa phương.

                Chiến dịch không chỉ mang lại niềm vui, tiếng cười cho trẻ em, mà còn góp phần khơi gợi tinh thần hiếu học và ước mơ vươn lên trong cuộc sống. Đây cũng là dịp để tình nguyện viên học được nhiều điều từ cuộc sống nơi vùng cao, đồng thời lan tỏa những giá trị nhân văn sâu sắc đến cộng đồng.',
                'images' => 'images/ev4A1.jpg;images/ev4A2.jpg;images/ev4A3.jpg',
            ],
            [
                'event_id' => '198da1b1-8933-49f6-a739-5fe7f593bd88',
                'result_id' => Str::uuid(),
                'content' => 'Chương trình thiện nguyện tại xã Mường Nhé đã diễn ra thành công với sự tham gia của gần 40 tình nguyện viên từ khắp nơi. Các hoạt động chính bao gồm tổ chức trò chơi tập thể, dạy học kỹ năng sống, vẽ tranh, làm thủ công, và phát hơn 300 phần quà cho các em nhỏ trong xã.

                Ngoài ra, đội ngũ tình nguyện viên cũng phối hợp với địa phương để cải tạo lại sân chơi của trường tiểu học, góp phần tạo ra không gian vui chơi an toàn, sạch đẹp cho trẻ em. Chương trình đã để lại nhiều cảm xúc sâu sắc và tiếp thêm niềm tin cho cả cộng đồng địa phương và các bạn tình nguyện viên.',
                'images' => 'images/ev5A6.jpg;images/ev5A7.jpg;images/ev5A8.jpg;images/ev5A9.jpg;images/ev5A10.jpg',
            ],

            //ms
            [
                'event_id' => '6eae53de-92e4-4a0b-877e-48b4a9a0f932',
                'result_id' => Str::uuid(),
                'content' => 'Chương trình "Bữa Trưa Cho Em 2024–2025" đã diễn ra trong không khí ấm áp, đầy yêu thương tại tỉnh Thái Nguyên. Với sự tham gia của hơn 50 tình nguyện viên, chương trình đã chuẩn bị và phát hơn 500 suất cơm trưa dinh dưỡng cho học sinh tại các điểm trường vùng cao.

                Các em nhỏ đã có một buổi trưa trọn vẹn không chỉ với những phần ăn đầy đủ mà còn với những hoạt động giao lưu sôi nổi như vẽ tranh, trò chơi vận động, và tặng sách vở, đồ dùng học tập. Nụ cười rạng rỡ trên gương mặt các em là minh chứng rõ ràng nhất cho thành công của chương trình.

                Chiến dịch lần này không chỉ mang đến giá trị vật chất mà còn lan tỏa tinh thần nhân ái đến cộng đồng, góp phần tạo nên sự gắn kết mạnh mẽ giữa các tình nguyện viên và người dân địa phương.',
                'images' => 'images/ev6A1.jpg',
            ],
            [
                'event_id' => '03a86147-43b4-4a1a-bc6d-40dbd300b8b1',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Trạm Phóng Tương Lai 3" đã diễn ra thành công tại điểm trường Ông Ngọc, xã Trà Dơn, huyện Nam Trà My. Với sự góp sức của hơn 40 tình nguyện viên từ nhiều nơi, chiến dịch đã hoàn thành việc cải tạo lại 3 phòng học, lắp đặt hệ thống điện năng lượng mặt trời giúp thắp sáng lớp học về đêm, và trao tặng hơn 300 cuốn sách, 100 bộ dụng cụ học tập cho học sinh.

                Các hoạt động giao lưu như trò chơi tập thể, vẽ tranh, múa hát cũng mang đến không khí sôi động, giúp các em nhỏ tự tin hơn và thêm yêu trường lớp. 

                Trạm Phóng Tương Lai 3 không chỉ góp phần cải thiện điều kiện học tập, mà còn để lại dấu ấn sâu sắc về tinh thần thiện nguyện, kết nối trái tim đến những vùng đất còn nhiều khó khăn.',
                'images' => 'images/ev7A6.jpg;images/ev7A7.jpg;images/ev7A8.jpg;images/ev7A9.jpg;images/ev7A10.jpg',
            ],

            [
                'event_id' => '2052a19f-ef55-4ecf-9e11-4fe7a26907cd',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Clean Up Việt Nam Lần 7" đã thành công rực rỡ với sự tham gia của hơn 200.000 tình nguyện viên trải dài trên 63 tỉnh thành và hơn 10 quốc gia. Trong ngày 08.06.2025, hàng ngàn tấn rác thải đã được thu gom tại các bãi biển, khu dân cư, rừng quốc gia và khu vực công cộng, góp phần tạo nên một môi trường sống sạch đẹp hơn.

                Chiến dịch không chỉ dừng lại ở hành động dọn rác, mà còn tổ chức các hoạt động truyền thông về bảo vệ môi trường, hội thảo cộng đồng, và các chương trình giáo dục dành cho trẻ em và thanh thiếu niên về ý thức sống xanh. Tinh thần tình nguyện lan tỏa mạnh mẽ, kết nối những con người đến từ nhiều vùng miền khác nhau cùng hành động vì một Việt Nam xanh – sạch – đẹp.

                Chiến dịch khép lại với những con số ấn tượng và để lại dấu ấn sâu sắc trong lòng mỗi người tham gia, hứa hẹn những mùa Clean Up tiếp theo sẽ còn lan rộng và mạnh mẽ hơn.',
                'images' => 'images/ev8A1.jpg;images/ev8A2.jpg;images/ev8A3.jpg',
            ],
            [
                'event_id' => '36b93b10-8593-45c2-918f-02855d2755e0',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Góp Gạo Nuôi Bé – Vùng Cao Tây Nguyên" đã khép lại thành công với nhiều kỷ niệm đẹp và cảm xúc lắng đọng. Trong suốt ba ngày, các tình nguyện viên đã cùng nhau chuẩn bị và phát hơn 900 suất cơm trưa dinh dưỡng cho các em nhỏ tại điểm trường xã Bông Krang, huyện Lắk.

                Không chỉ mang đến những bữa ăn chất lượng, các hoạt động giao lưu, trò chơi kỹ năng sống và chia sẻ yêu thương đã giúp các em nhỏ thêm tự tin, gắn bó và có thêm động lực đến lớp. Nhiều phụ huynh cũng được truyền cảm hứng để cùng đồng hành với con em trong hành trình học tập.

                Chiến dịch không chỉ gieo mầm hy vọng về một tương lai tốt đẹp hơn cho các em, mà còn lan tỏa tinh thần trách nhiệm cộng đồng, sẻ chia và yêu thương giữa những con người xa lạ nhưng cùng chung một trái tim thiện nguyện.',
                'images' => 'images/ev9A1.jpg',
            ],
            [
                'event_id' => 'b5df3ea0-d1b9-4e07-80c2-f928f1c82a2a',
                'result_id' => Str::uuid(),
                'content' => 'Chiến dịch "Viện Phong Yêu Thương – Đợt 4" đã diễn ra thành công và để lại nhiều cảm xúc sâu sắc trong lòng các tình nguyện viên cũng như những cụ già tại viện phong. Trong suốt thời gian diễn ra chương trình, các tình nguyện viên đã trực tiếp hỗ trợ tắm gội, trò chuyện, cắt tóc, chăm sóc cá nhân cho gần 50 cụ già đang sinh sống tại viện dưỡng lão.

                Không chỉ mang đến sự hỗ trợ về thể chất, các hoạt động giao lưu tinh thần đã giúp các cụ cảm nhận được sự quan tâm, yêu thương từ cộng đồng. Nhiều câu chuyện, nụ cười và giọt nước mắt xúc động đã được chia sẻ, tạo nên một không gian kết nối giữa các thế hệ.

                Chiến dịch một lần nữa khẳng định vai trò quan trọng của các hoạt động thiện nguyện trong việc xây dựng một xã hội giàu tình người, và là nguồn cảm hứng để tiếp tục lan tỏa lòng nhân ái đến mọi miền đất nước.',
                'images' => 'images/ev10A6.jpg;images/ev10A7.jpg;images/ev10A8.jpg;images/ev10A9.jpg;images/ev10A10.jpg',
            ],
        ];

        foreach ($results as $result) {
            Result::create([
                'result_id' => $result['result_id'],
                'event_id' => $result['event_id'],
                'content' => $result['content'],
                'images' => $result['images'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
