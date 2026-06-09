<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.replicatemasscontent.edit') ? 'active' : '' }}"

            href="{{ @$dataArr['content']->is_content_completed ? route('admin.replicatemasscontent.edit', $dataArr['content']->id) : '#' }}"
            role="tab">Step
            1 : Details</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Route::is('admin.replicatemasscontent.step.one.update') ? 'active' : '' }}"
            href="{{ @$dataArr['content']->is_content_completed ? route('admin.replicatemasscontent.step.one.update', $dataArr['content']->id) : '#' }}" role="tab">Step
            2 : Update Section</a>
    </li>
    
    
  
   
</ul>
