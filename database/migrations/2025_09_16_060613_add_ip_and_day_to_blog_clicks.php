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
        Schema::table('blog_clicks', function (Blueprint $table) {
            // tjek først at kolonnerne ikke findes i forvejen
            if (!Schema::hasColumn('blog_clicks', 'ip')) {
                $table->string('ip', 45)->after('slug');
            }

            if (!Schema::hasColumn('blog_clicks', 'visited_on')) {
                $table->date('visited_on')->after('clicked_at');
            }

            // index navn skal være unikt på tværs af hele DB
            $table->unique(['slug', 'ip', 'visited_on'], 'blog_clicks_slug_ip_visited_unique');
        });
    }

    public function down(): void
    {
        Schema::table('blog_clicks', function (Blueprint $table) {
            // rollback = fjern unikt index + kolonner
            $table->dropUnique('blog_clicks_slug_ip_visited_unique');

            if (Schema::hasColumn('blog_clicks', 'ip')) {
                $table->dropColumn('ip');
            }

            if (Schema::hasColumn('blog_clicks', 'visited_on')) {
                $table->dropColumn('visited_on');
            }
        });
    }
};
