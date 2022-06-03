<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Goutte\Client;
use stdClass;
use App\Http\Controllers\Admin\StoreImg;

class ScrapeController extends Controller
{

    public function show()
    {
        if(auth()->user()->email === env('ADMINISTRATOR_EMAIL')){
            $shops = [
                'The baby\'s corner' => 'https://www.thebabyscorner.be',
                'Babylux' => 'https://www.babylux.be/nl',
                'Babywinkel' => 'https://www.babywinkel.be',

            ];
            return view('scrape-form', compact('shops'));
        }else{
            abort(404);
        }

    }

    public function scrapeSubCategories(Request $r)
    {
        if(auth()->user()->email === env('ADMINISTRATOR_EMAIL')){
            $shop= $_POST['webshop_name'];
            switch ($shop) {
                case 'babywinkel.be':
                    $url_exists = Category::where('url', $r->url)->count();
                    $name_exists = Category::where('name', $r->category)->count();
                    $category_entity = new Category();
                    $category_entity->name = $r->category;
                    $category_entity->url = $r->url;
                    $category_entity->shop = $shop;
                    $category_entity->save();

                    $this->scrapeBabyWinkelSubCategories($r->url, $shop);

                    if($url_exists <= 0 || $name_exists <=0) break;

                case 'babylux.be':
                    $url_exists = Category::where('url', $r->url)->count();
                    $name_exists = Category::where('name', $r->category)->count();
                    $category_entity = new Category();
                    $category_entity->name = $r->category;
                    $category_entity->url = $r->url;
                    $category_entity->shop = $shop;
                    $category_entity->save();

                    $this->scrapeBabyluxSubCategories($r->url, $shop);

                    if($url_exists <= 0 || $name_exists <=0) break;

                case 'juneandjulian.com':
                    $url_exists = Category::where('url', $r->url)->count();
                    $name_exists = Category::where('name', $r->category)->count();
                    $category_entity = new Category();
                    $category_entity->name = $r->category;
                    $category_entity->url = $r->url;
                    $category_entity->shop = $shop;
                    $category_entity->save();

                    $this->scrapeJuneAndJulianSubCategories($r->url, $shop);

                    if($url_exists <= 0 || $name_exists <=0) break;

                default:
                    # code...
                    break;
            }
        }else{
            abort(404);
        }



    }


    public function scrapeArticles(Request $r)
    {
        if(auth()->user()->email === env('ADMINISTRATOR_EMAIL')){
            switch ($r->shop) {
                case 'babywinkel.be':
                    $this->scrapeBabyWinkelArticles($r->url);
                    break;

                case 'babylux.be':
                    $this->scrapeBabyluxArticles($r->url);
                    break;

                case 'juneandjulian.com':
                    $this->scrapeJuneAndJulianArticles($r->url);
                    break;

                default:
                    # code...
                    break;
            }
        }else{
            abort(404);
        }



    }

    // _________________________ Scraper babywinkel _________________________

    private function scrapeBabyWinkelSubCategories($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $sub_categories = $crawler->filter('.list-catalog li a')->each(function($node){
            $name = $node->text();
            $url = $node->attr('href');

            $cat = new stdClass();
            $cat->name = $name;
            $cat->url = $url;
            return $cat;
        });

        $main_category = Category::orderBy('id', 'desc')->first();

        foreach ($sub_categories as $scrape_sub_category) {
            // check if subcategory exists
            $exists = Sub_Category::where('url', $scrape_sub_category->url)->count();
            if($exists > 0) continue;

            // add sub category to db
            $sub_category_entity = new Sub_Category();
            $sub_category_entity->category_id = $main_category->id;
            $sub_category_entity->name = $scrape_sub_category->name;
            $sub_category_entity->url = $scrape_sub_category->url;
            $sub_category_entity->shop = $main_category->shop;
            $sub_category_entity->save();

        }
    }


