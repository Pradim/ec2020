<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            array(
                'title' => 'About Us',
                'slug' => 'about-us',
                'summary' => 'This is about us',
                'status' => 'active'
            ),
            array(
                'title' => 'Terms and Condition',
                'slug' => 'terms-and-condition',
                'summary' => 'This is terms and condition',
                'status' => 'active'
            ),
            array(
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'summary' => 'This is privacy policy',
                'status' => 'active'
            ),
            array(
                'title' => 'Help and FAQ',
                'slug' => 'help-and-faq',
                'summary' => 'This is Help Page',
                'status' => 'active'
            )
        );

        foreach ($array as $page_info) {
            $page = new Page();
            if ($page->where('slug', $page_info['slug'])->count() <= 0){
                $page->fill($page_info);
                $page->save();
            }
        }
    }
}
