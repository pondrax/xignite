<div class="row">
@foreach($media as $m)
  @if($m->url!='')
  <div class="col-md-3 img-item text-center">
    <img class="col-md-12 thumbnail" src="{{$m->url}}" alt="{{$m->title}}" />
    <i class="fa fa-check"></i>
    <span>{{$m->title}}</span>
  </div>
  @endif
@endforeach
</div>