    private function scrapeBabyWinkelArticles($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $products = $this->scrapeBabyWinkelData($crawler);
        dd($products);

        $pages = $crawler->filter('.nav-pagination ol li a')->count();
        for($i = 0; $i<= $pages; $i++){
            $crawler = $this->getNextPageBabyWinkel($crawler);
            if(!$crawler || $pages<1) break;
            $products = array_merge($products, $this->scrapeBabyWinkelData($crawler));


        }

        dd('hello');
        foreach($products as $product){
            if($product !== null){
                $extra_details = $this->scrapeProductDetailBabyWinkel($product->url_product);
                $product->description = $extra_details['0']->description;
                $product->image = $extra_details['0']->image;

                $product_table = new Product();
                $product_table->sub_category_id = $product->sub_category_id;
                $product_table->name = $product->name;
                $product_table->description = $product->description;
                $product_table->url_product = $product->url_product;
                $product_table->price = $product->price;
                $product_table->image = $product->image;
                $product_table->save();
            }

        }


    }

    private function scrapeBabyWinkelData($crawler)
    {
        return $crawler->filter('.list-collection li')->each(function($node){
            $product = new stdClass();
            $product->url = $node->filter('h2 a')->attr('href');
            // $product->name = $node->filter('p')->first()->text();

            // $product->img = $node->filter('.img figure img')->attr('src');
            // $product->img2 = $node->filter('.img figure img')->selectImage('Kitten')->image();
            // $product->url = $node->filter('h2 a')->attr('href');

            // StoreImg::storeProductImg($product->img);
            return $product;
        });
    }


