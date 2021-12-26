<?php

namespace App\Http\Controllers;

use App\Product;
use App\Subject;
use App\Author;
use App\Publisher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    // ajax product search
    public function ajax_search_to_product(Request $request)
    {
        if (!(empty($request->search))) {
            $result = null;
            if ($request->type=="book") {
                 $product = Product::where('title', 'LIKE', '%'.$request->search.'%')
                                         ->orWhere('eng', 'LIKE', '%'.$request->search.'%')
                                         ->latest()->get();
                if ($product->count()!=0) {
                    $result.='<table class="table">';
                    foreach ($product as $product) {
                     $image = 'storage/product/'.$product->cover_photo;
                        $result.='<tr style="cursor: pointer;" onclick="get_product_title(\'' .$product->title. '\')">
                                    <td>
                                        <img src="'.asset($image).'" width="40xp" height="40xp" class="img-responsive"/>
                                    </td>
                                    <td>'.$product->title.'</td>
                                 </tr>';
                    }
                    $result.='</table>';
                }
            }
            if ($request->type=="author") {
                 $author = Author::where('name', 'LIKE', '%'.$request->search.'%')
                                         ->orWhere('eng', 'LIKE', '%'.$request->search.'%')
                                         ->latest()->get();
                if ($author->count()!=0) {
                    $result.='<table class="table">';
                    foreach ($author as $author) {
                     $image = 'storage/author/'.$author->image;
                        $result.='<tr style="cursor: pointer;" onclick="get_product_title(\'' .$author->name. '\')">
                                    <td>
                                        <img src="'.asset($image).'" width="40xp" height="40xp" class="img-responsive"/>
                                    </td>
                                    <td>'.$author->name.'</td>
                                 </tr>';
                    }
                    $result.='</table>';
                }
            }
            if ($request->type=="publisher") {
                 $publisher = Publisher::where('name', 'LIKE', '%'.$request->search.'%')
                                         ->orWhere('eng', 'LIKE', '%'.$request->search.'%')
                                         ->latest()->get();
                if ($publisher->count()!=0) {
                    $result.='<table class="table">';
                    foreach ($publisher as $publisher) {
                     $image = 'storage/publisher/'.$publisher->image;
                        $result.='<tr style="cursor: pointer;" onclick="get_product_title(\'' .$publisher->name. '\')">
                                    <td>
                                        <img src="'.asset($image).'" width="40xp" height="40xp" class="img-responsive"/>
                                    </td>
                                    <td>'.$publisher->name.'</td>
                                 </tr>';
                    }
                    $result.='</table>';
                }
            }

            if ($request->type=="subject") {
                 $subject = Subject::where('name', 'LIKE', '%'.$request->search.'%')
                                         ->orWhere('eng', 'LIKE', '%'.$request->search.'%')
                                         ->latest()->get();
                if ($subject->count()!=0) {
                    $result.='<table class="table">';
                    foreach ($subject as $subject) {
                     $image = 'storage/subject/'.$subject->image;
                        $result.='<tr style="cursor: pointer;" onclick="get_product_title(\'' .$subject->name. '\')">
                                    <td>
                                        <img src="'.asset($image).'" width="40xp" height="40xp" class="img-responsive"/>
                                    </td>
                                    <td>'.$subject->name.'</td>
                                 </tr>';
                    }
                    $result.='</table>';
                }
            }

            return $result;
            
        }
        

    }

    public function search(Request $request)
    {
        $type = $request->type;
        $search = $request->search;
        $url = "type=".$type."&search=".$search;

        if ($type=="book") {
        	$query = Product::query();
        	if (isset($search)) {
        		$query = $query->where('title', 'LIKE', '%'.$search.'%');
        		$query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');
        	}
            $query = $query->select('id','author_id','title','slug','sell_price','regular_price','cover_photo','discount')->latest()->paginate(20);
            $query->withPath('?'.$url);

            $products = $query;

            $subjects = Subject::select('name','id')->get();
            $authors = Author::select('name','id')->get();
            $publishers = Publisher::select('name','id')->get();
            $title = 'বই';

            $fltr_sub ='all-subject';
            $fltr_auth ="all-author";
            $fltr_pub ='all-publisher';
            $fltr_price ='all-price';
            return view('search',compact('products','title','subjects','authors','publishers','fltr_sub','fltr_auth','fltr_pub','fltr_price','search','type'));
        }

        if ($type=="author") {
            $title = 'লেখক';
            $authors = Author::where('name','LIKE','%'.$search.'%')
            				->orWhere('eng','LIKE','%'.$search.'%')
           					->select('name','slug','image')->paginate(48);
            return view('author',compact('title','authors','search','type'));
        }

        if ($type=="publisher") {
             $title = 'প্রকাশনী';
             $publishers = Publisher::where('name','LIKE','%'.$search.'%')
             				->orWhere('eng','LIKE','%'.$search.'%')
            					->select('name','slug','image')->paginate(48);
             return view('publisher',compact('title','publishers','search','type'));
        }

        if ($type=="subject") {
            $title = 'বিষয়';
            $subjects = Subject::where('name','LIKE','%'.$search.'%')
             				->orWhere('eng','LIKE','%'.$search.'%')
            					->select('name','slug','image')->paginate(48);
            return view('subject',compact('title','subjects','search','type'));
        }

        
    }

    public function book_search(Request $request)
    {
        $type = $request->type;
        $search = $request->search;
        $url = "type=".$type."&search=".$search;

        $query = Product::query();

        if ($type=="book") {
            $query = $query->where('title', 'LIKE', '%'.$search.'%');
            $query = $query->orWhere('eng', 'LIKE', '%'.$search.'%');

            $fltr_sub ='all-subject';
            $fltr_auth ="all-author";
            $fltr_pub ='all-publisher';
            $fltr_price ='all-price';
            $title = 'বই';
        }

        if ($type=="author") {
            $cat= Author::where('name',$search)->select('id')->first();

            $query = $query->where('author_id',$cat->id);
            $query = $query->orWhere('second_author',$cat->id);

            $fltr_sub ='all-subject';
            $fltr_auth =$cat->id;
            $fltr_pub ='all-publisher';
            $fltr_price ='all-price';
            $title = 'লেখক';
        }

        if ($type=="publisher") {
            $cat= Publisher::where('name',$search)->select('id')->first();

            $query = $query->where('publisher_id',$cat->id);

           $fltr_sub ='all-subject';
           $fltr_auth ='all-author';
           $fltr_pub =$cat->id;
           $fltr_price ='all-price';
           $title = 'প্রকাশনী';
        }

        if ($type=="subject") {
            $cat= Subject::where('name',$search)->select('id')->first();

            $query = $query->where('subject_id',$cat->id);

           $fltr_sub =$cat->id;
           $fltr_auth ='all-author';
           $fltr_pub ='all-publisher';
           $fltr_price ='all-price';
           $title = 'বিষয়';
        }

        $query = $query->select('id','author_id','title','slug','sell_price','regular_price','cover_photo','discount')->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;

        $subjects = Subject::select('name','id')->get();
        $authors = Author::select('name','id')->get();
        $publishers = Publisher::select('name','id')->get();
        if ($type=="author") {
            $cat= Author::where('name',$search)->first();
            return view('author_search',compact('products','title','subjects','authors','publishers','fltr_sub','fltr_auth','fltr_pub','fltr_price','type','search','cat'));
        } else {
            return view('search',compact('products','title','subjects','authors','publishers','fltr_sub','fltr_auth','fltr_pub','fltr_price','type','search'));
        }
        
    }

    public function filter_subject(Request $request)
    {
        // return $request;
        $fltr_sub = $request->subject;
        $fltr_price = $request->price;

        $path = null;
        if (isset($fltr_sub)) {
            foreach ($fltr_sub as $url_id) {
                $path .= "&subject%5B%5D=".$url_id;
            }
        }

        if (isset($fltr_price)) {
            $path .= "&price=".$fltr_price;
        }
        
        $url = trim($path,'&');



        $query = Product::query();
        if (isset($fltr_sub)) {
            if ($fltr_sub[0]!="all-subject") {
                $query = $query->where(function ($q) use ($fltr_sub) {
                        foreach ($fltr_sub as $id) {
                            $q->orWhere('subject_id',$id);
                        }
                    });
            }
        }

        if (isset($fltr_price)) {
            if ($fltr_price!="all-price") {
                if ($fltr_price=="2000+") {
                    $query = $query->where('sell_price','>',2000);
                } else {
                    $price = explode("-",$fltr_price);
                    $min = (int)$price[0];
                    $max = (int)$price[1];
                    $query = $query->whereBetween('sell_price', [$min,$max]);
                }                
            }
        }

        $query = $query->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;

        $subjects = Subject::select('name','id')->get();
        $title = 'ফিল্টার';
        return view('filter_subject',compact('products','title','subjects','fltr_sub','fltr_auth','fltr_pub','fltr_price'));
    }

    public function filter_author(Request $request)
    {
        // return $request;
        $fltr_sub = $request->subject;
        $fltr_auth = $request->author;
        $fltr_pub = $request->publisher;
        $fltr_price = $request->price;

        $path = null;
        if (isset($fltr_sub)) {
            foreach ($fltr_sub as $url_id) {
                $path .= "&subject%5B%5D=".$url_id;
            }
        }
        $path .= "&author=".$fltr_auth;

        if (isset($fltr_pub)) {
            foreach ($fltr_pub as $url_id) {
                $path .= "&publisher%5B%5D=".$url_id;
            }
        }

        if (isset($fltr_price)) {
            $path .= "&price=".$fltr_price;
        }
        
        $url = trim($path,'&');



        $query = Product::query();
        $query = $query->where('author_id',$fltr_auth);
        if (isset($fltr_sub)) {
            if ($fltr_sub[0]!="all-subject") {
                $query = $query->where(function ($q) use ($fltr_sub) {
                        foreach ($fltr_sub as $id) {
                            $q->orWhere('subject_id',$id);
                        }
                    });
            }
        }

        if (isset($fltr_pub)) {
            if ($fltr_pub[0]!="all-publisher") {
                $query = $query->where(function ($q) use ($fltr_pub) {
                        foreach ($fltr_pub as $id) {
                            $q->orWhere('publisher_id',$id);
                        }
                    });
            }
        }

        if (isset($fltr_price)) {
            if ($fltr_price!="all-price") {
                if ($fltr_price=="2000+") {
                    $query = $query->where('sell_price','>',2000);
                } else {
                    $price = explode("-",$fltr_price);
                    $min = (int)$price[0];
                    $max = (int)$price[1];
                    $query = $query->whereBetween('sell_price', [$min,$max]);
                }                
            }
        }

        $query = $query->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;

        $sub_id =Product::where('author_id',$fltr_auth)->orWhere('second_author',$fltr_auth)->distinct()->get(['subject_id']);

        $pub_id =Product::where('author_id',$fltr_auth)->orWhere('second_author',$fltr_auth)->distinct()->get(['publisher_id']);

        if ($sub_id->count()>0) {
            $subjects = Subject::where(function ($q) use ($sub_id) {
                    foreach ($sub_id as $sub_id) {
                        $q->orWhere('id',$sub_id->subject_id);
                    }
                })->select('name','id')->get();
        } else {
            $subjects=null;
        }
        
        if ($pub_id->count()>0) {
            $publishers = Publisher::where(function ($q) use ($pub_id) {
                    foreach ($pub_id as $pub_id) {
                        $q->orWhere('id',$pub_id->publisher_id);
                    }
                })->select('name','id')->get();
        }else {
            $publishers =null;
        }

        $title = 'ফিল্টার';
        return view('filter_author',compact('products','title','subjects','authors','publishers','fltr_sub','fltr_auth','fltr_pub','fltr_price'));
    }

    public function filter_publisher(Request $request)
    {
        // return $request;
        $fltr_sub = $request->subject;
        $fltr_auth = $request->author;
        $fltr_pub = $request->publisher;
        $fltr_price = $request->price;

        $path = null;
        if (isset($fltr_sub)) {
            foreach ($fltr_sub as $url_id) {
                $path .= "&subject%5B%5D=".$url_id;
            }
        }
        if (isset($fltr_auth)) {
            foreach ($fltr_auth as $url_id) {
                $path .= "&author%5B%5D=".$url_id;
            }
        }

        $path .= "&publisher=".$fltr_pub;

        if (isset($fltr_price)) {
            $path .= "&price=".$fltr_price;
        }
        
        $url = trim($path,'&');



        $query = Product::query();
        $query = $query->where('publisher_id',$fltr_pub);
        if (isset($fltr_sub)) {
            if ($fltr_sub[0]!="all-subject") {
                $query = $query->where(function ($q) use ($fltr_sub) {
                        foreach ($fltr_sub as $id) {
                            $q->orWhere('subject_id',$id);
                        }
                    });
            }
        }

        if (isset($fltr_auth)) {
            if ($fltr_auth[0]!="all-author") {
                $query = $query->where(function ($q) use ($fltr_auth) {
                        foreach ($fltr_auth as $id) {
                            $q->orWhere('author_id',$id);
                        }
                    });
            }
        }

        if (isset($fltr_price)) {
            if ($fltr_price!="all-price") {
                if ($fltr_price=="2000+") {
                    $query = $query->where('sell_price','>',2000);
                } else {
                    $price = explode("-",$fltr_price);
                    $min = (int)$price[0];
                    $max = (int)$price[1];
                    $query = $query->whereBetween('sell_price', [$min,$max]);
                }                
            }
        }

        $query = $query->latest()->paginate(20);
        $query->withPath('?'.$url);

        $products = $query;

        $sub_id =Product::where('publisher_id',$fltr_pub)->distinct()->get(['subject_id']);

        $auth_id =Product::where('publisher_id',$fltr_pub)->distinct()->get(['author_id']);

        if ($auth_id->count()>0) {
            $subjects = Subject::where(function ($q) use ($sub_id) {
                    foreach ($sub_id as $sub_id) {
                        $q->orWhere('id',$sub_id->subject_id);
                    }
                })->select('name','id')->get();
        }else {
            $subjects = null;
        }

        if ($auth_id->count()>0) {
            $authors = Author::where(function ($q) use ($auth_id) {
                    foreach ($auth_id as $auth_id) {
                        $q->orWhere('id',$auth_id->author_id);
                    }
                })->select('name','id')->get();
        }else {
            $authors = null;
        }

        $title = 'ফিল্টার';
        return view('filter_publisher',compact('products','title','subjects','authors','fltr_sub','fltr_auth','fltr_pub','fltr_price'));
    }
}
