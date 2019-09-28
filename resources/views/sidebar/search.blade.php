<form method="get" class="form" nosubmit>
    <div class="form-group">
        <input type="search" id="q" class="form-control" placeholder="post title" onchange="
            document.getElementById('search').href = '/posts/q/' + this.value;" onkeypress="document.getElementById('search').href = '/posts/q/' + this.value;if(event.which === 13){event.preventDefault();document.getElementById('search').click();return false;}" />
    </div>
    <div class="fomr-group">
        <a href="" id="search" class="btn btn-info btn-lg btn-block">Search</a>
    </div>
</form>
