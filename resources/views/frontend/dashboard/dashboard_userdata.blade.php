@php $id = Auth::user()->id;
$userData = App\Models\User::find($id);
@endphp
<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="blog-details.html">
                            <img src="{{(!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg')}}" alt="user-image" style="width: 100px; height:100px;"></a></figure>
                    <h5><a href="blog-details.html">{{$userData->name}} </a></h5>
                    <p>{{$userData->email}} </p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        @include('frontend.dashboard.dashboard_sidebar')

    </div>
</div>