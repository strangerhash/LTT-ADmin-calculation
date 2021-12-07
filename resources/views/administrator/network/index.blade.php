@extends('administrator.layouts.app-master')

@section('content')
<style>
    ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 100px 0 0 100px
  /*padding: 0;*/
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  /*display: none;*/
}

.active {
  display: block;
}
</style>
<div class="container" style="margin-top:30px;">
    <div class="row">
        <div class="col-md-4">
            {!! $html !!}
           
        </div>
       
    </div>
</div>
@endsection

@section('scripts')
    <script>
        var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
  });
}
    </script>
@endsection
