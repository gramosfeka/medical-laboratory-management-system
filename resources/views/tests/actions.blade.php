<div class="btn-group" role="group" >
<a href="{{ route('tests.edit', ['test' => $test->id]) }}" class="btn">
        <i class="fas fa-edit">  </i>
    </a>

    <form action="{{ route('tests.destroy', ['test'=> $test->id]) }}" class="d-inline" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                <button type="submit" onclick="return confirm('Are you sure?');" style="border: 0; background: none; margin-top: 5px;">
                    <i class="far fa-trash-alt"></i>
                </button>
        </a>
    </form>
</div>
