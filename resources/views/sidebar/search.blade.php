<div class="card mb-4">
    <h5 class="card-header">Search</h5>
    <div class="card-body">
        <form method="get" class="form" nosubmit>
            <div class="input-group">
                <input type="search" id="q" class="form-control"
                    placeholder="search for"
                    onchange="
            document.getElementById('search').href = '/posts/q/' + this.value;"
                    onkeypress="document.getElementById('search').href = '/posts/q/' + this.value;if(event.which === 13){event.preventDefault();document.getElementById('search').click();return false;}" />
                <span class="input-group-btn">
                    <a href="" id="search" class="btn btn-info">Go!</a>
                </span>
            </div>
        </form>
    </div>
</div>