<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'event_id' => 'e351d301-c48a-4c8c-97a1-1a2540d617a1',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Chiến dịch Trồng Rừng Tình Nguyện',
            'description' => '
            Chiến dịch "Trồng Rừng Hồi Sinh Xanh" được tổ chức nhằm kêu gọi các bạn tình nguyện viên cùng chung tay phục hồi những cánh rừng bị tàn phá tại khu vực Hòa Bình. Trong suốt thời gian diễn ra chiến dịch, các tình nguyện viên sẽ trực tiếp tham gia vào các hoạt động như đào hố, trồng cây giống, che chắn cây non, dọn dẹp rác thải trong rừng và chăm sóc khu vực trồng mới.

            Bên cạnh hoạt động chính là trồng rừng, chiến dịch còn tổ chức các buổi truyền thông nhỏ nhằm nâng cao nhận thức cộng đồng địa phương về tầm quan trọng của hệ sinh thái rừng đối với cuộc sống con người và biến đổi khí hậu. Các buổi sinh hoạt nhóm và chia sẻ trải nghiệm trong rừng cũng sẽ giúp tình nguyện viên hiểu rõ hơn về thiên nhiên và phát triển kỹ năng làm việc nhóm.

            Đây không chỉ là một hoạt động thiện nguyện, mà còn là hành trình kết nối con người với thiên nhiên, góp phần nuôi dưỡng tinh thần trách nhiệm và lòng yêu môi trường trong mỗi cá nhân tham gia.
            ',
            'start_date' => '2023-03-15 08:00:00',
            'end_date' => '2023-03-17 17:00:00',
            'location' => 'Hòa Bình',
            'approved' => 'approved',
            'min_quantity' => 3,
            'max_quantity' => 15,
            'quantity_now' => 7,
            'status' => 'completed',
            'images' => 'images/ev1A1.jpg;images/ev1A2.jpg;images/ev1A3.jpg;images/ev1A4.jpg;images/ev1A5.jpg',
            'created_at' => '2023-03-01 09:00:00',
            'updated_at' => '2023-03-01 09:00:00',
        ]);

        Event::create([
            'event_id' => 'a7b9f74d-056e-44c6-82cd-b8c1b9a6a0d5',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Sức Khỏe Vùng Cao – San Sẻ Yêu Thương',
            'description' => 'Chiến dịch "Sức Khỏe Vùng Cao – San Sẻ Yêu Thương" được tổ chức với mục tiêu mang lại các hoạt động chăm sóc sức khỏe, hỗ trợ vệ sinh cá nhân và nâng cao nhận thức về y tế cho người dân tại xã Suối Tọ, huyện Phù Yên, tỉnh Sơn La. Trong khuôn khổ chiến dịch, các tình nguyện viên sẽ phối hợp cùng đội ngũ y bác sĩ địa phương để hỗ trợ khám sức khỏe cơ bản, phát thuốc miễn phí, hướng dẫn vệ sinh cá nhân, và tổ chức các trò chơi giáo dục về sức khỏe cho trẻ em.

            Ngoài ra, các bạn tình nguyện viên sẽ tham gia tu sửa lại một số cơ sở vật chất cộng đồng như nhà vệ sinh trường học, hệ thống cấp nước, và tạo sân chơi an toàn cho trẻ nhỏ.

            Đây là cơ hội để mỗi tình nguyện viên không chỉ đóng góp công sức cho cộng đồng, mà còn được trải nghiệm cuộc sống giản dị, gần gũi của đồng bào miền núi, từ đó lan tỏa giá trị nhân ái và tinh thần sẻ chia trong xã hội.',
            'start_date' => '2023-07-20 08:00:00',
            'end_date' => '2023-07-24 17:00:00',
            'location' => 'Xã Suối Tọ, huyện Phù Yên, tỉnh Sơn La',
            'approved' => 'approved',
            'min_quantity' => 5,
            'max_quantity' => 20,
            'quantity_now' => 10,
            'status' => 'completed',
            'images' => 'images/ev2A1.jpg;images/ev2A2.jpg;images/ev2A3.jpg;images/ev2A4.jpg',
            'created_at' => '2023-07-15 09:00:00',
            'updated_at' => '2023-07-15 09:00:00',
        ]);


        Event::create([
            'event_id' => 'e0055c4e-2ea9-4c4f-913f-75e4fa1661a3',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Trung Thu Cho Em – Vui Hội Trăng Rằm',
            'description' => 'Chiến dịch "Trung Thu Cho Em – Vui Hội Trăng Rằm" được tổ chức nhằm mang đến một mùa Trung thu ấm áp và đầy ý nghĩa cho các em nhỏ tại vùng sâu, vùng xa. Trong khuôn khổ chiến dịch, các tình nguyện viên sẽ tham gia vào việc chuẩn bị và tổ chức các hoạt động vui chơi, biểu diễn văn nghệ, làm lồng đèn, và phát quà Trung thu cho các em nhỏ.

            Ngoài ra, chiến dịch còn hướng đến việc tạo ra một không gian giao lưu, học hỏi giữa các tình nguyện viên và cộng đồng địa phương, từ đó góp phần nâng cao nhận thức về tầm quan trọng của việc chăm sóc và giáo dục trẻ em. Đây là cơ hội để các tình nguyện viên thể hiện tinh thần nhân ái, sẻ chia và trách nhiệm xã hội, đồng thời trải nghiệm và hiểu thêm về cuộc sống của người dân ở những vùng còn nhiều khó khăn.',
            'start_date' => '2024-09-05 08:00:00',
            'end_date' => '2024-09-09 17:00:00',
            'location' => 'Xã Mường Lống, huyện Kỳ Sơn, tỉnh Nghệ An',
            'approved' => 'approved',
            'min_quantity' => 5,
            'max_quantity' => 30,
            'quantity_now' => 15,
            'status' => 'completed',
            'images' => 'images/ev3A1.jpg;images/ev3A2.jpg',
            'created_at' => '2024-08-25 09:00:00',
            'updated_at' => '2024-08-25 09:00:00',
        ]);


        Event::create([
            'event_id' => 'f5a322cd-f140-4c62-89d1-6f5fc594cf80',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Hành Trình Ánh Sáng – Mang Lại Niềm Tin',
            'description' => 'Chiến dịch "Hành Trình Ánh Sáng – Mang Lại Niềm Tin" được tổ chức nhằm hỗ trợ các em nhỏ có hoàn cảnh khó khăn tại vùng sâu, vùng xa. Các tình nguyện viên sẽ tham gia vào việc tổ chức các hoạt động giáo dục, vui chơi, và phát quà cho các em, nhằm mang lại niềm vui và động lực cho các em trong học tập và cuộc sống.

            Ngoài ra, chiến dịch còn hướng đến việc nâng cao nhận thức của cộng đồng về tầm quan trọng của giáo dục và sự quan tâm đến trẻ em. Đây là cơ hội để các tình nguyện viên thể hiện tinh thần nhân ái, sẻ chia và trách nhiệm xã hội, đồng thời trải nghiệm và hiểu thêm về cuộc sống của người dân ở những vùng còn nhiều khó khăn.',
            'start_date' => '2023-06-10 08:00:00',
            'end_date' => '2023-06-14 17:00:00',
            'location' => 'Xã Mường Nhé, huyện Mường Nhé, tỉnh Điện Biên',
            'approved' => 'approved',
            'min_quantity' => 10,
            'max_quantity' => 35,
            'quantity_now' => 18,
            'status' => 'completed',
            'images' => 'images/ev4A1.jpg;images/ev4A2.jpg;images/ev4A3.jpg',
            'created_at' => '2023-05-25 09:00:00',
            'updated_at' => '2023-05-25 09:00:00',
        ]);

        Event::create([
            'event_id' => '198da1b1-8933-49f6-a739-5fe7f593bd88',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Chương trình thiện nguyện tại xã Mường Nhé',
            'description' => 'Chương trình thiện nguyện tại xã Mường Nhé được tổ chức nhằm hỗ trợ các em nhỏ có hoàn cảnh khó khăn tại vùng sâu, vùng xa. Các tình nguyện viên sẽ tham gia vào việc tổ chức các hoạt động giáo dục, vui chơi, và phát quà cho các em, nhằm mang lại niềm vui và động lực cho các em trong học tập và cuộc sống.

            Ngoài ra, chương trình còn hướng đến việc nâng cao nhận thức của cộng đồng về tầm quan trọng của giáo dục và sự quan tâm đến trẻ em. Đây là cơ hội để các tình nguyện viên thể hiện tinh thần nhân ái, sẻ chia và trách nhiệm xã hội, đồng thời trải nghiệm và hiểu thêm về cuộc sống của người dân ở những vùng còn nhiều khó khăn.',
            'start_date' => '2023-06-10 08:00:00',
            'end_date' => '2023-06-14 17:00:00',
            'location' => 'Xã Mường Nhé, huyện Mường Nhé, tỉnh Điện Biên',
            'approved' => 'approved',
            'min_quantity' => 15,
            'max_quantity' => 46,
            'quantity_now' => 25,
            'status' => 'completed',
            'images' => 'images/ev5A1.jpg;images/ev5A2.jpg;images/ev5A3.jpg;images/ev5A4.jpg;images/ev5A5.jpg',
            'created_at' => '2023-05-25 09:00:00',
            'updated_at' => '2023-05-25 09:00:00',
        ]);

        Event::create([
            'event_id' => '6eae53de-92e4-4a0b-877e-48b4a9a0f932',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Bữa Trưa Cho Em 2024–2025',
            'description' => 'Chương trình "Bữa Trưa Cho Em 2024–2025" nhằm mang đến những bữa ăn đầy đủ dinh dưỡng và sự sẻ chia yêu thương cho các em học sinh tại vùng sâu vùng xa, nơi điều kiện sinh hoạt và học tập còn nhiều khó khăn. Trong không khí se lạnh cuối năm, chiến dịch hướng đến việc lan tỏa tinh thần nhân ái và khuyến khích cộng đồng cùng hành động vì trẻ em.

            Chúng tôi tổ chức các buổi phát cơm trưa, tặng quà và giao lưu cùng các em học sinh, giúp các em không chỉ có một bữa ăn ngon mà còn cảm nhận được sự quan tâm từ xã hội. Qua hoạt động này, tình nguyện viên sẽ cùng đồng hành, tổ chức trò chơi, hỗ trợ hậu cần và trực tiếp mang đến tiếng cười, niềm vui cho các em nhỏ.

            Đây là cơ hội tuyệt vời để kết nối, truyền cảm hứng và xây dựng một cộng đồng yêu thương, nơi mà mỗi hành động dù nhỏ bé cũng có thể tạo nên giá trị lớn lao. Hãy cùng chúng tôi viết tiếp hành trình thiện nguyện bằng trái tim và hành động cụ thể.',
            'start_date' => '2024-12-27 08:00:00',
            'end_date' => '2024-12-29 17:00:00',
            'location' => 'Thái Nguyên',
            'approved' => 'approved',
            'min_quantity' => 6,
            'max_quantity' => 16,
            'quantity_now' => 7,
            'status' => 'completed',
            'images' => 'images/ev6A1.jpg',
            'created_at' => now()->subDays(180),
            'updated_at' => now()->subDays(170),
        ]);

        Event::create([
            'event_id' => '03a86147-43b4-4a1a-bc6d-40dbd300b8b1',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Trạm Phóng Tương Lai 3 – Hỗ trợ điểm trường Ông Ngọc',
            'description' => 'Trạm Phóng Tương Lai 3 là một chiến dịch thiện nguyện nhằm xây dựng môi trường học tập tốt hơn cho các em nhỏ tại điểm trường Ông Ngọc, xã Trà Don, huyện Nam Trà My, tỉnh Quảng Nam. Chiến dịch kêu gọi các tình nguyện viên cùng đến hỗ trợ cải tạo lớp học, lắp đặt hệ thống điện năng lượng mặt trời, tổ chức hoạt động giao lưu, tặng sách và đồ dùng học tập cho học sinh người dân tộc thiểu số. Mỗi tình nguyện viên không chỉ góp phần nâng cấp cơ sở vật chất mà còn mang đến sự sẻ chia, động viên về tinh thần, góp phần lan tỏa yêu thương đến vùng cao. Đây là hành trình đầy cảm xúc để kết nối, cống hiến và thắp sáng tương lai cho trẻ em nơi vùng sâu vùng xa.',
            'start_date' => '2023-11-18 08:00:00',
            'end_date' => '2023-11-21 17:00:00',
            'location' => 'Trường PTDTBT Tiểu học Trà Dơn, Xã Trà Dơn, Huyện Nam Trà My, Tỉnh Quảng Nam',
            'approved' => 'approved',
            'min_quantity' => 5,
            'max_quantity' => 20,
            'quantity_now' => 10,
            'status' => 'completed',
            'images' => 'images/ev7A1.jpg;images/ev7A2.jpg;images/ev7A3.jpg;images/ev7A4.jpg;images/ev7A5.jpg',
            'created_at' => now()->subMonths(4),
            'updated_at' => now()->subMonths(4),
        ]);

        Event::create([
            'event_id' => '2052a19f-ef55-4ecf-9e11-4fe7a26907cd',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Chiến Dịch Clean Up Việt Nam Lần 7',
            'description' => 'Chiến dịch Clean Up Việt Nam Lần 7 là hoạt động tình nguyện quy mô toàn quốc nhằm hưởng ứng Ngày Môi trường Thế giới 05.06 và Ngày Đại dương thế giới 08.06. Với mục tiêu lan tỏa lối sống xanh và hành động thiết thực vì môi trường, chiến dịch kêu gọi 200.000 tình nguyện viên tại 63 tỉnh thành và hơn 10 quốc gia cùng tham gia hoạt động nhặt rác, truyền thông môi trường và nâng cao ý thức bảo vệ đại dương vào ngày 08.06.2025. Đây là dịp để các tổ chức và cộng đồng đồng lòng góp phần bảo vệ hành tinh xanh, đồng thời giáo dục các thế hệ trẻ về trách nhiệm và hành động vì môi trường bền vững.',
            'start_date' => '2025-06-08 08:00:00',
            'end_date' => '2025-06-08 17:00:00',
            'location' => 'Toàn quốc và 10 quốc gia khác',
            'approved' => 'approved',
            'min_quantity' => 10,
            'max_quantity' => 30,
            'quantity_now' => 15,
            'status' => 'completed',
            'images' => 'images/ev8A1.jpg;images/ev8A2.jpg;images/ev8A3.jpg',
            'created_at' => '2025-03-12 09:00:00',
            'updated_at' => '2025-04-15 10:00:00',
        ]);

        Event::create([
            'event_id' => '36b93b10-8593-45c2-918f-02855d2755e0',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Góp Gạo Nuôi Bé – Vùng Cao Tây Nguyên',
            'description' => 'Chiến dịch tình nguyện "Góp Gạo Nuôi Bé" hướng đến việc hỗ trợ các em nhỏ người dân tộc thiểu số vùng sâu vùng xa tại Tây Nguyên. Mục tiêu là mang đến những bữa ăn trưa đủ dinh dưỡng tại điểm trường, từ đó khuyến khích phụ huynh cho các em đến lớp đều đặn và xây dựng thói quen học tập bền vững. Các tình nguyện viên sẽ cùng tham gia vào hoạt động nấu ăn, phát cơm, giao lưu và tổ chức các hoạt động giáo dục kỹ năng sống cho các em nhỏ. Đây là hành trình đầy ý nghĩa, gieo mầm hy vọng về một tương lai tươi sáng hơn cho trẻ em vùng cao.',
            'start_date' => '2024-04-01 08:00:00',
            'end_date' => '2024-04-03 17:00:00',
            'location' => 'Xã Bông Krang, Huyện Lắk, Tỉnh Đắk Lắk',
            'approved' => 'approved',
            'min_quantity' => 15,
            'max_quantity' => 46,
            'quantity_now' => 18,
            'status' => 'completed',
            'images' => 'images/ev9A1.jpg',
            'created_at' => '2024-03-25 09:00:00',
            'updated_at' => '2024-03-25 09:00:00',
        ]);

        Event::create([
            'event_id' => 'b5df3ea0-d1b9-4e07-80c2-f928f1c82a2a',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Viện Phong Yêu Thương 4',
            'description' => 'Chương trình thiện nguyện "Viện Phong Yêu Thương – Đợt 4" là cơ hội để các bạn trẻ cùng nhau sẻ chia yêu thương với những cụ già mắc bệnh phong đang sinh sống tại một viện dưỡng lão ngoại thành Hà Nội. Với số lượng khoảng 49 cụ, chiến dịch này tập trung vào việc hỗ trợ chăm sóc sức khỏe, vệ sinh cá nhân, và các hoạt động gắn kết tinh thần như tắm gội, trò chuyện, chia sẻ. 
            Các tình nguyện viên sẽ tổ chức thăm hỏi định kỳ hàng tháng, góp phần mang lại sự ấm áp, lạc quan và niềm vui cho các cụ già có hoàn cảnh neo đơn, bệnh tật. Đây không chỉ là cơ hội để trải nghiệm tinh thần trách nhiệm xã hội, mà còn là dịp để lan tỏa lòng nhân ái, góp phần xây dựng cộng đồng đầy yêu thương và nghĩa tình.',
            'start_date' => '2024-11-06 08:00:00',
            'end_date' => '2024-11-10 17:00:00',
            'location' => '8 Ngõ 271 Bùi Xương Trạch, Phường Khương Đình, Quận Thanh Xuân, Hà Nội',
            'approved' => 'approved',
            'min_quantity' => 15,
            'max_quantity' => 50,
            'quantity_now' => 25,
            'status' => 'completed',
            'images' => 'images/ev10A1.jpg;images/ev10A2.jpg;images/ev10A3.jpg;images/ev10A4.jpg;images/ev10A5.jpg',
            'created_at' => now()->subMonths(3),
            'updated_at' => now()->subMonths(3),
        ]);

        Event::create([
            'event_id' => '8d011437-4825-47c4-aee3-5ec5fcfd949f',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Bát Cháo Yêu Thương - Trao Gửi Nghĩa Tình',
            'description' => 'Chiến dịch “Bát Cháo Yêu Thương” là hoạt động thiện nguyện được tổ chức vào mỗi sáng thứ 7 hằng tuần nhằm trao tận tay những suất cháo ấm lòng đến bệnh nhân và người nhà bệnh nhân tại các bệnh viện như Bệnh viện Phổi, Y học Cổ truyền, Quân y 4, Bệnh viện Đa khoa Thành phố Vinh CS1, và các trung tâm trẻ mồ côi, khuyết tật. Với tinh thần "sống là sẻ chia", chiến dịch là nơi hội tụ của những tấm lòng thiện nguyện, cùng nhau lan tỏa yêu thương tới những hoàn cảnh neo đơn, yếu thế. Mỗi tình nguyện viên sẽ góp phần chuẩn bị, phát cháo và động viên tinh thần người bệnh vào đầu ngày mới, tạo nên một môi trường nhân ái, ấm áp giữa lòng thành phố.',
            'start_date' => '2025-09-02 07:00:00',
            'end_date' => '2025-09-02 11:00:00',
            'location' => 'TP. Vinh, Nghệ An',
            'approved' => 'approved',
            'min_quantity' => 5,
            'max_quantity' => 15,
            'quantity_now' => 7,
            'status' => 'active',
            'images' => 'images/ev11A1.jpg;images/ev11A2.jpg',
            'created_at' => '2023-08-15 10:00:00',
            'updated_at' => '2023-08-15 10:00:00',
        ]);

        Event::create([
            'event_id' => 'eac886df-ff12-47f7-a28b-d2280c0dc90b',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Ngôi Nhà Mơ Ước Số 81 – Hỗ Trợ Cô Giáo Mạc Thị Thu',
            'description' => 'Chương trình “Ngôi Nhà Mơ Ước Số 81” nhằm hỗ trợ cô giáo Mạc Thị Thu – một người mẹ đơn thân đang mang căn bệnh ung thư di căn gan – có hoàn cảnh đặc biệt khó khăn tại thị trấn Pác Miầu, huyện Bảo Lâm, tỉnh Cao Bằng. Cô từng là giáo viên tiểu học và trụ cột trong gia đình nuôi mẹ già và hai con nhỏ. Sau khi phát hiện bệnh vào đầu năm 2024, cô đã trải qua các đợt điều trị tốn kém và phải nghỉ dạy để điều trị tại Hà Nội. Dù đã phẫu thuật và điều trị hóa chất, sức khỏe của cô vẫn rất yếu. Hiện tại, cô cần một mái nhà an toàn để yên tâm điều trị và chăm sóc con. Chương trình kêu gọi các tình nguyện viên hỗ trợ xây dựng ngôi nhà mới với mức kinh phí ước tính 300 triệu đồng, trong đó cần thêm 40 triệu để hoàn tất phần thiếu. Đây là cơ hội để chung tay lan tỏa yêu thương và tiếp sức cho cô giáo vững vàng vượt qua bệnh tật.',
            'start_date' => '2025-10-10 08:00:00',
            'end_date' => '2025-10-13 17:00:00',
            'location' => 'Pác Miầu, Bảo Lâm, Cao Bằng',
            'approved' => 'approved',
            'min_quantity' => 5,
            'max_quantity' => 20,
            'quantity_now' => 10,
            'status' => 'active',
            'images' => 'images/ev12A1.jpg;images/ev12A2.jpg;images/ev12A3.jpg;images/ev12A4.jpg;images/ev12A5.jpg',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(10),
        ]);

        Event::create([
            'event_id' => '63f2120d-f104-443e-9d7d-d9e9e7a78b7d',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Ngôi Nhà Mơ Ước số 80 – Ông Trần Công Ghế – Hải Dương',
            'description' => 'Chiến dịch hỗ trợ xây mới ngôi nhà xuống cấp cho ông Trần Công Ghế tại xã Liên Mạc, huyện Thanh Hà, tỉnh Hải Dương – người đã sống trong căn nhà cũ từ năm 1989. Với hoàn cảnh neo đơn, tuổi cao, sức yếu và không có khả năng lao động hay con cháu phụ giúp, ông Ghế đang phải sống trong điều kiện nhà ở xuống cấp nghiêm trọng, đặc biệt khi mùa mưa lũ đến.

            Chiến dịch nhằm xây dựng một căn nhà cấp 4 vững chắc có diện tích 56m², đảm bảo an toàn và điều kiện sống cơ bản cho ông. Đây không chỉ là mái nhà mới mà còn là nơi ươm mầm niềm tin, hy vọng cho những ngày tháng cuối đời bớt nhọc nhằn. Với tổng chi phí dự kiến 200 triệu đồng, trong đó chính quyền xã hỗ trợ 80 triệu và các mạnh thường quân đã đóng góp được 40 triệu, chiến dịch kêu gọi cộng đồng tiếp tục chung tay để hoàn thiện ngôi nhà.

            Mỗi đóng góp đều là sự sẻ chia quý giá giúp ông Ghế có được mái ấm khang trang hơn, vững chãi hơn, và tránh xa nguy cơ mất an toàn khi mưa bão.',
            'start_date' => '2025-11-01 08:00:00',
            'end_date' => '2025-11-04 17:00:00',
            'location' => 'Xã Liên Mạc, Huyện Thanh Hà, Tỉnh Hải Dương',
            'approved' => 'approved',
            'min_quantity' => 7,
            'max_quantity' => 25,
            'quantity_now' => 15,
            'status' => 'active',
            'images' => 'images/ev13A1.jpg;images/ev13A2.jpg;images/ev13A3.jpg;images/ev13A4.jpg;images/ev13A5.jpg',
            'created_at' => now()->subDays(30),
            'updated_at' => now()->subDays(30),
        ]);

        Event::create([
            'event_id' => '2d4d46e2-6d48-407a-b340-b0551918cb62',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Hành trình nhân đạo – Lan tỏa yêu thương',
            'description' => 'Nhân dịp kỷ niệm 50 năm Giải phóng miền Nam và 135 năm ngày sinh Chủ tịch Hồ Chí Minh, chiến dịch “Hành trình nhân đạo – Lan tỏa yêu thương” được phát động với mục tiêu hỗ trợ người nghèo, người khuyết tật, trẻ em khó khăn và gia đình chính sách. 
    
            Chiến dịch gồm các hoạt động ý nghĩa như:
            - Khám bệnh và cấp thuốc miễn phí cho 500 người/dợt khám.
            - Xây dựng nhà nhân đạo trị giá 50 triệu đồng/căn.
            - Hỗ trợ sinh kế cho hộ nghèo: 15 triệu đồng/hộ.
            - Hỗ trợ dinh dưỡng cho trẻ em nghèo tại vùng sâu vùng xa.

            Đây là dịp để lan tỏa tình yêu thương, tinh thần tương thân tương ái, xây dựng cộng đồng đoàn kết và hỗ trợ những hoàn cảnh kém may mắn trên toàn quốc.',
            'start_date' => '2025-06-24 08:00:00',
            'end_date' => '2025-06-30 17:00:00',
            'location' => '82 Nguyễn Du, Quận Hai Bà Trưng, Hà Nội',
            'approved' => 'approved',
            'min_quantity' => 15,
            'max_quantity' => 50,
            'quantity_now' => 19,
            'status' => 'active',
            'images' => 'images/ev14A1.jpg;images/ev14A2.jpg;images/ev14A3.jpg',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(5),
        ]);

        Event::create([
            'event_id' => 'b1d91e2c-1234-4c2b-88e0-91f1a33ab001',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Chuyến Xe Yêu Thương',
            'description' => 'Chiến dịch tổ chức các chuyến xe miễn phí đưa đón người lao động về quê ăn Tết, đặc biệt hỗ trợ các tỉnh miền Trung và miền Bắc.',
            'start_date' => '2025-01-20 07:00:00',
            'end_date' => '2025-01-25 20:00:00',
            'location' => 'Bến xe Miền Đông, TP.HCM',
            'approved' => 'pending',
            'min_quantity' => 20,
            'max_quantity' => 200,
            'quantity_now' => 0,
            'status' => 'completed',
            'images' => 'images/ev15A1.jpg;images/ev15A2.jpg;images/ev15A3.jpg;images/ev15A4.jpg;images/ev15A5.jpg',
            'created_at' => now()->subDays(10),
            'updated_at' => now()->subDays(5),
        ]);

        Event::create([
            'event_id' => 'c3f29e45-6789-4a5b-a3a5-987f33fce002',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Sách Cũ – Tri Thức Mới',
            'description' => 'Thu gom sách cũ, truyện thiếu nhi, và sách giáo khoa để xây dựng “Tủ sách cộng đồng” cho các điểm trường vùng sâu vùng xa.',
            'start_date' => '2025-03-01 08:00:00',
            'end_date' => '2025-03-05 17:00:00',
            'location' => 'Kon Tum, Gia Lai, Lào Cai',
            'approved' => 'pending',
            'min_quantity' => 10,
            'max_quantity' => 50,
            'quantity_now' => 0,
            'status' => 'completed',
            'images' => 'images/ev16A1.jpg;images/ev16A2.jpg;images/ev16A3.jpg;images/ev16A4.jpg;images/ev16A5.jpg',
            'created_at' => now()->subMonths(2),
            'updated_at' => now()->subMonths(1),
        ]);

        Event::create([
            'event_id' => 'd4e50a67-9101-4b67-b6df-c1ff24a0de03',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Hành Trình Nụ Cười',
            'description' => 'Tổ chức khám và phẫu thuật miễn phí cho trẻ em bị hở hàm ếch tại các tỉnh miền Tây, phối hợp với đội ngũ bác sĩ tình nguyện.',
            'start_date' => '2024-10-10 09:00:00',
            'end_date' => '2024-10-14 16:00:00',
            'location' => 'Bệnh viện Đa khoa Cần Thơ',
            'approved' => 'pending',
            'min_quantity' => 30,
            'max_quantity' => 150,
            'quantity_now' => 0,
            'status' => 'completed',
            'images' => 'images/ev17A1.jpg;images/ev17A2.jpg;images/ev17A3.jpg;images/ev17A4.jpg;images/ev17A5.jpg',
            'created_at' => now()->subMonths(3),
            'updated_at' => now()->subMonths(2),
        ]);

        Event::create([
            'event_id' => 'a5d73e98-4321-4f88-87ab-123456fdf004',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Ánh Sáng Cho Em',
            'description' => 'Lắp đặt hệ thống điện năng lượng mặt trời cho điểm trường chưa có điện tại vùng núi cao Sơn La và Điện Biên.',
            'start_date' => '2024-12-05 07:30:00',
            'end_date' => '2024-12-09 18:00:00',
            'location' => 'Xã Nậm Pồ, Điện Biên',
            'approved' => 'pending',
            'min_quantity' => 25,
            'max_quantity' => 100,
            'quantity_now' => 0,
            'status' => 'completed',
            'images' => 'images/ev18A1.jpg;images/ev18A2.jpg;images/ev18A3.jpg;images/ev18A4.jpg;images/ev18A5.jpg',
            'created_at' => now()->subDays(40),
            'updated_at' => now()->subDays(30),
        ]);

        Event::create([
            'event_id' => 'f9e67a21-bcde-4ee4-9c77-987abcdef005',
            'organization_id' => 'b2b692fc-1a4d-4c07-b23b-41ce0c7d0c43',
            'name' => 'Ngày Hội Vì Sức Khỏe Cộng Đồng',
            'description' => 'Khám bệnh tổng quát miễn phí, tư vấn dinh dưỡng, đo thị lực, cấp phát thuốc và tổ chức gian hàng trò chơi sức khỏe cho người dân.',
            'start_date' => '2025-04-15 08:00:00',
            'end_date' => '2025-04-17 17:00:00',
            'location' => 'Nhà Văn hóa Phường 3, TP. Mỹ Tho',
            'approved' => 'pending',
            'min_quantity' => 20,
            'max_quantity' => 80,
            'quantity_now' => 0,
            'status' => 'completed',
            'images' => 'images/ev19A1.jpg;images/ev19A2.jpg;images/ev19A3.jpg;images/ev19A4.jpg;images/ev19A5.jpg',
            'created_at' => now()->subWeek(),
            'updated_at' => now()->subDays(3),
        ]);
    }
}
