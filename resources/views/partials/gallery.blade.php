<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
  @foreach($images as $image)
    <div class="col">
      <div class="card shadow-sm">
        <a href="<?=route('gallery.show', $image);?>">
          <img src="<?=$image->thumb;?>" class="bd-placeholder-img card-img-top"/>
        </a>
      </div>
    </div>
  @endforeach
</div>