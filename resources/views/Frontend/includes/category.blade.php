<!-- Categories -->
<div class="categories-section">
    <div class="container">
        <h1 class="main-title">Our Categories</h1>
        <div class="row mt-4 categories">
            @foreach($category as $cat)
                <div class="col-md-3">
                    <a href="{{'/category/'.$cat->id}}">
                    <div class="category">
                        <img
                                src="{{$cat->imageUrl}}"
                        />
                        <div class="overlay">
                            <h5>{{$cat->name}}</h5>
                        </div>
                    </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
</div>