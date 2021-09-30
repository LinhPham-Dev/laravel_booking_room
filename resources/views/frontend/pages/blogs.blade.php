@extends('frontend.layouts.master')

@section('content')

<main>
    <!-- Breadcrumb section -->
    <section class="breadcrumb-area d-flex align-items-center position-relative bg-img-center"
        style="background-image:  url('{{ asset('assets/frontend')}}/img/blog/blog-breadcrumb.jpg');">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1>Blog Standard</h1>
                <ul class="list-inline">
                    <li><a href="index-2.html">Home</a></li>
                    <li><i class="far fa-angle-double-right"></i></li>
                    <li>Blogs</li>
                </ul>
            </div>
        </div>
        <h1 class="big-text">
            Blogs
        </h1>
    </section>
    <!-- Breadcrumb section End-->
    <section class="blog-wrapper section-padding section-bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter-view">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-wrap">
                                    <select name="sort" id="sort">
                                        <option value="default">Default Sorting</option>
                                        <option value="price-low-to-hight">Price Low To High</option>
                                        <option value="price-hight-to-low">Price High To Low</option>
                                        <option value="name-a-z">Name A to Z</option>
                                        <option value="name-z-a">Name Z to A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <ul class="view-option">
                                    <li><a href="#" class="item-icon toggle-grid active"><i class="fas fa-th"></i></a>
                                    </li>
                                    <li><a href="#" class="item-icon toggle-list"><i class="fa fa-list"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="item-list">
                        <div class="post-loop">
                            <div class="single-blog-wrap">
                                <div class="post-thumbnail">
                                    <img src="assets/img/blog/01.jpg" alt="Image">
                                </div>
                                <div class="post-desc">
                                    <ul class="blog-meta list-inline">
                                        <li><a href="single-blog.html"><i class="far fa-user-alt"></i>Somalia
                                                Alexz</a>
                                        </li>
                                        <li><a href="single-blog.html"><i class="far fa-calendar-alt"></i>20 jan
                                                2020</a></li>
                                    </ul>
                                    <h3><a href="single-blog-html.html">CSS Grid Challenge Build A Template, Win
                                            Some
                                            Smashing Prizes!</a></h3>
                                    <a href="single-blog.html" class="btn filled-btn">View post <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="single-blog-wrap video-post">
                                <div class="post-thumbnail">
                                    <img src="assets/img/blog/02.jpg" alt="Image">
                                    <a href="https://www.youtube.com/watch?v=NpEaa2P7qZI" class="video-popup"> <i
                                            class="fas fa-play"></i></a>
                                </div>
                                <div class="post-desc">
                                    <ul class="blog-meta list-inline">
                                        <li><a href="single-blog.html"><i class="far fa-user-alt"></i>Somalia
                                                Alexz</a>
                                        </li>
                                        <li><a href="single-blog.html"><i class="far fa-calendar-alt"></i>20 jan
                                                2020</a></li>
                                    </ul>
                                    <h3><a href="single-blog-html.html">Building Pattern Libraries With Shadow Dom
                                            in
                                            Markdown</a></h3>
                                    <a href="single-blog.html" class="btn filled-btn">View post <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="single-blog-wrap">
                                <div class="post-thumbnail">
                                    <img src="assets/img/blog/03.jpg" alt="Image">
                                </div>
                                <div class="post-desc">
                                    <ul class="blog-meta list-inline">
                                        <li><a href="single-blog.html"><i class="far fa-user-alt"></i>Somalia
                                                Alexz</a>
                                        </li>
                                        <li><a href="single-blog.html"><i class="far fa-calendar-alt"></i>20 jan
                                                2020</a></li>
                                    </ul>
                                    <h3><a href="single-blog-html.html">Challenge Yourself More Often By Creating
                                            Artwork
                                            Every Day Shadow Markdown</a></h3>
                                    <a href="single-blog.html" class="btn filled-btn">View post <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="single-blog-wrap">
                                <div class="post-thumbnail">
                                    <img src="assets/img/blog/04.jpg" alt="Image">
                                </div>
                                <div class="post-desc">
                                    <ul class="blog-meta list-inline">
                                        <li><a href="single-blog.html"><i class="far fa-user-alt"></i>Somalia
                                                Alexz</a>
                                        </li>
                                        <li><a href="single-blog.html"><i class="far fa-calendar-alt"></i>20 jan
                                                2020</a></li>
                                    </ul>
                                    <h3><a href="single-blog-html.html">Things To Keep In Mind When Designing
                                            Transportation
                                            Map Weather</a></h3>
                                    <a href="single-blog.html" class="btn filled-btn">View post <i
                                            class="far fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item-grid active">
                        <div class="post-loop">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-01.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">CSS Grid Challenge Build A Template, Win
                                                    Some
                                                    Smashing Prizes!</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-02.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">We're Touring Through Southeast Asia:
                                                    Join The
                                                    Mozilla Develop Road</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-03.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">Why Switched To Sketch For UI Design
                                                    (And Never
                                                    Looked Back) </a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-04.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">CSS Grid Challenge Build A Template, Win
                                                    Some
                                                    Smashing Prizes!</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-05.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">We're Touring Through Southeast Asia:
                                                    Join The
                                                    Mozilla Develop Road</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-06.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">Why Switched To Sketch For UI Design
                                                    (And Never
                                                    Looked Back) </a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-07.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">CSS Grid Challenge Build A Template, Win
                                                    Some
                                                    Smashing Prizes!</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="single-blog-wrap">
                                        <div class="post-thumbnail">
                                            <img src="assets/img/blog/gird-08.jpg" alt="Image">
                                        </div>
                                        <div class="post-desc">
                                            <ul class="blog-meta list-inline">
                                                <li><a href="blog-details.html"><i class="far fa-calendar-alt"></i>20
                                                        jan
                                                        2020</a></li>
                                            </ul>
                                            <h3><a href="blog-details.html">We're Touring Through Southeast Asia:
                                                    Join The
                                                    Mozilla Develop Road</a></h3>
                                            <a href="blog-details.html" class="read-more">Read More <i
                                                    class="far fa-long-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination Wrap -->
                    <div class="pagination-wrap">
                        <ul class="list-inline">
                            <li><a href="#"><i class="far fa-angle-left"></i></a></li>
                            <li class="active"><a href="#">01</a></li>
                            <li><a href="#">02</a></li>
                            <li><a href="#">03</a></li>
                            <li><a href="#"><i class="far fa-angle-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Sidebars Area -->
                    <div class="sidebar-wrap">
                        <div class="widget search-widget">
                            <h4 class="widget-title">Search Here</h4>
                            <form>
                                <input type="text" placeholder="Seacrh Keywords">
                                <button><i class="far fa-search"></i></button>
                            </form>
                        </div>
                        <div class="widget recent-news">
                            <h4 class="widget-title">Latest News</h4>
                            <ul>
                                <li>
                                    <div class="recent-post-img">
                                        <img src="assets/img/blog/rp01.jpg" alt="Image">
                                    </div>
                                    <div class="recent-post-desc">
                                        <h6><a href="#">Quick Win For Impre Perfor Securitys.</a></h6>
                                        <span class="date">05 Feb 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="recent-post-img">
                                        <img src="assets/img/blog/rp02.jpg" alt="Image">
                                    </div>
                                    <div class="recent-post-desc">
                                        <h6><a href="#">Quick Win For Impre Perfor Securitys.</a></h6>
                                        <span class="date">05 Feb 2020</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="recent-post-img">
                                        <img src="assets/img/blog/rp03.jpg" alt="Image">
                                    </div>
                                    <div class="recent-post-desc">
                                        <h6><a href="#">Quick Win For Impre Perfor Securitys.</a></h6>
                                        <span class="date">05 Feb 2020</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget category-widget">
                            <h4 class="widget-title">Gategory</h4>
                            <div class="single-cat bg-img-center"
                                style="background-image: url(assets/img/blog/cat-01.jpg);">
                                <a href="#">Luxury Room</a>
                            </div>
                            <div class="single-cat bg-img-center"
                                style="background-image: url(assets/img/blog/cat-02.jpg);">
                                <a href="#">Couple Room</a>
                            </div>
                            <div class="single-cat bg-img-center"
                                style="background-image: url(assets/img/blog/cat-03.jpg);">
                                <a href="#">Hotel Views</a>
                            </div>
                        </div>
                        <div class="widget banner-widget"
                            style="background-image: url(assets/img/blog/sidebar-banner.jpg);">
                            <h2>Booking Your Latest apartment</h2>
                            <p>Lorem ipsum dolor sit amet conse ctetur adipisicing elit sed do eiusmod tempor
                                incididunt ut labore </p>
                            <a href="#" class="btn filled-btn">BOOK NOW <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brands section start -->
    <section class="brands-section primary-bg">
        <div class="container">
            <div id="brandsSlideActive" class="row">
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/01.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/02.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/03.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/04.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/05.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/06.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/01.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/02.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/03.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/04.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/05.png" alt="Brands">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="brand-item text-center">
                        <img src="assets/img/brands/06.png" alt="Brands">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brands section End -->
</main>

@endsection
