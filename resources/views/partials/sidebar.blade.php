<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <form action="" method="GET">
                <div class="input-group">
                    <input class="form-control" type="text" name="search" value="{{ request()->query('search')}}" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                    <button class="btn btn-primary btn-sm" id="button-search" type="submit">Go!</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header"> <b>Categories</b> </div>
        <div class="card-body">
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('blog.category', $category->id)}}" style="text-decoration: none">{{$category->name}}</a></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header"> <b>Tags</b> </div>
        <div class="card-body">
            <div class="row">
                @foreach ($tags as $tag)
                <div class="col-sm-4">
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('blog.tag', $tag->id)}}" class="btn btn-sm btn-dark mb-2" style="text-decoration: none">{{$tag->name}}</a></li>
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
