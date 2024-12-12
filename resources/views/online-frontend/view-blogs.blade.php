<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Blog Grid Page</title>
  <!-- Bootstrap 4.5.2 CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="shortcut icon" href="../assets/image/logo/bhurr-fav-icon.png" type="image/x-icon" />
  <!-- =======custome css======== -->
  <link rel="stylesheet" href="../assets/css/stylenew.css" />
  <link rel="stylesheet" href="../assets/css/drivernew.css" />
  <link rel="stylesheet" href="../assets/css/hotelnew.css" />
  <!--============font awesome cdn============ -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .blog__grid__page .card {
      transition: 0.3s;
      border-color: #33333341;
      border-radius: 8px;
    }

    .blog__grid__page .card .card-title {
      color: black;
    }

    .blog__grid__page .card .card-title:hover {
      color: brown;
      text-decoration: underline;
    }

    .blog__grid__page .card:hover {
      box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
    }

    @media (min-width: 768px) {
      .blog__grid__page .card img {
        width: 100%;
        max-height: 200px;
        object-fit: cover;
      }
    }
  </style>
</head>

<body>
  <section class="navigation" id="navigation">
    <nav class="navbar navbar-expand-lg d-lg-block d-none" style="z-index: 100">
      <div class="container">
        <a class="navbar-brand py-0 d-flex align-items-center" href="index.html">
          <img src="../assets/image/logo/bhurr-logo.png" width="150px" alt="" />
        </a>
        <button class="navbar-toggler bg-dark" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

      </div>
    </nav>
  </section>
  <div class="container py-5 blog__grid__page">
    <h1 class="text-center mb-5">Our Blogs</h1>
    <div class="row">
      @foreach ($blogs as $blog)      
      <!-- Blog Post 1 -->
      <div class="col-md-4 mb-4">
      <div class="card h-100">
        <img src="{{asset($blog->blog_image)}}" class="card-img-top" alt="{{$blog->slug}}" />
        <div class="card-body">
        @if($blog->child_category_name)
      <a
        href="{{url('blog')}}/{{str_replace(' ', '-', strtolower($blog->child_category_name))}}/{{str_replace(' ', '-', strtolower($blog->category_name))}}/{{$blog->slug}}">
        <h5 class="card-title">
        {{$blog->title}}
        </h5>
      </a>
    @else
    <a href="{{url('blog')}}/{{str_replace(' ', '-', strtolower($blog->category_name))}}/{{$blog->slug}}">
      <h5 class="card-title">
      {{$blog->title}}
      </h5>
    </a>
  @endif
        <p class="card-text text-muted">
        {!! html_entity_decode(Str::limit($blog->description, 300)) !!}
        </p>
        </div>
      </div>
      </div>
    @endforeach
    </div>
  </div>
  <!-- Bootstrap 4.5.2 JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>