    private function scrapeProductDetailBabyWinkel($url_product)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url_product);
        return $crawler->filter('.content-row')->each(function($node){
            $product_details = new stdClass();
            $product_details->image = $node->filter('.product-gallery .images .single-product-main-image a img')->first()->attr('data-src');
            $product_details->description = $node->filter('.product-info .product-short-description p')->first()->text();
            return $product_details;
        });
    }


    private function getNextPageBabyWinkel($crawler)
    {
       $linkTag = $crawler->filter('.link-btn a')->selectLink('Toon meer artikelen')->first();
       if($linkTag->count()<= 0) return;
       $link = $linkTag->link();
       if(!$link) return;

       $client = new Client();
       $nextCrawler = $client->click($link);
       return $nextCrawler;
    }


    // _____________________________ babylux _____________________________

    private function scrapeBabyluxSubCategories($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $sub_categories = $crawler->filter('.bbl-product-slider-paragraph')->each(function($node){
            $name = $node->filter('.bbl-product-slider-title')->text();
            $url = $node->filter('.bbl-product-slider-button a')->attr('href');

            $cat = new stdClass();
            $cat->name = $name;
            $cat->url = $url;
            return $cat;
        });

        $main_category = Category::orderBy('id', 'desc')->first();

        foreach ($sub_categories as $scrape_sub_category) {
            // check if subcategory exists
            $exists = Sub_Category::where('url', $scrape_sub_category->url)->count();
            if($exists > 0) continue;

            // add sub category to db
            $sub_category_entity = new Sub_Category();
            $sub_category_entity->category_id = $main_category->id;
            $sub_category_entity->name = $scrape_sub_category->name;
            $sub_category_entity->url = $scrape_sub_category->url;
            $sub_category_entity->shop = $main_category->shop;
            $sub_category_entity->save();

        }
    }

    private function scrapeBabyluxArticles($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $products = $this->scrapeBabyluxData($crawler);
        dd($products);

        // $pages = $crawler->filter('.pages .pages-items item')->count();
        // for($i = 0; $i<= $pages; $i++){
        //     $crawler = $this->getNextPage($crawler);
        //     if(!$crawler || $pages<1) break;
        //     $products = array_merge($products, $this->scrapeBabyluxData($crawler));


        // }


        // dd($products);
    }

    private function scrapeBabyluxData($crawler)
    {
        return $crawler->filter('.product-item-info')->each(function($node){
            $product = new stdClass();
            $product->url = $node->filter('.product-item-details div .name a')->attr('href');
            $product->name = $node->filter('.product-item-details div strong a')->text();
            $product->img = $node->filter('.product-item-photo span .product-image-photo')->attr('src');
            // $product->img = $node->filter('.product-item-photo span img')->attr('src');
            // dump($product);
            // StoreImg::storeProductImg($product->img);
            // dd($node->attr('href'));
            return $product;
        });
    }

    private function getNextPageBabylux($crawler)
    {
       $linkTag = $crawler->filter('.link-btn a')->selectLink('Toon meer artikelen')->first();
       if($linkTag->count()<= 0) return;
       $link = $linkTag->link();
       if(!$link) return;

       $client = new Client();
       $nextCrawler = $client->click($link);
       return $nextCrawler;
    }



    // _______________________ June and Julian ___________________________________

    private function scrapeJuneAndJulianSubCategories($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $sub_categories = $crawler->filter('.product-category .col-inner a')->each(function($node){
            $name = $node->filter('.box .box-text .box-text-inner h5')->text();
            $url = $node->attr('href');

            $cat = new stdClass();
            $cat->name = $name;
            $cat->url = $url;
            return $cat;
        });

        $main_category = Category::orderBy('id', 'desc')->first();

        foreach ($sub_categories as $scrape_sub_category) {
            // check if subcategory exists
            $exists = Sub_Category::where('url', $scrape_sub_category->url)->count();
            if($exists > 0) continue;

            // add sub category to db
            $sub_category_entity = new Sub_Category();
            $sub_category_entity->category_id = $main_category->id;
            $sub_category_entity->name = $scrape_sub_category->name;
            $sub_category_entity->url = $scrape_sub_category->url;
            $sub_category_entity->shop = $main_category->shop;
            $sub_category_entity->save();

        }
    }

    private function scrapeJuneAndJulianArticles($url){
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $products = $this->scrapeJuneAndJulianData($crawler);
        // dd('stop');

        $pages = $crawler->filter('.woocommerce-pagination .page-numbers li')->count();
        for($i = 0; $i<= $pages; $i++){
            $crawler = $this->getNextPageJuneAndJulian($crawler);
            if(!$crawler || $pages<1) break;
            $products = array_merge($products, $this->scrapeJuneAndJulianData($crawler));


        }

        foreach($products as $product){
            if($product !== null){
                // dd($product);
                $extra_details = $this->scrapeProductDetailJuneAndJulian($product->url_product);
                $product->description = $extra_details['0']->description;
                $product->image = $extra_details['0']->image;

                $saved_img = StoreImg::storeProductImg($product->image);
                $path_saved_img = session('full_path');

                $product_table = new Product();
                $product_table->sub_category_id = $product->sub_category_id;
                $product_table->name = $product->name;
                $product_table->description = $product->description;
                $product_table->url_product = $product->url_product;
                $product_table->price = $product->price;
                $product_table->image = $path_saved_img;
                $product_table->save();
            }else{
                dump('no products');
            }

        }
        // dd('succes');



    }

    private function scrapeJuneAndJulianData($crawler)
    {

        return $crawler->filter('.product-small .col-inner .box')->each(function($node){
            $product_url = $node->filter('.box-text .title-wrapper .product-title a')->first()->attr('href');
            $product_url_array = explode("/", $product_url);
            $sub_category_product = $product_url_array[0].'//' . $product_url_array[2] . '/'. $product_url_array[3]. '/';
            $sub_category = Sub_Category::where('url', '=', $sub_category_product)->first();
            if($sub_category !== null){
                $product = new stdClass();
                $product->name = $node->filter('.box-text .title-wrapper .product-title a')->first()->text();
                $product->url_product = $product_url;
                $product->price = $node->filter('.box-text .price-wrapper .price .amount bdi')->first()->text();
                $product->sub_category_id = $sub_category->id;
                return $product;
            }else{
                $product = null;
                return $product;
            }
        });
    }

    private function scrapeProductDetailJuneAndJulian($url_product)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url_product);
        return $crawler->filter('.content-row')->each(function($node){
            $product_details = new stdClass();
            $product_details->image = $node->filter('.product-gallery .images .single-product-main-image a img')->first()->attr('data-src');
            $product_details->description = $node->filter('.product-info .product-short-description p')->first()->text();
            return $product_details;
        });
    }

    private function getNextPageJuneAndJulian($crawler)
    {
       $linkTag = $crawler->filter('.woocommerce-pagination .page-numbers li .next')->first();
       if($linkTag->count()<= 0) return;
       $link = $linkTag->link();
       if(!$link) return;

       $client = new Client();
       $nextCrawler = $client->click($link);
       return $nextCrawler;
    }




}
