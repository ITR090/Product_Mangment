@component('mail::message')

<div>
    You Have A comment In The Product {{$product->name}}
    <br/>
    {{$comment->content}}
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
