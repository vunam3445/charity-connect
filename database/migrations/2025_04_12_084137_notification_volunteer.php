    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            //
            Schema::create('notification_volunteer', function (Blueprint $table) {
                $table->id(); // tự tăng
                $table->uuid('notification_id');
                $table->uuid('volunteer_id');
                $table->string('title');
                $table->text('content');
                $table->boolean('is_read')->default(false);
                $table->timestamps();

                $table->foreign('volunteer_id')->references('volunteer_id')->on('volunteers')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            //
        }
    };
