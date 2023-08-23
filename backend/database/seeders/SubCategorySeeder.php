<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $graphic=['Logo & Brand Identity','Logo Design','Brand Style Guides','Business Cards & Stationery','Gaming','Game Art','Graphics for Streamers','Twitch Store','Art & Illustration','Illustration','Pattern Design','Portraits & Caricatures','Cartoons & Comics','Tattoo Design','Storyboards','Web & App Design','Website Design','App Design','UX Design','Landing Page Design','Email Design','Icon Design','Web Banners','Social Media','Social Media Design','AR Filters & Lenses','Packaging & Covers','Packaging & Label Design','Book Design','Album Cover Design','Podcast Cover Art','Car Wraps','Visual Design','Photoshop Editing','Presentation Design','Infographic Design','Vector Tracing','Resume Design','Architecture & Building Design','Architecture & Interior Design','Landscape Design','Building Information Modeling','Fashion & Merchandise','Fashion Design','T-Shirts & Merchandise','Jewelry Design','Print Design','Flyer Design','Brochure Design','Signage Design','Poster Design','Catalog Design','Menu Design','Postcard Design','Invitation Design','Product & Characters Design','Industrial & Product Design','Character Modeling','Trade Booth Design','Miscellaneous','Other'];
        $marketing=['Social Media Marketing','Social Media Advertising','Search Engine Optimization','Local SEO','Marketing Strategy','Public Relations','Content Marketing','Video Marketing','Email Marketing','Web Analytics','Text Message Marketing','Affiliate Marketing','Search Engine Marketing (SEM)','Display Advertising ','E-Commerce Marketing','Influencer Marketing','Community Management','Mobile App Marketing','Music Promotion','Book & eBook Marketing','Podcast Marketing','Crowdfunding','Other'];
        $writing=['Articles & Blog Posts','Translation','Proofreading & Editing','Resume Writing','Cover Letters','LinkedIn Profiles','Ad Copy','Sales Copy','Social Media Copy','Email Copy','Case Studies','Book & eBook Writing','Book Editing','Scriptwriting','Podcast Writing','Beta Reading','Creative Writing','Brand Voice & Tone','UX Writing','Speechwriting','eLearning Content Development','Technical Writing','Job Descriptions','White Papers','Website Content','Product Descriptions','Press Releases','Business Names & Slogans','Legal Writing','Grant Writing','Transcripts','Research & Summaries','Other'];
        $video=['Whiteboard & Animated Explainers','Video Editing','Visual Effects','Subtitles & Captions','Lyric & Music Videos','Character Animation','Logo Animation','Animation for Kids','Lottie & Website Animation','Corporate Videos','Animated GIFs','Short Video Ads','3D Product Animation','E-Commerce Product Videos','Spokesperson Videos','Live Action Explainers','Crowdfunding Videos','Unboxing Videos','App & Website Previews','Animation for Streamers','Video Templates Editing','Intros & Outros','Product Photography','Local Photography','Drone Videography','eLearning Video Production','Screencasting Videos','Slideshow Videos','Game Trailers','Book Trailers','Article to Video','Real Estate Promos','Other'];
        $music=['Voice Over','Producers & Composers','Singers & Vocalists','Mixing & Mastering','Session Musicians','Online Music Lessons','Podcast Editing','Songwriters','Beat Making','Audiobook Production','Audio Ads Production','Sound Design','Jingles & Intros','Dialogue Editing','Music Transcription','Vocal Tuning','DJ Drops & Tags','DJ Mixing','Remixing & Mashups','Synth Presets','Meditation Music','Other'];
        $programming=['WordPress','Website Builders & CMS','Game Development','Development for Streamers','Web Programming','E-Commerce Development','Mobile Apps','Desktop Applications','Support & IT','Chatbots','Online Coding Lessons','Cybersecurity & Data Protection','Convert Files','User Testing','QA & Review','Other'];
        $data=['Databases','Data Processing','Data Analytics','Data Visualization','Data Engineering','Data Science','Data Entry','Other'];
        $bussiness=['Virtual Assistant','Market Research','Sales','E-Commerce Management','Supply Chain Management','Project Management','Presentations','Game Concept Design','Flyer Distribution','Business Plans','Business Consulting','Legal Consulting','Financial Consulting','Customer Care','HR Consulting','Career Counseling','Other'];
        $lifestyle=['Online Tutoring','Gaming','Astrology & Psychics','Modeling & Acting','Wellness','Traveling','Fitness Lessons','Dance Lessons','Life Coaching','Greeting Cards & Videos','Personal Stylists','Cooking Lessons','Craft Lessons','Arts & Crafts','Family & Genealogy','Your Message On...','Collectibles','Other'];


        foreach($graphic as $item){
            SubCategory::create([
                'category_id'=>1,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($marketing as $item){
            SubCategory::create([
                'category_id'=>2,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($writing as $item){
            SubCategory::create([
                'category_id'=>3,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($video as $item){
            SubCategory::create([
                'category_id'=>4,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($music as $item){
            SubCategory::create([
                'category_id'=>5,
                'title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($programming as $item){
            SubCategory::create([
                'category_id'=>6,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($data as $item){
            SubCategory::create([
                'category_id'=>7,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($bussiness as $item){
            SubCategory::create([
                'category_id'=>8,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
        foreach($lifestyle as $item){
            SubCategory::create([
                'category_id'=>9,
                'title'=>$item,
                'fi_title'=>$item,
                'banner'=>'assets/images/Pro.jpeg',
                'slug' => Str::slug($item)
            ]);
        }
    }
}
