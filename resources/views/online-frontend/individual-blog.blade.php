<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{$blog->seotitle}}</title>
    <meta name="description" content="{{$blog->seodescription}}">
    <link rel="canonical" href="{{Request::url()}}" />

    <meta property="og:title" content="{{$blog->social_title}}" />
    <meta property="og:description" content="{{$blog->social_description}}" />
    <meta property="og:image" content="{{asset($blog->social_image)}}" />
    <meta property="og:url" content="{{Request::url()}}" />

    <meta name="twitter:title" content="{{$blog->x_title}}" />
    <meta name="twitter:description" content="{{$blog->x_description}}" />
    <meta name="twitter:image" content="{{asset($blog->x_image)}}" />

    <meta name="robots"
        content="{{ $blog->allow_search == 'Yes' ? 'index' : 'noindex' }}, {{ $blog->follow_links == 'Yes' ? 'follow' : 'nofollow' }}" />
    <!-- Bootstrap 4.5.2 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="../assets/image/logo/bhurr-fav-icon.png" type="image/x-icon">
    <!-- =======custome css======== -->
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/driver.css" />
    <link rel="stylesheet" href="../assets/css/hotel.css" />
    <!--============font awesome cdn============ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .blog a {
            color: #000 !important;
        }

        @media (min-width:768px) {

            .individual__blog__page .blog__image {
                width: 100%;
                max-height: 400px;
                object-fit: cover;
                border-radius: 8px;
            }

            .individual__blog__page .latest-blog img {
                width: 100%;
                max-height: 120px;
                object-fit: cover;
                border-radius: 4px;
            }

            .individual__blog__page .latest-blog a {
                color: black !important;
            }

            .individual__blog__page .latest-blog a:hover {
                color: brown;
                text-decoration: underline !important;
            }

        }
    </style>
</head>

<body class="blog">
    <div class="container py-md-5 py-3   individual__blog__page">
        <div class="row">
            <div class="col-md-9 card shadow">
                <!-- Blog Header -->
                <div class="container mt-3">
                    <h1 class="">{{$blog->title}}</h1>
                    <p class=" text-muted">
                        Posted on {{date('Y-m-d', $blog->published_date)}} | By {{$blog->author}}
                    </p>
                </div <!-- Blog Image -->
                <div class="">
                    <img src="{{asset($blog->blog_image)}}" class="img-fluid blog__image" alt="{{$blog->slug}}" />
                </div>

                <!-- Blog Content -->
                <div class="container mt-5">
                    {!!html_entity_decode($blog->description)!!}
                </div>

                <!-- Back to Blog Grid Button -->
                <!-- <div class="container my-5">
                    <a href="blog.html" class="btn common__btn">Back to All Blogs</a>
                </div> -->
            </div>
            <div class="col-md-3 d-md-block mt-4 mt-md-0">
                <h4 class="mb-3">Latest Blogs</h4>
                @foreach ($featuredBlogs as $data)
                    <div class="latest-blog  mb-4">
                        <img src="{{asset($data->blog_image)}}" class="img-fluid" alt="{{$data->slug}}">
                        <h5 class="mt-2 ">
                            @if($data->child_category_name)
                                <a
                                    href="{{url('blog')}}/{{str_replace(' ', '-', strtolower($data->child_category_name))}}/{{str_replace(' ', '-', strtolower($data->category_name))}}/{{$data->slug}}">
                                    <h5 class="card-title">
                                        {{$data->title}}
                                    </h5>
                                </a>
                            @else
                                <a
                                    href="{{url('blog')}}/{{str_replace(' ', '-', strtolower($data->category_name))}}/{{$data->slug}}">
                                    <h5 class="card-title">
                                        {{$data->title}}
                                    </h5>
                                </a>
                            @endif
                        </h5>
                        <p class="text-muted">Posted on {{date('Y-m-d', $data->published_date)}} | By {{$data->author}}</p>
                    </div>
                @endforeach
                <hr>
                <h4 class="mb-3">Tags</h4>
                @foreach ($tags as $data)
                    <div class="latest-blog  mb-4">
                        <a href="{{url('/blog/' . str_replace(' ', '-', strtolower($data->name)))}}">
                            <h6 class="card-title">
                                {{$data->name}}
                            </h6>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- <section>
        <footer class="footer-section py-md-5 py-3">
            <div class="container">
                <div class="row mb-4">
                    <div class="col-md-4 d-flex justify-content-md-start justify-content-center">
                        <a href="/" class="py-2 px-2">
                            <img src="../assets/image/logo/bhurr-logo.png" alt="" />
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="row align-items-center d-md-flex">
                            <div
                                class="col-md-4 align-items-center justify-content-md-end justify-content-center d-flex">
                                <h6 class="mb-md-0 text-md-end text-center">COMING SOON</h6>
                            </div>
                            <div class="col-md-8 justify-content-md-start justify-content-center d-flex">
                                <div class="">
                                    <img src="../assets/image/logo/430X70.png" alt="" style="height: 40px" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row border-bottom pb-3">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="widget-title">ABOUT US</h5>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="widget course-links-widget">
                                    <ul class="courses-link-list">
                                        <li><a href="#">About Bhurr</a></li>
                                        <li><a href="#">Corporate</a></li>
                                        <li><a href="#">Careers</a></li>
                                        <li><a href="#">Drive with us</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="widget course-links-widget">
                                    <ul class="courses-link-list">
                                        <li><a href="#">Our offerings</a></li>
                                        <li><a href="#">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 pt-md-0 pt-3">
                        <div class="widget course-links-widget">
                            <h5 class="widget-title">BOOK & MANAGE</h5>
                            <ul class="courses-link-list">
                                <li><a href="#">Account</a></li>
                                <li><a href="#">Manage Bookings</a></li>
                                <li><a href="#">Refer & Earn</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-6 pt-md-0 pt-3">
                        <div class="widget course-links-widget">
                            <h5 class="widget-title">SUPPORT</h5>
                            <ul class="courses-link-list">
                                <li><a href="#">Contact</a></li>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Grievance Resolution</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3 col-6">
                        <div class="widget course-links-widget">
                            <ul class="courses-link-list">
                                <li><a href="#">Sitemap</a></li>
                                <li><a href="#">Terms and Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="widget course-links-widget">
                            <ul class="courses-link-list">
                                <li><a href="#">Cookie Policy</a></li>
                                <li><a href="#">GST</a></li>
                                <li><a href="#">Passenger Rights</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 justify-content-md-center justify-content-left d-flex">
                        <div class="widget newsletter-widget">
                            <div class="footer-newsletter">
                                <ul class="social__icon__list">
                                    <li>
                                        <a href=""><i class="fab fa-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fab fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-threads"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fab fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href=""><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </section> -->
    <!-- Bootstrap 4.5.2 JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{Request::url()}}"
        },
        "headline": "{{$blog->seotitle}}",
        "image": "https://demo.webwideit.solutions/blog/public/{{$blog->blog_image}}"
        },
        "datePublished": "{{date('Y-m-d', $blog->published_date)}}",
        "dateModified": "{{date('Y-m-d', $blog->published_date)}}"
    </script>
</body>

</html>