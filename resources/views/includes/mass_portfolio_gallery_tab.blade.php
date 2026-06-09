<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.massportfoliogallery.add') || Route::is('admin.massportfoliogallery.edit') ? 'active' : '' }}"

            href="{{ @$dataArr['content']->is_completed ? route('admin.massportfoliogallery.edit', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            1 : Details</a>
    </li>
     <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.massportfoliogallery.step.one.add.images') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_completed ? route('admin.massportfoliogallery.step.one.add.images', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            2 : 1st Section</a>
    </li> 
  
    
</ul>
