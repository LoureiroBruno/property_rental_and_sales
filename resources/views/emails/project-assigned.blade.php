@component('mail::message')
# New Project Assignment

You have been assigned to a new project.

@component('mail::button', ['url' => url('/')])
View Project
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
